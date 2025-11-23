<div class="container-sweetvows bg-[var(--spotify-gray-bold)] p-5 rounded-xl">
    <h2 class="text-xl font-bold mb-4">Timeline</h2>

    <div class="timeline pl-5">
        <ol class="relative border-s border-white">
            <li class="mb-10 ms-6 ml-8">
                <span class="absolute flex items-center justify-center w-6 h-6 
                    bg-[var(--spotify-gray-bold)] rounded-full -start-3 ring-8 ring-white">
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </span>

                <h3 class="mb-1 text-xl font-semibold">Akad</h3>
                <time class="block mb-1 text-sm font-normal text-[var(--spotify-gray)]">
                    {{ \Carbon\Carbon::parse($wedding->wedding_vow_date)->format('d F Y') }},
                    {{ $wedding->wedding_vow_start_time }} - {{ $wedding->wedding_vow_end_time }} WIB
                </time>
                <p class="mb-1 text-base font-normal text-[var(--spotify-gray)]">
                    {{ $wedding->wedding_vow_location }}
                </p>
                @if ($wedding->wedding_vow_image)
                    <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_vow_image) }}"
                         alt="Akad Image"
                         class="w-1/4 h-auto rounded-lg mt-2" />
                @endif
            </li>
            <li class="ms-6 ml-8">
                <span class="absolute flex items-center justify-center w-6 h-6 
                    bg-[var(--spotify-gray-bold)] rounded-full -start-3 ring-8 ring-white">
                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </span>

                <h3 class="mb-1 text-xl font-semibold">Resepsi</h3>

                <time class="block mb-1 text-sm font-normal text-[var(--spotify-gray)]">
                    {{ \Carbon\Carbon::parse($wedding->wedding_reception_date)->format('d F Y') }},
                    {{ $wedding->wedding_reception_start_time }} - {{ $wedding->wedding_reception_end_time }} WIB
                </time>

                <p class="text-base font-normal text-[var(--spotify-gray)]">
                    {{ $wedding->wedding_reception_location }}
                </p>

                @if ($wedding->wedding_reception_image)
                    <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($wedding->wedding_reception_image) }}"
                         alt="Resepsi Image"
                         class="w-1/4 h-auto rounded-lg mt-2" />
                @endif
            </li>

        </ol>
    </div>
</div>
