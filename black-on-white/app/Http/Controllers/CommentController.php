<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Просмотр комментареив
     *
     * @param int $article_id ID новости
     * @return AnonymousResourceCollection
     */
    public function index(int $article_id): AnonymousResourceCollection
    {
        $commentsQuery = Comment::where('article_id', $article_id)->get();
        return CommentResource::collection($commentsQuery);
    }

    /**
     * Создание комментария
     *
     * @param CreateCommentRequest $request
     * @return JsonResponse
     */
    public function create(CreateCommentRequest $request): JsonResponse
    {
        $comment = Comment::create([
            'body' => $request->body,
            'user_id' => Auth::user()['id'],
            'article_id' => $request->article_id,
            'parent_id' => $request->parent_id,
        ]);

        return response()->json(['success' => new CommentResource($comment)]);
    }

    /**
     * Редактирование комментария
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Удаление комментария
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function destroy(Comment $comment)
    {
        try {
            if (Auth::user()['id'] === $comment->user_id || Auth::user()['is_admin']) {
                $comment->delete();
                return response()->json(['success' => 'Комментарий успешно удален']);
            } else {
                return response()->json(['error' => 'Недостаточно прав для удаления комментария']);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
