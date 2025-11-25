import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

document.addEventListener('alpine:init', () => {
    Alpine.store('imageModal', {
        isOpen: false,
        item: null,

        open(item) {
            this.item = item;
            this.isOpen = true;
        },

        close() {
            this.isOpen = false;
            this.item = null;
        }
    });
});

window.Alpine = Alpine;
Alpine.start();
