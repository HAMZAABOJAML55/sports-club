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
        $tournament = new Tournament();
        $tournament->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $tournament->description = $request->description;
        $tournament->number = $request->number;
        $tournament->start_time = $request->start_time;
        $tournament->end_time = $request->end_time;
        $tournament->tournament_type_id = $request->tournament_type_id;
        $tournament->prize_type_id = $request->prize_type_id;
        $tournament->championship_levels_id = $request->championship_levels_id;
        $tournament->save();
        $tournament->player()->attach($request->player_id);
        $tournament->coach()->attach($request->coach_id);
        return response()->json([
            'status'=>true,
            'message'=>'created Tournament successfully',
            'data'=>$tournament
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
        $tournament = Tournament::findOrFail($request->id);

        if($tournament)
        {
            $tournament->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $tournament->description = $request->description;
            $tournament->number = $request->number;
            $tournament->start_time = $request->start_time;
            $tournament->end_time = $request->end_time;
            $tournament->tournament_type_id = $request->tournament_type_id;
            $tournament->prize_type_id = $request->prize_type_id;
            $tournament->championship_levels_id = $request->championship_levels_id;
            //important to update player
            if(isset($request->player_id)) {
                $tournament->player()->sync($request->player_id);
            } else {
                $tournament->player()->sync(array());
            }

            //important to update coach
            if(isset($request->coach_id)) {
                $tournament->coach()->sync($request->coach_id);
            } else {
                $tournament->coach()->sync(array());
            }
            $tournament->save();

            return response()->json([
                'status'=>true,
                'message'=>'update Tournament',
                'data'=>$tournament
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
