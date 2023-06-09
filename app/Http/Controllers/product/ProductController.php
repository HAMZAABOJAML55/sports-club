<?php

namespace App\Http\Controllers\product;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try {

            $product = new Product();
            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();
            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/product/' . $product->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->file_name = $name;
                    $images->imageable_id = $product->id;
                    $images->imageable_type = 'App\Models\Product';
                    $images->save();
                }
            }
            DB::commit();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('product.index');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {

        $img=Image::where('imageable_id',$id)->get();
        return view('pages.product.show', compact('img','id'));
    }

    public function edit($id)
    {
        $types=ProductType::all();
        $products=Product::findorfail($id);
        return view('pages.product.edit', compact('types','products'));
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $product = Product::findOrFail($request->id);
            $product->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $product->description = $request->description;
            $product->price = $request->price;
            $product->product_types_id = $request->product_types_id;
            $product->save();
            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/product/' . $product->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->file_name = $name;
                    $images->imageable_id = $product->id;
                    $images->imageable_type = 'App\Models\Product';
                    $images->save();
                }
            }
            DB::commit();
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('product.index');

        } catch (\Exception $e) {
            DB::rollback();
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
