<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\ResetPasswordAuthRequest;
use App\Http\Requests\ResetPasswordResponseRequest;
use App\Http\Requests\ValidateTokenRequest;
use App\Mail\ResetPasswordEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'auth:api',
            ['except' => ['login', 'register', 'resetPassword', 'resetPasswordResponse', 'validateToken']]
        );
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $token = Str::random(80);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => $token,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function refresh(): JsonResponse
    {
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $user->refreshToken(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function isAdmin(): bool
    {
        return (bool)Auth::user()['is_admin'];
    }

    public function resetPassword(ResetPasswordAuthRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $user->generateResetPasswordToken();

        Mail::to($user->email)->queue(new ResetPasswordEmail($user));

        return response()->json(['status' => 'success']);
    }

    public function resetPasswordResponse(ResetPasswordResponseRequest $request): JsonResponse
    {
        $user = User::where('remember_token', $request->remember_token)->first();
        $user->password = Hash::make($request->new_password);
        $user->remember_token = null;
        $user->save();

        return response()->json(['status' => 'success']);
    }

    public function validateToken(ValidateTokenRequest $request): JsonResponse
    {
        return response()->json(['status' => 'success']);
    }
}
