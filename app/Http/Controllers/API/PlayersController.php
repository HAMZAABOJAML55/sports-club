<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\player\SignupPlayerController;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PlayersController extends Controller
{

    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }


    public function store(StorePlayerRequest $request)
    {
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
