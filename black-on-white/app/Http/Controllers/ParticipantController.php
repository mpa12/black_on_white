<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParticipantRequest;
use App\Http\Resources\ParticipantResource;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     * Создание участника
     *
     * @param CreateParticipantRequest $request
     * @return JsonResponse
     */
    public function create(CreateParticipantRequest $request)
    {
        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('participant'), $imageName);

        $participant = Participant::create([
            'name' => $request->name,
            'role' => $request->role,
            'photo' => '/articles/' . $imageName,
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
     * Update the specified resource in storage.
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
     * Удаление участника
     *
     * @param Participant $participant
     * @return JsonResponse
     */
    public function destroy(Participant $participant): JsonResponse
    {
        try {
            $participant->delete();
            return response()->json(['success' => 'Участник успешно удален']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
