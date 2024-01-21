<?php

namespace App\Http\Controllers;

use App\Http\Actions\ArticleType\ArticleTypeCreateAction;
use App\Http\Requests\ArticleType\CreateArticleTypeRequest;
use App\Http\Resources\ArticleTypeResource;
use App\Models\ArticleType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

// TODO: Сделать CRUD для типов.
class ArticleTypeController extends Controller
{
    /**
     * Получение списка типов новостей.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ArticleTypeResource::collection(ArticleType::all());
    }

    /**
     * Создание типа новости.
     *
     * @param ArticleTypeCreateAction $action
     * @param CreateArticleTypeRequest $request
     *
     * @return ArticleTypeResource
     */
    public function create(ArticleTypeCreateAction $action, CreateArticleTypeRequest $request): ArticleTypeResource
    {
        return ($action)($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
