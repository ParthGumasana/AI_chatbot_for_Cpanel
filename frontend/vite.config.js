// frontend/vite.config.js
import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command, mode }) => {
    // Load .env files from the root of the project
    const env = loadEnv(mode, process.cwd(), '');

    return {
        plugins: [
            laravel({
                // The 'input' array specifies the assets that Laravel's @vite directive expects.
                input: ['resources/css/app.css', 'resources/js/app.js'],
                refresh: true,
            }),
        ],
        // Expose environment variables to the client-side JavaScript
        define: {
            'process.env': env
        },
        server: {
            host: '0.0.0.0', // Allow external access for development
            port: 5173,      // Default Vite port
            watch: {
                usePolling: true, // For Docker/WSL/cPanel shared filesystems
            }
        }
    };
});
