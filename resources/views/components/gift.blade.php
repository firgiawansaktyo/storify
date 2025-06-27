<div class="container-storify bg-[var(--spotify-gray-bold)]">
    <h2 class="text-xl font-bold text-white">Wedding Gift</h2>
    <p class="text-sm text-[var(--spotify-gray)]">
        Bagi tamu undangan yang ingin memberikan tanda kasih untuk calon pengantin, dapat diberikan melalui:
    </p>

    <!-- BCA Section -->
    <div class="flex items-center rounded-lg p-3 mb-3 relative">
        <img src="{{asset('bank/bca.jpg')}}" alt="BCA" class="w-1/8 object-contain mx-auto mr-3">
        <div class="flex-1">
            <input hidden class="text-sm font-medium" id="bca-account" value="123123">123123</p>
            <p class="text-sm text-gray-400">a.n Yohan Putra Nugraha</p>
        </div>
        <button data-copy-to-clipboard-target="bca-account" class="absolute end-2.5 top-1/2 -translate-y-1/2 text-gray-900 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 rounded-lg py-2 px-2.5 inline-flex items-center justify-center bg-white border-gray-200 border h-8">
            <span id="default-message-bca">
                <span class="inline-flex items-center">
                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                    </svg>
                    <span class="text-xs font-semibold">Copy</span>
                </span>
            </span>
            <span id="success-message-bca" class="hidden">
                <span class="inline-flex items-center">
                    <svg class="w-3 h-3 text-[var(--spotify-green)] me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span class="text-xs font-semibold text-[#5dbc6c]">Copied</span>
                </span>
            </span>
        </button>
    </div>

    <!-- Mandiri Section -->
    <div class="flex items-center rounded-lg p-3 relative">
        <img src="{{asset('bank/mandiri.jpg')}}" alt="Mandiri" class="w-1/8 object-contain mx-auto mr-3">
        <div class="flex-1">
            <input hidden class="text-sm font-medium" id="mandiri-account" value="0261020240">0261020240</p>
            <p class="text-sm text-gray-400">a.n Alya Fadilah M.R</p>
        </div>
  
        <button data-copy-to-clipboard-target="mandiri-account" class="absolute end-2.5 top-1/2 -translate-y-1/2 text-gray-900 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-600 dark:hover:bg-gray-700 rounded-lg py-2 px-2.5 inline-flex items-center justify-center bg-white border-gray-200 border h-8">
            <span id="default-message-mandiri">
                <span class="inline-flex items-center">
                    <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                    </svg>
                    <span class="text-xs font-semibold">Copy</span>
                </span>
            </span>
            <span id="success-message-mandiri" class="hidden">
                <span class="inline-flex items-center">
                    <svg class="w-3 h-3 text-[var(--spotify-green)] me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span class="text-xs font-semibold text-[#5dbc6c]">Copied</span>
                </span>
            </span>
        </button>
    </div>
</div>




