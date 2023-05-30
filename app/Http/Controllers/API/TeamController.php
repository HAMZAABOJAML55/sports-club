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

    public function store(StoreTeamRequest $request)
    {
        $data['name']      =$request->name;
        $data['number']          =$request->number;
        $data['description' ]   =$request->description;
        $data['phone']       =$request->phone;
//dd($data);
        $Team=Team::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$Team,
            'message' => 'Team Information Added Successfully',
        ]);

    }




    public function update(UpdateTeamRequest $request)
    {
        $team = Team::findOrFail($request->id);
        if($team)
        {

            $data['name']      =$request->name;
            $data['number']          =$request->number;
            $data['description' ]   =$request->description;
            $data['phone']       =$request->phone;

            $team->update($data);
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
