<style>
    .wedding-landing-background {
        content: '';
        position: absolute;
        inset: 0;
        background: url('{{ cdn_sweetvows($wedding->wedding_landing_image) }}');
        background-size: cover;
        background-position: center;
        filter: blur(50px);
        transform: scale(3);
        z-index: -2;
    }

    .landing-cover::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent, #121212 60%, #121212 100%);
        z-index: -1;
    }
</style>

<div
    id="landingCard"
    class="landing-cover relative mx-auto w-full min-h-screen overflow-hidden"
>
    <div class="wedding-landing-background"></div>

    <div class="landing-header">
        <div class="min-h-screen max-w-xl w-full mx-auto landing-header-after px-4 sm:px-6 py-2 grid content-between">
            {{-- Cover image --}}
            <div class="relative pt-4">
                <img
                    src="{{ cdn_sweetvows($wedding->wedding_landing_image) }}"
                    alt="Landing Image"
                    class="w-full max-w-xs sm:max-w-sm md:max-w-md mx-auto object-cover shadow-lg"
                />
            </div>

            {{-- Content --}}
            <div class="relative bg-gradient-to-b from-transparent via-[var(--spotify-black)] to-[var(--spotify-black)] mt-6 sm:mt-8 pb-4">
                <h2 class="font-bold text-base sm:text-lg md:text-xl text-[var(--spotify-white)] pt-3 px-4 sm:px-6">
                    {{ $wedding->wedding_landing_title }}
                </h2>

                <p class="text-xs sm:text-sm md:text-base text-[var(--spotify-white)] px-4 sm:px-6 mt-1">
                    Cover: {{ $wedding->bride_name }} and {{ $wedding->groom_name }} ❤️
                </p>

                <div class="px-4 sm:px-6 flex flex-row items-center py-2 gap-2">
                    <img
                        src="{{ asset('logo/swan-rounded.png') }}"
                        alt="Sweet Vows Logo"
                        class="w-6 h-6 flex-shrink-0"
                    />
                    <span class="text-xs sm:text-sm md:text-base text-[var(--spotify-gray)] leading-snug">
                        Picked for
                        <span class="font-bold text-[var(--spotify-white)]">
                            {{ $invitedGuestName }}
                        </span>
                    </span>
                </div>

                <div class="px-4 sm:px-6 flex flex-wrap items-center gap-1 text-[var(--spotify-gray)] text-xs sm:text-sm md:text-base">
                    <span>
                        {{ \Carbon\Carbon::parse($wedding->wedding_vow_date)->locale('id')->translatedFormat('l, d F Y') }}
                    </span>
                    <span>•</span>
                    @php
                        $start = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_vow_start_time);
                        $end = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_reception_end_time);
                        $durationMinutes = $start->diffInMinutes($end);
                        $hours = intdiv($durationMinutes, 60);
                        $minutes = $durationMinutes % 60;
                        $durationString = $minutes > 0
                            ? "{$hours} hours {$minutes} minutes"
                            : "{$hours} hours";
                    @endphp
                    <span>{{ $durationString }}</span>
                </div>

                <button
                    id="seeDetailBtn"
                    class="mt-4 flex flex-col items-center justify-center mx-auto text-xs sm:text-sm md:text-base text-[var(--spotify-white)] hover:text-[var(--spotify-gray)] py-2"
                >
                    <span class="font-semibold tracking-wider uppercase">
                        Lihat lebih banyak
                    </span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 animate-bounce mt-1"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="landingSentinel" class="relative bottom-0 left-0 w-full h-px pb-10"></div>
    </div>
</div>

<div
    id="detailsSection"
    class="mx-auto min-h-screen max-w-xl w-full flex flex-col items-center justify-center px-4 sm:px-6 hidden opacity-0 -translate-y-8 transition-all duration-700"
>
    <div class="w-full container bg-[var(--spotify-black)] overflow-hidden">
        <x-episode :wedding="$wedding" :invitedGuestName="$invitedGuestName" />
        <x-video-banner :wedding="$wedding" />
        <x-description :wedding="$wedding" />
        <x-hot-news :wedding="$wedding" />
        <x-bridegroom :wedding="$wedding" />
        <x-location :wedding="$wedding" />
        <x-timeline :wedding="$wedding" />
        <x-throwback :throwbacks="$throwbacks" />
        <x-albums :albums="$albums" />
        <x-wishes :wishes="$wishes" :wedding="$wedding" />
        <x-gift :wedding="$wedding" :gifts="$gifts" :banks="$banks" />
        <x-footer />
    </div>
</div>