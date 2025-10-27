import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
          input: [
                'resources/js/app.js',
                'resources/js/authenticated.js',
                'resources/js/loading.js',
                'resources/js/auth.js',
                'resources/css/app.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
