<?php

namespace App\Http\Controllers\API\employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\StoreEmployeeRequest;
use App\Http\Traits\GeneralTrait;
use App\Http\Traits\imageTrait;
use App\Models\Club;
use App\Models\Employe;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EmployeeController extends Controller
{
    use GeneralTrait;
    use imageTrait;

    public function __construct()
    {
        $this->middleware('auth:api_employe', ['except' => ['login', 'register']]);
    }

    public function register(StoreEmployeeRequest $request):  JsonResponse
    {
        DB::beginTransaction();
        try {
            $rules = [
                "club_id" => "required|integer",
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $response = new JsonResponse([
                    'data' => [],
                    'message' => 'Validation Error',
                    'errors' => $validator->messages()->all(),
                ], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

                throw new ValidationException($validator, $response);

            }

            $Club=Club::find($request->club_id);
            if (!$Club) {
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Club not found',
                    'data' => []
                ], ResponseAlias::HTTP_NOT_FOUND);
            }

            $section=Section::where('club_id',$request->club_id)->find($request->section_id);
            if (!$section){
                return response()->json([
                    'status' => 'Error',
                    'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                    'message' => 'Section not found id'
                ], ResponseAlias::HTTP_NOT_FOUND);
            }
            $employee = new Employe();
            $employee->club_id =$request->club_id;
            $employee->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $employee->email = $request->email;
            $employee->national_id = $request->national_id;
            $employee->description = $request->description;
            $employee->full_description = $request->full_description;
            $employee->section_id = $request->section_id;
            $employee->emp_id = $request->emp_id;
            $employee->password = Hash::make($request->password);
            $employee->date_of_birth = $request->date_of_birth;
            $employee->save();

            if ($request->hasfile('image_path')) {
                $employee_image = $this->saveImage($request->image_path, 'attachments/employees/' . $employee->id);
                $employee->image_path = $employee_image;
                $employee->save();
            }
            DB::commit();  // insert data

            $token = auth('api_employe')->login($employee);
            return response()->json([
                'message' => 'User successfully registered',
                'token'=>$token,
                'user' => $employee,

            ], 201);


        } catch (\Throwable $ex) {
            DB::rollback();
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


}
