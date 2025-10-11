<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Category,Product, Page, Order, OrderProduct};
use Illuminate\Http\Request;
use Session;
use Validator;
use Stripe;

class CartController extends Controller
{
    public function shop(Request $request)
    {
		$page = Page::where('slug','shop')->first();
        $categories = Category::where('status', 0)->get();
		$query = Product::where('status', 1);
		if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
		if ($request->filled('category')) {
			$query->where('category_id', $request->category);
		}
		if ($request->filled('extension_type')) {
			$types = (array) $request->extension_type;
			$query->whereIn('extension_type', $types);
		}
		if ($request->filled('min_price') && $request->filled('max_price')) {
			$query->whereBetween('price', [(float)$request->min_price, (float)$request->max_price]);
		}
		if ($request->filled('color')) {
			$query->whereHas('variationValues', function ($q) use ($request) {
				$q->whereHas('attribute', function ($a) {
					$a->where('slug', 'color');
				})->whereIn('attribute_value', (array) $request->color);
			});
		}
		if ($request->filled('length')) {
			$query->whereHas('variationValues', function ($q) use ($request) {
				$q->whereHas('attribute', function ($a) {
					$a->where('slug', 'length');
				})->whereIn('attribute_value', (array) $request->length);
			});
		}
		if ($request->filled('weight')) {
			$query->whereHas('variationValues', function ($q) use ($request) {
				$q->whereHas('attribute', function ($a) {
					$a->where('slug', 'weight');
				})->whereIn('attribute_value', (array) $request->weight);
			});
		}
		switch ($request->get('sort')) {
			case 'az':
				$query->orderBy('name', 'asc');
				break;
			case 'za':
				$query->orderBy('name', 'desc');
				break;
			case 'low-high':
				$query->orderBy('price', 'asc');
				break;
			case 'high-low':
				$query->orderBy('price', 'desc');
				break;
			default:
				$query->latest(); // default sorting
		}
		$products = $query->paginate(10)->appends($request->query());
		$extensionTypes = Product::select('extension_type')
			->whereNotNull('extension_type')
			->where('extension_type', '!=', '')
			->distinct()
			->pluck('extension_type');
		$colors = \App\Models\AttributeValueProduct::whereHas('attribute', fn($q) => $q->where('slug', 'colors'))
			->select('attribute_value')
			->distinct()
			->pluck('attribute_value');

		$lengths = \App\Models\AttributeValueProduct::whereHas('attribute', fn($q) => $q->where('slug', 'length'))
			->select('attribute_value')
			->distinct()
			->pluck('attribute_value');

		$weights = \App\Models\AttributeValueProduct::whereHas('attribute', fn($q) => $q->where('slug', 'weight'))
			->select('attribute_value')
			->distinct()
			->pluck('attribute_value');

        return view('shop.shop', compact('products','categories', 'page', 'extensionTypes', 'colors', 'lengths', 'weights'));
    }

    public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();
		$relatedProducts = Product::where('category_id', $product->category_id)
			->where('id', '!=', $product->id)
			->latest()
			->take(4)
			->get();
		
		$attributes = $product->variationValues()
			->with('attribute')
			->get()
			->groupBy(fn($item) => strtolower($item->attribute->slug));

		$colors = $product->variationValues()
			->whereHas('attribute', fn($q) => $q->where('slug', 'colors'))
			->select('attribute_value', 'addon')
			->get()
			->unique('attribute_value');
		$lengths = $product->variationValues()
			->whereHas('attribute', fn($q) => $q->where('slug', 'length'))
			->select('attribute_value', 'addon')
			->get()
			->unique('attribute_value');
		$weights = $product->variationValues()
			->whereHas('attribute', fn($q) => $q->where('slug', 'weight'))
			->select('attribute_value', 'addon')
			->get()
			->unique('attribute_value');
        return view('shop.product_detail',compact('product', 'relatedProducts', 'colors', 'lengths', 'weights', 'attributes'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
		if (empty($cart)) {
			return redirect()->route('home')->with('info', 'Your cart is empty. Please add some products first.');
		}
        $subtotal = collect($cart)->sum('subtotal');
		$tax = $subtotal * 0;
		$grandTotal = $subtotal + $tax;
        return view('shop.checkout', compact('cart', 'grandTotal'));
    }

	public function addWishlist(Request $request)
	{
		$user = auth()->user();
        $user->wishlist()->toggle($request->product_id);
		return redirect()->back()->with('success','Product Added to Wishlist Successfully');
	}

    public function payment(Request $request)
	{
		try {
			Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
			$customer = \Stripe\Customer::create([
				'email'       => $request->email,
				'name'        => $request->first_name . ' ' . $request->last_name,
				'phone'       => $request->phone,
				'description' => "Client Created From Website",
				'source'      => $request->stripeToken,
			]);
			$cart = session()->get('cart', []);
			if (empty($cart)) {
				return back()->with('error', 'Your cart is empty.');
			}
			$totalAmount = collect($cart)->sum(fn($item) => $item['subtotal']);
			$stripeAmount = (int) ($totalAmount * 100); // Stripe expects cents
			$charge = \Stripe\Charge::create([
				'customer'    => $customer->id,
				'amount'      => $stripeAmount,
				'currency'    => 'usd',
				'description' => "Order Payment - " . $request->first_name,
				'metadata'    => [
					'email' => $request->email,
					'phone' => $request->phone,
				],
			]);
			if ($charge->status !== 'succeeded') {
				return back()->with('stripe_error', 'Payment failed, please try again.');
			}
			$order = new Order();
			$order->name = $request->first_name . ' ' . $request->last_name;
			$order->email = $request->email;
			$order->phone = $request->phone;
			$order->zip = $request->zip;
			$order->country = $request->country;
			$order->address = $request->address;
			$order->user_id = auth()->id() ?? null;
			$order->notes = $request->notes ?? null;
			$order->payment_token = $charge->id; // Stripe charge ID
			$order->invoice = Order::generateInvoiceNumber();
			$order->payment_method = 'stripe';
			$order->amount = $totalAmount;
			$order->save();
			foreach ($cart as $item) {
				OrderProduct::create([
					'order_id'   		=> $order->id,
					'product_id' 		=> $item['id'],
					'base_price' 		=> $item['base_price'],
					'variation_price' 	=> $item['addon_total'],
					'price'      		=> $item['final_price'],
					'quantity'   		=> $item['quantity'],
					'attributes' 		=> $item['attributes'],
				]);
			}
			session()->forget('cart');
			Session::flash('success', 'Your order has been placed successfully!');
			return redirect()->route('thankyou');

		} catch (Exception $e) {
			return back()->with('stripe_error', $e->getMessage());
		}
	}

	public function addToCart(Request $request, $id){
		$product = Product::findOrFail($id);
		if ($product->stock <= 0) {
			return back()->with('error', 'This product is out of stock.');
		}
		$quantity = max(1, (int) $request->input('quantity', 1));
		$attributes = $request->input('attribute', []);
		$attributesWithAddon = [];
	    $addonTotal = 0;
		foreach ($attributes as $attrName => $attrValue) {
			$addon = $product->variationValues()
				->whereHas('attribute', fn($q) => $q->where('slug', $attrName))
				->where('attribute_value', $attrValue)
				->value('addon') ?? 0;
			$attributesWithAddon[] = [
				'name' => $attrName,
				'value' => $attrValue,
				'addon' => (float) $addon,
			];
			$addonTotal += (float) $addon;
		}
		$finalPrice = $product->price + $addonTotal;
		$cart = session()->get('cart', []);
		$cartKey = $id . '-' . md5(json_encode($attributes));
		if (isset($cart[$cartKey])) {
			$cart[$cartKey]['quantity'] += $quantity;
			if ($cart[$cartKey]['quantity'] > $product->stock) {
				$cart[$cartKey]['quantity'] = $product->stock;
			}
		} else {
			$cart[$cartKey] = [
				'id' => $product->id,
				'name' => $product->name,
				'slug' => $product->slug,
				'category' => $product->category->name,
				'category_slug' => $product->category->slug,
				'image' => $product->image,
				'base_price' => $product->price,
				'addon_total' => $addonTotal,
				'final_price' => $finalPrice,
				'quantity' => $quantity,
				'stock' => $product->stock,
				'attributes' => $attributesWithAddon,
				'subtotal' => $finalPrice * $quantity,
			];
		}
		$cart[$cartKey]['subtotal'] = $cart[$cartKey]['final_price'] * $cart[$cartKey]['quantity'];
		session()->put('cart', $cart);
		return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
	}

	public function cartIndex(){
		$cart = session()->get('cart', []);
		$subtotal = collect($cart)->sum('subtotal');
		$tax = $subtotal * 0;
		$grandTotal = $subtotal + $tax;
		return view('cart', compact('cart', 'subtotal', 'tax', 'grandTotal'));
	}

	public function cartRemove($index)
	{
		$cart = session()->get('cart', []);
		if (isset($cart[$index])) {
			unset($cart[$index]);
			session()->put('cart', array_values($cart));
		}
		return back()->with('success', 'Item removed from cart.');
	}

	public function cartUpdate(Request $request, $index)
	{
		$cart = session()->get('cart', []);
		if (!isset($cart[$index])) {
			return response()->json(['error' => 'Item not found'], 404);
		}
		$quantity = max(1, (int) $request->quantity);
		$cart[$index]['quantity'] = $quantity;
		$cart[$index]['subtotal'] = $cart[$index]['final_price'] * $quantity;
		session()->put('cart', $cart);
		$subtotal = collect($cart)->sum('subtotal');
		$tax = round($subtotal * 0.1, 2); // example tax (10%)
		$grandTotal = $subtotal + $tax;
		return response()->json([
			'success' => true,
			'quantity' => $quantity,
			'subtotal' => number_format($cart[$index]['subtotal'], 2),
			'cart_subtotal' => number_format($subtotal, 2),
			'cart_tax' => number_format($tax, 2),
			'cart_total' => number_format($grandTotal, 2),
		]);
	}
	
	public function thankyou(){
		return view('thankyou');
	}
 
}
