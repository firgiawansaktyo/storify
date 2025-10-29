<div class="container-storify bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Location</h2>
    <div class="grid grid-cols-2 gap-4 justify-center items-center">
        <div x-data x-init="() => {
            let iframe = $el.querySelector('iframe[src*=&quot;google.com/maps/embed&quot;]');
            if (!iframe) return;
            iframe.classList.add('rounded-lg');
            iframe.removeAttribute('width');
            iframe.removeAttribute('height');
            iframe.style.cssText += 'border:0; width:100%;';
            iframe.src = iframe.src.replace('!5e1', '!5e0');
        }">
            {!! $wedding->wedding_vow_iframe !!}
        </div>
        <div>
            <p class="text-md">{{ $wedding->wedding_vow_location }}</p>
            <p class="text-sm text-[var(--spotify-gray)]"> {{ $wedding->wedding_vow_address }}</p>
        <a  class="underline text-center text-sm"
            href="{{ $wedding->wedding_vow_location_link }}"
            target="_blank"
            rel="noopener noreferrer">
            Show Location
        </a>
        </div>
    </div>
</div>

