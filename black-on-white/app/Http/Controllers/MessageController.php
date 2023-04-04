<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $messagesQuery = Message::orderByDesc('id')->paginate(20, ['*'], 'page');
        return MessageResource::collection($messagesQuery);
    }

    /**
     * Создание сообщения
     *
     * @param CreateMessageRequest $request
     * @return JsonResponse
     */
    public function create(CreateMessageRequest $request): JsonResponse
    {
        $message = Message::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'is_read' => false
        ]);

        return response()->json(['success' => new MessageResource($message)]);
    }

    /**
     * Просмотр сообщения
     *
     * @param Message $message
     * @return MessageResource
     */
    public function show(Message $message): MessageResource
    {
        return new MessageResource($message);
    }

    /**
     * Удаление сообщения
     *
     * @param Message $message
     * @return JsonResponse
     */
    public function destroy(Message $message): JsonResponse
    {
        try {
            $message->delete();
            return response()->json(['success' => 'Сообщение успешно удалено']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
