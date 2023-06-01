<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayersController extends Controller
{

    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }


    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['user_name'] = $request->user_name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['subscription_number'] = $request->subscription_number;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['phone'] = $request->phone;
        $data['start_time'] = $request->start_time;
        $data['end_time'] = $request->end_time;
        $data['player_description'] = $request->player_description;
        $data['link_website'] = $request->link_website;
        $data['link_facebook'] = $request->link_facebook;
        $data['link_instagram'] = $request->link_instagram;
        $data['link_twitter'] = $request->link_twitter;
        $data['link_youtupe'] = $request->link_youtupe;
        $data['genders_id'] = $request->genders_id;
        $data['nationalitys_id'] = $request->nationalitys_id;
        $data['locations_id'] = $request->locations_id;
        $data['postal_code'] = $request->postal_code;
        $data['coachs_id'] = $request->coachs_id;

        $player = Player::create($data);
        return response()->json([
            'status' => true,
            'date' => $player,
            'message' => 'Player Information Added Successfully',
        ]);

    }

    public function show(Request $request)
    {
        $player = Player::findOrFail($request->id);
        return response()->json($player);
    }


    public function update(Request $request)
    {
        $player = Player::findOrFail($request->id);

        if ($player) {
            $data['name'] = $request->name;
            $data['user_name'] = $request->user_name;
            $data['email'] = $request->email;
            $data['subscription_number'] = $request->subscription_number;
            $data['date_of_birth'] = $request->date_of_birth;
            $data['phone'] = $request->phone;
            $data['start_time'] = $request->start_time;
            $data['end_time'] = $request->end_time;
            $data['player_description'] = $request->player_description;
            $data['link_website'] = $request->link_website;
            $data['link_facebook'] = $request->link_facebook;
            $data['link_instagram'] = $request->link_instagram;
            $data['link_twitter'] = $request->link_twitter;
            $data['link_youtupe'] = $request->link_youtupe;
            $data['genders_id'] = $request->genders_id;
            $data['nationalitys_id'] = $request->nationalitys_id;
            $data['locations_id'] = $request->locations_id;
            $data['postal_code'] = $request->postal_code;
            $data['coachs_id'] = $request->coachs_id;


            $player->update($data);
            return response()->json([
                'status' => true,
                'data' => $player,
                'message' => 'Player Information Updated Successfully',
            ]);
        }
    }


    public function destroy(Request $request)
    {
        Player::find($request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Player Information deleted Successfully',
        ]);
    }


}
