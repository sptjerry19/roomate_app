<template>
    <div
        class="min-h-screen bg-cover bg-center"
        style="
            background-image: url('https://s3-alpha-sig.figma.com/img/f88d/14fd/fd957412170343cd5d4c14d1db083c5e?Expires=1743379200&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=i77mpPSl~pRbX6HyUpm2ZF2e30~TmzfbdEyugHQlfGtGnePq00B6tpMWnpLVDHOUwtA47lGQUvXwLhKEUldlWesMkLqtlM8FbA3MtTSzTn-b2vLUl1Jhoq938ieRCV6x1fRZyDQTZNEeUDe3sdKb9c66VLen8~cjLavHqzTGkh~yxptAlYJmPEfzcuBVgHTKxGQvtlo0d7D7F~cWN1jedY31Q5B5Wki18cwVtnt3M81dW5YLDxRakpvF1UhKyNR1a80RjnZb87ULKLNOAMKw~TqL9iARrf4j3mjONR~yKWHOpGKU~UUWX7CoJPNLExxtDOR1~g2Qrl7UzH9derF-3A__');
        "
    >
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 z-20 w-full py-2.5 px-4">
            <div class="container mx-auto flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-white">AA+ HOME</span>
                </div>
                <div class="flex items-center space-x-4">
                    <router-link to="/" class="text-white hover:text-gray-200"
                        >Trang chủ</router-link
                    >
                    <router-link
                        to="/about"
                        class="text-white hover:text-gray-200"
                        >Về chúng tôi</router-link
                    >
                    <router-link
                        to="/room"
                        class="text-white hover:text-gray-200"
                        >Phòng trọ</router-link
                    >
                    <router-link
                        to="/contact"
                        class="text-white hover:text-gray-200"
                        >Liên hệ</router-link
                    >
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-white">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="text-white">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div
            class="container mx-auto px-4 flex min-h-screen items-center justify-center"
        >
            <div class="flex w-full max-w-6xl">
                <!-- Left Side -->
                <div
                    class="hidden md:flex md:flex-1 bg-[#1a365d] p-8 rounded-l-lg text-white"
                >
                    <div>
                        <h2 class="text-2xl font-bold mb-4">AA+ HOME!</h2>
                        <p class="text-sm mb-4">
                            "Hãy để chúng tôi MANG ĐẾN cho bạn KHÔNG GIAN SỐNG
                            HOÀN HẢO và NHỮNG NGƯỜI BẠN CÙNG PHÒNG TUYỆT VỜI.
                            Nơi mà bạn có thể TÌM THẤY SỰ BÌNH YÊN và NIỀM VUI
                            mỗi ngày."
                        </p>
                        <img
                            alt="Illustration of a cozy room with bunk beds, a desk, and a sofa"
                            class="rounded-lg w-full"
                            src="https://aahome.click/storage/aahome.png"
                        />
                    </div>
                </div>

                <!-- Right Side -->
                <div
                    class="flex-1 bg-white rounded-lg md:rounded-r-lg md:rounded-l-none p-8"
                >
                    <h2 class="text-2xl font-bold text-center mb-6">
                        Đăng nhập
                    </h2>
                    <form @submit.prevent="handleLogin" class="space-y-4">
                        <div>
                            <input
                                type="email"
                                id="email"
                                v-model="email"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Email"
                            />
                        </div>

                        <div>
                            <input
                                type="password"
                                id="password"
                                v-model="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Mật khẩu"
                            />
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-[#1a365d] text-white py-2 rounded-md hover:bg-[#152a4a]"
                        >
                            Đăng nhập
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <router-link
                            to="/forgot-password"
                            class="text-sm text-gray-600 hover:underline"
                        >
                            Quên mật khẩu?
                        </router-link>
                        <span class="mx-2 text-gray-400">|</span>
                        <router-link
                            to="/register"
                            class="text-sm text-gray-600 hover:underline"
                        >
                            Đăng ký tài khoản mới
                        </router-link>
                    </div>

                    <div class="mt-4 flex justify-center space-x-4">
                        <button
                            @click="loginWith('google')"
                            class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50"
                        >
                            <img
                                src="https://www.svgrepo.com/show/475656/google-color.svg"
                                class="h-5 w-5"
                                alt="Google logo"
                            />
                            Đăng nhập bằng google
                        </button>
                        <button
                            @click="loginWith('github')"
                            class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50"
                        >
                            <img
                                src="https://www.svgrepo.com/show/512317/github-142.svg"
                                class="h-5 w-5"
                                alt="GitHub logo"
                            />
                            Đăng nhập bằng github
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-[#1a365d] text-white py-6 absolute bottom-0 w-full">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img
                            src="https://aahome.click/storage/aahome.png"
                            alt="Logo"
                            class="h-8"
                        />
                    </div>
                    <div class="flex space-x-8">
                        <div>
                            <h4 class="font-semibold mb-2">HƯỚNG DẪN</h4>
                            <ul class="text-sm space-y-1">
                                <li>
                                    <a href="#" class="hover:text-gray-300"
                                        >Trợ giúp</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-300"
                                        >Bảo mật</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-300"
                                        >Điều khoản</a
                                    >
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">LIÊN HỆ</h4>
                            <ul class="text-sm space-y-1">
                                <li>+84 123456789</li>
                                <li>support@aahome.com</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">ĐĂNG KÝ NHẬN TIN</h4>
                            <div class="flex">
                                <input
                                    type="email"
                                    placeholder="Email của bạn"
                                    class="px-3 py-1 text-sm bg-white/10 border border-white/20 rounded-l-md focus:outline-none"
                                />
                                <button
                                    class="px-3 py-1 bg-blue-600 text-white rounded-r-md hover:bg-blue-700"
                                >
                                    Gửi
                                </button>
                            </div>
                        </div>
                    </div>
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
        loginWith(provider) {
            window.location.href = `http://aahome.click/api/v1/auth/${provider}`;
        },
        async handleLogin() {
            try {
                const response = await defaultApiClient.post("/login", {
                    email: this.email,
                    password: this.password,
                });

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
.bg-primary {
    background-color: #1a365d;
}
</style>
