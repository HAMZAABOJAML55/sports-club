<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ChampionshipLevel;
use Illuminate\Http\Request;

class ChampionshipLevelController extends Controller
{


    public function index()
    {
        $company = ChampionshipLevel::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'ChampionshipLevel Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = ChampionshipLevel::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        ChampionshipLevel::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'ChampionshipLevel Information deleted Successfully',
        ]);
    }

}
