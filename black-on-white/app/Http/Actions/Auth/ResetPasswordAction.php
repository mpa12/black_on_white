<?php

namespace App\Http\Actions\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordAuthRequest;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ResetPasswordAction extends Controller
{
    /**
     * Запрос на восстановление пароля.
     *
     * @param ResetPasswordAuthRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(ResetPasswordAuthRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $user->generateResetPasswordToken();

        Mail::to($user->email)->queue(new ResetPasswordEmail($user));

        return response()->json(['status' => 'success']);
    }
}
