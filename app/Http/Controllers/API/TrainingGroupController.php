<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TrainingGroup;
use Illuminate\Http\Request;

class TrainingGroupController extends Controller
{


    public function index()
    {
        $company = TrainingGroup::all();
        return response()->json([
            'status'=>true,
            'data' =>$company,
            'message' => 'TrainingGroup Information Successfully',
        ]);
    }

    public function show(Request $request)
    {
        $company = TrainingGroup::findOrFail($request->id);

        return response()->json($company);
    }

    public function delete($id)
    {
        TrainingGroup::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'TrainingGroup Information deleted Successfully',
        ]);
    }

}
