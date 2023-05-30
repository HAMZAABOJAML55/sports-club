<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    //

    // function rgister new user
    public function register(Request $request)
    {
        $failds= $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','min:4'],
            'phone'=>['string','max:25'],
            'birth_day' =>'date',
        ]);

        $failds['password']= Hash::make($failds['password']);
        $user = User::create($failds);
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }
    // function login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $failds= $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ]);
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match with our record.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

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
    // function logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'user logged out'
        ];
    }

}
