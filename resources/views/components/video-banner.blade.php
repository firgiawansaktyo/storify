<div class="container-storify bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <video  src="{{ asset('storage/' . $wedding->wedding_video) }}"
            muted 
            class="max-w-full object-cover rounded-lg"
            id="video-banner">
    </video>    
    <audio 
        src="{{ asset('storage/' . $wedding->wedding_audio) }}"
        id="audio-banner">
    </audio>
</div>
