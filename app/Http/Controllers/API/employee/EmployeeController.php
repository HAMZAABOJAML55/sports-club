<?php

namespace App\Http\Controllers\API\employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Coach;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use GeneralTrait;
    public function __construct()
    {
        $this->middleware('auth:api_employe', ['except' => ['login', 'register']]);
    }


    public function register(StoreEmployeeRequest $request)
    {
        try {
            $Section = Section::findOrFail($request->section_id);
            if ($Section)
                $employees  = new Employe();
                $employees->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
                $employees->email = $request->email;
                $employees->password = Hash::make($request->password);
                $employees->number = $request->number;
                $employees->section_id = $request->section_id;
                $employees->description = $request->description;
                $employees->full_description = $request->full_description;
                $employees->date_of_birth = $request->date_of_birth;
                $employees->emp_id = $request->emp_id;
                $employees->save();

                $token = auth('api_employe')->login($employees);
                return response()->json([
                    'message' => 'User successfully registered',
                    'token'=>$token,
                    'user' => $employees,

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
        if (!$token = auth('api_employe')->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->returnData('token', $token, 'Here Is Your Token');
    }

    public function myData()
    {
        $data = auth('api_employe')->user();
        return $this->returnData('data', $data, 'Here Is Your Data');
    }
    public function logout()
    {
        auth('api_employe')->logout();

        return $this->returnSuccessMessage('Successfully logged out');
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('api_employe')->refresh());
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'expires_in' => auth('api_employe')->factory()->getTTL() * 60
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
