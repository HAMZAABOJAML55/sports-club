<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\player\SignupPlayerController;
use App\Http\Requests\StorePlayerRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PlayersController extends Controller
{
    use GeneralTrait;
    use imageTrait;
    public function index()
    {
        $players = Player::all();
        return response()->json($players);
    }


    public function store(StorePlayerRequest $request)
    {
        DB::beginTransaction();
        try {
            $couch=Coach::find($request->coachs_id);
            if (!$couch) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'couch not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
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
        $player->save();
            if ($request->hasfile('image_path')) {
                $player_image = $this->saveImage($request->image_path, 'attachments/players/' . $player->id);
                $player->image_path = $player_image;
                $player->save();
            }
            DB::commit();  // insert data
        return response()->json([
            'status' => true,
            'date' => $player,
            'message' => 'Player Information Added Successfully',
        ]);
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function show(Request $request)
    {
        $player= Player::find($request->id);
        if (!$player) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'player not found',
                'data' => []
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => true,
            'data' => $player
        ]);
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $couch=Coach::find($request->coachs_id);
            if (!$couch) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'couch not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
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
            if ($request->hasfile('media_path')) {
                $player_image = $this->saveImage($request->image_path, 'attachments/players/' . $player->id);
                $player->image_path = $player_image;
                $player->save();
            }
            DB::commit();  // insert data
            return response()->json([
                'status' => true,
                'data' => $player,
                'message' => 'Player Information Updated Successfully',
            ]);
        }
        } catch (\Throwable $ex) {
            //            وهنا يعمل رجوع عن الحفظ
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
       $player= Player::find($request->id);
        if (!$player) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'player not found',
                'data' => []
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $this->deleteFile('players',$request->id);
        $player->delete();
        return response()->json([
            'status' => true,
            'message' => 'Player Information deleted Successfully',
        ]);
    }


}
