<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sub_Location;
use Illuminate\Http\Request;

class Sub_LocationController extends Controller
{
    //

    public function index()
    {
        $company = Sub_Location::all();
        return response()->json($company);
    }

    public function store(StoreSubLocationRequest $request)
    {
//        $data['name'] = $request->name;
//        $data['location_id'] = $request->location_id;
//        $location=Sub_Location::create($data);
//        return response()->json([
//            'status'=>true,
//            'data' =>$location,
//            'message' => 'location Information Added Successfully',
//        ]);

    }




    public function update(Request $request)
    {
//        $location = Sub_Location::findOrFail($request->id);
//
//        if($location)
//        {
//            $data['name']  = $request->name ? $request->name : $location->name;
//        }
//        $location->update($data);
//        return response()->json([
//            'status'=>true,
//            'data' => $location,
//            'message' => 'sub_location Information Updated Successfully',
//        ]);
    }


    public function show(Request $request)
    {
        $company = Sub_Location::findOrFail($request->id);
        return response()->json($company);
    }

    public function delete(Request $request)
    {
        Sub_Location::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Location Information deleted Successfully',
        ]);
    }

}
