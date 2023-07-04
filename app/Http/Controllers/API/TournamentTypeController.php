<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TournamentType;
use Illuminate\Http\Request;

class TournamentTypeController extends Controller
{


    public function index()
    {
        $company = TournamentType::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'TournamentType Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = TournamentType::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        TournamentType::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'TournamentType Information deleted Successfully',
        ]);
    }

}
