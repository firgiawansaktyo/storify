<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="64x64">
  <title>Sweet Vows</title>
  @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="min-h-screen flex items-center justify-center">
            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="o-hidden border-1 border-[var(--spotify-gray-semibold)] rounded-lg my-5">
                    <div class="card-body p-0 bg-[var(--spotify-gray-bold)]">
                        <!-- Nested Row within Card Body -->
                        <div class="col">
                            <div class="hidden lg:flex flex-1 items-center justify-center">
                                <div class="flex items-center justify-center">
                                    <img 
                                    src="{{ asset('logo/swan.png') }}" 
                                    alt="Sweet Vows Logo" 
                                    class="py-2"
                                    width="100"
                                    height="100"
                                    />
                                    <span class="pl-2 relative text-5xl font-semibold text-[var(--spotify-white)]">Sweet Vows</span>
                                </div>
                            </div>
                            <div class="col-lg-6 text-center justify-center justify-self-center items-center">
                                <div class="p-5">
                                    <div class="text-red-500 text-3xl">
                                        {{ $error ?? 'An unexpected error occurred.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
