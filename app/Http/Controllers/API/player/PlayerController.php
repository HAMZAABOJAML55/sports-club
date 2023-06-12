<?php

namespace App\Http\Controllers\API\player;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Player;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PlayerController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware('auth:api_player', ['except' => ['login', 'register']]);
    }


    public function register(Request $request)
    {
        $rules = [
            "email" => "required|string|unique:players|unique:coachs|unique:users|unique:employes",
            "password" => "required|string",
            'date_of_birth'    => 'required|date',
            'coachs_id'    => 'required|integer',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = new JsonResponse([
                'data' => [],
                'message' => 'Validation Error',
                'errors' => $validator->messages()->all(),
            ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

            throw new ValidationException($validator, $response);

        } else {
            try {
                $coach=Coach::findorfail('$request->coachs_id');
                if ($coach)
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

                $token = auth('api_player')->login($player);

                return response()->json([
                    'message' => 'player successfully registered',
                    'token'=>$token,
                    'user' => $player,

                ], 201);
            } catch (\Throwable $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        }
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('api_player')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->returnData('token', $token, 'Here Is Your Token');
    }

    public function myData()
    {
        $data = auth('api_player')->user();
        return $this->returnData('data', $data, 'Here Is Your Data');
    }
    public function logout()
    {
        auth('api_player')->logout();

        return $this->returnSuccessMessage('Successfully logged out');
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('api_player')->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'expires_in' => auth('api_player')->factory()->getTTL() * 60
        ]);
    }







    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
