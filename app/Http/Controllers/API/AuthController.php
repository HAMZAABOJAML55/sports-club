<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */


    public function userProfile() {
        return response()->json(auth()->user());
    }


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

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 604800,
            'user' => auth()->user()
        ]);
    }
}
