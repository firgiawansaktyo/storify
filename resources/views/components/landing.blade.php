<div id="landingCard" class="landing-cover relative mx-auto justify-self-center w-full h-full">
    <div style="
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url('{{ asset('storage/' . $wedding->wedding_landing_image) }}');
        background-size: cover;
        background-position: center;
        filter: blur(50px);
        transform: scale(3);
        z-index: -2;
        height:10%
        ">
    </div>
    <div style="
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, transparent, #121212 60%, #121212 100%);
        z-index: -1;">
    </div>
    <div style="position: relative; z-index: 2;">
            <div class="min-h-screen max-w-xl mx-auto justify-items-center" style="position: relative; z-index: 2;">
                <div class="relative px-4 pt-4">
                    <img src="{{ asset('storage/' . $wedding->wedding_landing_image) }}" alt="Landing Image" class="w-80 h-auto mx-auto object-cover"/>
                    <div class="absolute top-6 left-6 right-6 flex items-center justify-between">
                        <img src="{{ asset('logo/swan-pink.png') }}" alt="Sweet Vows Logo" class="w-8 sm:w-9 md:w-10 lg:w-11" />
                        <h2 class="font-extrabold text-lg sm:text-xl md:text-2xl lg:text-3xl text-[#f4b9c9] drop-shadow-md text-right">
                            Wedding Day
                        </h2>
                    </div>
                </div>
                <div class="relative bg-gradient-to-b from-transparent via-[var(--spotify-black)] to-[var(--spotify-black)]">
                    <h2 class="font-bold text-lg relative text-[var(--spotify-white)] pt-2 px-6">{{ $wedding->wedding_landing_title }} Cover: {{ $wedding->bride_name }} and {{ $wedding->groom_name }} ❤️
                    </h2>
                    <div class="px-6 flex flew-row items-center py-1">
                        <img 
                            src="{{ asset('logo/swan-rounded.png') }}" 
                            alt="Sweet Vows Logo" 
                            class="w-6"/>
                        <span class="px-2 text-md text-[var(--spotify-gray)]">Picked for <span class="font-bold text-[var(--spotify-white)]">{{ $wedding->name }}</span>
                        </span>                        
                    </div>
                    <div class="px-6">
                        <span class="text-md text-[var(--spotify-gray)]">{{ \Carbon\Carbon::parse($wedding->wedding_vow_datas)->format('l, F j Y') }}</span>
                        <span class="text-md text-[var(--spotify-gray)]">•</span>
                        @php
                            $start = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_vow_start_time);
                            $end = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_reception_end_time);
                            $durationMinutes = $start->diffInMinutes($end);
                            $hours = intdiv($durationMinutes, 60);
                            $minutes = $durationMinutes % 60;
                            $durationString = "{$hours} hours";
                        @endphp
                        <span class="text-md text-[var(--spotify-gray)]">{{ $durationString }}</span>
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
            <div id="landingSentinel" class="relative bottom-0 left-0 w-full h-px pb-10"></div>
    </div>
</div>

<div id="detailsSection" class="mx-auto min-h-screen max-w-xl flex flex-col items-center justify-center hidden opacity-0 -translate-y-8 transition-all duration-700">
    <div class="max-w-xl container bg-[var(--spotify-black)]">
        <x-episode :wedding=$wedding/>
        <x-video-banner :wedding=$wedding/>
        <x-description :wedding=$wedding/>
        <x-hot-news :wedding=$wedding/>
        <x-bridegroom :wedding=$wedding/>
        <x-location :wedding=$wedding/>
        <x-timeline :wedding=$wedding/>
        <x-throwback :throwbacks=$throwbacks/>
        <x-albums :albums=$albums/>
        <x-wishes :wishes=$wishes :wedding=$wedding/>
        <x-gift :wedding=$wedding :gifts=$gifts :banks=$banks/>
        <x-footer/>
    </div>
</div>

