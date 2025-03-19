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
                        Đăng ký tài khoản
                    </h2>
                    <form @submit.prevent="handleSignup" class="space-y-4">
                        <div>
                            <input
                                type="text"
                                id="name"
                                v-model="name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Họ và tên"
                                required
                            />
                        </div>

                        <div>
                            <input
                                type="email"
                                id="email_or_phone"
                                v-model="emailOrPhone"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Email"
                                required
                            />
                        </div>

                        <div>
                            <input
                                type="text"
                                id="phone"
                                v-model="Phone"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Số điện thoại"
                            />
                        </div>

                        <div>
                            <input
                                type="password"
                                id="password"
                                v-model="password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Mật khẩu"
                                required
                            />
                        </div>

                        <div>
                            <input
                                type="password"
                                id="password_confirm"
                                v-model="passwordConfirm"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                placeholder="Xác nhận mật khẩu"
                                required
                            />
                        </div>

                        <div class="flex justify-center space-x-4">
                            <label class="flex items-center space-x-2">
                                <input
                                    type="radio"
                                    v-model="role"
                                    value="owner"
                                    class="form-radio text-[#1a365d]"
                                />
                                <span class="text-sm">Chủ sở hữu</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input
                                    type="radio"
                                    v-model="role"
                                    value="lessee"
                                    class="form-radio text-[#1a365d]"
                                />
                                <span class="text-sm">Người thuê</span>
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                id="terms"
                                v-model="acceptTerms"
                                class="text-[#1a365d]"
                                required
                            />
                            <label
                                for="terms"
                                class="text-sm text-gray-600 ml-2"
                            >
                                Tôi đồng ý với các điều khoản và điều kiện
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="w-full bg-[#1a365d] text-white py-2 rounded-md hover:bg-[#152a4a]"
                        >
                            Đăng ký
                        </button>
                    </form>

                    <div class="mt-4 text-center text-sm">
                        <p class="text-gray-600">
                            Đã có tài khoản?
                            <router-link
                                to="/login"
                                class="font-medium text-[#1a365d] hover:text-[#152a4a]"
                            >
                                Đăng nhập ngay
                            </router-link>
                        </p>
                    </div>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div
                                    class="w-full border-t border-gray-300"
                                ></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500"
                                    >Hoặc đăng ký với</span
                                >
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <button
                                @click="loginWith('google')"
                                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                <img
                                    src="https://www.svgrepo.com/show/475656/google-color.svg"
                                    class="h-5 w-5"
                                    alt="Google logo"
                                />
                            </button>
                            <button
                                @click="loginWith('github')"
                                class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                            >
                                <img
                                    src="https://www.svgrepo.com/show/512317/github-142.svg"
                                    class="h-5 w-5"
                                    alt="GitHub logo"
                                />
                            </button>
                        </div>
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
                            src="https://aahome.click/storage/logo-white.png"
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
            name: "",
            emailOrPhone: "",
            Phone: "",
            password: "",
            passwordConfirm: "",
            acceptTerms: false,
            role: "owner",
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
                    phone: this.Phone,
                    password: this.password,
                    password_confirmation: this.passwordConfirm,
                    role: this.role,
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
    background-image: url("https://aahome.click/storage/aahome.png"); /* Thay bằng đường dẫn đến ảnh nền */
    background-size: cover; /* Phủ toàn bộ màn hình */
    background-position: center; /* Canh giữa ảnh */
    background-repeat: no-repeat; /* Không lặp lại ảnh */
}
body {
    font-family: "Arial", sans-serif;
}
</style>
