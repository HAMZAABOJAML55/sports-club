<?php

namespace App\Http\Controllers\player;
use App\Http\Controllers\Controller;
use App\Models\Coach;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Natinality;
use App\Models\Player;
use App\Models\Sub_Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.player.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationals=Natinality::all();
        $Genders=Gender::all();
        $locations=Location::all();
        $sub_locations=Sub_Location::all();
        $coachs=Coach::all();
        return view('pages.player.create', compact('nationals','Genders','locations','sub_locations','coachs'));
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
            $students = new Player();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->user_name = $request->user_name;
            $students->phone = $request->phone;
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->subscription_number = $request->subscription_number;
            $students->date_of_birth = $request->date_of_birth;
            $students->start_time = $request->start_time;
            $students->end_time = $request->end_time;
            $students->link_website = $request->link_website;
            $students->link_facebook = $request->link_facebook;
            $students->link_twitter = $request->link_twitter;
            $students->link_youtupe = $request->link_youtupe;
            $students->employment_type = $request->employment_type;
            $students->coachs_id = $request->coach_id;
            $students->location_id = $request->location_id;
            $students->postal_code = $request->postal_code;
            $students->sub_location_id = $request->sub_location_id;
            $students->nationality_id = $request->nationality_id;
            $students->genders_id = $request->genders_id;
            $students->save();
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

        $player = Player::destroy($id);

    }
}
