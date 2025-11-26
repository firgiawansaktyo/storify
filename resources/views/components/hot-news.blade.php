<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold">Hot News</h3>
    <img class="rounded-lg max-w-full" src="{{ cdn_sweetvows($wedding->wedding_hotnews_image) }}">
    <p class="text-sm text-[var(--spotify-gray)]">
        {{ $wedding->wedding_hotnews_description }}
    </p>
</div>
