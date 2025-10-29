<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h2 class="text-xl font-bold">Hot News</h2>
    <img class="rounded-md w-full h-full" src="{{ asset('storage/' . $wedding->wedding_hotnews_image) }}">
    <p class="pt-2 text-[var(--spotify-gray)]">
        {{ $wedding->wedding_hotnews_description }}
    </p>
</div>