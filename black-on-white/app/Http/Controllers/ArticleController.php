<?php

namespace App\Http\Controllers;

use App\Http\Actions\Article\ArticleCreateAction;
use App\Http\Actions\Article\ArticleDestroyAction;
use App\Http\Actions\Article\ArticleIndexAction;
use App\Http\Actions\Article\ArticleUpdateAction;
use App\Http\Actions\Article\ArticleUploadImageAction;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Article\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    /**
     * Получение списка новостей.
     *
     * @param ArticleIndexAction $action
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(ArticleIndexAction $action, Request $request): AnonymousResourceCollection
    {
        return ($action)($request);
    }

    /**
     * Создание новости.
     *
     * @param ArticleCreateAction $action
     * @param CreateArticleRequest $request
     *
     * @return JsonResponse
     */
    public function create(ArticleCreateAction $action, CreateArticleRequest $request): JsonResponse
    {
        return ($action)($request);
    }

    /**
     * Просмотр новости.
     *
     * @param Article $article
     *
     * @return ArticleResource
     */
    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    /**
     * Редактирование новости.
     *
     * @param ArticleUpdateAction $action
     * @param UpdateArticleRequest $request
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function update(ArticleUpdateAction $action, UpdateArticleRequest $request, Article $article): JsonResponse
    {
        return ($action)($request, $article);
    }

    /**
     * Удаление новости.
     *
     * @param ArticleDestroyAction $action
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function destroy(ArticleDestroyAction $action, Article $article): JsonResponse
    {
        return ($action)($article);
    }

    /**
     * Получение двух последних новостей.
     *
     * @return AnonymousResourceCollection
     */
    public function two_last(): AnonymousResourceCollection
    {
        return ArticleResource::collection(
            Article::limit(2)->orderByDesc('created_at')->get()
        );
    }

    /**
     * Загрузка изображения.
     *
     * @param ArticleUploadImageAction $action
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function uploadImage(ArticleUploadImageAction $action, Request $request): JsonResponse
    {
        return ($action)($request);
    }
}
