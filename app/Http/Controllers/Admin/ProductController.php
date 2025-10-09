<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use DB;
use File;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValueProduct;

class ProductController extends Controller
{
    public function removeColumns($columns, $columsToBeRemove)
    {
        foreach ($columsToBeRemove as $value) {
            if (($key = array_search($value, $columns)) !== false) {
                unset($columns[$key]);
            }
        }
        return $columns;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = new Product();

        if ($search != null) {
            $query = Product::query();

            $table = $data->getTable();

            $columns = ['name', 'slug', 'short_desc', 'description'];

            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }
            $data = $query->orderBy('name')->paginate(12);

            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        } else {
            $data = $data->paginate(12);
            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        }
        return view('admin.product.index', compact('data'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;
        $attributes = Attribute::where('status', 0)->get();
        return view("admin.product.create", compact('data', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/products')) or File::makeDirectory(public_path('uploads/products'), 0777, true, true);
            $fileName =  time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $fileName);
        }
        $data = array_merge($request->except(['image', '_token', 'gallery']), ['image' => 'uploads/products/' . $fileName]);
        if ($request->hasFile('gallery')) {
            $productImages = [];
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time() . '_' . strval($key + 1) . '.' . $file->extension();
                $file->move(public_path('uploads/products'), $fileName);
                array_push($productImages, 'uploads/products/' . $fileName);
            }
            $data = array_merge($data, ['images' => $productImages]);
        }
        $product = Product::create($data);

        if (!collect($request->variation)->map(function ($values) {
            return collect($values)->filter(fn($value) => !is_null($value))->isEmpty();
        })->contains(false)) {
            return response()->json(['status' => false, 'message' => 'All values are null or empty.']);
        } else {
            if (!empty($request->variation['attrbuite_values'])) {
                foreach ($request->variation['attrbuite_values'] as $i => $valueName) {
                    if (!empty($valueName)) {
                        $attributeId = $request->variation['attrbuite'][$i];
                        $addon = $request->variation['addon'][$i] ?? 0;
                        $imagePath = null;
                        if (!empty($request->variation['image'][$i])) {
                            File::isDirectory(public_path('uploads/pro-attr'))
                                || File::makeDirectory(public_path('uploads/pro-attr'), 0777, true, true);

                            $file = $request->variation['image'][$i];
                            $imgName = time() . uniqid() . '.' . $file->extension();
                            $file->move(public_path('uploads/pro-attr'), $imgName);
                            $imagePath = 'uploads/pro-attr/' . $imgName;
                        }
                        AttributeValueProduct::create([
                            'product_id' => $product->id,
                            'attribute_id' => $attributeId,
                            'attribute_value' => $valueName,
                            'addon' => $addon,
                            'image' => $imagePath,
                        ]);
                    }
                }
            }
        }
        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (routePermissionGiven('edit product')) {
            $data = Product::with('attributeValueProducts.attribute')->find($id);
            $attributes = Attribute::where('status', 0)->get();
            return view('admin.product.create', compact('data', 'attributes'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $request->validated();

        $product = Product::findOrFail($id);
        $data = $request->except(['image', '_token', '_method', 'gallery', 'variation']);

        // --- Handle main image ---
        if ($request->hasFile('image')) {
            if (File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }

            File::isDirectory(public_path('uploads/products')) 
                or File::makeDirectory(public_path('uploads/products'), 0777, true, true);

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $fileName);
            $data['image'] = 'uploads/products/' . $fileName;
        }

        // --- Handle gallery images ---
        if ($request->hasFile('gallery')) {
            $productImages = [];
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time() . '_' . ($key + 1) . '.' . $file->extension();
                $file->move(public_path('uploads/products'), $fileName);
                $productImages[] = 'uploads/products/' . $fileName;
            }
            $data['images'] = $productImages;
        }

        $product->update($data);

        if (!empty($request->variation['attrbuite_values'])) {
            foreach ($request->variation['attrbuite_values'] as $i => $valueName) {
                if (!empty($valueName)) {
                    $attributeId = $request->variation['attrbuite'][$i];
                    $addon = $request->variation['addon'][$i] ?? 0;
                    $imagePath = null;

                    if (!empty($request->variation['image'][$i])) {
                        File::isDirectory(public_path('uploads/pro-attr'))
                            or File::makeDirectory(public_path('uploads/pro-attr'), 0777, true, true);

                        $file = $request->variation['image'][$i];
                        $imgName = time() . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/pro-attr'), $imgName);
                        $imagePath = 'uploads/pro-attr/' . $imgName;
                    }

                    AttributeValueProduct::create([
                        'product_id' => $product->id,
                        'attribute_id' => $attributeId,
                        'attribute_value' => $valueName,
                        'addon' => $addon,
                        'image' => $imagePath,
                    ]);
                }
            }
        }

        return response()->json(['status' => true]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product)
        {
            DB::table('order_products')->where('product_id',$product->id)->delete();
        }
        //delete image
        if (File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        //delete images
        $productImages = $product->images;
        if(count($productImages) > 0)
        {
            foreach($productImages as $image)
            {
                if (File::exists(public_path($image))) {
                    File::delete(public_path($image));
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted');
    }

    public function deleteImages(Request $request)
    {
        if (File::exists(public_path($request->input('path')))) {
            File::delete(public_path($request->input('path')));
        }
        $product = Product::find($request->input('key'));
        $imagesArray = $product->images;
        if (($key = array_search($request->input('path'), $imagesArray)) !== false) {
            unset($imagesArray[$key]);
        }
        $product->update(['images' => $imagesArray]);
        return response()->json(['status' => true]);
    }

    public function deleteVariation(Request $request)
    {
        DB::table('attribute_value_product')->where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }

    public function attributes(Request $request)
    {
        $attribute = Attribute::where('status', 0)->get();
        if ($attribute->isNotEmpty()) {
            return response()->json(['status' => true, 'data' => $attribute]);
        } else {
            return response()->json(['status' => false, 'data' => []]);
        }
    }

    public function hasNullValues(array $data): bool
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if ($this->hasNullValues($value)) {
                    return true;
                }
            } elseif ($value === null || $value === "null") {
                return true;
            }
        }
        return false;
    }
}
