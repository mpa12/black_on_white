<?php

namespace App\Http\Actions\ArticleType;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleType\CreateArticleTypeRequest;
use App\Http\Resources\ArticleTypeResource;
use App\Models\ArticleType;

class ArticleTypeCreateAction extends Controller
{
    /**
     * Создание типа новости.
     *
     * @param CreateArticleTypeRequest $request
     *
     * @return ArticleTypeResource
     */
    public function __invoke(CreateArticleTypeRequest $request): ArticleTypeResource
    {
        $articleType = ArticleType::create([
            'title' => $request->title,
        ]);

        return new ArticleTypeResource($articleType);
    }
}
