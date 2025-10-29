<div class="container-sweetvows bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Bride & Groom</h2>
    <div class="grid grid-cols-2 bride-groom">
        <div>
        <img src="{{ asset ('storage/' . $wedding->bride_image) }}" class="w-full bride">
        <div>
            <h4 class="bride-name text-center">{{ $wedding->bride_name }}</h4>
            <p class="pt-2 bride-parent text-center text-[var(--spotify-gray)]">Putri dari Bapak{{ $wedding->father_bride_name }} &amp; Ibu {{ $wedding->mother_bride_name }}</p>
        </div>
        </div>
        <div>
        <img src="{{ asset('storage/' . $wedding->groom_image) }}" class="w-full groom">
        <div>
            <h4 class="groom-name text-center">{{ $wedding->groom_name }}</h4>
            <p class="pt-2 groom-parent text-center text-[var(--spotify-gray)]">Putra dari Bapak {{ $wedding->father_groom_name }} &amp; Ibu {{ $wedding->mother_groom_name }}</p>
        </div>
        </div>
    </div>
</div>