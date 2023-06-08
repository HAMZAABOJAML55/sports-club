<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Location;
use App\Models\Natinality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    //

    public function index()
    {
        $company = Natinality::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'Natinality Information Successfully',
        ]);
    }

    public function store(Request $request)
    {
//        $data['name'] = $request->name;
////dd($data);
//        $location=Natinality::create($data);
//        return response()->json([
//            'status'=>true,
//            'data' =>$location,
//            'message' => 'Natinality Information Added Successfully',
//        ]);

    }



//UpdateNatinalityRequest
    public function update(Request $request)
    {
//        $location = Natinality::findOrFail($request->id);
//
//        if($location)
//        {
//            $data['name']  = $request->name ? $request->name : $location->name;
//        }
//        $location->update($data);
//        return response()->json([
//            'status'=>true,
//            'data' => $location,
//            'message' => 'Natinality Information Updated Successfully',
//        ]);
    }


    public function show(Request $request)
    {
        $company = Natinality::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        Natinality::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Natinality Information deleted Successfully',
        ]);
    }

}
