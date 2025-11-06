import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ command, mode }) => {
  // Set the correct CORS origin based on the environment (development or production)
  const isDevelopment = mode === 'development';
  const isProduction = mode === 'production';

  return {
    server: {
      host: 'localhost', // ensure this matches your local development server
      port: 5173,
      cors: {
        origin: isDevelopment ? 'http://localhost:8000' : 'https://sweetvows.site', // CORS for dev and prod
      },
      headers: {
        'X-Content-Type-Options': 'nosniff', // Security headers
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
      tailwindcss(), // Ensure TailwindCSS is included
    ],
    base: isProduction ? '/build/' : '/', // Correct base URL in production
  };
});
