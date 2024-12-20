import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: ['jquery']  // Pastikan jQuery dioptimalkan oleh Vite
    },
    server: {
        https: true,  // Pastikan menggunakan HTTPS
    },
});
