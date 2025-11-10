<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="64x64">
  <title>Sweet Vows</title>
  @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="page-top">
  <div id="wrapper">
      @include('partials.sidebar')
      <div id="content-wrapper" class="d-flex flex-column ml-2 mr-2">
          <div id="content" class="bg-[var(--spotify-black)]">
              @include('partials.topbar')
              <div class="container-fluid bg-[var(--spotify-gray-bold)] rounded-xl min-h-screen">  
                  @yield('content')                      
              </div>
          </div>
          @include('partials.footer')
      </div>
  </div>
<script>
  window.path = @json($path);
  window.albumStoreRoute = "{{ route('albums.store') }}";
  window.albumUpdateRoute = "{{ route('albums.update', ['album' => '__ALBUM_ID__']) }}";
  window.bankStoreRoute = "{{ route('banks.store') }}";
  window.bankUpdateRoute = "{{ route('banks.update', ['bank' => '__BANK_ID__']) }}";
  window.coupleStoreRoute = "{{ route('couples.store') }}";
  window.coupleUpdateRoute = "{{ route('couples.update', ['couple' => '__COUPLE_ID__']) }}";
  window.giftStoreRoute = "{{ route('gifts.store') }}";
  window.giftUpdateRoute = "{{ route('gifts.update', ['gift' => '__GIFT_ID__']) }}";
  window.throwbackStoreRoute = "{{ route('throwbacks.store') }}";
  window.throwbackUpdateRoute = "{{ route('throwbacks.update', ['throwback' => '__THROWBACK_ID__']) }}";
  window.timelineStoreRoute = "{{ route('timelines.store') }}";
  window.timelineUpdateRoute = "{{ route('timelines.update', ['timeline' => '__TIMELINE_ID__']) }}";
  window.weddingStoreRoute = "{{ route('weddings.store') }}";
  window.weddingUpdateRoute = "{{ route('weddings.update', ['wedding' => '__WEDDING_ID__']) }}";
</script>
@include('partials.user-info')
@stack('scripts')
</body>
</html>