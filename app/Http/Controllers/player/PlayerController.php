<?php

namespace App\Http\Controllers\player;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\StorePlayerRequest;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Player;
use App\Models\Prof;
use App\Models\Sub_Location;
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
use imageTrait;
    public function index()
    {
        $players=Player::where('club_id',Auth::user()->club_id)->get();
        return view('pages.player.index', compact('players'));
    }


    public function create()
    {
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $players=player::all();
        $subtypes=Subtype::all();
        $profs_degrees=Prof::all();
        $coachs=Coach::where('club_id',Auth::user()->club_id)->get();
        return view('pages.player.create', compact('coachs','nationals','Genders','locations','sub_locations','players', 'subtypes' ,'profs_degrees' ));
    }


    public function store(StorePlayerRequest $request)
    {
        try {
            $player = new Player();
            $player->club_id = Auth::user()->club_id;
            $player->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $player->user_name = $request->user_name;
            $player->phone = $request->phone;
            $player->email = $request->email;
            $player->password = Hash::make($request->password);
            $player->subscription_number = $request->subscription_number;
            $player->salary_month = $request->salary_month;
            $player->total = $request->total;
            $player->weight = $request->weight;
            $player->height = $request->height;
            $player->postal_code = $request->postal_code;
            $player->date_of_birth = $request->date_of_birth;
            $player->link_website = $request->link_website;
            $player->link_facebook = $request->link_facebook;
            $player->link_instagram = $request->link_instagram;
            $player->link_twitter = $request->link_twitter;
            $player->link_youtupe = $request->link_youtupe;
            $player->profs_id = $request->profs_id;
            $player->coachs_id = $request->coachs_id;
            $player->subtype_id = $request->subtype_id;
            $player->location_id = $request->location_id;
            $player->sub_location_id = $request->sub_location_id;
            $player->player_description = $request->player_description;
            $player->nationality_id = $request->nationality_id;
            $player->genders_id = $request->genders_id;

            $player->player_status = $request->player_status;

            $player->save();

            if ($request->hasfile('image_path')) {
                $player_image = $this->saveImage($request->image_path, 'attachments/players/' .Auth::user()->club_id.'/'. $player->id);
                $player->image_path = $player_image;
                $player->save();
            }
            session()->flash('Add', trans('notifi.add'));
            return redirect()->route('player.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $player=Player::where('club_id',Auth::user()->club_id)->find($id);
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $profs_degrees=Prof::all();
        $subtypes =Subtype::all();
        $coachs  =Coach::where('club_id',Auth::user()->club_id)->get();
        return view('pages.player.edit', compact('coachs','subtypes','player','profs_degrees','nationals','Genders','locations','sub_locations'));

    }


    public function update(Request $request, $id)
    {
        try {
            $player = Player::where('club_id',Auth::user()->club_id)->find($request->id);
            $player->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $player->user_name = $request->user_name;
            $player->phone = $request->phone;
            $player->email = $request->email;
            $player->password = Hash::make($request->password);
            $player->subscription_number = $request->subscription_number;
            $player->salary_month = $request->salary_month;
            $player->total = $request->total;
            $player->weight = $request->weight;
            $player->height = $request->height;
            $player->postal_code = $request->postal_code;
            $player->date_of_birth = $request->date_of_birth;
            $player->link_website = $request->link_website;
            $player->link_facebook = $request->link_facebook;
            $player->link_instagram = $request->link_instagram;
            $player->link_twitter = $request->link_twitter;
            $player->link_youtupe = $request->link_youtupe;
            $player->profs_id = $request->profs_id;
            $player->coachs_id = $request->coachs_id;
            $player->subtype_id = $request->subtype_id;
            $player->location_id = $request->location_id;
            $player->sub_location_id = $request->sub_location_id;
            $player->player_description = $request->player_description;
            $player->nationality_id = $request->nationality_id;
            $player->genders_id = $request->genders_id;
            $player->player_status = $request->player_status;
            $player->save();
            if ($request->hasfile('image_path')) {
                $this->deleteFile('players',$request->id);
                $player_image = $this->saveImage($request->image_path, 'attachments/players/' .Auth::user()->club_id.'/'. $player->id);
                $player->image_path = $player_image;
                $player->save();
            }
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('player.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $this->deleteFile('players',$request->id);
            Player::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('player.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
