import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/booking-modal.jsx',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/booking-app.js'
            ],
            refresh: true,
        }),
        react(),
    ],
});
