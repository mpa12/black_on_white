<?php

namespace App\Http\Actions\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Intervention\Image\Facades\Image;

class ArticleCreateAction extends Controller
{
    /**
     * Добавление новости.
     *
     * @param CreateArticleRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateArticleRequest $request): JsonResponse
    {
        $path = $request->file('photo')->store('articles', 'public');

        Image::make(public_path('storage/' . $path))
            ->encode('webp', 0)
            ->resize(1280, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();

        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'text' => $request->text,
            'photo' => $path,
            'article_type_id' => $request->article_type_id,
        ]);

        return response()->json(['success' => new ArticleResource($article)]);
    }
}
