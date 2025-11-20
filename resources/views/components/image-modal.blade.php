@php
    $disk = env('FILESYSTEM_DISK', config('filesystems.default', 'public'));
    $diskUrl = rtrim(config('filesystems.disks.' . $disk . '.url') ?? '', '/');
    if ($disk === 'b2') {
        $endpoint = rtrim(env('B2_ENDPOINT'), '/');
        $bucket   = trim(env('B2_BUCKET_NAME'), '/');
        $diskUrl  = rtrim($endpoint . '/' . $bucket, '/');
    }
@endphp


<div
  x-data
  x-cloak
  x-show="$store.imageModal.isOpen && $store.imageModal.item"
  x-trap.inert.noscroll="$store.imageModal.isOpen"
  x-transition.opacity
  x-on:keydown.esc.window="$store.imageModal.close()"
  x-on:click.self="$store.imageModal.close()"
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 sm:p-8"
  role="dialog"
  aria-modal="true"
>
    <template x-if="$store.imageModal.isOpen && $store.imageModal.item">
        <div
            x-on:keydown.window.escape="$store.imageModal.close()"
            x-on:click.self="$store.imageModal.close()"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
            role="dialog"
            aria-modal="true"
        >
            <div
                class="rounded-lg shadow-xl max-w-sm max-h-sm w-full relative overflow-hidden"
                x-transition:enter="transition ease-out duration-200 delay-100"
                x-transition:enter-start="scale-90 opacity-0"
                x-transition:enter-end="scale-100 opacity-100"
            >
                <!-- Blurred background -->
                <div
                    class="absolute inset-0 bg-cover bg-center blur-3xl scale-200"
                    x-bind:style="'background-image: url({{ $diskUrl }}/' + $store.imageModal.item.image + ')'"
                ></div>

                <!-- Dark overlay -->
                <div class="absolute inset-0 bg-black/40"></div>

                <!-- Content -->
                <div class="relative z-10 bg-opacity-80 flex flex-col">
                    <button
                        @click="$store.imageModal.close()"
                        aria-label="Close modal"
                        class="pt-2 px-2 self-end text-white hover:text-[var(--spotify-gray)] focus:outline-none"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="w-full h-2/3 overflow-hidden px-6 pb-4">
                        <img
                            :src="'{{ $diskUrl }}/' + $store.imageModal.item.image"
                            :alt="'image-' + $store.imageModal.item.title"
                            class="max-w-xs justify-self-center rounded-lg"
                        />
                        <h2
                            class="text-lg font-bold text-white pt-2"
                            x-text="$store.imageModal.item.title"
                        ></h2>
                        <p
                            class="text-sm text-[var(--spotify-white)]"
                            x-text="$store.imageModal.item.description"
                        ></p>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
