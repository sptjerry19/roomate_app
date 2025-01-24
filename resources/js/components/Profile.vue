<template>
    <nav class="fixed top-0 left-0 z-20 w-full bg-white py-2.5 px-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo and Dropdown -->
            <div class="flex items-center space-x-3">
                <router-link to="/">
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
                </router-link>
                <select
                    class="border border-gray-300 rounded-md py-1.5 px-3 text-sm text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-300 cursor-pointer"
                    @change="navigateToRoute($event)"
                >
                    <option value="/">thông tin cá nhân</option>
                    <option value="/">Trang chủ</option>
                    <option value="/room">Phòng trọ</option>
                    <option value="/roommate">Roommate</option>
                </select>
            </div>

            <!-- Search Bar -->
            <div class="flex-grow mx-6">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Tìm kiếm"
                        class="w-5/6 rounded-full border border-gray-300 py-2 px-4 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    />
                    <!-- <button
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21 21l-6-6m3-9a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"
                                    />
                                </svg>
                            </button> -->
                </div>
            </div>

            <!-- Icons and Post Button -->
            <div
                v-if="user"
                class="flex items-center space-x-4 mt-4 md:mt-0 md:order-2"
            >
                <!-- Avatar -->
                <div class="relative">
                    <button
                        @click="toggleAvatarDropdown"
                        class="relative focus:outline-none"
                    >
                        <img
                            class="w-10 h-10 rounded-full"
                            :src="
                                user.avatar
                                    ? user.avatar
                                    : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg'
                            "
                            alt="User Avatar"
                        />
                    </button>

                    <!-- Dropdown menu -->
                    <div
                        v-if="showDropdown"
                        class="absolute -left-12 mt-2 w-48 bg-white rounded-lg shadow-lg z-20"
                    >
                        <router-link
                            to="/profile"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            Xem thông tin
                        </router-link>
                        <button
                            @click="logout"
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            Đăng xuất
                        </button>
                    </div>
                </div>

                <!-- Notification Icon -->
                <button class="relative">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="h-6 w-6 text-blue-700"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 9.75V8.25a6 6 0 00-12 0v1.5a5.25 5.25 0 0010.5 0zM10.5 21.75a1.5 1.5 0 001.5-1.5H9a1.5 1.5 0 001.5 1.5z"
                        />
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 flex h-3 w-3 items-center justify-center rounded-full bg-red-500 text-[10px] text-white"
                    >
                        3
                    </span>
                </button>

                <!-- Post Button -->
                <router-link to="/post">
                    <button
                        class="rounded bg-blue-700 py-1.5 px-4 text-sm font-medium text-white hover:bg-blue-800 focus:ring-2 focus:ring-blue-500"
                    >
                        Đăng bài
                    </button>
                </router-link>
            </div>

            <div
                v-else
                class="flex items-center space-x-3 mt-4 md:mt-0 md:order-2"
            >
                <router-link to="/login">
                    <button
                        type="button"
                        class="rounded-lg border border-blue-700 py-1.5 px-4 text-center text-sm font-medium text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        Login
                    </button>
                </router-link>
                <router-link to="/register">
                    <button
                        type="button"
                        class="rounded-lg bg-blue-700 py-1.5 px-4 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                    >
                        Register
                    </button>
                </router-link>
            </div>
        </div>
    </nav>
    <div class="container mt-14 mx-auto py-8">
        <!-- Cover Photo -->
        <div class="relative h-64 bg-gray-200">
            <img
                :src="coverPhoto"
                alt="Cover Photo"
                class="absolute inset-0 w-full h-full object-cover"
            />
            <!-- Avatar -->
            <div
                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2"
            >
                <img
                    :src="avatar"
                    alt="User Avatar"
                    class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover"
                />
            </div>
        </div>

        <!-- User Info -->
        <div class="text-center mt-20">
            <h1 class="text-2xl font-bold text-gray-800">{{ user.name }}</h1>
            <p class="text-gray-600">{{ user.email }}</p>
            <p class="text-gray-600">{{ user.phone }}</p>
            <p class="text-gray-600">{{ user.address }}</p>
        </div>

        <!-- About Section -->
        <div class="mt-8 p-4 bg-white rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">
                About
            </h2>
            <p class="mt-4 text-gray-600">{{ user.about }}</p>
        </div>

        <!-- Additional Info Section -->
        <div class="mt-8 p-4 bg-white rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">
                Additional Information
            </h2>
            <ul class="mt-4 space-y-2">
                <li class="flex items-center">
                    <span class="font-semibold text-gray-800 w-32"
                        >Date of Birth:</span
                    >
                    <span class="text-gray-600">{{ user.dob }}</span>
                </li>
                <li class="flex items-center">
                    <span class="font-semibold text-gray-800 w-32"
                        >Gender:</span
                    >
                    <span class="text-gray-600">{{ user.gender }}</span>
                </li>
                <li class="flex items-center">
                    <span class="font-semibold text-gray-800 w-32"
                        >Member Since:</span
                    >
                    <span class="text-gray-600">{{ user.joined }}</span>
                </li>
            </ul>
        </div>

        <!-- Favorite Rooms Section -->
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2 mt-4">
            Các phòng trọ đã quan tâm
        </h2>
        <div v-if="posts.length === 0" class="text-center text-gray-500">
            Không tìm thấy bài đăng nào.
        </div>
        <div v-else>
            <div
                v-for="post in posts"
                :key="post.id"
                class="mb-6 mt-2 bg-white rounded-lg shadow-lg overflow-hidden flex"
            >
                <!-- Hình ảnh -->
                <div class="w-1/3">
                    <img
                        class="w-full h-full object-cover"
                        :src="post.images[0] || '/images/default-room.jpg'"
                        alt="Room image"
                    />
                </div>
                <!-- Thông tin bài đăng -->
                <div class="w-2/3 p-4">
                    <h2 class="text-lg font-bold text-blue-600 truncate">
                        {{ post.title }}
                    </h2>
                    <p class="text-gray-500 text-sm">
                        {{ post.location }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        Diện tích: {{ post.area }} m²
                    </p>
                    <p class="text-gray-500 text-sm">
                        Người đăng: {{ post.posted_by }}
                    </p>
                    <p class="text-gray-700 mt-2">
                        {{ post.description }}
                    </p>
                    <div class="flex justify-between items-center mt-4">
                        <p class="text-lg font-bold text-red-500">
                            {{ post.price }} VNĐ/tháng
                        </p>
                        <div class="flex items-center">
                            <button
                                @click="toggleFavorite(post)"
                                :class="
                                    post.is_favorite
                                        ? 'bg-red-500 text-white'
                                        : 'bg-gray-300 text-gray-700'
                                "
                                class="px-4 py-2 rounded hover:opacity-80 transition"
                            >
                                <span v-if="post.is_favorite"
                                    ><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="size-6"
                                    >
                                        <path
                                            d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
                                        />
                                    </svg>
                                </span>
                                <span v-else
                                    ><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                        />
                                    </svg>
                                </span>
                            </button>
                            <router-link
                                :to="`/room/${post.id}`"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2"
                            >
                                Chi tiết
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <loading :isLoading="loading"></loading>
</template>

<script>
import apiClient, { defaultApiClient } from "../axios";
import loading from "./loading.vue";
export default {
    data() {
        return {
            autoCloseTimeout: null,
            loading: false,
            coverPhoto:
                "https://i.pinimg.com/736x/b2/35/f9/b235f98eaf33557113de7f75bac0c002.jpg", // Placeholder ảnh bìa
            avatar: "https://www.redwolf.in/image/cache/catalog/stickers/jerry-face-sticker-india-600x800.jpg?m=1687857111", // Placeholder avatar
            user: {
                name: "Nguyen Van A",
                email: "nguyenvana@example.com",
                phone: "+84 123 456 789",
                address: "123 Pham Van Dong, Hanoi, Vietnam",
                about: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet, nulla et dictum interdum, nisi lorem egestas odio, vitae scelerisque enim ligula venenatis dolor.",
                dob: "01/01/2003",
                gender: "Male",
                joined: "01/01/2025",
            },
            showDropdown: false, // Điều khiển hiển thị menu dropdown
            posts: [],
        };
    },
    mounted() {
        // Lấy dữ liệu từ localStorage
        const storedUser = JSON.parse(localStorage.getItem("user"));
        if (storedUser && storedUser.name && storedUser.email) {
            this.user.name = storedUser.name;
            this.user.email = storedUser.email;
        }

        this.fetchFavoriteData();
    },
    methods: {
        navigateToRoute(event) {
            const selectedRoute = event.target.value;
            this.$router.push(selectedRoute);
        },
        toggleAvatarDropdown() {
            // Toggle hiển thị dropdown menu
            this.showDropdown = !this.showDropdown;
        },
        // async toggleFavorite(post) {
        //     try {
        //         const token = localStorage.getItem("access_token");
        //         if (!token) {
        //             this.showLoginModal = true; // Hiển thị modal thông báo
        //         } else {
        //             // Gửi yêu cầu yêu thích
        //             this.favoriteItem();
        //         }
        //         const url = post.is_favorite
        //             ? "/api/v1/favorite"
        //             : "/api/v1/favorite";
        //         const method = post.is_favorite ? "PUT" : "POST";

        //         const response = await fetch(url, {
        //             method,
        //             headers: {
        //                 "Content-Type": "application/json",
        //                 Authorization: `Bearer ${token}`, // Nếu có token
        //             },
        //             body: JSON.stringify({ post_id: post.id }),
        //         });

        //         if (response.ok) {
        //             post.is_favorite = !post.is_favorite;
        //         } else {
        //             console.error(
        //                 "Failed to toggle favorite:",
        //                 await response.text()
        //             );
        //         }
        //     } catch (error) {
        //         console.error("Error toggling favorite:", error);
        //     }
        // },
        async fetchFavoriteData() {
            this.loading = true;
            try {
                // Truyền tham số page và itemsPerPage vào API
                const response = await apiClient.get("/favorite", {
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`, // Nếu có token
                    },
                });

                console.log(response);

                // Kiểm tra nếu dữ liệu rỗng
                if (response.data.data.length === 0) {
                    this.posts = []; // Đặt danh sách bài đăng thành rỗng
                    this.totalPages = 0;
                    this.currentPage = 0;
                    this.showNoDataMessage = true; // Biến để hiển thị thông báo "Không tìm thấy bài đăng nào"
                } else {
                    this.posts = response.data.data;
                    this.currentPage = response.data.pagination.current_page;
                    this.itemsPerPage = response.data.pagination.per_page;
                    this.totalPages = response.data.pagination.last_page;
                    this.total = response.data.pagination.total;
                    this.showNoDataMessage = false; // Ẩn thông báo nếu có dữ liệu
                }
            } catch (error) {
                console.error("Error fetching data", error);
            } finally {
                this.loading = false; // Ẩn spinner
            }
        },
        logout() {
            // Xử lý logic đăng xuất
            console.log("Đăng xuất");
            // Thực hiện các bước đăng xuất, ví dụ: gọi API, xóa token, chuyển hướng
            localStorage.removeItem("access_token");
            localStorage.removeItem("user");
            this.user = null;
            this.$router.push("/login");
        },
    },
};
</script>

<style scoped>
.container {
    max-width: 800px;
}
</style>
