import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);

document.addEventListener('alpine:init', () => {
    Alpine.store('imageModal', {
        isOpen: false,
        item: {
            image: '',
            title: '',
            description: '',
        },

        open(item) {
            if (item && item.image) {
                this.item = item;
                this.isOpen = true;
            }
        },

        close() {
            this.isOpen = false;
            this.item = {
                image: '',
                title: '',
                description: '',
            };
        }
    });
});


window.Alpine = Alpine;
Alpine.start();
