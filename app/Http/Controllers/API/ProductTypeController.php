<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{


    public function index()
    {
        $company = ProductType::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'ProductType Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = ProductType::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        ProductType::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'ProductType Information deleted Successfully',
        ]);
    }

}
