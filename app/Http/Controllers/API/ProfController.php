<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prof;
use Illuminate\Http\Request;

class ProfController extends Controller
{
    //

    public function index()
    {
        $prof = Prof::all();
        return response()->json([
            'status'=>true,
            'data' =>$prof,
            'message' => 'activity Information Successfully',
        ]);
    }

    public function store(Request $request)
    {
//        $data['name'] = $request->name;
////dd($data);
//        $location=Prof::create($data);
//        return response()->json([
//            'status'=>true,
//            'data' =>$location,
//            'message' => 'Prof Information Added Successfully',
//        ]);

    }



//UpdateNatinalityRequest
    public function update(Request $request)
    {
//        $location = Prof::findOrFail($request->id);
//
//        if($location)
//        {
//            $data['name']  = $request->name ? $request->name : $location->name;
//        }
//        $location->update($data);
//        return response()->json([
//            'status'=>true,
//            'data' => $location,
//            'message' => 'Prof Information Updated Successfully',
//        ]);
    }


    public function show(Request $request)
    {
        $prof = Prof::findOrFail($request->id);
//        dd($prof);
        return response()->json($prof);
    }

    public function delete(Request $request)
    {
//        Prof::find($request->id)->delete();
//        return response()->json([
//            'status'=>true,
//            'message' => 'activity Information deleted Successfully',
//        ]);
    }

}
