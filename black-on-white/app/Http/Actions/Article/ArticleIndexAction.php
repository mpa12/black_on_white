<?php

namespace App\Http\Actions\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleIndexAction extends Controller
{
    /**
     * Получение списка новостей.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $articlesQuery = Article::orderByDesc('created_at');

        if ($request->has('article_type'))
            $articlesQuery->whereIn('article_type_id', explode(',', $request->input('article_type')));

        if ($request->has('text'))
            $articlesQuery->where('title', 'LIKE', '%' . $request->input('text') . '%');

        return ArticleResource::collection($articlesQuery->paginate(20, ['*'], 'page'));
    }
}
