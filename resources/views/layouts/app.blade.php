<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="64x64">
  <title>Sweet Vows</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--spotify-black)]">
  @yield('content')
  <x-image-modal />
  <div id="floatingPlayer" class="fixed bottom-5 right-5 z-50 hidden">    
    <button id="playPauseFloat" class="w-12 h-12 bg-[var(--spotify-green)] rounded-full flex items-center justify-center hover:bg-green-400 transition">
      <!-- Play Icon -->
      <svg id="playIconFloat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
          class="w-6 h-6 text-black" fill="currentColor">
        <path d="M8 5v14l11-7z"/>
      </svg>
      <!-- Pause Icon -->
      <svg id="pauseIconFloat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
          class="w-6 h-6 text-black hidden" fill="currentColor">
        <rect x="6" y="4" width="4" height="16" rx="1"/>
        <rect x="14" y="4" width="4" height="16" rx="1"/>
      </svg>
    </button>
  </div>
  @stack('scripts')
</body>
</html>