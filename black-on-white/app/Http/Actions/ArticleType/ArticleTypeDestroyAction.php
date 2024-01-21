<?php

namespace App\Http\Actions\ArticleType;

use App\Http\Controllers\Controller;
use App\Models\ArticleType;
use Illuminate\Http\JsonResponse;

class ArticleTypeDestroyAction extends Controller
{
    /**
     * Удаление типа новости.
     *
     * @param ArticleType $articleType
     *
     * @return JsonResponse
     */
    public function __invoke(ArticleType $articleType): JsonResponse
    {
        $articleType->delete();

        return response()->json(
            ['success' => 'Тип новости успешно удален']
        );
    }
}
