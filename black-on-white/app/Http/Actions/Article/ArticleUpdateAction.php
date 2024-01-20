<?php

namespace App\Http\Actions\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ArticleUpdateAction extends Controller
{
    /**
     * Редактирование новости.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     *
     * @return JsonResponse
     */
    public function __invoke(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        foreach ($article->fillable as $item) {
            if ($item === 'photo') {
                continue;
            }

            $article->$item = $request->$item ?? $article->$item;
        }

        $image = $request->file('photo');

        if ($image) {
            $storage = Storage::disk('public');

            if ($storage->exists($article->photo)) {
                $storage->delete($article->photo);
            }

            $article->photo = $image->store('articles', 'public');

            Image::make(public_path('storage/' . $article->photo))
                ->encode('webp', 0)
                ->resize(1280, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save();
        }

        try {
            $article->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }

        return response()->json(['success' => new ArticleResource($article)]);
    }
}
