<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="64x64">
  <title>Storify</title>
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
                        <div class="row">
                            <div class="hidden lg:flex flex-1 items-center justify-center">
                                <div class="flex items-center justify-center">
                                    <img 
                                    src="{{ asset('logo/swan.png') }}" 
                                    alt="Storify Logo" 
                                    class="py-2"
                                    width="100"
                                    height="100"
                                    />
                                    <span class="pl-2 relative text-5xl font-semibold text-[var(--spotify-white)]">Storify</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        @if ($errors->any())
                                            <h1 class="h4">Storify Panel</h1>
                                            <div>
                                                <ul>
                                                    @foreach ($errors->all() as $error) <div class="text-red-500 text-lg">Username/Password Salah</div> @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <h1 class="h4 mb-4">Storify Panel</h1>
                                        @endif

                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input name="username" type="username" class="text-[var(--spotify-white)] form-control" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password" class="form-control " placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-spotify btn-block">
                                            Login
                                        </button>
                                    </form>
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
