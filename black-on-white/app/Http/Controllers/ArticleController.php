<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ArticleResource::collection(Article::paginate(20));
    }

    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'text' => $request->text,
            'photo' => $request->photo,
            'article_type_id' => $request->article_type_id,
        ]);

        return response()->json(['success' => new ArticleResource($article)]);
    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function update(UpdateArticleRequest $request, Article $article)
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

    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return response()->json(['success' => 'Новость успешно удалена']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
