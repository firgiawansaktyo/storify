<div class="container-storify bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Throwback</h2>
    <div class="relative w-full max-w-4xl">
        <!-- Prev/Next buttons -->
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

        <div id="carousel-throwback" class="flex overflow-x-auto no-scrollbar scroll-smooth px-1 py-1 space-x-4">
            <!-- Repeat this block for each album -->
            <div class="carousel-card-throwback flex-shrink-0 w-48"> <!-- 12rem wide fixed -->
                <div class="throwback-cover max-w-sm mx-auto justify-items-center episode-box overflow-hidden p-2 rounded-lg">
                    <!-- Album Cover -->
                    <img src="episodes/borntodie.jpg" alt="Lana Del Rey Born To Die" class="w-1/2 h-auto relative rounded-lg" />
                    <!-- Album Info -->
                    <div class="p-1">
                        <h2 class="font-bold text-xs uppercase relative">Born To Die: Paradise Edition</h2>
                        <div class="text-xs relative text-[var(--spotify-gray)]">
                            <p>It is the story of young women getting pulled into tricky situations until they can't get out. It's a reflection of those rebellious years of being young, but also a reflection of what happens when it goes too far. By the end of the song, she sings about getting sent away.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-card-throwback flex-shrink-0 w-48"> <!-- 12rem wide fixed -->
                <div class="throwback-cover max-w-sm mx-auto justify-items-center episode-box overflow-hidden p-2 rounded-lg">
                    <!-- Album Cover -->
                    <img src="episodes/borntodie.jpg" alt="Lana Del Rey Born To Die" class="w-1/2 h-auto relative rounded-lg" />
                    <!-- Album Info -->
                    <div class="p-1">
                        <h2 class="font-bold text-xs uppercase relative">Born To Die: Paradise Edition</h2>
                        <div class="text-xs relative text-[var(--spotify-gray)]">
                            <p>It is the story of young women getting pulled into tricky situations until they can't get out. It's a reflection of those rebellious years of being young, but also a reflection of what happens when it goes too far. By the end of the song, she sings about getting sent away.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-card-throwback flex-shrink-0 w-48"> <!-- 12rem wide fixed -->
                <div class="throwback-cover max-w-sm mx-auto justify-items-center episode-box overflow-hidden p-2 rounded-lg">
                    <!-- Album Cover -->
                    <img src="episodes/borntodie.jpg" alt="Lana Del Rey Born To Die" class="w-1/2 h-auto relative rounded-lg" />
                    <!-- Album Info -->
                    <div class="p-1">
                        <h2 class="font-bold text-xs uppercase relative">Born To Die: Paradise Edition</h2>
                        <div class="text-xs relative text-[var(--spotify-gray)]">
                            <p>It is the story of young women getting pulled into tricky situations until they can't get out. It's a reflection of those rebellious years of being young, but also a reflection of what happens when it goes too far. By the end of the song, she sings about getting sent away.</p>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>