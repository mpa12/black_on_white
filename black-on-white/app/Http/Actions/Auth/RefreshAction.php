<?php

namespace App\Http\Actions\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RefreshAction extends Controller
{
    /**
     * Обновление токена.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
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
}
