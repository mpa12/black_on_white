<?php

namespace App\Http\Controllers;

use App\Http\Requests\Participant\CreateParticipantRequest;
use App\Http\Requests\Participant\UpdateParticipantRequest;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ParticipantController extends Controller
{
    /**
     * Список участников
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ParticipantResource::collection(Participant::orderBy('name', 'asc')->get());
    }

    /**
     * Количество участников
     *
     * @return int
     */
    public function participants_count(): int
    {
        return Participant::all()->count();
    }

    /**
     * Создание участника
     *
     * @param CreateParticipantRequest $request
     * @return JsonResponse
     */
    public function create(CreateParticipantRequest $request): JsonResponse
    {
        $path = $request->file('photo')->store('participant', 'public');
        Image::make(public_path('storage/' . $path))
            ->encode('webp', 0)
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save();

        $participant = Participant::create([
            'name' => $request->name,
            'role' => $request->role,
            'photo' => $path,
        ]);

        return response()->json(['success' => new ParticipantResource($participant)]);
    }

    /**
     * Просмотр участника
     *
     * @param Participant $participant
     * @return ParticipantResource
     */
    public function show(Participant $participant): ParticipantResource
    {
        return new ParticipantResource($participant);
    }

    /**
     * Редактирование участника
     *
     * @param UpdateParticipantRequest $request
     * @param Participant $participant
     * @return JsonResponse
     */
    public function update(UpdateParticipantRequest $request, Participant $participant): JsonResponse
    {
        foreach ($participant->fillable as $item) {
            if ($item === 'photo') continue;
            $participant->$item = $request->$item ?? $participant->$item;
        }

        $image = $request->file('photo');
        if ($image) {
            $storage = Storage::disk('public');
            if ($storage->exists($participant->photo)) $storage->delete($participant->photo);
            $participant->photo = $image->store('articles', 'public');
            Image::make(public_path('storage/' . $participant->photo))
                ->encode('webp', 0)
                ->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save();
        }

        try {
            $participant->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }

        return response()->json(['success' => new ParticipantResource($participant)]);
    }

    /**
     * Удаление участника
     *
     * @param Participant $participant
     * @return JsonResponse
     */
    public function destroy(Participant $participant): JsonResponse
    {
        try {
            Storage::disk('public')->delete($participant->photo);
            $participant->delete();
            return response()->json(['success' => 'Участник успешно удален']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
