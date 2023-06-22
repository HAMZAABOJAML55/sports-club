<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }


    public function edit(Image $image)
    {
        //
    }


    public function update(Request $request)
    {
//        return $request;
//        $name_product=Product::findorfail($request->id);
//
//        if ($request->hasfile('photos')) {
//            foreach ($request->file('photos') as $file) {
//                $name = $file->getClientOriginalName();
//                $file->storeAs('attachments/product/'.$name_product->name,$file->getClientOriginalName(), 'upload_attachments');
//                // insert in image_table
//                $images = new Image();
//                $images->file_name = $name;
//                $images->imageable_id = $request->id;
//                $images->imageable_type = 'App\Models\Product';
//                $images->save();
//            }
//        }
//        session()->flash('Add', trans('notifi.add'));
//        return redirect()->route('product.show', $request->id);
    }


    public function destroy(Request $request ,Image $image)
    {
//        return $request;
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/product/' . $request->product_name . '/' . $request->file_name);
        // Delete in data
        Image::where('id',$request->id)->where('file_name', $request->file_name)->delete();
        session()->flash('delete', trans('notifi.delete'));
        return redirect()->route('product.show', $request->product_id);
    }
}
