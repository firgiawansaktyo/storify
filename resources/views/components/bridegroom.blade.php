<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold title-sweetvows mb-4">Bride & Groom</h3>
    <div class="grid grid-cols-2 bride-groom">
        <div>
            <img src="{{ cdn_sweetvows($wedding->bride_image) }}" class="max-w-full bride mb-3">
            <div>
                <h4 class="text-sm bride-name mb-1">{{ $wedding->bride_name }}</h4>
                <p class="text-xs pt-2 bride-parent text-[var(--spotify-gray)]">Putri dari Bapak {{ $wedding->father_bride_name }} &amp; Ibu {{ $wedding->mother_bride_name }}</p>
            </div>
        </div>
        <div>
            <img src="{{ cdn_sweetvows($wedding->groom_image) }}" class="max-w-full groom mb-2">
            <div>
                <h4 class="text-sm groom-name mb-1">{{ $wedding->groom_name }}</h4>
                <p class="text-xs pt-2 groom-parent text-[var(--spotify-gray)]">Putra dari Bapak {{ $wedding->father_groom_name }} &amp; Ibu {{ $wedding->mother_groom_name }}</p>
            </div>
        </div>
    </div>
</div>
