const API_KEY = import.meta.env.VITE_PUBLIC_API_KEY;

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

document.addEventListener('alpine:init', () => {
    Alpine.store('imageModal', {
        isOpen: false,
        item: null,
        async fetch({ id }) {
            let res = await fetch(`/api/images/${id}`, {
                headers: { 'X-API-KEY': API_KEY }
            });
            if (!res.ok) throw new Error('failed to load');
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