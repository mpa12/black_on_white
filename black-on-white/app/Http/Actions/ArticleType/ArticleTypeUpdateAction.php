<?php

namespace App\Http\Actions\ArticleType;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleType\UpdateArticleTypeRequest;
use App\Http\Resources\ArticleTypeResource;
use App\Models\ArticleType;

class ArticleTypeUpdateAction extends Controller
{
    /**
     * Редактирование типа новости.
     *
     * @param UpdateArticleTypeRequest $request
     * @param ArticleType $articleType
     *
     * @return ArticleTypeResource
     */
    public function __invoke(UpdateArticleTypeRequest $request, ArticleType $articleType): ArticleTypeResource
    {
        foreach ($articleType->fillable as $item) {
            $articleType->$item = $request->$item ?? $articleType->$item;
        }

        $articleType->save();

        return new ArticleTypeResource($articleType);
    }
}
