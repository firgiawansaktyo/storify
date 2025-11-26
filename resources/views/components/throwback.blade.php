<div x-data class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold title-sweetvows">Throwbacks</h3>
    <div class="relative w-full max-w-4xl">

        <button id="prevBtnThrowback"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-[var(--spotify-black)]/50 hover:bg-[var(--spotify-black)]/70 p-2 rounded-full z-10"
                aria-label="Previous">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 19l-7-7 7-7"/>
            </svg>
        </button>
        
        <button id="nextBtnThrowback"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-[var(--spotify-black)]/50 hover:bg-[var(--spotify-black)]/70 p-2 rounded-full z-10"
                aria-label="Next">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        <div id="carousel-throwback" class="flex overflow-x-auto no-scrollbar scroll-smooth px-1 py-1">
            @foreach ($throwbacks as $throwback)
                <div
                    class="carousel-card-throwback flex-shrink-0 w-48 h-64 p-1"
                    @click="$store.imageModal.open({
                        image: '{{ cdn_sweetvows($throwback->wedding_throwback_image) }}',
                        title: @js($throwback->wedding_throwback_title),
                        description: @js($throwback->wedding_throwback_description),
                    })"
                >
                    <div class="throwback-cover p-1 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition flex flex-col">
                        <div class="relative aspect-square overflow-hidden w-full rounded-lg">
                            <img
                                src="{{ cdn_sweetvows($throwback->wedding_throwback_image) }}"
                                alt="image-{{ $throwback->wedding_throwback_title }}"
                                class="rounded-lg w-full h-full object-cover"
                            />
                        </div>
                        <div class="relative flex flex-col justify-center pt-2 h-15">
                            <span class="text-sm font-semibold truncate">
                                {{ $throwback->wedding_throwback_title }}
                            </span>
                            <p class="text-[var(--spotify-gray)] text-xs line-clamp-2">
                                {{ $throwback->wedding_throwback_description }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
