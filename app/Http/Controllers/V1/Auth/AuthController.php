<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\V1\AuthRequest;

class AuthController extends Controller
{
    
    public function login(AuthRequest $request)
    {
        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'data' => [
                    'error' => false,
                    'token' => $request->user()->createToken($request->email)->plainTextToken,
                    'message' => 'Login Success',
                    'user' => [
                        'user' => $request->user(),
                        'permissions' => $request->user()->getAllPermissions()->pluck('name'),
                        'role' => $request->user()->getRoleNames()
                    ]
                ]
            ], 200);
        }
        else{
            return response()->json([
                'data' => [
                    'error' => true,
                    'message' => 'Login Failed'
                ]
            ], 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
