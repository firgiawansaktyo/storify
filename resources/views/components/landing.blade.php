<style>
  .wedding-landing-background {
      content: '';
      position: absolute;
      inset: 0;
      background: url('{{ cdn_sweetvows($wedding->wedding_landing_image) }}');
      background-size: cover;
      background-position: center;
      filter: blur(30px);
      transform: scale(1.5);
      z-index: -2;
  }

  .landing-cover::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, 
          transparent 0%, 
          rgba(18, 18, 18, 0.7) 40%,
          #121212 75%,
          #121212 100%
      );
      z-index: -1;
  }

  .font-smoother {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
  }
</style>

<div
    id="landingCard"
    class="landing-cover relative mx-auto w-full min-h-screen overflow-hidden"
>
    <div class="wedding-landing-background"></div>

    <div class="landing-header">
        <div class="min-h-screen max-w-xl w-full mx-auto landing-header-after px-4 sm:px-6 py-4 grid content-end">
            
            <div class="relative pt-8 mb-6">
                <img
                    src="{{ cdn_sweetvows($wedding->wedding_landing_image) }}"
                    alt="Landing Image"
                    class="w-full max-w-xs sm:max-w-sm md:max-w-md mx-auto object-cover shadow-2xl rounded-lg transform transition-transform duration-500 hover:scale-[1.02]"
                />
            </div>

            <div class="relative mt-6 sm:mt-8 pb-4 font-smoother"> 
                
                <h2 class="font-extrabold text-2xl sm:text-3xl md:text-4xl text-[var(--spotify-white)] px-4 sm:px-6 leading-tight">
                    {{ $wedding->wedding_landing_title }}
                </h2>

                <p class="text-sm sm:text-base md:text-lg text-[var(--spotify-white)] px-4 sm:px-6 mt-2">
                    Cover: {{ $wedding->bride_name }} and {{ $wedding->groom_name }}
                </p>

                <div class="px-4 sm:px-6 flex flex-row items-center py-4 gap-2 border-t border-[var(--spotify-gray)]/30 mt-3">
                    <img
                        src="{{ asset('logo/swan-rounded.png') }}"
                        alt="Sweet Vows Logo"
                        class="w-7 h-7 flex-shrink-0 rounded-full"
                    />
                    <span class="text-sm sm:text-base md:text-lg text-[var(--spotify-gray)] leading-snug">
                        Picked for
                        <span class="font-extrabold text-[var(--spotify-white)]">
                            {{ $invitedGuestName }}
                        </span>
                    </span>
                </div>

                <div class="px-4 sm:px-6 flex flex-wrap items-center gap-x-2 gap-y-1 text-[var(--spotify-gray)] text-sm sm:text-base md:text-lg mb-4">
                    <span class="font-semibold text-[var(--spotify-white)]">
                        {{ \Carbon\Carbon::parse($wedding->wedding_vow_date)->locale('id')->translatedFormat('l, d F Y') }}
                    </span>
                    <span class="text-xl leading-none">·</span>
                    @php
                        $start = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_vow_start_time);
                        $end = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_reception_end_time);
                        $durationMinutes = $start->diffInMinutes($end);
                        $hours = intdiv($durationMinutes, 60);
                        $minutes = $durationMinutes % 60;
                        
                        if ($minutes > 0) {
                            $durationString = "{$hours} hours {$minutes} minutes";
                        } else {
                            $durationString = "{$hours} hours";
                        }
                    @endphp
                    <span>{{ $durationString }}</span>
                </div>

                <button
                    id="seeDetailBtn"
                    class="mt-4 flex flex-col items-center justify-center mx-auto text-sm sm:text-base md:text-lg text-[var(--spotify-green)] hover:text-[var(--spotify-white)] py-4 transition-colors duration-300"
                >
                    <span class="font-bold tracking-widest uppercase text-lg">
                        Lihat lebih banyak
                    </span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 animate-bounce mt-2"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="3"
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
    class="mx-auto min-h-screen max-w-xl w-full flex flex-col items-center justify-center px-0 sm:px-0 hidden opacity-0 -translate-y-8 transition-all duration-1000"
>
    <div class="w-full overflow-hidden"> 
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