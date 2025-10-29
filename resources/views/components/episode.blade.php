<div class="podcast-section">
  <div style="
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('{{ asset('storage/' . $wedding->wedding_image) }}');
    background-size: cover;
    filter: blur(60px);
    transform: scale(3);
    z-index: 1;
    height:30%
    ">
  </div>
  <div style="position: relative; z-index: 2;">
      <div class="podcast-header items-center">
        <div class="podcast-content flex flex-row align-center p-6 items-center justify-center gap-6">
          <img
            class="podcast-cover rounded-lg"
            src="{{ asset('storage/' . $wedding->wedding_image) }}"
            alt="Episode Cover Art"
          />
          <div class="podcast-text flex-1 gap-6">
            <div class="podcast-label flex align-center">
            <span class="text-sm">•</span>
              <span class="text-xs sm:text-xs md:text-base lg:text-sm xl:text-md font-semibold">New Podcast Episode</span>
            </div>
            <h1 class="podcast-title text-sm sm:text-md md:text-lg lg:text-xl xl:text-2xl font-bold">{{ $wedding->wedding_title }}</h1>
            <div class="podcast-subtitle text-sm sm:text-lg md:text-xl font-medium">{{ $wedding->wedding_sub_title }}</div>
          </div>
        </div>
      </div>
      <div class="podcast-duration max-w-3xl mx-auto px-6 pt-2.5 pb-2 bg-gradient-to-b from-[var(--spotify-gray-bold)]/40 to-[var(--spotify-gray-bold)]">
        <div class="flex flew-row items-center">
          <img 
            src="{{ asset('logo/swan-rounded.png') }}" 
            alt="Sweet Vows Logo" 
            class="w-6"/>
          <span class="px-1 text-sm text-[var(--spotify-gray)]">Picked for <span class="font-bold text-[var(--spotify-white)]">{{ $wedding->name }}</span></span>
          <span class="px-1 text-sm text-[var(--spotify-gray)]">•</span>
          <svg class="w-4 h-4 text-[var(--spotify-gray)] border-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M8.6 5.2A1 1 0 0 0 7 6v12a1 1 0 0 0 1.6.8l8-6a1 1 0 0 0 0-1.6l-8-6Z" clip-rule="evenodd"/>
          </svg>
          <span class="px-1 text-sm text-[var(--spotify-gray)]">Video</span>
          <span class="px-1 text-sm text-[var(--spotify-gray)]">•</span>
          <svg class="w-6 info-flipped" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
          </svg>
          <span class="px-1 text-sm]">Hot Released</span>
        </div>
        <div>
          <span class="text-sm text-[var(--spotify-gray)]">{{ \Carbon\Carbon::parse($wedding->wedding_vow_datas)->format('l, F j Y') }}</span>
          <span class="text-sm text-[var(--spotify-gray)]">•</span>
          @php
              $start = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_vow_start_time);
              $end = \Carbon\Carbon::createFromFormat('H:i', $wedding->wedding_reception_end_time);
              $durationMinutes = $start->diffInMinutes($end);
              $hours = intdiv($durationMinutes, 60);
              $minutes = $durationMinutes % 60;
              $durationString = "{$hours} hours";
          @endphp
          <span class="text-sm text-[var(--spotify-gray)]">{{ $durationString }}</span>
        </div>

        <div class="flex items-center pt-2.5 space-x-4">
          <!-- Play/Pause -->
          <button id="playPause" class="w-12 h-12 bg-[var(--spotify-green)] rounded-full flex items-center justify-center hover:bg-green-400 transition">
            <svg id="playIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="w-6 h-6 text-black" fill="currentColor">
              <path d="M8 5v14l11-7z"/>
            </svg>
            <svg id="pauseIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                  class="w-6 h-6 text-black hidden" fill="currentColor">
              <rect x="6" y="4" width="4" height="16" rx="1"/>
              <rect x="14" y="4" width="4" height="16" rx="1"/>
            </svg>
          </button>
          <div class="flex-1">
            <div class="flex items-center space-x-2 text-sm text-[var(--spotify-gray)]">
              <span id="currentTime">0:00</span>
              <div id="progressContainer" class="flex-1 h-1 bg-[var(--spotify-gray)] rounded overflow-hidden">
                <div id="progressBar" class="h-full bg-[var(--spotify-green)]" style="width:0%"></div>
              </div>
              <span id="duration">0:00</span>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
