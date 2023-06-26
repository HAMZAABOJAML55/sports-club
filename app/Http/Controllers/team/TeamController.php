<?php

namespace App\Http\Controllers\team;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreTeamRequest;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
use imageTrait;

    public function index()
    {
        $teams=Team::where('club_id',Auth::user()->club_id)->get();
        return view('pages.team.index', compact('teams'));

    }

    public function create()
    {
        $coachs=Coach::where('club_id',Auth::user()->club_id)->get();
        $players=Player::where('club_id',Auth::user()->club_id)->get();
      return view('pages.team.create', compact('players','coachs',));
    }


    public function store(StoreTeamRequest $request)
    {
        DB::beginTransaction();

        try {
//            return $request;
            $team = new Team();
            $team->club_id = Auth::user()->club_id;
            $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $team->description = $request->description;
            $team->number = $request->number;
//            $team->team_member = $request->team_member;
            $team->save();
            $team->player()->syncWithoutDetaching($request->player_id);
            $team->coach()->syncWithoutDetaching($request->coach_id);
            if ($request->hasfile('image_path')) {
                $_image = $this->saveImage($request->image_path, 'attachments/teams/' .Auth::user()->club_id.'/'. $team->id);
                $team->image_path = $_image;
                $team->save();
            }
            DB::commit();  // insert data

            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('team.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $coachs=Coach::where('club_id',Auth::user()->club_id)->get();
        $players=Player::where('club_id',Auth::user()->club_id)->get();
        $teams=Team::where('club_id',Auth::user()->club_id)->find($id);
        return view('pages.team.edit', compact('players','coachs','teams'));
    }


    public function update(StoreTeamRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $team = Team::where('club_id',Auth::user()->club_id)->find($request->id);
            $team->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $team->description = $request->description;
            $team->number = $request->number;
//            $team->team_member = $request->team_member;
            //important to update player
            if(isset($request->player_id)) {
                $team->player()->sync($request->player_id);
            }
            //important to update coach
            if(isset($request->coach_id)) {
                $team->coach()->sync($request->coach_id);
            }
            $team->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('teams',$request->id);
                $_image = $this->saveImage($request->image_path, 'attachments/teams/' .Auth::user()->club_id.'/'. $team->id);
                $team->image_path = $_image;
                $team->save();
            }
            DB::commit();  // insert data
            session()->flash('update', trans('update.add'));
            return redirect()->route('team.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            $team = Team::where('club_id',Auth::user()->club_id)->find($request->id);
            $team->coach()->detach();
            $team->player()->detach();
            $this->deleteFile('teams',$request->id);
            $team->delete();
            DB::commit();  // insert data
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('team.index');
        } catch (\Exception $e) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
