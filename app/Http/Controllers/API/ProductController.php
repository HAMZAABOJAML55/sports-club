<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $prodects = Product::all();
        return response()->json($prodects);
    }


    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $product->description = $request->description;
        $product->price = $request->price;
        $product->product_types_id = $request->product_types_id;
        $product->save();

        return response()->json([
            'status'=>true,
            'date' => $product,
            'message' => 'Player Information Added Successfully',
        ]);

    }


    public function show(Request $request)
    {
        $prodect = Product::findOrFail($request->id);
        return response()->json($prodect);
    }


    public function update(StoreProductRequest $request)
    {
        $product = Product::findOrFail($request->id);

        if($product){
            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();
        return response()->json([
            'status'=>true,
            'data' => $product,
            'message' => 'product Information Updated Successfully',
        ]);
        }
    }


    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return response()->json([
        'status'=>true,
        'message' => 'Product Information deleted Successfully',
        ]);
    }
}
