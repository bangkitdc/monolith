import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: "/monolith/public/build/",
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        https: false,
        host: true,
        strictPort: true,
        port: 5173,
        hmr: { host: "localhost", protocol: "ws" },
        watch: {
            usePolling: true,
        },
    },
});
