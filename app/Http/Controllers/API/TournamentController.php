<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Http\Traits\GeneralTrait;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class TournamentController extends Controller
{
use GeneralTrait;
    public function index()
    {
        $professions = Tournament::where('club_id',Auth::user()->club_id)->get();
        return response()->json($professions);
    }
    public function store(StoreTournamentRequest $request)
    {
        try {
            #to check if id found
            if(isset($request->player_id)) {
                $Player = Player::where('club_id',Auth::user()->club_id)->find($request->player_id);
                if(!$Player)
                {
                    return response()->json([
                        'status' => 'Error',
                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'player id not found'
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            if(isset($request->coach_id)) {
                $coach = Coach::where('club_id',Auth::user()->club_id)->find($request->coach_id);
                if(!$coach)
                {
                    return response()->json([
                        'status' => 'Error',
                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'coach id id not found'
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }

            $tournament = new Tournament();
            $tournament->club_id = Auth::user()->club_id;
            $tournament->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $tournament->description = $request->description;
            $tournament->number = $request->number;
            $tournament->start_time = $request->start_time;
            $tournament->end_time = $request->end_time;
            $tournament->tournament_type_id = $request->tournament_type_id;
            $tournament->prize_type_id = $request->prize_type_id;
            $tournament->championship_levels_id = $request->championship_levels_id;
            $tournament->save();
            //important to update player
            if(isset($request->player_id)) {
//            dd("hgyhg");
                $tournament->player()->attach($request->player_id);
            }
            //important to update coach
            if(isset($request->coach_id)) {
                $tournament->coach()->attach($request->coach_id);
            }

            return response()->json([
                'status'=>true,
                'message'=>'created $tournament successfully',
                'data'=>$tournament
            ]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }



    public function show(Request $request)
    {
        #to check if id found
        $tournament = Tournament::where('club_id',Auth::user()->club_id)->find($request->id);
        if(!$tournament){
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'Tournament id not found'
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

            return response()->json([
                'status'=>true,
                'message'=>'update Tournament',
                'data'=>$tournament
            ]);

    }

    public function update(StoreTournamentRequest $request)
    {
        try {

            #to check if id found
            $tournament = Tournament::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$tournament){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Tournament id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            if(isset($request->player_id)) {
                $Player = Player::where('club_id',Auth::user()->club_id)->find($request->player_id);
                if(!$Player)
                {
                    return response()->json([
                        'status' => 'Error',
                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'player id not found'
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            if(isset($request->coach_id)) {
                $coach = Coach::where('club_id',Auth::user()->club_id)->find($request->coach_id);
                if(!$coach)
                {
                    return response()->json([
                        'status' => 'Error',
                        'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'coach id id not found'
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }

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
                'data' => $tournament,
                'message' => '$tournament Information Updated Successfully',
            ]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function destroy(Request $request)
    {
        try {
            $Tournament = Tournament::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$Tournament)
            {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Tournament not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $Tournament->delete();
            return response()->json([
                'status'=>true,
                'message' => 'Tournament deleted Successfully',
            ],200);


        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}
