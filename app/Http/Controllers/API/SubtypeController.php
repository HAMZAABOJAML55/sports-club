<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subtype;
use Illuminate\Http\Request;

class SubtypeController extends Controller
{


    public function index()
    {
        $company = Subtype::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'Subtype Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = Subtype::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        Subtype::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Subtype Information deleted Successfully',
        ]);
    }

}
