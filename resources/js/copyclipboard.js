document.addEventListener('click', function(e) {
    const btn = e.target.closest('[data-copy-to-clipboard-target]');
    if (!btn) return;

    const inputId    = btn.getAttribute('data-copy-to-clipboard-target');
    const defaultId  = btn.getAttribute('data-copy-default');
    const successId  = btn.getAttribute('data-copy-success');

    const inputEl = document.getElementById(inputId);
    const defaultEl = document.getElementById(defaultId);
    const successEl = document.getElementById(successId);

    if (!inputEl) return;

    // Copy logic
    const val = inputEl.value || '';
    navigator.clipboard.writeText(val).then(() => {
        if (defaultEl && successEl) {
            defaultEl.classList.add('hidden');
            successEl.classList.remove('hidden');
            setTimeout(() => {
                successEl.classList.add('hidden');
                defaultEl.classList.remove('hidden');
            }, 1400);
        }
    });
});
