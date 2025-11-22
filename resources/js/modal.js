import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

document.addEventListener('alpine:init', () => {
    Alpine.store('imageModal', {
        isOpen: false,
        item: null,
        loading: false,
        error: null,

        async fetch({ id }) {
            const url = `/images/${id}`;

            this.loading = true;
            this.error   = null;

            try {
                const res = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                    }
                });

                if (!res.ok) {
                    console.error('imageModal fetch failed', res.status, url);
                    throw new Error(`Request failed with status ${res.status}`);
                }

                const dataJson = await res.json();

                if (!dataJson.success) {
                    throw new Error(dataJson.message || 'Failed to load image data');
                }

                this.item   = dataJson.data;
                this.isOpen = true;
            } catch (err) {
                console.error('imageModal error', err);
                this.error = err.message || 'Failed to load';
                this.isOpen = false;
            } finally {
                this.loading = false;
            }
        },

        close() {
            this.isOpen = false;
        }
    });
});

window.Alpine = Alpine;
Alpine.start();
