<?php

namespace App\Http\Controllers\player;
use App\Http\Controllers\Controller;
use App\Models\player;
use App\Models\Employment_type;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Prof;
use App\Models\Sub_Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    
    public function index()
    {
        return view('pages.player.index');

    }

    
    public function create()
    {
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $players=player::all();
        $Employment_Types=Employment_type::all();
        $profs_degrees=Prof::all();
        return view('pages.player.create', compact('nationals','Genders','locations','sub_locations','players', 'Employment_Types' ,'profs_degrees' ));
    }

 
    public function store(Request $request)
    {
        try {
            $player = new Player();
            $player->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $player->user_name = $request->user_name;
            $player->phone = $request->phone;
            $player->email = $request->email;
            $player->password = Hash::make($request->password);
            $player->subscription_number = $request->subscription_number;
            $player->salary = $request->salary;
            $player->date_of_birth = $request->date_of_birth;
            $player->start_time = $request->start_time;
            $player->end_time = $request->end_time;
            $player->link_website = $request->link_website;
            $player->link_facebook = $request->link_facebook;
            $player->link_twitter = $request->link_twitter;
            $player->link_youtupe = $request->link_youtupe;
            $player->employment_type_id = $request->employment_type_id;
            $player->profs_id = $request->profs_id;
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
        $Employment_Types=Employment_type::all();
        $profs_degrees=Prof::all();
        $players=Player::all();
        return view('pages.player.edit', compact('player','profs_degrees','Employment_Types','nationals','Genders','locations','sub_locations'));

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
            $player->salary = $request->salary;
            $player->date_of_birth = $request->date_of_birth;
            $player->start_time = $request->start_time;
            $player->end_time = $request->end_time;
            $player->link_website = $request->link_website;
            $player->link_facebook = $request->link_facebook;
            $player->link_twitter = $request->link_twitter;
            $player->link_youtupe = $request->link_youtupe;
            $player->employment_type_id = $request->employment_type_id;
            $player->profs_id = $request->profs_id;
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
