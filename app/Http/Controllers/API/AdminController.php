<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginAdmin;
use App\Models\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class AdminController extends Controller
{

    public function index()
    {
        $users = Admin::all();
        return response()->json([
            'status'=>true,
            'Admin'=>$users
        ]);
    }

    public function store(loginAdmin $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $failds= $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
        if(Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = Admin::where('email', $request->email)->first();

        if (Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } else {
            return response()->json(['error' => 'email or password is incorrect'], ResponseAlias::HTTP_UNAUTHORIZED);
        }


    }




}
