<div class="container-sweetvows bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Album Description</h2>
    <p class="text-[var(--spotify-gray)]">
        {{ $wedding->wedding_description }}
    </p>
</div>

<div class="container-sweetvows bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Pray Verse Description</h2>
    <p class="italic text-[var(--spotify-gray)]">
        {{ $wedding->wedding_prayer_verse ??  null }}
    </p>
</div>