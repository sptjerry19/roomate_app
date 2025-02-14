import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue"; // Đảm bảo đường dẫn này đúng
import Login from "../components/Auth/Login.vue";
import Register from "../components/Auth/Register.vue";
import Dashboard from "../components/Admin/DashBoard.vue";
import ImageCollection from "../components/ImageCollection.vue";
import UploadImages from "../components/Upload/UploadImages.vue";
import Room from "../components/Room.vue";
import Roomate from "../components/Roomate.vue";
import Detail from "../components/Detail.vue";
import CreatePost from "../components/Upload/CreatePost.vue";
import Profile from "../components/Profile.vue";
import RoomateV2 from "../components/RoomateV2.vue";
import RoommateManagement from "../components/Admin/RoommateManagement.vue";

const routes = [
    {
        path: "/",
        component: Home,
    },
    {
        path: "/post",
        component: CreatePost,
    },
    {
        path: "/room",
        component: Room,
    },
    {
        path: "/roommate",
        component: RoomateV2,
    },
    {
        path: "/room/:id",
        name: "room-detail",
        component: Detail,
        props: true, // Pass the ID as a prop to the component
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
        path: "/profile",
        component: Profile,
    },
    {
        path: "/admin",
        component: Dashboard,
    },
    {
        path: "/manage",
        component: RoommateManagement,
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
