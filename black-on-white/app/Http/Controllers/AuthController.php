<?php

namespace App\Http\Controllers;

use App\Http\Actions\Auth\LoginAction;
use App\Http\Actions\Auth\RefreshAction;
use App\Http\Actions\Auth\RegisterAction;
use App\Http\Actions\Auth\ResetPasswordAction;
use App\Http\Actions\Auth\ResetPasswordResponseAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Requests\Auth\ResetPasswordAuthRequest;
use App\Http\Requests\Auth\ResetPasswordResponseRequest;
use App\Http\Requests\Auth\ValidateTokenRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Регистрация пользователя.
     *
     * @param RegisterAction $action
     * @param RegisterAuthRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterAction $action, RegisterAuthRequest $request): JsonResponse
    {
        return ($action)($request);
    }

    /**
     * Обновление токена.
     *
     * @param RefreshAction $action
     *
     * @return JsonResponse
     */
    public function refresh(RefreshAction $action): JsonResponse
    {
        return ($action)();
    }

    /**
     * Проверка на админа по accessToken.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return (bool)Auth::user()['is_admin'];
    }

    /**
     * Запрос на восстановление пароля.
     *
     * @param ResetPasswordAction $action
     * @param ResetPasswordAuthRequest $request
     *
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordAction $action, ResetPasswordAuthRequest $request): JsonResponse
    {
        return ($action)($request);
    }

    /**
     * Восстановление пароля.
     *
     * @param ResetPasswordResponseAction $action
     * @param ResetPasswordResponseRequest $request
     *
     * @return JsonResponse
     */
    public function resetPasswordResponse(
        ResetPasswordResponseAction $action,
        ResetPasswordResponseRequest $request
    ): JsonResponse
    {
        return ($action)($request);
    }

    public function validateToken(ValidateTokenRequest $request): JsonResponse
    {
        return response()->json(['status' => 'success']);
    }
}
