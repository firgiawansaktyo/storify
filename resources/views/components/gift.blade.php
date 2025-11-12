<div class="container-sweetvows bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold">Wedding Gift</h2>
    <p class="text-sm text-[var(--spotify-gray)]">
        Bagi tamu undangan yang ingin memberikan tanda kasih untuk calon pengantin, dapat diberikan melalui:
    </p>

    @forelse($gifts as $gift)
        @php
            $inputId   = "gift-account-{$gift->id}";
            $defaultId = "copy-default-{$gift->id}";
            $successId = "copy-success-{$gift->id}";
            $modalId   = "qrisModal-{$gift->id}";
        @endphp

       <div class="flex items-center rounded-lg p-3 relative">
            {{-- Bank Logo --}}
            <img
                src="{{ $gift->bank && $gift->bank->bank_image ? Storage::disk(env('FILESYSTEM_DISK'))->url($gift->bank->bank_image) : asset('bank/default.jpg') }}"
                alt="{{ $gift->bank->name ?? 'Bank' }}"
                class="w-12 h-12 object-contain mr-3 rounded bg-white"
            >

            {{-- Account Info --}}
            <div class="flex-1">
                <p class="text-sm font-medium text-white tracking-wide">
                    {{ $gift->bank->name ?? 'Bank' }}
                </p>
                <p class="text-xs text-gray-400">
                    a.n <span class="font-medium text-gray-200">{{ $gift->account_holder }}</span>
                </p>

                {{-- Account number and Copy Button --}}
                @if (!$gift->qris_image)
                    <input type="text" id="{{ $inputId }}" value="{{ $gift->account_number }}" class="sr-only" readonly>

                    <div class="flex items-center gap-2 absolute right-2 top-1/2 -translate-y-1/2 mr-1">
                        <button
                            data-copy-to-clipboard-target="{{ $inputId }}"
                            data-copy-default="{{ $defaultId }}"
                            data-copy-success="{{ $successId }}"
                            class="text-gray-900 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 rounded-lg py-2 px-2.5 inline-flex items-center justify-center bg-white border-gray-200 border h-8"
                        >
                            <span id="{{ $defaultId }}">
                                <span class="inline-flex items-center">
                                    <svg class="w-3 h-3 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                                    </svg>
                                    <span class="text-xs font-semibold">Copy</span>
                                </span>
                            </span>
                            <span id="{{ $successId }}" class="hidden">
                                <span class="inline-flex items-center">
                                    <svg class="w-3 h-3 text-[var(--spotify-green)] me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-[#5dbc6c]">Copied</span>
                                </span>
                            </span>
                        </button>
                    </div>
                @endif
            </div>

            {{-- QRIS Button --}}
            @if($gift->qris_image)
                <button
                    id="modal-toggle-{{ $gift->id }}"
                    class="text-xs font-semibold flex items-center gap-1 rounded-lg py-2 px-2.5 bg-white border border-gray-200 hover:bg-gray-100 text-gray-900 h-8"
                    aria-label="Show QRIS"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-3 h-3 mr-1.5">
                        <path d="M160 224L224 224L224 160L160 160L160 224zM96 144C96 117.5 117.5 96 144 96L240 96C266.5 96 288 117.5 288 144L288 240C288 266.5 266.5 288 240 288L144 288C117.5 288 96 266.5 96 240L96 144zM160 480L224 480L224 416L160 416L160 480zM96 400C96 373.5 117.5 352 144 352L240 352C266.5 352 288 373.5 288 400L288 496C288 522.5 266.5 544 240 544L144 544C117.5 544 96 522.5 96 496L96 400zM416 160L416 224L480 224L480 160L416 160zM400 96L496 96C522.5 96 544 117.5 544 144L544 240C544 266.5 522.5 288 496 288L400 288C373.5 288 352 266.5 352 240L352 144C352 117.5 373.5 96 400 96zM384 416C366.3 416 352 401.7 352 384C352 366.3 366.3 352 384 352C401.7 352 416 366.3 416 384C416 401.7 401.7 416 384 416zM384 480C401.7 480 416 494.3 416 512C416 529.7 401.7 544 384 544C366.3 544 352 529.7 352 512C352 494.3 366.3 480 384 480zM480 512C480 494.3 494.3 480 512 480C529.7 480 544 494.3 544 512C544 529.7 529.7 544 512 544C494.3 544 480 529.7 480 512C480 494.3 465.7 480 448 480C430.3 480 416 465.7 416 448C416 430.3 430.3 416 448 416C465.7 416 480 430.3 480 448z"/>
                    </svg>
                    QRIS
                </button>
            @endif
        </div>

        @if($gift->qris_image)
            <div class="modal fade gift-qris" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-qris bg-transparent">
                        <img src="{{ Storage::disk(env('FILESYSTEM_DISK'))->url($gift->qris_image) }}" alt="QRIS {{ $gift->bank->name ?? '' }}" class="rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="rounded-lg p-3 bg-[var(--spotify-black)] text-sm text-gray-400">
            Belum ada data gift.
        </div>
    @endforelse
</div>
