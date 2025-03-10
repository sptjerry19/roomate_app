import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import apiClient from "./axios";

const app = createApp(App);

// Load Google Analytics khi ứng dụng khởi chạy
function loadGoogleAnalytics() {
    const script = document.createElement("script");
    script.src = "https://www.googletagmanager.com/gtag/js?id=G-YHQJ286011";
    script.async = true;
    document.head.appendChild(script);

    const script2 = document.createElement("script");
    script2.innerHTML = `
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-YHQJ286011');
    `;
    document.head.appendChild(script2);
}

// Gọi khi app khởi chạy
loadGoogleAnalytics();

// Theo dõi thay đổi route
router.afterEach((to) => {
    window.gtag("config", "G-YHQJ286011", {
        page_path: to.fullPath,
    });
});

app.use(router).use(apiClient).mount("#app");
