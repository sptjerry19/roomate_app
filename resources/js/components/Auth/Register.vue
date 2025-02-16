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
                            src="https://s3-alpha-sig.figma.com/img/94aa/de1b/7c2686b66c34627c8e323577a00ecd80?Expires=1740355200&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=Ex3TtLJcraaGGZJf0Y7z8znbGyYjk5v~jsAocqgG4S6yb9XTHaoeW7vwIQrtxeJfTrbtYSYLeDmxPx7S1EtUkysukNdYrYKCREcKsHI8ExlpdcK2OGYKSf3IcXWN3wYXEIn5anDZeWBRnwjttsdhUk5jTSrP7Iv55dRROUCR4D4ttmgEmNXWXzHolaetcxGHSLSjet1prJG61EK0mux6O5AM1s3CLMLxc~EgOV-iGhOiGZGjGzEoQh~sCXgs~e6uAK~dem-48WN9YhwRRaxLKkv23M5QaoVYCL92mrKu9eZGwdkq5hT44H4pR1IYUNEvf~XiKSDqBjCDPxlmevxnGQ__"
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
                            to="/room"
                            class="hover:underline px-6 py-1"
                            >Về chúng tôi</router-link
                        >
                        <router-link
                            to="/roommate"
                            class="hover:underline px-6 py-1"
                            >Phòng trọ</router-link
                        >
                        <router-link
                            to="/roommate"
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
            <div class="flex justify-center items-center mx-auto min-h-screen">
                <!-- Left Side -->
                <div class="bg-primary p-8 rounded-lg shadow-lg max-w-lg">
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
                        src="https://s3-alpha-sig.figma.com/img/b459/39ce/bc91d5ac44c2727eb62fdf70619133f7?Expires=1740355200&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=GORA84r4JRuW60Ant~cUnSBen70lFyPerPF83XmAwZEAtvkp-WojkkwJ~3N11RhrA917Xw9lLb8akjGn0BAx4~cuN~ZW8Ly~k5UTxCgX9HqCdh3ZA~0-MwOVuC9B3HXYiayFIR~3WkSH8RnOs~dRM5iu8nOZj4PRyHJCIWepWW0oHrR3IHTbEmqXiLxvqA4j~SWEgp5nqJ7FRkWydFRSGM897p2du~4un-K1TJ~xqJX3IP5VwpLrsSkqAfKCZFjJbW44-Bu7fCKkRYBo4xCcOz3b66LgeYPyOb~aanGJUbwy8h6krI~D8YgF4JPOm7Y1yWSSDZwtFgIgF9pMNwN99Q__"
                        width="400"
                    />
                </div>

                <div
                    class="bg-white text-black p-8 rounded-lg shadow-lg ml-8 max-w-md"
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
        <footer class="bg-primary text-white p-8 mt-16">
            <div class="flex justify-between">
                <div>
                    <h3 class="font-bold mb-4">VỀ AA++ HOME</h3>
                    <ul>
                        <li class="mb-2">
                            <a class="hover:underline" href="#"> Giới thiệu </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Quy chế hoạt động
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Quy định sử dụng
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Chính sách bảo mật
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#"> Liên hệ </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">DÀNH CHO KHÁCH HÀNG</h3>
                    <ul>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Câu hỏi thường gặp
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Hướng dẫn đăng tin
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Quy định đăng tin
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Hướng dẫn sử dụng
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Hướng dẫn thanh toán
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="hover:underline" href="#">
                                Giải quyết khiếu nại
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">ĐĂNG KÍ ĐỂ NHẬN ƯU ĐÃI</h3>
                    <p class="mb-4">
                        Đăng ký để nhận ngay ưu đãi của AA++ HOME dành cho lần
                        thuê trọ đầu tiên!
                    </p>
                    <form>
                        <input
                            class="w-full p-2 border border-gray-300 rounded mb-2"
                            placeholder="EMAIL"
                            type="email"
                        />
                        <button
                            class="w-full bg-blue-800 text-white p-2 rounded"
                            type="submit"
                        >
                            ĐĂNG KÝ
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-8">
                <p>AA++ HOME</p>
            </div>
        </footer>
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
