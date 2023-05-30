<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json([
            'status'=>true,
            'users'=>$users
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = bcrypt($inputs['password']);

        if (User::create($inputs)) {
            $status = 'Success';
            $status_code = ResponseAlias::HTTP_CREATED;
            $message = 'User created successfully';
        }else{
            $status = 'Error';
            $status_code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'User not created';
        }

        return response()->json([
            'status' => $status,
            'status_code'=>$status_code,
            'message' => $message,
            'data'=>[]
        ], $status_code);

    }


    public function show($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'User not found','data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'status' => 'Success',
            'status_code'=>ResponseAlias::HTTP_OK,
            'message' => '',
            'data'=>$user->only(['id','name','email'])
        ], ResponseAlias::HTTP_OK);
    }

    public function update(UpdateUserRequest $request, $id): JsonResponse
    {
        $inputs = $request->all();
        if ($request->has('password')) {
            $inputs['password'] = bcrypt($inputs['password']);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'User not found',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($user->update($inputs)) {
            $status = 'Success';
            $status_code = ResponseAlias::HTTP_OK;
            $message = 'User updated successfully';
        }else{
            $status = 'Error';
            $status_code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'User not updated';
        }

        return response()->json([
            'status' => $status,
            'status_code'=>$status_code,
            'message' => $message,
            'data'=>[]
        ], $status_code);

    }

    public function destroy($id): JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'message' => 'User not found',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }

        if ($user->delete()) {
            $status = 'Success';
            $status_code = ResponseAlias::HTTP_OK;
            $message = 'User deleted successfully';
        }else{
            $status = 'Error';
            $status_code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'User not deleted';
        }

        return response()->json([
            'status' => $status,
            'status_code'=>$status_code,
            'message' => $message,
            'data'=>[]
        ], $status_code);
    }


    // function to change_password
    public function change_password(Request $request)
    {
        $request->validate([
            'current_password'  => 'required',
            'password'          => 'required|confirmed'
        ]);

        $user = User::findOrFail($request->id);
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' => bcrypt($request->password),
            ]);

            if ($update) {
                return response()->json([
                    'status' => true,
                    'message' => 'User cahnge_password  Successfully',
                ], 200);
            }
        }
    }
}
