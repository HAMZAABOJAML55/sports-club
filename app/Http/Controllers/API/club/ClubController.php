<?php

namespace App\Http\Controllers\API\club;

use App\Http\Controllers\Controller;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
use imageTrait;
use GeneralTrait;
    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                "name" => "required|string",
                "user_name" => "required|string",
                "subscribes_id" => "required|integer",
                "subscription_period" => "required|string",
                "email" => "required|string|unique:clubs",
                "password" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
//                $code = $this->returnCodeAccordingToInput($validator);
//                return $this->returnValidationError($code, $validator);
                return response()->json($validator->errors(), 422);
            } else {
                $Club=new Club();
                $Club->name = $request->name;
                $Club->user_name = $request->user_name;
                $Club->email = $request->email;
                $Club->phone = $request->phone;
                $Club->subscribes_id = $request->subscribes_id;
                $Club->subscription_period = $request->subscription_period;
                $Club->password =Hash::make($request->password);
                $Club->save();
                if ($request->hasFile('image_path')) {
                    $image = $this->saveImage($request->image_path, 'images/logos/clubs/'. $Club->id);
                    $Club->image_path = $image;
                    $Club->save();
                }

                $admin=new User();
                $admin->club_id = $Club->id;
                $admin->name = $Club->name;
                $admin->email = $Club->email;
                $admin->password = $Club->password;
                $admin->permission = 'admin';
                $admin->save();
                DB::commit();
                $token = auth('api')->login($admin);
                return $this->returnData('token', $token, 'Here Is Your Token');
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::user()->club_id;
            $club =Club::find($id);
//            dd($club->id);
            if (!$club) {
                return $this->returnError(404, "The requested Admin not found club_id is null");
            }
            $admin = User::where('club_id', '=', $id)->where('permission', 'admin')->get();
            if (!$admin){
                return $this->returnError(404, "The requested Admin not found club_id is null");
            }
//                                dd($admin);
                $rules = [
                    "name" => "required|string",
                    "user_name" => "required|string",
                    "email" => "required|email|unique:employes,email|unique:coachs,email|unique:players,email|unique:clubs,email," . $this->id,
                    "subscribes_id" => "required|integer",
                    "subscription_period" => "required|string",
                    "password" => "required"
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                } else {
                    $club->name = $request->name;
                    $club->user_name = $request->user_name;
                    $club->email = $request->email;
                    $club->phone = $request->phone;
                    $club->subscribes_id = $request->subscribes_id;
                    $club->subscription_period = $request->subscription_period;
                    $club->password =Hash::make($request->password);
                    $club->save();
                   #update in table users #admin
                    $admin = User::find($club->id);
                    $admin->club_id = $club->id;
                    $admin->name = $club->name;
                    $admin->email = $club->email;
                    $admin->password = $club->password;
                    $admin->permission = 'admin';
                    $admin->save();
                    DB::commit();
                    return $this->returnData('club', $club);
                }
        } catch (\Exception $ex) {
            DB::rollback();
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }


    public function destroy($id)
    {
        //
    }
}
