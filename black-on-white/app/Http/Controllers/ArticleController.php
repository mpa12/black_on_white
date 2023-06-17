<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

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
        $articlesQuery = Article::orderByDesc('created_at');

        if ($request->has('article_type'))
            $articlesQuery->whereIn('article_type_id', explode(',', $request->input('article_type')));

        if ($request->has('text'))
            $articlesQuery->where('title', 'LIKE', '%' . $request->input('text') . '%');

        return ArticleResource::collection($articlesQuery->paginate(20, ['*'], 'page'));
    }

    /**
     * Добавление новости
     * @param StoreArticleRequest $request
     * @return JsonResponse
     */
    public function create(StoreArticleRequest $request): JsonResponse
    {
        $path = $request->file('photo')->store('articles', 'public');

        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'text' => $request->text,
            'photo' => $path,
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
            if ($item === 'photo') continue;
            $article->$item = $request->$item ?? $article->$item;
        }

        $image = $request->file('photo');
        if ($image) {
            $storage = Storage::disk('public');
            if ($storage->exists($article->photo)) $storage->delete($article->photo);
            $article->photo = $image->store('articles', 'public');
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
            Storage::disk('public')->delete($article->photo);
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

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('article-images'), $filename);
            $url = asset('article-images/' . $filename);
            return response()->json(['url' => $url]);
        } else {
            return response()->json(['error' => 'Image not found'], 400);
        }
    }
}
