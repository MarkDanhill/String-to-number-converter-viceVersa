import { defineConfig } from 'vite';
import { fileURLToPath, URL } from "node:url";
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("./src", import.meta.url)),
            "@layouts": path.resolve(__dirname, "./src/views/layouts"),
            "@pages": path.resolve(__dirname, "./src/views/pages"),
            "@stores": path.resolve(__dirname, "./src/js/stores"),
            "@routes": path.resolve(__dirname, "./src/js/routes"),
            "@components": path.resolve(__dirname, "./src/views/components"),
            "~node_modules": fileURLToPath(
                new URL("./node_modules", import.meta.url)
            ),
        },
    },
    server: {
        port: 8001,
   },
})
