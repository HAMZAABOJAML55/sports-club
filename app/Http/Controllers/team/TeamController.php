<?php

namespace App\Http\Controllers\team;
use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function index()
    {
        $teams=Team::all();
        return view('pages.team.index', compact('teams'));

    }

    public function create()
    {
        $coachs=Coach::all();
        $players=Player::all();
      return view('pages.team.create', compact('players','coachs',));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
//            return $request;
            $team = new Team();
            $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $team->description = $request->description;
            $team->number = $request->number;
            $team->save();
            $team->player()->attach($request->player_id);
            $team->coach()->attach($request->coach_id);
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('team.index');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coachs=Coach::all();
        $players=Player::all();
        return view('pages.team.edit', compact('players','coachs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
//            $validated = $request->validated();
            $team = Team::findOrFail($request->id);
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
            session()->flash('update', trans('update.add'));
            return redirect()->route('team.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        try {
            Team::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('team.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
