<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <video  src="{{ cdn_sweetvows($wedding->wedding_video) }}"
            autoplay
            controls
            playsinline
            preload="metadata"
            {{-- muted  --}}
            loop
            class="max-w-full object-cover rounded-lg"
            id="video-banner">
    </video>    
    {{-- <audio  src="{{ cdn_sweetvows($wedding->wedding_audio) }}"
            loop
            preload="none"
            muted
            id="audio-banner">
    </audio> --}}
</div>
