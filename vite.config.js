import path from 'path';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import i18n from 'laravel-react-i18n/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        react(),i18n()
    ],
    resolve: {
        alias: {
          '@': path.resolve(__dirname, './resources/js/Frontend'),
        },
    },
});
