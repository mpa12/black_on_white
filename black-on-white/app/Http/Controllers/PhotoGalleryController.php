<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePhotoGalleryRequest;
use App\Http\Resources\PhotoGalleryResource;
use App\Models\PhotoGallery;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryController extends Controller
{
    /**
     * Получение списка изображений
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PhotoGalleryResource::collection(PhotoGallery::orderByDesc('id')->paginate(50, ['*'], 'page'));
    }

    /**
     * @param CreatePhotoGalleryRequest $request
     * @return JsonResponse
     */
    public function create(CreatePhotoGalleryRequest $request)
    {
        $path = $request->file('photo')->store('photo-gallery', 'public');

        $photo = PhotoGallery::create(['photo' => $path]);

        return response()->json(['success' => new PhotoGalleryResource($photo)]);
    }

    /**
     * Удаление изображения
     *
     * @param PhotoGallery $photo
     * @return JsonResponse
     */
    public function destroy(PhotoGallery $photo): JsonResponse
    {
        try {
            Storage::disk('public')->delete($photo->photo);
            $photo->delete();
            return response()->json(['success' => 'Изображение успешно удалено']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->errorInfo]);
        }
    }
}
