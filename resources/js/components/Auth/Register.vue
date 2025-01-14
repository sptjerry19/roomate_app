<template>
    <div class="bg-gray-100 flex justify-center items-center h-screen">
        <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img
                src="https://placehold.co/800x/667fff/ffffff.png?text=Your+Image&font=Montserrat"
                alt="Placeholder Image"
                class="object-cover w-full h-full"
            />
        </div>
        <!-- Right: Sign Up Form -->
        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <h1 class="text-2xl font-semibold mb-4">Sign Up</h1>
            <form @submit.prevent="handleSignup">
                <!-- Name Input -->
                <div class="mb-4">
                    <label class="block text-gray-600">Name</label>
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
                    <label class="block text-gray-600">Email or Phone</label>
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
                        >Password</label
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
                    <label for="password_confirm" class="block text-gray-600"
                        >Confirm Password</label
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
                        >I accept the Terms and Conditions</label
                    >
                </div>
                <!-- Sign Up Button -->
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md py-2 px-4 w-full"
                >
                    Sign Up
                </button>
            </form>
            <!-- Sign up Link -->
            <div class="mt-6 text-blue-500 text-center">
                <p>
                    Already have an account?
                    <router-link to="login" class="hover:underline"
                        >Login Here</router-link
                    >
                </p>
            </div>
            <!-- Return Button -->
            <div class="mt-4 text-center">
                <button
                    @click="goHome"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-md py-2 px-4"
                >
                    Return to Home
                </button>
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

                // Xử lý khi đăng ký thành công
                console.log("Đăng ký thành công:", response.data.data);
                localStorage.setItem(
                    "user",
                    JSON.stringify(response.data.user)
                );
                localStorage.setItem(
                    "access_token",
                    response.data.data.access_token
                );

                // Chuyển hướng người dùng sau khi đăng ký thành công
                if (response.data.roles.includes("Admin")) {
                    this.$router.push("/admin");
                } else {
                    this.$router.push("/");
                }
            } catch (error) {
                // Xử lý lỗi đăng ký
                console.error(
                    "Đăng ký thất bại:",
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
