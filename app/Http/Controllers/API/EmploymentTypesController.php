<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employment_type;
use Illuminate\Http\Request;

class EmploymentTypesController extends Controller
{


    public function index()
    {
        $company = Employment_type::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'Employment_type Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = Employment_type::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        Employment_type::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Employment_type Information deleted Successfully',
        ]);
    }

}
