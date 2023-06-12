<?php

namespace App\Http\Controllers\player;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Coach;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Player;
use App\Models\Prof;
use App\Models\Sub_Location;
use App\Models\Subtype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $players=player::all();
        $subtypes=Subtype::all();
        $profs_degrees=Prof::all();
        $coachs=Coach::all();
        return view('pages.player.signup', compact('coachs','nationals','Genders','locations','sub_locations','players', 'subtypes' ,'profs_degrees' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}