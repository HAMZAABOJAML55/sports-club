<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ForgotPasswordController extends Controller
{

//    public function forgot(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//        ]);
//
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        if ($status == Password::RESET_LINK_SENT) {
//            return [
//                'status' => __($status)
//            ];
//        }
//
//        throw ValidationException::withMessages([
//            'email' => [trans($status)],
//        ]);
//    }
//
//    public function reset(Request $request)
//    {
//        $request->validate([
//            'token' => 'required',
//            'email' => 'required|email',
//            'password' => ['required', 'confirmed', RulesPassword::defaults()],
//        ]);
//
//        $status = Password::reset(
//            $request->only('email', 'password', 'password_confirmation', 'token'),
//            function ($user) use ($request) {
//                $user->forceFill([
//                    'password' => Hash::make($request->password),
//                    'remember_token' => Str::random(60),
//                ])->save();
//
//                $user->tokens()->delete();
//
//                event(new PasswordReset($user));
//            }
//        );
//
//        if ($status == Password::PASSWORD_RESET) {
//            return response([
//                'message' => 'Password reset successfully'
//            ]);
//        }
//
//        return response([
//            'message' => __($status)
//        ], 500);
//
//    }

    public function forgetPassword(Request $request)
    {
        $verificationCode = mt_rand(100000, 999999);
        $codeInsert=User::where('email',$request->email)->first();
        if (!$codeInsert){
            return response()->json(['message' => 'Invalid Invalid email address Please try again'],422);
        }
//        $codeInsert->code=Hash::make($verificationCode);
        $codeInsert->code=$verificationCode;
        $codeInsert->save();
        return response()->json(['message' => 'User successfully sent code check it',
            'code' =>$verificationCode, ]);
    }



    public function reset(Request $request)
    {
        $verificationCode = mt_rand(100000, 999999);
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);
        $currentDate = Carbon::today();

        $user = User::where('email', $request->email)
            ->where('code', $request->code)
            ->whereDate('created_at', $currentDate)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid verification code. Please try again.']);
        }
        $user->forceFill([
            'password' => Hash::make($request->password),
            'code' =>  Hash::make($verificationCode),
        ])->save();
        return response([
            'message' => 'Password reset successfully'
        ]);
    }

}
