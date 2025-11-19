<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class FileUploadController extends Controller
{
    public function store(Request $request, $path)
    {   
        if (Auth::user()) {
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
                'bank_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
                'qris_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:204800',
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
                        'wedding_throwback_image' => 'wedding-throwback-images',
                        'bank_image' => 'bank-images',
                        'qris_image' => 'qris-images',
                    };

                    $finalPath = $path . '/' . $folder;

                    $s3Client = new S3Client([
                        'driver' => 's3',
                        'key'    => env('B2_KEY_ID'),
                        'secret' => env('B2_APP_KEY'),
                        'region' => env('B2_REGION'),
                        'bucket' => env('B2_BUCKET_NAME'),
                        'endpoint' => env('B2_ENDPOINT'),
                        'use_path_style_endpoint' => true,
                        'visibility' => 'public',
                        'throw' => true,
                        'checksum' => false,
                        'http' => [
                            'verify' => false,
                        ],
                    ]);

                    try {
                        $file = $request->file($field);
                        $fileContent = fopen($file->getRealPath(), 'r');
                        
                        $result = $s3Client->putObject([
                            'Bucket' => env('B2_BUCKET_NAME'),
                            'Key' => $finalPath . '/' . $file->getClientOriginalName(),
                            'Body' => $fileContent,
                            'ContentType' => $file->getMimeType(),
                        ]);

                        $validated[$field] = $result['ObjectURL'];
                    } catch (AwsException $e) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Error uploading to Backblaze B2: ' . $e->getMessage(),
                        ], 500);
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Upload complete.',
                'paths' => (object) $validated,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 401);
        }
    }   
}
