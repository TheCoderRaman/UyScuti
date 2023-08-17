import path from 'path';
import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';
import i18n from 'laravel-react-i18n/vite';

export default defineConfig({
    content: [
        './resources/**/*.vue',
        './resources/**/*.blade.php',
        './resources/**/*.{js,ts,jsx,tsx}'
    ],
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/index.jsx',
                'resources/js/index.css',
            ],
            refresh: true,
        }),
        tailwindcss(),react(),i18n()
    ],
    resolve: {
        alias: {
          '@': path.resolve(__dirname, './resources/js/Frontend'),
        },
    },
});
