<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <video
        id="video-banner"
        class="max-w-full w-full h-auto object-cover rounded-lg"
        muted
        playsinline
        preload="none"
        poster="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_image ?? $wedding->wedding_landing_image) }}"
        data-src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_video) }}"
    >
        Browser Anda tidak mendukung pemutar video.
    </video>

    <audio
        id="audio-banner"
        preload="none"
        data-src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_audio) }}"
    >
        Browser Anda tidak mendukung pemutar audio.
    </audio>
</div>
