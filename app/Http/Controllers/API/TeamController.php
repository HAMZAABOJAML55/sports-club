<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //

    public function index()
    {
        $invoices = Team::all();
        return response()->json($invoices);
    }

    public function store(Request $request)
    {
        $team = new Team();
        $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $team->description = $request->description;
        $team->number = $request->number;
        $team->save();
        $team->player()->attach($request->player_id);
        $team->coach()->attach($request->coach_id);
        return response()->json([
            'status'=>true,
            'message'=>'created $team successfully',
            'data'=>$team
        ]);

    }




    public function update(UpdateTeamRequest $request)
    {
        $team = Team::findOrFail($request->id);
        if($team)
        {

            $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $team->description = $request->description;
            $team->number = $request->number;
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

            return response()->json([
                'status'=>true,
                'data' => $team,
                'message' => 'Team Information Updated Successfully',
            ]);
        }
    }

    public function show(Request $request)
    {
        $team = Team::findOrFail($request->id);
        return response()->json($team);
    }

    public function delete(Request $request)
    {
        Team::where('id' ,$request->id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Team Information deleted Successfully',
        ]);
    }

}
