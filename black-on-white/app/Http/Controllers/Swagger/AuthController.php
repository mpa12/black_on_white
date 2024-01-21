<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Аутентификация пользователя",
 *     tags={"Auth"},
 *     description="Endpoint для аутентификации пользователя.",
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Учетные данные пользователя для аутентификации",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(property="email", type="string", example="email@gmail.com"),
 *                 @OA\Property(property="password", type="string", maxLength=255, example="password"),
 *             )
 *         ),
 *     ),
 *
 *     @OA\Response(
 *         response="401",
 *         description="Unauthorized: неверный email или пароль",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="message", type="string", example="Unauthorized"),
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response="201",
 *         description="Успешная аутентификация",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success"),
 *             @OA\Property(property="user", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="name"),
 *                 @OA\Property(property="email", type="string", example="email"),
 *                 @OA\Property(property="email_verified_at", type="string", format="date-time", example=null),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="created_at"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="updated_at"),
 *                 @OA\Property(property="is_admin", type="boolean", example=false),
 *                 @OA\Property(property="api_token", type="string", example="api_token"),
 *             ),
 *             @OA\Property(property="authorisation", type="object",
 *                 @OA\Property(property="token", type="boolean", example=true),
 *                 @OA\Property(property="type", type="string", example="bearer"),
 *             ),
 *         )
 *     ),
 * )
 */
class AuthController extends Controller
{

}
