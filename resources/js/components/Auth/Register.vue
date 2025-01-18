<template>
    <div class="background h-screen flex items-center">
        <nav
            class="fixed top-0 left-0 z-20 w-full py-2.5 px-4 md:px-6 border-b"
        >
            <div class="container mx-auto flex items-center justify-between">
                <!-- Logo và tên trang -->
                <div class="flex items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-8 w-8 text-blue-700"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                        />
                    </svg>
                    <span class="ml-2 text-xl font-bold text-blue-700"
                        >Roomates</span
                    >
                </div>
                <div
                    class="flex flex-wrap justify-center space-x-4 text-base font-bold text-blue-700"
                >
                    <router-link to="/" class="hover:bg-blue-200 px-6 py-1"
                        >Trang chủ</router-link
                    >
                    <router-link to="/room" class="hover:bg-blue-200 px-6 py-1"
                        >Phòng trọ</router-link
                    >
                    <router-link
                        to="/roommate"
                        class="hover:bg-blue-200 px-6 py-1"
                        >Tìm roommates</router-link
                    >
                </div>
            </div>
        </nav>
        <div class="flex justify-center items-center p-8">
            <!-- Left Side -->
            <div
                class="hidden lg:flex flex-col items-center justify-center w-1/2 max-h-full mr-2 bg-blue-950 text-white"
            >
                <h1 class="text-4xl font-bold mb-4 pt-1">AA++ HOME!</h1>

                <p class="text-lg px-12 text-center">
                    “Nơi kết nối bạn với không gian sống lý tưởng và những người
                    bạn cùng phòng hoàn hảo. Đăng nhập hoặc đăng ký ngay để bắt
                    đầu hành trình tìm trọ nhanh chóng, tiện lợi và an toàn.”
                </p>
                <div class="mt-8 max-w-2xl pb-10">
                    <img
                        src="https://s3-alpha-sig.figma.com/img/f88d/14fd/fd957412170343cd5d4c14d1db083c5e?Expires=1737936000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=lp3zvz9m104TmrX53oho2bOO4KqALtK~eifWhPh~uwIalkjobM-W6MA81nxFgWtLsnOxYJPg8OZM18Owk2vDBldH5g6v6qZAwIgEwS3oBWJSBNxdjYxw~-2wMr4QYzvTyrwCRJyZuTLJxFPHi7W74OkrGWmDLsJXPi-w6lwe4TjvG~dFEUra09KtLlOiXn62O6YIdToavY7UTeJ9p~81JUI4FY5dSfafbsLLHB2FBdpZCPnCFpR6~9r0mM1LCwc4qZQyaMw9JTEflxd0mXHyI3PksqpydmofBhNV1vAM7TaX51Ru7nN7Kj02Ne-IG8HNlWjDqhhzFb7HZ7zLdYYI4A__"
                        alt="Room Illustration"
                        class="rounded-lg shadow-lg"
                    />
                </div>
            </div>

            <div
                class="w-full lg:w-1/2 px-8 sm:px-12 lg:px-20 py-12 bg-white shadow-lg rounded-lg"
            >
                <h1 class="text-2xl font-semibold mb-4">Đăng ký</h1>
                <form @submit.prevent="handleSignup">
                    <!-- Name Input -->
                    <div class="mb-4">
                        <label class="block text-gray-600">Tên</label>
                        <input
                            type="text"
                            id="name"
                            v-model="name"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off"
                        />
                    </div>
                    <!-- Email or Phone Input -->
                    <div class="mb-4">
                        <label class="block text-gray-600"
                            >Email hoặc số điện thoại</label
                        >
                        <input
                            type="text"
                            id="email_or_phone"
                            v-model="emailOrPhone"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off"
                        />
                    </div>
                    <!-- Password Input -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-600"
                            >Mật khẩu</label
                        >
                        <input
                            type="password"
                            id="password"
                            v-model="password"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off"
                        />
                    </div>
                    <!-- Confirm Password Input -->
                    <div class="mb-4">
                        <label
                            for="password_confirm"
                            class="block text-gray-600"
                            >Xác nhận mật khẩu</label
                        >
                        <input
                            type="password"
                            id="password_confirm"
                            v-model="passwordConfirm"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off"
                        />
                    </div>
                    <!-- Terms and Conditions Checkbox -->
                    <div class="mb-4 flex items-center">
                        <input
                            type="checkbox"
                            id="terms"
                            v-model="acceptTerms"
                            class="text-blue-500"
                        />
                        <label for="terms" class="text-gray-600 ml-2"
                            >Tôi chấp nhận các Điều khoản và Điều kiện
                        </label>
                    </div>
                    <!-- Sign Up Button -->
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full"
                    >
                        Đăng ký
                    </button>
                </form>
                <!-- Sign up Link -->
                <div class="mt-6 text-blue-500 text-center">
                    <p>
                        Đã có tài khoản?
                        <router-link to="login" class="hover:underline"
                            >Đăng nhập tại đây</router-link
                        >
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defaultApiClient } from "../../axios";

export default {
    data() {
        return {
            name: "",
            emailOrPhone: "",
            password: "",
            passwordConfirm: "",
            acceptTerms: false,
        };
    },
    methods: {
        async handleSignup() {
            // Kiểm tra nếu password và confirm password không trùng khớp
            if (this.password !== this.passwordConfirm) {
                alert("Passwords do not match!");
                return;
            }

            try {
                // Gửi yêu cầu đăng ký và đợi phản hồi từ API
                const response = await defaultApiClient.post("/register", {
                    name: this.name,
                    email: this.emailOrPhone,
                    password: this.password,
                    password_confirmation: this.passwordConfirm,
                });

                console.log("Đăng ký thành công:", response.data.data);

                // Sau khi đăng ký thành công, tự động gọi API login
                const loginResponse = await defaultApiClient.post("/login", {
                    email: this.emailOrPhone,
                    password: this.password,
                });

                console.log("Đăng nhập thành công:", loginResponse.data);

                // Lưu thông tin người dùng và token vào localStorage
                localStorage.setItem(
                    "user",
                    JSON.stringify(loginResponse.data.user)
                );
                localStorage.setItem(
                    "access_token",
                    loginResponse.data.data.access_token
                );

                // Chuyển hướng về trang chủ
                this.$router.push("/");
            } catch (error) {
                // Xử lý lỗi đăng ký hoặc đăng nhập
                console.error(
                    "Đăng ký hoặc đăng nhập thất bại:",
                    error.response?.data || error.message
                );
            }
        },

        // Phương thức để quay về trang chủ
        goHome() {
            this.$router.push("/"); // Chuyển hướng về trang chủ
        },
    },
};
</script>

<style scoped>
.background {
    background-image: url("https://s3-alpha-sig.figma.com/img/f88d/14fd/fd957412170343cd5d4c14d1db083c5e?Expires=1737936000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=lp3zvz9m104TmrX53oho2bOO4KqALtK~eifWhPh~uwIalkjobM-W6MA81nxFgWtLsnOxYJPg8OZM18Owk2vDBldH5g6v6qZAwIgEwS3oBWJSBNxdjYxw~-2wMr4QYzvTyrwCRJyZuTLJxFPHi7W74OkrGWmDLsJXPi-w6lwe4TjvG~dFEUra09KtLlOiXn62O6YIdToavY7UTeJ9p~81JUI4FY5dSfafbsLLHB2FBdpZCPnCFpR6~9r0mM1LCwc4qZQyaMw9JTEflxd0mXHyI3PksqpydmofBhNV1vAM7TaX51Ru7nN7Kj02Ne-IG8HNlWjDqhhzFb7HZ7zLdYYI4A__"); /* Thay bằng đường dẫn đến ảnh nền */
    background-size: cover; /* Phủ toàn bộ màn hình */
    background-position: center; /* Canh giữa ảnh */
    background-repeat: no-repeat; /* Không lặp lại ảnh */
}
body {
    font-family: "Arial", sans-serif;
}
</style>
