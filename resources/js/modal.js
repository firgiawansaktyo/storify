const API_KEY = import.meta.env.VITE_PUBLIC_API_KEY;
const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

document.addEventListener('alpine:init', () => {
    Alpine.store('imageModal', {
        isOpen: false,
        item: null,
        async fetch({ id }) {
            const url = `${API_BASE_URL}/pictures/${id}`;

            let res = await fetch(url, {
                headers: { 'X-API-KEY': API_KEY }
            });

            if (!res.ok) {
                console.error('imageModal fetch failed', res.status, url);
                throw new Error('failed to load');
            }

            this.dataJson = await res.json();
            this.item = this.dataJson.data;
            this.isOpen = true;
        },
        close() {
            this.isOpen = false;
        }
    });
});

window.Alpine = Alpine;
Alpine.start();
