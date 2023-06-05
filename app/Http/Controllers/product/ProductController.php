<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products=Product::all();
        return view('pages.product.index', compact('products'));
    }


    public function create()
    {
        $types=ProductType::all();
        return view('pages.product.create', compact('types'));
    }


    public function store(Request $request)
    {
        try {
            $product = new Product();
            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $types=ProductType::all();
        $products=Product::findorfail($id);
        return view('pages.product.edit', compact('types','products'));
    }


    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($request->id);
            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Product::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('product.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
