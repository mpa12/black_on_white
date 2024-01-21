<?php

namespace App\Http\Controllers;

use App\Http\Actions\Auth\LoginAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Requests\Auth\ResetPasswordAuthRequest;
use App\Http\Requests\Auth\ResetPasswordResponseRequest;
use App\Http\Requests\Auth\ValidateTokenRequest;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Аутентификация пользователя.
     *
     * @param LoginAction $action
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginAction $action, LoginRequest $request): JsonResponse
    {
        return ($action)($request);
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
