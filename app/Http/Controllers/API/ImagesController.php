<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return response()->json($images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['file_name'] = $request->file_name ;
        $data['imageable_type'] = $request->imageable_type ;
        $data['imageable_id'] = $request->imageable_id ;



        $image = Image::create($data);
        return response()->json([
            'status'=> true,
            'date' => $image,
            'message' => 'Image  Added Successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $image = Image::findOrFail($id);
            if($image)
            {
                $data['file_name'] = $request->file_name ? $request->file_name : $image->file_name;
                $data['imageable_type'] = $request->imageable_type ? $request->imageable_type : $image->imageable_type;
                $data['imageable_id'] = $request->imageable_id ? $request->imageable_id : $image->imageable_id;

                $image->update($data);
                return response()->json([
                    'status'=>true,
                    'date' =>$image,
                    'message' => 'Image  Update Successfully',
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Image::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Image deleted Successfully',
        ]);
    }
}
