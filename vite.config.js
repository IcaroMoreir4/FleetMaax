import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import postcssImport from 'postcss-import';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            url: process.env.APP_URL || 'http://localhost',
            forceDomain: true,
        }),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    css: {
        postcss: {
            plugins: [
                postcssImport,
                tailwindcss,
                autoprefixer,
            ],
        },
    },
});
