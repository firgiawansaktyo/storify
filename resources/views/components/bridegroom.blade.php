<div class="container-sweetvows bg-[var(--spotify-gray-bold)] max-w-3xl mx-auto">
    <h3 class="text-md font-bold">Bride & Groom</h3>
    <div class="grid grid-cols-2 bride-groom">
        <div>
            <img src="{{ cdn_sweetvows($wedding->bride_image) }}" class="max-w-full bride">
            <div>
                <h4 class="text-sm bride-name text-center">{{ $wedding->bride_name }}</h4>
                <p class="text-xs pt-2 bride-parent text-center text-[var(--spotify-gray)]">Putri dari Bapak {{ $wedding->father_bride_name }} <br/>&amp; <br/> Ibu {{ $wedding->mother_bride_name }}</p>
            </div>
        </div>
        <div>
            <img src="{{ cdn_sweetvows($wedding->groom_image) }}" class="max-w-full groom">
            <div>
                <h4 class="text-sm groom-name text-center">{{ $wedding->groom_name }}</h4>
                <p class="text-xs pt-2 groom-parent text-center text-[var(--spotify-gray)]">Putra dari Bapak {{ $wedding->father_groom_name }} <br/>&amp; <br/> Ibu {{ $wedding->mother_groom_name }}</p>
            </div>
        </div>
    </div>
</div>
