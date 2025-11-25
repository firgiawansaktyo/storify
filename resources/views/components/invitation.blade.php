<div id="invitationPage" class="flex flex-col items-center justify-center w-full h-screen">
    <div class="w-full max-w-xl px-4">
        <div class="text-center">
            <x-logo/>
        </div>
        <div class="w-full flex justify-center">
            <h1 class="font-bold text-2xl text-center">
                Picked For {{ $invitedGuestName }}
            </h1>
        </div>
        <div class="flex items-center justify-center">
            <div id="LandingBtn" class="group w-full grid grid-cols-2 md:grid-cols-2 rounded-lg p-0.5 hover:bg-[var(--spotify-gray-semibold)] cursor-pointer overflow-hidden hover:scale-105 transition">
                <div>
                    <img src="{{ cdn_sweetvows($wedding->wedding_image) }}" alt="Wedding Cover" class="w-full h-auto object-cover rounded-l-lg"/>
                </div>
                <div class="relative group flex flex-col items-start md:items-start justify-center
                            space-y-2 bg-[var(--spotify-gray-bold)] px-6 py-4 rounded-r-lg">

                    <h2 class="text-sm sm:text-md md:text-lg lg:text-xl xl:text-2xl font-bold text-start md:text-left">
                        {{ $wedding->wedding_title }}
                    </h2>

                    <p class="text-xs sm:text-sm md:text-md text-[var(--spotify-gray)]">
                        {{ $wedding->wedding_sub_title }}
                    </p>

                    <div class="flex flex-wrap gap-1">
                        @forelse ($hashtags as $tag)
                            <span class="text-xs sm:text-sm md:text-md rounded-full">
                                #{{ $tag->name }}
                            </span>
                        @empty
                        @endforelse
                    </div>

                    <div class="absolute inset-0 p-2 transition-colors duration-200 flex items-center justify-center rounded-l-lg">
                        <button class="button-spotify absolute bottom-4 right-4 bg-[var(--spotify-green)] p-3 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="black">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button id="LandingBtn" class="flex flex-col items-center justify-center justify-self-center hover:text-gray-300 py-4">
        <svg class="w-6 h-6 animate-bounce" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7"/>
        </svg>
        <span class="font-semibold tracking-wider">Tap the album cover to dive into our stories</span>
    </button>
    <div id="invitationSentinel" class="relative bottom-0 left-0 w-full h-px pb-10"></div>
</div>

<div id="goToLanding" class="hidden opacity-0 -translate-y-8 transition-all duration-700">
    <x-landing :wedding=$wedding :albums=$albums :throwbacks=$throwbacks :wishes=$wishes :gifts=$gifts :banks=$banks :invitedGuestName=$invitedGuestName/>
</div>
