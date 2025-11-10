import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: 'localhost',
        port: 5173,
        headers: {
        'X-Content-Type-Options': 'nosniff',
        'Referrer-Policy': 'no-referrer-when-downgrade',
        'Cross-Origin-Resource-Policy': 'same-origin',
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js', 
                'resources/css/admin.css', 
                'resources/js/admin.js',
                'resources/js/albumCreate.js',
                'resources/js/albumUpdate.js',
                'resources/js/bankCreate.js',
                'resources/js/bankUpdate.js',
                'resources/js/coupleCreate.js',
                'resources/js/coupleUpdate.js',
                'resources/js/giftCreate.js',
                'resources/js/giftUpdate.js',
                'resources/js/throwbackCreate.js',
                'resources/js/throwbackUpdate.js',
                'resources/js/timelineCreate.js',
                'resources/js/timelineUpdate.js',
                'resources/js/weddingCreate.js',
                'resources/js/weddingUpdate.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
