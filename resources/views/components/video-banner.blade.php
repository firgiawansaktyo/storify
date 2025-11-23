<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <video  src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_video) }}"
            playsinline
            preload="metadata"
            muted 
            class="max-w-full object-cover rounded-lg"
            id="video-banner">
    </video>    
    <audio 
        preload="none"
        src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_audio) }}"
        id="audio-banner">
    </audio>
</div>
