<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\PersonalAccessToken;
use Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token_blog');

        return response()
            ->json([
                'data' => $user,
                // 'access_token' => $token, 'token_type' => 'Bearer',
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                // 'expired_at' => $token->accessToken->expired_at,
             ]);
    }
    public function Login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token_blog');

        return response()
            ->json([
                'message' => 'Hi '.$user->name.', welcome to home',
                // 'access_token' => $token,
                // 'token_type' => 'Bearer',
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expired_at' => $token->accessToken->expired_at,
             ]);
        
    }
    // method for user logout and delete token
    public function logout()
    {
        // Get user who requested the logout
        $user = request()->user(); //or Auth::user()
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ]);
    }
    // method for kill all user
    public function kill_all_user()
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'You have successfully logged out all users and the token was successfully deleted'
        ]);
    }
    // method for user detail
    public function profil()
    {
        // Get user who requested the logout
        $user = request()->user(); //or Auth::user()

        return response()->json($user);
    }
    //represh token
    public function token_represh(Request $request) 
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        if (!Auth::guard('web')->attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }
        // $cek_token = Auth::check();
            $user_name = Auth::guard('web')->user()->name;
            $token = auth()->user()->createToken('auth_token_blog');
            return response()->json([
                'message' => 'Hi '.$user_name.', welcome back',
                'access_token' => $token->plainTextToken,
                'token_type' => 'Bearer',
                'expired_at' => $token->accessToken->expired_at,
            ]);
        
    }

}
