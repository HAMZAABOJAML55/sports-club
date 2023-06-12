<?php

namespace App\Http\Controllers\player;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Coach;
use App\Models\Player;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Prof;
use App\Models\Sub_Location;
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{

    public function index()
    {
        $players=Player::all();
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
        $coachs=Coach::all();
        return view('pages.player.create', compact('coachs','nationals','Genders','locations','sub_locations','players', 'subtypes' ,'profs_degrees' ));
    }


    public function store(StorePlayerRequest $request)
    {
        try {

            $player = new Player();
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
            $player->save();
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
        $player=Player::findorfail($id);
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $profs_degrees=Prof::all();
        $subtypes =Subtype::all();
        $coachs  =Coach::all();
        return view('pages.player.edit', compact('coachs','subtypes','player','profs_degrees','nationals','Genders','locations','sub_locations'));

    }


    public function update(Request $request, $id)
    {
        try {
//            return $request->id;
            $player = Player::findorfail($request->id);
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
            $player->save();
            session()->flash('update', trans('notifi.update'));
            return redirect()->route('player.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {


        try {
            Player::destroy($request->id);
            session()->flash('delete', trans('notifi.delete'));
            return redirect()->route('player.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
