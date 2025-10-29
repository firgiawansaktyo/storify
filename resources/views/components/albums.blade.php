<div x-data class="container-sweetvows bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Albums</h2>
    <div class="relative w-full max-w-xl">

        <button id="prevBtnAlbums"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-[var(--spotify-black)]/50 hover:bg-[var(--spotify-black)]/70 p-2 rounded-full z-10"
            aria-label="Previous">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button id="nextBtnAlbums"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-[var(--spotify-black)]/50 hover:bg-[var(--spotify-black)]/70 p-2 rounded-full z-10"
            aria-label="Next">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <div id="carousel-albums" class="flex overflow-x-auto no-scrollbar scroll-smooth px-1 py-1">
            @foreach ($albums as $album )
            @php
                $encryptedId = encrypt($album->id);
            @endphp
            <div class="carousel-card-albums flex-shrink-0 w-48 h-64 p-1" 
            @click="$store.imageModal.fetch({ id: '{{ $encryptedId }}' })"
            >
                <div class="p-1 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition flex flex-col">
                    <div class="aspect-square overflow-hidden w-full rounded-lg">
                        <img
                        src="{{ asset('storage/' . $album->wedding_album_image) }}"
                        alt="image-{{ $album->wedding_album_title }}"
                        class="rounded-lg w-full h-full object-cover"
                        />
                    </div>
                    <div class="flex flex-col justify-center pt-2 h-15">
                        <span class="text-sm font-semibold truncate">{{ $album->wedding_album_title }}</span>
                        <p class="text-[var(--spotify-gray)] text-xs line-clamp-2">{{ $album->wedding_album_description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>