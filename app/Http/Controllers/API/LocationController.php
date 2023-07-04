<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //

    public function index()
    {
        $company = location::all();
        return response()->json($company);
    }

    public function store(StoreLocationRequest $request)
    {
//        $data['name'] = $request->name;
////dd($data);
//        $location=location::create($data);
//        return response()->json([
//            'status'=>true,
//            'data' =>$location,
//            'message' => 'location Information Added Successfully',
//        ]);

    }




    public function update(Request $request)
    {
//        $location = location::findOrFail($request->id);
//
//        if($location)
//        {
//            $data['name']  = $request->name ? $request->name : $location->name;
//        }
//        $location->update($data);
//        return response()->json([
//            'status'=>true,
//            'data' => $location,
//            'message' => 'location Information Updated Successfully',
//        ]);
    }


    public function show(Request $request)
    {
        $company = Location::findOrFail($request->id);
        return response()->json($company);
    }

    public function delete(Request $request)
    {
        Location::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Location Information deleted Successfully',
        ]);
    }

}
