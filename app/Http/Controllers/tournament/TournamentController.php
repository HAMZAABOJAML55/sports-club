<?php

namespace App\Http\Controllers\tournament;
use App\Http\Controllers\Controller;
use App\Models\ChampionshipLevel;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Prize;
use App\Models\Tournament;
use App\Models\TournamentType;
use Illuminate\Http\Request;

class TournamentController extends Controller
{

    public function index()
    {
        $tournaments=Tournament::all();
        return view('pages.tournament.index',compact('tournaments'));

    }

    public function create()
    {
        $tournament_types=TournamentType::all();
        $prizes=Prize::all();
        $coachs=Coach::all();
        $players=Player::all();
        $championship_levels=ChampionshipLevel::all();
        return view('pages.tournament.create', compact('players','coachs','tournament_types','prizes','championship_levels'));
    }

    public function store(Request $request)
    {
        try {
//            return $request;
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
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('tournament.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $tournament_types=TournamentType::all();
        $prizes=Prize::all();
        $coachs=Coach::all();
        $players=Player::all();
        $championship_levels=ChampionshipLevel::all();
        $tournaments=Tournament::findorfail($id);
        return view('pages.tournament.edit', compact('players','coachs','prizes','tournament_types','tournaments','championship_levels'));
    }


    public function update(Request $request)
    {
        try {
//            $validated = $request->validated();
            $tournament = Tournament::findOrFail($request->id);
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
            session()->flash('update', trans('update.add'));
            return redirect()->route('tournament.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            Tournament::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('tournament.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
