<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageModalResource;
use App\Models\Album;
use App\Models\InvitedGuest;
use App\Models\Throwback;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ImageModalController extends Controller
{
    public function show(string $id)
    {
        $encryptedId = $id;
        $id = decrypt($encryptedId);
        if (! Str::isUuid($id)) {
            return new ImageModalResource(false, Response::HTTP_UNPROCESSABLE_ENTITY, []);
        }

        $throwbacks = Throwback::find($id);
        $albums = Album::find($id);
        if ($throwbacks) {
            $images = [
                'image' => $throwbacks->wedding_throwback_image,
                'title' => $throwbacks->wedding_throwback_title,
                'description' => $throwbacks->wedding_throwback_description
            ];
            return new ImageModalResource(true, Response::HTTP_OK, $images);
        }
        else if($albums) {
            $images = [
                'image' => $albums->wedding_album_image,
                'title' => $albums->wedding_album_title,
                'description' => $albums->wedding_album_description
            ];
            return new ImageModalResource(true, Response::HTTP_OK, $images);
        }
        else {
            return new ImageModalResource(false, Response::HTTP_NOT_FOUND, []);
        }
    }
}
