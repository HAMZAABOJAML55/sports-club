<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodects = Product::all();
        return response()->json($prodects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $data[ 'name'] =$request->name ;
        $data['player_id'] = $request->player_id;
        $data[ 'description'] =$request->description ;
        $data[ 'price'] =$request->price ;


        $product = Product::create($data);
        return response()->json([
            'status'=>true,
            'date' => $product,
            'message' => 'Player Information Added Successfully',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $prodect = Product::findOrFail($request->id);
        return response()->json($prodect);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request)
    {
        $product = Product::findOrFail($request->id);

        if($product){
            $data[ 'name'] =$request->name ;
            $data['player_id'] = $request->player_id;
            $data[ 'description'] =$request->description ;
            $data[ 'price'] =$request->price ;

        $product->update($data);
        return response()->json([
            'status'=>true,
            'data' => $product,
            'message' => 'product Information Updated Successfully',
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
        Product::find($request->id)->delete();
        return response()->json([
        'status'=>true,
        'message' => 'Prodect Information deleted Successfully',
        ]);
    }
}
