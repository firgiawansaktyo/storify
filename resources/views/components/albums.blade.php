<div class="container-storify bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Albums</h2>
    <div class="relative w-full max-w-xl">
        <!-- Prev & Next buttons -->
        <button id="prevBtn"
        class="absolute left-0 top-1/2 -translate-y-1/2 bg-[var(--spotify-black)]/50 hover:bg-[var(--spotify-black)]/70 p-2 rounded-full z-10"
        aria-label="Previous">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15 19l-7-7 7-7"/>
        </svg>
        </button>
        <button id="nextBtn"
        class="absolute right-0 top-1/2 -translate-y-1/2 bg-[var(--spotify-black)]/50 hover:bg-[var(--spotify-black)]/70 p-2 rounded-full z-10"
        aria-label="Next">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 5l7 7-7 7"/>
        </svg>
        </button>

        <!-- Carousel -->
        <div id="carousel" class="flex overflow-x-auto no-scrollbar scroll-smooth px-1 py-1 space-x-4">
            <div class="carousel-card flex-shrink-0 w-48">
                <div class="p-2 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition">
                    <div class="aspect-square overflow-hidden w-full rounded-lg">
                        <img
                        src="https://slametandfatma.wedding/galeri/1.jpg"
                        alt="Album 1"
                        class="rounded-lg w-full h-full object-cover"
                        />
                    </div>
                    <div class="pt-2 flex-1">
                        <span class="text-sm font-semibold">Wedding Day #1</span>
                        <p class="text-[var(--spotify-gray)] text-xs">Love Story Begin #1</p>
                    </div>
                </div>
            </div>
            <div class="carousel-card flex-shrink-0 w-48">
                <div class="p-2 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition">
                    <div class="aspect-square overflow-hidden w-full rounded-lg">
                        <img
                        src="https://slametandfatma.wedding/galeri/2.jpg"
                        alt="Album 1"
                        class="rounded-lg w-full h-full object-cover"
                        />
                    </div>
                    <div class="pt-2 flex-1">
                        <span class="text-sm font-semibold">Wedding Day #2</span>
                        <p class="text-[var(--spotify-gray)] text-xs">Love Story Begin #2</p>
                    </div>
                </div>
            </div>
            <div class="carousel-card flex-shrink-0 w-48">
                <div class="p-2 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition">
                    <div class="aspect-square overflow-hidden w-full rounded-lg">
                        <img
                        src="https://slametandfatma.wedding/galeri/3.jpg"
                        alt="Album 1"
                        class="rounded-lg w-full h-full object-cover"
                        />
                    </div>
                    <div class="pt-2 flex-1">
                        <span class="text-sm font-semibold">Wedding Day #3</span>
                        <p class="text-[var(--spotify-gray)] text-xs">Love Story Begin #3</p>
                    </div>
                </div>
            </div>
            <div class="carousel-card flex-shrink-0 w-48">
                <div class="p-2 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition">
                    <div class="aspect-square overflow-hidden w-full rounded-lg">
                        <img
                        src="https://slametandfatma.wedding/galeri/4.jpg"
                        alt="Album 1"
                        class="rounded-lg w-full h-full object-cover"
                        />
                    </div>
                    <div class="pt-2 flex-1">
                        <span class="text-sm font-semibold">Wedding Day #4</span>
                        <p class="text-[var(--spotify-gray)] text-xs">Love Story Begin #4</p>
                    </div>
                </div>
            </div>
            <div class="carousel-card flex-shrink-0 w-48">
                <div class="p-2 rounded-lg cursor-pointer hover:bg-[var(--spotify-gray-semibold)] hover:scale-105 transition">
                    <div class="aspect-square overflow-hidden w-full rounded-lg">
                        <img
                        src="https://slametandfatma.wedding/galeri/5.jpg"
                        alt="Album 1"
                        class="rounded-lg w-full h-full object-cover"
                        />
                    </div>
                    <div class="pt-2 flex-1">
                        <span class="text-sm font-semibold">Wedding Day #5</span>
                        <p class="text-[var(--spotify-gray)] text-xs">Love Story Begin #5</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>