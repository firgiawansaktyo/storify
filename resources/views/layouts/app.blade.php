<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="64x64">
  <title>Storify</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--spotify-black)]">
  @yield('content')
  @stack('scripts')
</body>
</html>