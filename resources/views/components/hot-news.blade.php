<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold title-sweetvows mb-2">Hot News</h3>
    <img class="rounded-lg max-w-full mb-2" src="{{ cdn_sweetvows($wedding->wedding_hotnews_image) }}">
    <p class="text-sm text-[var(--spotify-gray)] mb-2">
        {{ $wedding->wedding_hotnews_description }}
    </p>
</div>
