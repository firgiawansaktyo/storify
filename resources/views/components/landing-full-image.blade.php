<div id="landingCard" class="relative mx-auto justify-self-center w-full h-full overflow-hidden">
    <div class="max-w-xl mx-auto justify-items-center">
        <div class="relative w-full max-w-xl mx-auto group">
            <div class="min-h-screen bg-cover bg-center bg-no-repeat flex flex-col justify-end mb-10"
                style="background-image: url('https://slametandfatma.wedding/galeri/nikahfix.jpg');">
                    <div class="relative bg-gradient-to-b from-transparent via-[var(--spotify-black)] to-[var(--spotify-black)]">
                        <h2 class="font-bold text-lg relative text-[var(--spotify-white)] pt-2 px-6">Special scenes for our special day. Cover: Fatmawati and Slamet Riyadi ❤️
                        </h2>
                        <div class="px-6 flex flew-row items-center py-1">
                            <img 
                                src="{{ asset('logo/swan-rounded.png') }}" 
                                alt="Storify Logo" 
                                class="w-6"/>
                            <span class="px-2 text-md text-[var(--spotify-gray)]">Made for <span class="font-bold text-[var(--spotify-white)]">You</span>
                            </span>                        
                        </div>
                        <div class="px-6">
                            <span class="text-md text-[var(--spotify-gray)]">Monday, 10 December 2025</span>
                            <span class="text-md text-[var(--spotify-gray)]">•</span>
                            <span class="text-md text-[var(--spotify-gray)]">5h</span>
                        </div>
                        <button id="seeDetailBtn" class="flex flex-col items-center justify-center justify-self-center hover:text-[var(--spotify-gray)] py-2">
                            <span class="font-semibold tracking-wider">Show more</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 animate-bounce space-y-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
            </div>
            <div class="absolute top-2 left-2 right-2 flex items-center justify-between px-2">
                <img src="{{ asset('logo/swan-pink.png') }}" alt="Storify Logo" class="w-8 sm:w-9 md:w-10 lg:w-11"/>
                <h2 class="font-extrabold text-center text-lg sm:text-xl md:text-2xl lg:text-3xl text-[#f4b9c9] drop-shadow-md">
                    Wedding Day
                </h2>
            </div>
        
        </div>
    </div>
    <div id="landingSentinel" class="relative bottom-0 left-0 w-full h-px pb-10"></div>
</div>

<div id="detailsSection" class="mx-auto min-h-screen max-w-xl flex flex-col items-center justify-center hidden opacity-0 -translate-y-8 transition-all duration-700">
    <div class="max-w-xl container bg-[var(--spotify-black)]">
        <x-podcast/>
        <x-video-banner/>
        <x-description/>
        <x-hot-news/>
        <x-bridegroom/>
        <x-location/>
        <x-timeline/>
        <x-throwback/>
        <x-albums/>
        <x-wishes/>
        <x-gift/>
        <x-footer/>
    </div>
</div>

