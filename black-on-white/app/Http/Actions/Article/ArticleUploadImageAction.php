<?php

namespace App\Http\Actions\Article;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleUploadImageAction extends Controller
{
    /**
     * Загрузка изображения.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
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
