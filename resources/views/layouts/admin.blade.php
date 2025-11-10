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
@include('partials.user-info')
@stack('scripts')
</body>
</html>