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
        host: '0.0.0.0', // Agar Vite dapat diakses dari luar
        port: parseInt(process.env.PORT) || 5173, // Gunakan port yang ditentukan Railway
    },

});
