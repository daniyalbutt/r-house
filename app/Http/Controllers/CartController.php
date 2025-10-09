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
		$query = Product::query();
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
        return view('shop.product_detail',compact('product', 'relatedProducts'));
    }

    public function checkout()
    {
        return view('shop.checkout');
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

 
}
