<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'data' => [
                    'token' => $request->user()->createToken($request->email)->plainTextToken,
                    'message' => 'Login Success'
                ]
            ]);
        }
        else{
            return response()->json([
                'data' => [
                    'error' => 'Login Failed'
                ]
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
