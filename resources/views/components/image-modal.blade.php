<div
  x-data="{ isOpen: false, item: { image: '', title: '', description: '' } }"
  x-cloak
  x-show="$store.imageModal.isOpen && $store.imageModal.item.image"
  x-trap.inert.noscroll="$store.imageModal.isOpen && $store.imageModal.item"
  x-transition.opacity
  x-on:keydown.esc.window="$store.imageModal.close()"
  x-on:click.self="$store.imageModal.close()"
  class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4 sm:p-8"
  role="dialog"
  aria-modal="true"
>
    <div
        class="relative rounded-lg shadow-xl max-w-sm w-full overflow-hidden bg-black/70"
        x-transition:enter="transition ease-out duration-200 delay-100"
        x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100"
    >
        <button
            @click="$store.imageModal.close()"
            aria-label="Close modal"
            class="pt-2 px-2 absolute right-0 top-0 text-white hover:text-[var(--spotify-gray)] focus:outline-none z-20"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div
            class="absolute inset-0 bg-cover bg-center blur-3xl scale-200"
            x-bind:style="'background-image: url(' + $store.imageModal.item.image + ')'"
        ></div>
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 flex flex-col px-6 pb-6 pt-6">
            <div class="w-full overflow-hidden">
                <img
                    :src="$store.imageModal.item.image"
                    :alt="'image-' + $store.imageModal.item.title"
                    class="max-w-xs mx-auto rounded-lg"
                />
                <h2
                    class="text-lg font-bold text-white pt-3 text-center"
                    x-text="$store.imageModal.item.title"
                ></h2>
                <p
                    class="text-sm text-[var(--spotify-white)] mt-1"
                    x-text="$store.imageModal.item.description"
                ></p>
            </div>
        </div>
    </div>
</div>
