import { fileURLToPath, URL } from 'node:url';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import path from 'path'
import { viteStaticCopy } from 'vite-plugin-static-copy'
import ViteImages from 'vite-plugin-vue-images'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/js/main.js'],
            publicDirectory: "public_html",
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: "resources/js/assets/img",
                    dest: "../build/assets",
                },
            ],
            publicDirectory: "public_html",
        }),
        ViteImages({
            //dirs: ['src/assets'], // relative path to the image directory
            extensions: ['jpg', 'jpeg', 'png', 'svg', 'webp'], // valid image extensions
            customResolvers:[], // Override the default behavior of name->image path resolution
            customSearchRegex: '([a-zA-Z0-9]+)', // Override the Regex that searches for the variable to replace.
        }),
    ],
    resolve: {
        alias: {
            // '@': path.resolve(__dirname, 'resources/js'),
            '@': fileURLToPath(new URL('resources/js', import.meta.url))
        }
    },
    build: {
        rollupOptions: {
            output:{
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return id.toString().split('node_modules/')[1].split('/')[0].toString();
                    }
                }
            }
        }
    }
});
