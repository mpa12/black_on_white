<?php

namespace App\Http\Actions\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ArticleDestroyAction extends Controller
{
    /**
     * Удаление новости.
     *
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function __invoke(Article $article): JsonResponse
    {
        try {
            Storage::disk('public')->delete($article->photo);

            $article->delete();

            return response()->json(['success' => 'Новость успешно удалена']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
