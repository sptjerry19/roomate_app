import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
    build: {
        outDir: "public/build",
    },
    base: "/build/",
    server: {
        host: "0.0.0.0", // Để container có thể truy cập từ ngoài
        port: 5173,
        strictPort: true,
        hmr: {
            host: "localhost", // Nếu chạy trên WSL2, dùng IP host thay vì localhost
        },
    },
});
