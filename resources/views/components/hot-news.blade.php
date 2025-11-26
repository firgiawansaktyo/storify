<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold title-sweetvows mb-4">Hot News</h3>
    <img class="rounded-lg max-w-full mb-3" src="{{ cdn_sweetvows($wedding->wedding_hotnews_image) }}">
    <p class="text-sm text-[var(--spotify-gray)]">
        {{ $wedding->wedding_hotnews_description }}
    </p>
</div>
