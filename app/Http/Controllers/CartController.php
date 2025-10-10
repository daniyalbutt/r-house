<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Category,Product, Page};
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
		
			try	{
				
				try {
					Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

					$customer = \Stripe\Customer::create(array(
						'email' => $request->email,
						'name' => $request->first_name,
						'phone' => $request->phone,
						'description' => "Client Created From Website",
						'source'  => $request->stripeToken,
					));
				} catch (Exception $e) {
					return redirect()->back()->with('stripe_error', $e->getMessage());
				}
				
				try {
					
					$charge = \Stripe\Charge::create(array(
						'customer' => $customer->id,
						'amount'   =>  120,
						'currency' => 'USD',
						'description' => "Payment From Website",
						'metadata' => array("name" => $request->first_name, "email" => $request->email),
					));
				} catch (Exception $e) {

					return redirect()->back()->with('stripe_error', $e->getMessage());
				}
			}
			catch (Exception $e) {
				return redirect()->back()->with('stripe_error', $e->getMessage());
			}
			
			$chargeJson = $charge->jsonSerialize();
	

		Session::flash('message', 'Your Order has been placed Successfully');	
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
			if ($request->ajax()) {
				return response()->json(['error' => 'Item not found'], 404);
			}
			return back()->with('error', 'Item not found.');
		}

		$quantity = max(1, (int) $request->quantity);
		$cart[$index]['quantity'] = $quantity;
		$cart[$index]['subtotal'] = $cart[$index]['final_price'] * $quantity;

		session()->put('cart', $cart);

		// Recalculate cart total
		$cartTotal = collect($cart)->sum('subtotal');

		if ($request->ajax()) {
			return response()->json([
				'success' => true,
				'quantity' => $quantity,
				'subtotal' => number_format($cart[$index]['subtotal'], 2),
				'cart_total' => number_format($cartTotal, 2),
			]);
		}

		return back()->with('success', 'Cart updated successfully.');
	}


 
}
