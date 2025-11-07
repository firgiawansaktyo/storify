<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sweet Vows</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
                /* Include your custom styles here */
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex items-center justify-center min-h-screen">
        <div class="flex items-center justify-center text-center lg:text-left transition-all translate-y-0 opacity-100 max-w-none duration-1000 starting:opacity-0 starting:translate-y-6 lg:grow starting:opacity-0">
            <!-- Logo and Title Section -->
            <img 
                src="{{ asset('logo/swan.png') }}" 
                alt="Sweet Vows Logo" 
                class="py-2"
                width="100"
                height="100"
            />

            <div class="pl-2 flex flex-col leading-tight mt-4 lg:mt-0">
                <span class="text-4xl lg:text-5xl font-semibold text-white">Sweet Vows</span>
                <span class="text-lg lg:text-2xl text-white">From Invitations to Celebration</span>
            </div>
        </div>
    </body>
</html>
