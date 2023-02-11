<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ArticleResource::collection(Article::paginate(20));
    }

    public function store(Request $request)
    {
        return ['store'];
    }

    public function show(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function update(Request $request, Article $article)
    {
        return ['update'];
    }

    public function destroy(Article $article)
    {
        //
    }
}
