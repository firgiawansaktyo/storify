@php
    $disk = env('FILESYSTEM_DISK');

    $videoPath  = $wedding->wedding_video;
    $audioPath  = $wedding->wedding_audio;
    $posterPath = $wedding->wedding_image;

    $videoUrl  = Storage::disk($disk)->url($videoPath);
    $audioUrl  = Storage::disk($disk)->url($audioPath);
    $posterUrl = Storage::disk($disk)->url($posterPath);
@endphp
<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <video
        id="video-banner"
        class="max-w-full w-full aspect-video object-cover rounded-lg"
        muted
        playsinline
        preload="metadata"
        poster="{{ $posterUrl }}"
        data-src="{{ $videoUrl }}"
    ></video>

    <audio
        id="audio-banner"
        preload="none"
        data-src="{{ $audioUrl }}"
    ></audio>
</div>
