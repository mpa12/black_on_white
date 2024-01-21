<?php

namespace App\Http\Controllers;

use App\Http\Actions\ArticleType\ArticleTypeCreateAction;
use App\Http\Actions\ArticleType\ArticleTypeDestroyAction;
use App\Http\Actions\ArticleType\ArticleTypeUpdateAction;
use App\Http\Requests\ArticleType\CreateArticleTypeRequest;
use App\Http\Requests\ArticleType\UpdateArticleTypeRequest;
use App\Http\Resources\ArticleTypeResource;
use App\Models\ArticleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleTypeController extends Controller
{
    /**
     * Получение списка типов новостей.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ArticleTypeResource::collection(ArticleType::all());
    }

    /**
     * Создание типа новости.
     *
     * @param ArticleTypeCreateAction $action
     * @param CreateArticleTypeRequest $request
     *
     * @return ArticleTypeResource
     */
    public function create(ArticleTypeCreateAction $action, CreateArticleTypeRequest $request): ArticleTypeResource
    {
        return ($action)($request);
    }

    /**
     * Редактирование типа новости.
     *
     * @param ArticleTypeUpdateAction $action
     * @param UpdateArticleTypeRequest $request
     * @param ArticleType $articleType
     *
     * @return ArticleTypeResource
     */
    public function update(
        ArticleTypeUpdateAction $action, UpdateArticleTypeRequest $request, ArticleType $articleType
    ): ArticleTypeResource
    {
        return ($action)($request, $articleType);
    }

    /**
     * Удаление типа новости.
     *
     * @param ArticleTypeDestroyAction $action
     * @param ArticleType $articleType
     *
     * @return JsonResponse
     */
    public function destroy(ArticleTypeDestroyAction $action, ArticleType $articleType): JsonResponse
    {
        return ($action)($articleType);
    }
}
