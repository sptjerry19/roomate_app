import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue"; // Đảm bảo đường dẫn này đúng
import Login from "../components/Auth/Login.vue";
import Register from "../components/Auth/Register.vue";
import Dashboard from "../components/Admin/DashBoard.vue";
import ImageCollection from "../components/ImageCollection.vue";
import UploadImages from "../components/Upload/UploadImages.vue";
import Room from "../components/Room.vue";
import Roomate from "../components/Roomate.vue";

const routes = [
    {
        path: "/",
        component: Home,
    },
    {
        path: "/room",
        component: Room,
    },
    {
        path: "/roommate",
        component: Roomate,
    },
    {
        path: "/login",
        component: Login,
    },
    {
        path: "/register",
        component: Register,
    },
    {
        path: "/admin",
        component: Dashboard,
    },
    {
        path: "/collection",
        component: ImageCollection,
    },
    {
        path: "/image-upload",
        component: UploadImages,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
