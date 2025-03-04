<template>
    <div class="h-screen">
        <div class="background h-2/3 flex items-center">
            <nav
                class="fixed top-0 left-0 z-20 w-full py-2.5 px-4 md:px-6 border-b"
            >
                <div
                    class="container mx-auto flex items-center justify-between"
                >
                    <!-- Logo và tên trang -->
                    <div class="flex items-center">
                        <img
                            src="https://aahome.click/storage/logo.png"
                            alt="Logo"
                            class="h-8 w-8 object-contain"
                        />
                        <span class="ml-2 text-xl font-bold text-blue-700"
                            >AA+Home</span
                        >
                    </div>
                    <div
                        class="flex flex-wrap justify-center space-x-4 text-base font-bold"
                    >
                        <router-link to="/" class="hover:underline px-6 py-1"
                            >Trang chủ</router-link
                        >
                        <router-link
                            to="/about"
                            class="hover:underline px-6 py-1"
                            >Về chúng tôi</router-link
                        >
                        <router-link
                            to="/room"
                            class="hover:underline px-6 py-1"
                            >Phòng trọ</router-link
                        >
                        <router-link
                            to="/about"
                            class="hover:underline px-6 py-1"
                            >Liên hệ</router-link
                        >
                    </div>
                    <div class="space-x-4">
                        <i class="fas fa-search"> </i>
                        <i class="fas fa-user"> </i>
                    </div>
                </div>
            </nav>
            <div
                class="flex justify-center items-center mx-auto min-h-screen flex-col md:flex-row"
            >
                <!-- Left Side (Ẩn khi màn hình nhỏ) -->
                <div
                    class="hidden md:block bg-primary p-8 rounded-lg shadow-lg max-w-lg"
                >
                    <h2 class="text-3xl font-bold mb-4">AA++ HOME!</h2>
                    <p class="mb-8">
                        "Nơi kết nối bạn với không gian sống lý tưởng và những
                        người bạn cùng phòng hoàn hảo. Đăng nhập hoặc đăng ký
                        ngay để bắt đầu hành trình tìm trọ nhanh chóng, tiện lợi
                        và an toàn."
                    </p>
                    <img
                        alt="Illustration of a cozy room with bunk beds, a desk, and a sofa"
                        class="rounded-lg"
                        height="300"
                        src="https://aahome.click/storage/aahome.png"
                        width="400"
                    />
                </div>

                <!-- Right Side -->
                <div
                    class="bg-white text-black p-8 rounded-lg shadow-lg max-w-md"
                >
                    <h2
                        class="text-3xl font-bold text-gray-700 text-center mb-8"
                    >
                        Đăng nhập
                    </h2>
                    <form @submit.prevent="handleLogin">
                        <div class="mb-6">
                            <label for="email" class="block text-gray-600 mb-2"
                                >Email</label
                            >
                            <input
                                type="text"
                                id="email"
                                v-model="email"
                                class="w-full border border-gray-300 rounded-md py-3 px-4 focus:outline-none focus:border-blue-500"
                                placeholder="Nhập email hoặc số điện thoại"
                            />
                        </div>

                        <div class="mb-6">
                            <label
                                for="password"
                                class="block text-gray-600 mb-2"
                                >Mật khẩu</label
                            >
                            <input
                                type="password"
                                id="password"
                                v-model="password"
                                class="w-full border border-gray-300 rounded-md py-3 px-4 focus:outline-none focus:border-blue-500"
                                placeholder="Nhập mật khẩu"
                            />
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-blue-600 text-white font-bold py-3 rounded-md hover:bg-blue-700 transition"
                        >
                            Đăng nhập
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-gray-500">
                            Bạn chưa có tài khoản?
                            <router-link
                                to="/register"
                                class="text-blue-500 hover:underline"
                            >
                                Đăng ký
                            </router-link>
                        </p>
                    </div>

                    <div class="mt-4 flex justify-center space-x-4">
                        <button
                            class="flex items-center justify-center px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                        >
                            Đăng nhập bằng Google
                        </button>
                        <button
                            class="flex items-center justify-center px-6 py-2 bg-blue-800 text-white rounded-md hover:bg-blue-900 transition"
                        >
                            Đăng nhập bằng Facebook
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <footer class="bg-primary text-white py-10">
            <div class="container mx-auto gap-8 px-4 flex justify-around">
                <!-- cột 1 + 2 -->
                <div class="flex justify-around max-w-6xl">
                    <!-- Cột 1 -->
                    <div class="">
                        <h3 class="text-lg font-semibold text-white mb-4">
                            VỀ AA+ HOME
                        </h3>
                        <ul class="space-y-2 text-white text-xs">
                            <li>
                                <a href="/about" class="hover:text-gray-900"
                                    >Giới thiệu</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Quý chế hoạt động</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Quy định sử dụng</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Chính sách bảo mật</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Liên hệ</a
                                >
                            </li>
                        </ul>
                    </div>

                    <!-- Cột 2 -->
                    <div class="pl-14">
                        <h3 class="text-lg font-semibold text-white mb-4">
                            Dành cho khách hàng
                        </h3>
                        <ul class="space-y-2 text-white text-xs">
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Câu hỏi thường gặp</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Hướng dẫn đăng tin</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Quy định đăng tin</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Bảng giá dịch vụ</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Hướng dẫn thanh toán</a
                                >
                            </li>
                            <li>
                                <a
                                    href="/regulations"
                                    class="hover:text-gray-900"
                                    >Giải quyết khiếu nại</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cột 3 -->
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">
                        ĐĂNG KÍ ĐỂ NHẬN ƯU ĐÃI
                    </h3>
                    <p class="text-white mb-4">
                        Đăng ký để nhận ngay ưu đãi của AA++ HOME dành cho lần
                        thuê trọ đầu tiên!
                    </p>
                    <form class="flex flex-col space-y-3">
                        <input
                            type="email"
                            placeholder="EMAIL"
                            class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:outline-none"
                            required
                        />
                        <button
                            type="submit"
                            class="bg-gray-800 text-white py-2 rounded-md hover:bg-gray-900 transition"
                        >
                            ĐĂNG KÝ
                        </button>
                    </form>
                    <p class="mt-4 text-center text-gray-500 font-medium">
                        AA++ HOME
                    </p>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import { defaultApiClient } from "../../axios";
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        goHome() {
            this.$router.push("/"); // Chuyển hướng về trang chủ
        },
        async handleLogin() {
            console.log(this.email);

            try {
                // Gửi yêu cầu đăng nhập và đợi phản hồi từ API
                const response = await defaultApiClient.post("/login", {
                    email: this.email,
                    password: this.password,
                });

                // Xử lý khi đăng nhập thành công
                console.log("Đăng nhập thành công:", response.data.data);
                localStorage.setItem(
                    "user",
                    JSON.stringify(response.data.user)
                );
                localStorage.setItem(
                    "access_token",
                    response.data.data.access_token
                );

                this.$router.push("/");
            } catch (error) {
                // Xử lý lỗi đăng nhập
                console.error(
                    "Đăng nhập thất bại:",
                    error.response?.data || error.message
                );
            }
        },
    },
};
</script>

<style scoped>
.background {
    background-image: url("https://aahome.click/storage/aahome.png"); /* Thay bằng đường dẫn đến ảnh nền */
    background-size: cover; /* Phủ toàn bộ màn hình */
    background-position: center; /* Canh giữa ảnh */
    background-repeat: no-repeat; /* Không lặp lại ảnh */
}
body {
    font-family: "Arial", sans-serif;
}
</style>
