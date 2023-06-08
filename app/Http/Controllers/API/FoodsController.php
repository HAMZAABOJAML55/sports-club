<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreFoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request)
    {
        $food = new Food();
        $food->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $food->foodsystem_id = $request->foodsystem_id;
        $food->number = $request->number;
        $food->start_time = $request->start_time;
        $food->end_time = $request->end_time;
        $food->description = $request->description;
        $food->save();
        return response()->json([
            'status'=>true,
            'date' => $food,
            'message' => 'Food Information Added Successfully',
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
        $food = Food::findOrFail($request->id);
        return response()->json($food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFoodRequest $request)
    {   $food = Food::findOrFail($request->id);
        if($food){
            $food->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $food->foodsystem_id = $request->foodsystem_id;
            $food->number = $request->number;
            $food->start_time = $request->start_time;
            $food->end_time = $request->end_time;
            $food->description = $request->description;
            $food->save();
            return response()->json([
                'status'=>true,
                'data' => $food,
                'message' => 'Food Information Updated Successfully',
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
        Food::find($request->id)->delete();
        return response()->json([
        'status'=>true,
        'message' => 'food Information deleted Successfully',
        ]);
    }

}



