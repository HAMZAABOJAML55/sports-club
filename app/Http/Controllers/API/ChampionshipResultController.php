<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\ChampionshipResult;
use App\Models\Player;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ChampionshipResultController extends Controller
{
use GeneralTrait;
use imageTrait;
    public function index()
    {
        $results = ChampionshipResult::where('club_id',Auth::user()->club_id)->get();
        return response()->json($results);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                "championship_id" => "required|integer|unique:championship_results,championship_id",
                "tournament_id" => "required|integer",
                "player_id" => "required|integer",
                "player_score" => "required|string",
                "performance_evolution" => "string",
                "player_notes" => "string",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            if(isset($request->player_id)) {
                $player = Player::where('club_id', Auth::user()->club_id)->find($request->player_id);
                if (!$player) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'player not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            if(isset($request->tournament_id)) {
                $tournament = Tournament::where('club_id', Auth::user()->club_id)->find($request->tournament_id);
                if (!$tournament) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'tournament not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            $result = new ChampionshipResult();
            $result->club_id = Auth::user()->club_id;
            $result->championship_id = $request->championship_id;
            $result->tournament_id = $request->tournament_id;
            $result->player_id = $request->player_id;
            $result->player_score = $request->player_score;
            $result->performance_evolution = $request->performance_evolution;
            $result->player_notes = $request->player_notes;
            $result->save();

            return response()->json([
                'status' => true,
                'date' => $result,
                'message' => 'ChampionshipResult Information Added Successfully',
            ]);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function show(Request $request)
    {
        $result= ChampionshipResult::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$result) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'result not found',
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => true,
            'data' => $result
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                "championship_id" => "required|integer",
                "tournament_id" => "required|integer",
                "player_id" => "required|integer",
                "player_score" => "required|string",
                "performance_evolution" => "string",
                "player_notes" => "string",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
            if(isset($request->player_id)) {
                $player = Player::where('club_id', Auth::user()->club_id)->find($request->player_id);
                if (!$player) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'player not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            if(isset($request->tournament_id)) {
                $tournament = Tournament::where('club_id', Auth::user()->club_id)->find($request->tournament_id);
                if (!$tournament) {
                    return response()->json([
                        'status' => 'Error',
                        'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                        'message' => 'tournament not found',
                        'data' => []
                    ], ResponseAlias::HTTP_NOT_FOUND);
                }
            }
            $result = ChampionshipResult::where('club_id',Auth::user()->club_id)->find($request->id);
            if (!$result) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'result not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $result->championship_id = $request->championship_id;
            $result->tournament_id = $request->tournament_id;
            $result->player_id = $request->player_id;
            $result->player_score = $request->player_score;
            $result->performance_evolution = $request->performance_evolution;
            $result->player_notes = $request->player_notes;
            $result->save();

            return response()->json([
                'status' => true,
                'date' => $result,
                'message' => 'ChampionshipResult Information Updated Successfully',
            ]);
        } catch (\Throwable $ex) {

            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        $result= ChampionshipResult::where('club_id',Auth::user()->club_id)->find($request->id);
        if (!$result) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'result not found',
                'data' => []
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $this->deleteFile('results',$request->id);
        $result->delete();
        return response()->json([
            'status' => true,
            'message' => 'ChampionshipResult Information deleted Successfully',
        ]);
    }
}
