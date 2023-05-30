<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Models\Tournament;
use Illuminate\Http\Request;


class TournamentController extends Controller
{

    public function index()
    {
        $professions = Tournament::all();
        return response()->json($professions);
    }

    public function store(StoreTournamentRequest $request)
    {
        $profession = Tournament::create($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'created Tournament successfully',
            'data'=>$profession
        ]);
    }


    public function show(Request $request)
    {
        $Tournament = Tournament::findOrFail($request->id);
        if($Tournament)
        {
            return response()->json([
                'status'=>true,
                'message'=>'update Tournament',
                'data'=>$Tournament
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message' => 'Tournament Information Updated error',
            ]);
        }
    }


    public function update(Request $request)
    {
        $Tournament = Tournament::findOrFail($request->id);

        if($Tournament)
        {
            $data['name']  = $request->name ? $request->name : $Tournament->name;
            $data['description']  = $request->description ;
            $data['start_time']  = $request->start_time ;
            $data['end_time']  = $request->end_time ;
            $data['prizes_id']  = $request->prizes_id;
            $Tournament->update($data);
            return response()->json([
                'status'=>true,
                'message'=>'update Tournament',
                'data'=>$Tournament
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message' => 'Tournament Information Updated error',
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $profession = Tournament::findOrFail($request->id);
        if($profession)
        {
            $profession->delete();
            return response()->json([
                'status'=>true,
                'message' => 'Tournament Information deleted Successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message' => 'not found Tournament',
            ]);
        }
    }
}
