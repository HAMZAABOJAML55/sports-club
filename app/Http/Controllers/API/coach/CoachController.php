<?php

namespace App\Http\Controllers\API\coach;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CoachController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware('auth:api_coach', ['except' => ['login', 'register']]);
    }
    use imageTrait;

    public function register(StoreCoachRequest $request)
    {
        try {
            $coach = new Coach();
            $coach->club_id = $request->club_id;
            $coach->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $coach->user_name = $request->user_name;
            $coach->phone = $request->phone;
            $coach->email = $request->email;
            $coach->password = Hash::make($request->password);
            $coach->subscription_number = $request->subscription_number;
            $coach->salary = $request->salary;
            $coach->date_of_birth = $request->date_of_birth;
            $coach->start_time = $request->start_time;
            $coach->end_time = $request->end_time;
            $coach->link_website = $request->link_website;
            $coach->link_facebook = $request->link_facebook;
            $coach->link_twitter = $request->link_twitter;
            $coach->link_youtupe = $request->link_youtupe;
            $coach->employment_type_id = $request->employment_type_id;
            $coach->profs_id = $request->profs_id;
            $coach->location_id = $request->location_id;
            $coach->sub_location_id = $request->sub_location_id;
            $coach->coach_description = $request->coach_description;
            $coach->nationality_id = $request->nationality_id;
            $coach->genders_id = $request->genders_id;
            $coach->height = $request->height;
            $coach->weight = $request->weight;
            $coach->postal_code = $request->postal_code;
            $coach->link_Instagram = $request->link_Instagram;
            $coach->save();
            $coach_image = $this->saveImage($request->image_path,'attachments/coachs/'.$coach->id);
            $coach->image_path = $coach_image;
            $coach->save();
            $token = auth('api_coach')->login($coach);

            return response()->json([
                'message' => 'coach successfully registered',
                'token'=>$token,
                'user' => $coach,

            ], 201);
        } catch (\Throwable $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
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
        if (!$token = auth('api_coach')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->returnData('token', $token, 'Here Is Your Token');

    }

    public function myData()
    {
        $data = auth('api_coach')->user();
        return $this->returnData('data', $data, 'Here Is Your Data');
    }
    public function logout()
    {
        auth('api_coach')->logout();

        return $this->returnSuccessMessage('Successfully logged out');
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('api_coach')->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'expires_in' => auth('api_coach')->factory()->getTTL() * 60
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
