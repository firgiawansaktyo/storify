<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Throwback;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ImageModalController extends Controller
{
    public function show(string $id): JsonResponse
    {
        if (! Str::isUuid($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid id format.',
                'data'    => [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $disk = config('filesystems.default', env('FILESYSTEM_DISK', 'public'));

        $throwback = Throwback::find($id);
        $album     = $throwback ? null : Album::find($id);

        if ($throwback) {
            $imagePath = $throwback->wedding_throwback_image;

            $data = [
                'image'       => $imagePath ? Storage::disk($disk)->url($imagePath) : null,
                'title'       => $throwback->wedding_throwback_title,
                'description' => $throwback->wedding_throwback_description,
                'type'        => 'throwback',
            ];

            return response()->json([
                'success' => true,
                'message' => 'Throwback image loaded.',
                'data'    => $data,
            ], Response::HTTP_OK);
        }

        if ($album) {
            $imagePath = $album->wedding_album_image;

            $data = [
                'image'       => $imagePath ? Storage::disk($disk)->url($imagePath) : null,
                'title'       => $album->wedding_album_title,
                'description' => $album->wedding_album_description,
                'type'        => 'album',
            ];

            return response()->json([
                'success' => true,
                'message' => 'Album image loaded.',
                'data'    => $data,
            ], Response::HTTP_OK);
        }

        return response()->json([
            'success' => false,
            'message' => 'Image not found.',
            'data'    => [],
        ], Response::HTTP_NOT_FOUND);
    }
}
