import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',
        cors: {
            origin: "http://siccad-roo.test",
            credentials: true,
        },
        hmr: {
            host: 'siccad-roo.test',
        }
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                'app/Livewire/**'
            ],
        }),
    ],
});
