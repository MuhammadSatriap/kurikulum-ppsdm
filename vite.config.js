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
        include: ['jquery'],  // Pastikan jQuery dioptimalkan oleh Vite
    },
    server: {
        proxy: {
            // Menyambungkan semua permintaan yang dimulai dengan "/api" ke backend yang berjalan di port 9000
            '/api': 'https://kurikulum-ppsdm-production.up.railway.app/:9000', // Ganti dengan URL backend Anda
        },
    },
});
