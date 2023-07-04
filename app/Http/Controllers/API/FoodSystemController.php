<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChampionshipLevel;
use App\Models\Foodsystem;
use Illuminate\Http\Request;

class FoodSystemController extends Controller
{


    public function index()
    {
        $company = Foodsystem::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'FoodSystem Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = Foodsystem::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        ChampionshipLevel::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'FoodSystem Information deleted Successfully',
        ]);
    }

}
