<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreTeamRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TeamController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {
        $invoices = Team::where('club_id',Auth::user()->club_id)->get();
        return response()->json($invoices);
    }

    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();
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

            $team = new Team();
            $team->club_id = Auth::user()->club_id;
            $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $team->description = $request->description;
            $team->number = $request->number;
            $team->team_member = $request->team_member;
            $team->save();
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/teams/' . $team->id);
                $team->image_path = $_image;
                $team->save();
            }
            //important to update player
            if(isset($request->player_id)) {
//            dd("hgyhg");
                $team->player()->attach($request->player_id);
            }
            //important to update coach
            if(isset($request->coach_id)) {
                $team->coach()->attach($request->coach_id);
            }


            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'message'=>'created $team successfully',
                'data'=>$team
            ]);

        } catch (\Throwable $ex) {
            DB::commit();  // insert data
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function update(StoreTeamRequest $request)
    {
        DB::beginTransaction();
        try {
            #to check if id found
            $team = Team::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$team){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Team id not found'
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
            $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $team->description = $request->description;
            $team->number = $request->number;
            $team->team_member = $request->team_member;

            //important to update player
            if(isset($request->player_id)) {
                $team->player()->sync($request->player_id);
            } else {
                $team->player()->sync(array());
            }

            //important to update coach
            if(isset($request->coach_id)) {
                $team->coach()->sync($request->coach_id);
            } else {
                $team->coach()->sync(array());
            }
            $team->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('teams',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/teams/' . $team->id);
                $team->image_path = $_image;
                $team->save();
            }
            DB::commit();  // insert data

            return response()->json([
                'status'=>true,
                'data' => $team,
                'message' => 'Team Information Updated Successfully',
            ]);
        } catch (\Throwable $ex) {
            DB::rollback();

            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function show(Request $request)
    {
        try {
            $team = Team::where('club_id',Auth::user()->club_id)->find($request->id);
            if(!$team){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Team id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            return response()->json($team);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function destroy(Request $request)
    {
        try {
            $team = Team::find($request->id);
            if(!$team){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Team id not found'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $this->deleteFile('teams',$request->id);
            $team->delete();
            return response()->json([
                'status'=>true,
                'message' => 'Team Information deleted Successfully',
            ]);

        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

}
