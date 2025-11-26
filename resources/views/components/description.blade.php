<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold title-sweetvows">Album Description</h3>
    <p class="text-sm text-[var(--spotify-gray)]">
        {{ $wedding->wedding_description }}
    </p>
</div>

<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold title-sweetvows">Pray Verse Description</h3>
    <p class="text-sm italic text-[var(--spotify-gray)]">
        {{ $wedding->wedding_prayer_verse ??  null }}
    </p>
</div>