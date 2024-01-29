<?php

namespace App\Http\Actions\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordResponseRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ResetPasswordResponseAction extends Controller
{
    /**
     * Восстановление пароля.
     *
     * @param ResetPasswordResponseRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(ResetPasswordResponseRequest $request): JsonResponse
    {
        $user = User::where('remember_token', $request->remember_token)->first();
        $user->password = Hash::make($request->new_password);
        $user->remember_token = null;
        $user->save();

        return response()->json(['status' => 'success']);
    }
}
