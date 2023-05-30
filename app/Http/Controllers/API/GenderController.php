<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    //

    public function index()
    {
        $company = Gender::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'Gender Information Successfully',
        ]);
    }

    public function store(Request $request)
    {
        $data['name'] = $request->name;
//dd($data);
        $location=Gender::create($data);
        return response()->json([
            'status'=>true,
            'data' =>$location,
            'message' => 'Gender Information Added Successfully',
        ]);

    }



//UpdateNatinalityRequest
    public function update(Request $request)
    {
        $location = Gender::findOrFail($request->id);

        if($location)
        {
            $data['name']  = $request->name ? $request->name : $location->name;
        }
        $location->update($data);
        return response()->json([
            'status'=>true,
            'data' => $location,
            'message' => 'Gender Information Updated Successfully',
        ]);
    }


    public function show(Request $request)
    {
        $company = Gender::findOrFail($request->id);
//        dd($company);
        return response()->json($company);
    }

    public function delete(Request $request)
    {
        Gender::find($request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Natinality Information deleted Successfully',
        ]);
    }

}
