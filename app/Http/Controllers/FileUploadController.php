<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function store(Request $request, $path)
    {   
        $validated = [];

        foreach ([
            'bride_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'groom_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_video' => 'mimes:mp4,mov,avi,wmv,flv,webm,mkv|max:1024000',
            'wedding_audio' => 'mimes:mp3,wav,ogg,flac,aac,m4a|max:204800',
            'wedding_landing_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_hotnews_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_vow_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_reception_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_album_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
            'wedding_throwback_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',



        ] as $field => $rules) {
            if ($request->hasFile($field)) {
                $request->validate([$field => $rules]);

                $folder = match($field) {
                    'bride_image' => 'bride-images',
                    'groom_image' => 'groom-images',
                    'wedding_image' => 'wedding-images',
                    'wedding_video' => 'wedding-videos',
                    'wedding_audio' => 'wedding-audios',
                    'wedding_landing_image' => 'wedding-landing-images',
                    'wedding_hotnews_image' => 'wedding-hotnews-images',
                    'wedding_vow_image' => 'vow-images',
                    'wedding_reception_image' => 'reception-images',
                    'wedding_album_image' => 'wedding-album-images',
                    'wedding_throwback_image' => 'wedding-throwback-images'
                };

                $finalPath = $path . '/' . $folder;
                Storage::disk('public')->makeDirectory($finalPath);
                $validated[$field] = $request->file($field)->store($finalPath, 'public');
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Upload complete.',
            'paths' => (object) $validated,
        ]);
    }
}
