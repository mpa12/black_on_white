<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *     path="/api/article",
 *     summary="Создание новости",
 *     tags={"Article"},
 *
 *     @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(property="title", type="string", maxLength=255),
 *                  @OA\Property(property="description", type="string", maxLength=255),
 *                  @OA\Property(property="text", type="string"),
 *                  @OA\Property(property="photo", type="string", format="binary"),
 *                  @OA\Property(property="article_type_id", type="integer", format="int64"),
 *              )
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response="200",
 *          description="Successful response"
 *      ),
 *
 *      security={{"bearerAuth": {}}}
 * ),
 */
class ArticleController extends Controller
{

}
