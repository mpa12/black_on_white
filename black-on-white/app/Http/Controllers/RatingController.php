<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetRatingRequest;
use App\Models\Rating;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Получения рейтинга новости
     *
     * @param int $article_id
     * @return array
     */
    public function index(int $article_id)
    {
        return [
            'rating' => Rating::where('article_id', $article_id)->count(),
            'isRated' => Rating::where('article_id', $article_id)
                ->where('user_id', Auth::guard('api')->check() ? Auth::guard('api')->id() : null)
                ->exists()
        ];
    }

    /**
     * Установка рейтинга новости
     *
     * @param SetRatingRequest $request
     * @return JsonResponse
     */
    public function setRating(SetRatingRequest $request)
    {
        return ($request->create_rating) ? $this->create($request) : $this->destroy($request);
    }

    /**
     * Установка рейтинга новости при отсутствии
     *
     * @param SetRatingRequest $request
     * @return JsonResponse
     */
    protected function create(SetRatingRequest $request)
    {
        if (Rating::where('article_id', $request->article_id)->exists())
            return response()->json([
                'status' => 'error',
                'message' => 'Rating already exists',
            ]);

        Rating::create([
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Rating created successfully',
            'rating' => Rating::where('article_id', $request->article_id)->count(),
            'isRated' => Rating::where('article_id', $request->article_id)
                ->where('user_id', Auth::guard('api')->id())
                ->exists()
        ]);
    }

    /**
     * @param SetRatingRequest $request
     * @return JsonResponse
     */
    protected function destroy(SetRatingRequest $request)
    {
        Rating::where('article_id', $request->article_id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Rating deleted successfully',
            'rating' => Rating::where('article_id', $request->article_id)->count(),
            'isRated' => Rating::where('article_id', $request->article_id)
                ->where('user_id', Auth::guard('api')->id())
                ->exists()
        ]);
    }
}
