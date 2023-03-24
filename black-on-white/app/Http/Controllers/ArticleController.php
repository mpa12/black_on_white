<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ArticleController extends Controller
{
    /**
     * Получение списка новостей
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Article::orderByDesc('created_at');

        if ($request->has('article_type')) {
            $query->whereIn('article_type_id', explode(',', $request->input('article_type')));
        }

        if ($request->has('text')) {
            $query->where('title', 'LIKE', '%' . $request->input('text') . '%');
        }

        return ArticleResource::collection($query->paginate(20, ['*'], 'page'));
    }

    /**
     * Добавление новости
     * @param StoreArticleRequest $request
     * @return JsonResponse
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('articles'), $imageName);

        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'text' => $request->text,
            'photo' => '/articles/' . $imageName,
            'article_type_id' => $request->article_type_id,
        ]);

        return response()->json(['success' => new ArticleResource($article)]);
    }

    /**
     * Просмотр новости
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    /**
     * Редактрирование новости
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return JsonResponse
     */
    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        foreach ($article->fillable as $item) {
            $article->$item = $request->$item ?? $article->$item;
        }

        try {
            $article->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }

        return response()->json(['success' => new ArticleResource($article)]);
    }

    /**
     * Удаление новости
     * @param Article $article
     * @return JsonResponse
     */
    public function destroy(Article $article): JsonResponse
    {
        try {
            $article->delete();
            return response()->json(['success' => 'Новость успешно удалена']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }

    /**
     * Получение двух последних новостей
     * @return AnonymousResourceCollection
     */
    public function two_last(): AnonymousResourceCollection
    {
        return ArticleResource::collection(Article::limit(2)->orderByDesc('created_at')->get());
    }
}
