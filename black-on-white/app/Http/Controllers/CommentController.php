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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
