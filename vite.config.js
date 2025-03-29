import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/vite.js',
                'resources/sass/app.scss',
                'resources/auth/css/style.scss',
            ],
            refresh: true,
        }),
    ],
});
