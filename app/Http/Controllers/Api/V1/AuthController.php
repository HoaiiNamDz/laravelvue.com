<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Enums\ResponseEnum;

class AuthController extends Controller
{
    public function __construct()
    {
        
    }
    public function login(AuthRequest $request) {
        
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            $expirationTime = now()->addMinutes(60);
            $token = $request->user()->createToken('backend_token', ['*'], $expirationTime);
            $user = $request->user();
            // Cookie::queue(
            //     'backend_token',
            //     $token,
            //     60,
            //     '/',
            //     'localhost',
            //     false,
            //     true
            // );
            return response()
            ->json([
                'token' => $token->plainTextToken,
                'token_expired_at' => $token->accessToken->expires_at,
                'user' => $user
            ], ResponseEnum::OK);
            // ->withCookie(
            //     'backend_token',
            //     $token,
            //     60,
            //     '/',
            //     'localhost',
            //     false,
            //     true
            // );
        }
        return response()->json([
            'message' => 'Tài khoản hoặc mật khẩu không chính xác'
        ], ResponseEnum::UNAUTHORIZED);
    }

    // public function getAuthCookie(Request $request) {
    //     $token = $request->cookie('backend_token');
    //     if($token) {
    //         $user = Auth::guard('sanctum')->setToken($token)->user();
    //         return response()->json([
    //             'token' => $token,
    //             'user' => $user
    //         ], ResponseEnum::OK);
    //     }
    //     return response()->json([
    //         'message' => 'Tài khoản hoặc mật khẩu không chính xác'
    //     ], ResponseEnum::UNAUTHORIZED);
    // }
}