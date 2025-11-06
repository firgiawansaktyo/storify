import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ command, mode }) => {
  const isDevelopment = mode === 'development';
  const isProduction = mode === 'production';

  return {
    server: {
      host: 'localhost',
      port: 5173,
      cors: {
        origin: isDevelopment ? 'http://localhost:8000' : 'https://sweetvows.site', // Restrict to your site
      },
      headers: {
        'X-Content-Type-Options': 'nosniff',
        'Referrer-Policy': 'no-referrer-when-downgrade',
      },
    },
    plugins: [
      laravel({
        input: [
          'resources/css/app.css',
          'resources/js/app.js',
          'resources/css/admin.css',
          'resources/js/admin.js',
        ],
        refresh: true,
      }),
      tailwindcss(),
    ],
    base: isProduction ? '/build/' : '/',
  };
});

