<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function store(Request $request, $path)
    {   
        if (!Auth::user()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 401);
        }

        $fieldsConfig = [
            'bride_image'             => 'bride-images',
            'groom_image'             => 'groom-images',
            'wedding_image'           => 'wedding-images',
            'wedding_video'           => 'wedding-videos',
            'wedding_audio'           => 'wedding-audios',
            'wedding_landing_image'   => 'wedding-landing-images',
            'wedding_hotnews_image'   => 'wedding-hotnews-images',
            'wedding_vow_image'       => 'vow-images',
            'wedding_reception_image' => 'reception-images',
            'wedding_album_image'     => 'wedding-album-images',
            'wedding_throwback_image' => 'wedding-throwback-images',
            'bank_image'              => 'bank-images',
            'qris_image'              => 'qris-images',
        ];

        $s3Client = new S3Client([ 
            'version' => 'latest',
            'region'  => env('B2_REGION'),
            'endpoint' => env('B2_ENDPOINT'),
            'use_path_style_endpoint' => true,
            'signature_version'=> 'v4',
            'http' => [
                'verify' => false,
            ],
            'credentials' => [
                'key'    => env('B2_KEY_ID'),
                'secret' => env('B2_APP_KEY'),
            ],
        ]);

        $bucket = env('B2_BUCKET_NAME');
        $resultData = [];

        foreach ($fieldsConfig as $field => $folder) {

            $filenameKey     = $field . '_filename';
            $contentTypeKey  = $field . '_content_type';

            if (!$request->filled($filenameKey) || !$request->filled($contentTypeKey)) {
                continue;
            }

            $filename    = $request->input($filenameKey);
            $contentType = $request->input($contentTypeKey);

            $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            $imageExts = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
            $videoExts = ['mp4', 'mov', 'avi', 'wmv', 'flv', 'webm', 'mkv'];
            $audioExts = ['mp3', 'wav', 'ogg', 'flac', 'aac', 'm4a'];

            if (str_contains($field, 'image') || in_array($field, ['bride_image','groom_image'])) {
                if (!in_array($extension, $imageExts)) {
                    return response()->json([
                        'success' => false,
                        'message' => "Invalid file type for {$field}.",
                    ], 422);
                }
            }

            if ($field === 'wedding_video' && !in_array($extension, $videoExts)) {
                return response()->json([
                    'success' => false,
                    'message' => "Invalid file type for {$field}.",
                ], 422);
            }

            if ($field === 'wedding_audio' && !in_array($extension, $audioExts)) {
                return response()->json([
                    'success' => false,
                    'message' => "Invalid file type for {$field}.",
                ], 422);
            }

            $finalPath = trim($path, '/') . '/' . $folder;
            $uniqueName = Str::uuid() . ($extension ? '.' . $extension : '');
            $key = $finalPath . '/' . $uniqueName;

            try {
                $cmd = $s3Client->getCommand('PutObject', [
                    'Bucket' => $bucket,
                    'Key'    => $key,
                ]);

                $presignedRequest = $s3Client->createPresignedRequest($cmd, '+30 minutes');
                $uploadUrl = (string) $presignedRequest->getUri();
                $publicUrl =  ltrim($key, '/');

                $resultData[$field] = [
                    'upload_url'   => $uploadUrl,
                    'path'         => $key,
                    'public_url'   => $publicUrl,
                    'content_type' => $contentType,
                ];
            } catch (AwsException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error generating presigned URL for ' . $field . ': ' . $e->getMessage(),
                ], 500);
            }
        }

        if (empty($resultData)) {
            return response()->json([
                'success' => false,
                'message' => 'No valid file metadata provided.',
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Presigned URLs generated.',
            'paths'   => (object) $resultData,
        ]);
    }   
}
