<template>
    <div class="Products">
        <!-- Create By Joker Banny -->
        <div class="bg-white">
            <!-- Header Navbar -->
            <nav
                class="fixed top-0 left-0 z-20 w-full bg-white py-2.5 px-4 shadow-md"
            >
                <div
                    class="container mx-auto flex items-center justify-between"
                >
                    <!-- Logo and Dropdown -->
                    <div class="flex items-center space-x-3">
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
                        <select
                            class="border border-gray-300 rounded-md py-1.5 px-3 text-sm text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-300 cursor-pointer"
                            @change="navigateToRoute($event)"
                        >
                            <option value="/">Trang chủ</option>
                            <option value="/room">Phòng Trọ</option>
                            <option value="/roommate">Roommate</option>
                        </select>
                    </div>

                    <!-- Search Bar -->
                    <div class="flex-grow mx-6">
                        <div class="relative">
                            <input
                                type="text"
                                placeholder="Tìm kiếm"
                                v-model="selectedFilters.keyword"
                                @input="
                                    selectFilter(
                                        selectedFilters.keyword,
                                        'keyword'
                                    )
                                "
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

                <!-- Filter Bar -->
                <div class="mt-3 flex items-center justify-center space-x-4">
                    <div
                        @click="toggleDropdown(index)"
                        v-for="(filter, index) in filters"
                        :key="index"
                        class="relative border flex items-center border-gray-300 rounded-md py-1.5 px-3 text-sm text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-300 cursor-pointer"
                    >
                        <!-- Icon -->
                        <span :class="filter.icon" class="text-blue-500"></span>

                        <!-- Label hoặc Placeholder -->
                        <span v-if="filter.placeholder" class="text-sm">
                            {{ filter.placeholder }}
                        </span>
                        <span v-else class="text-sm">
                            <!-- Hiển thị giá trị đã chọn nếu có -->
                            {{ selectedFilters[filter.type] || filter.label }}
                        </span>

                        <!-- Dropdown Icon -->
                        <span class="material-icons">arrow_drop_down</span>

                        <!-- Dropdown Menu -->
                        <div
                            v-if="openDropdown === index && filter.data"
                            class="absolute top-full left-0 right-0 mt-2 w-52 max-h-40 bg-white border border-gray-300 rounded-lg shadow-lg z-10 overflow-y-auto"
                        >
                            <div
                                v-for="(item, i) in filter.data"
                                :key="i"
                                class="px-4 py-2 hover:bg-orange-100 cursor-pointer"
                                @click="selectFilter(item, filter.type)"
                            >
                                {{ item.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Danh sách bài đăng -->
            <div class="container mx-auto mt-28 flex">
                <!-- Bộ lọc bên trái -->
                <aside class="w-1/4 p-4 bg-white rounded-lg shadow-lg h-full">
                    <h2 class="text-lg font-bold mb-4">Bộ lọc</h2>
                    <div class="mt-3 flex flex-col space-y-4">
                        <div
                            v-for="(filter, index) in filters"
                            :key="index"
                            class="relative border border-gray-300 rounded-md p-3 text-sm text-gray-700"
                        >
                            <!-- Tiêu đề bộ lọc -->
                            <div class="font-bold mb-2 flex items-center">
                                <span
                                    :class="filter.icon"
                                    class="text-blue-500 mr-2"
                                ></span>
                                <span>{{ filter.label }}</span>
                            </div>

                            <!-- Danh sách các tùy chọn -->
                            <div class="space-y-2">
                                <div
                                    v-for="(item, i) in filter.data"
                                    :key="i"
                                    class="flex items-center cursor-pointer hover:bg-orange-100 p-2 rounded-md"
                                    @click="selectFilter(item, filter.type)"
                                >
                                    <!-- Checkbox hoặc dấu hiệu tùy chỉnh -->
                                    <input
                                        type="radio"
                                        :name="filter.type"
                                        :value="item.name"
                                        v-model="selectedFilters[filter.type]"
                                        class="mr-2"
                                    />
                                    <span>{{ item.name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <!-- Danh sách bài đăng -->
                <section class="w-3/4 p-4">
                    <h1 class="text-2xl font-bold mb-4">
                        {{ total }} Phòng Trọ Được Cập Nhật
                    </h1>
                    <!-- bộ lọc -->
                    <div class="flex justify-start items-center border-b-2">
                        <h2
                            :class="[
                                'px-4 py-2 font-bold cursor-pointer',
                                is_select === 'all'
                                    ? 'border-cyan-700 text-blue-800'
                                    : 'text-gray-600',
                            ]"
                            @click="
                                is_select = 'all';
                                fetchRoomatesData();
                            "
                        >
                            Tất cả
                        </h2>
                        <h2
                            :class="[
                                'px-4 py-2 font-bold cursor-pointer',
                                is_select === 'room'
                                    ? 'border-cyan-700 text-blue-800'
                                    : 'text-gray-600',
                            ]"
                            @click="
                                is_select = 'room';
                                fetchRoomatesDataRoom();
                            "
                        >
                            Phòng trống
                        </h2>
                        <h2
                            :class="[
                                'px-4 py-2 font-bold cursor-pointer',
                                is_select === 'roommate'
                                    ? 'border-cyan-700 text-blue-800'
                                    : 'text-gray-600',
                            ]"
                            @click="
                                is_select = 'roommate';
                                fetchRoomatesDataRoommate();
                            "
                        >
                            Phòng đang tìm roommate
                        </h2>
                    </div>
                    <div
                        v-if="posts.length === 0"
                        class="text-center text-gray-500"
                    >
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
                                    :src="
                                        post.images[0] ||
                                        '/images/default-room.jpg'
                                    "
                                    alt="Room image"
                                />
                            </div>
                            <!-- Thông tin bài đăng -->
                            <div class="w-2/3 p-4">
                                <h2
                                    class="text-lg font-bold text-blue-600 truncate"
                                >
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
                                <div
                                    class="flex justify-between items-center mt-4"
                                >
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
                </section>
            </div>

            <!-- modal login -->
            <Modal v-if="showLoginModal" @close="closeModalError">
                <div
                    class="flex justify-between px-4 py-4 fixed top-32 right-3 bg-red-400"
                >
                    <p>Vui lòng đăng nhập để sử dụng tính năng này!</p>
                    <button class="ml-2 text-white" @click="closeModalError">
                        X
                    </button>
                </div>
            </Modal>

            <!-- Modal xem tất cả ảnh theo kiểu slide -->
            <div
                v-if="modalVisible"
                class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center"
            >
                <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                    <div class="flex justify-end">
                        <button
                            @click="closeModal"
                            class="text-red-500 text-xl"
                        >
                            &times;
                        </button>
                    </div>

                    <!-- Slide ảnh -->
                    <div class="relative">
                        <!-- Hiển thị ảnh -->
                        <img
                            :src="modalImages[currentImageIndex]"
                            :alt="'Room Image ' + (currentImageIndex + 1)"
                            class="w-full h-64 object-cover rounded-lg"
                        />

                        <!-- Nút chuyển ảnh -->
                        <button
                            v-if="currentImageIndex > 0"
                            @click="prevImage"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black text-white p-2 rounded-full"
                        >
                            &lt;
                        </button>

                        <button
                            v-if="currentImageIndex < modalImages.length - 1"
                            @click="nextImage"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black text-white p-2 rounded-full"
                        >
                            &gt;
                        </button>
                    </div>

                    <!-- Hiển thị số ảnh hiện tại -->
                    <div class="mt-2 text-center text-sm text-gray-600">
                        {{ currentImageIndex + 1 }} /
                        {{ modalImages.length }} ảnh
                    </div>
                </div>
            </div>

            <!-- Component phân trang -->
            <Pagination
                :total-pages="totalPages"
                :current-page="currentPage"
                @page-changed="handlePageChange"
            />

            <!-- Footer -->
            <footer class="py-6 bg-gray-200 text-gray-900">
                <div
                    class="container px-6 mx-auto space-y-6 divide-y divide-gray-400 md:space-y-12 divide-opacity-50"
                >
                    <div class="grid justify-center lg:justify-between">
                        <div
                            class="flex flex-col self-center text-sm text-center md:block lg:col-start-1 md:space-x-6"
                        >
                            <span>Copy rgight © 2023 by codemix team </span>
                            <a rel="noopener noreferrer" href="#">
                                <span>Privacy policy</span>
                            </a>
                            <a rel="noopener noreferrer" href="#">
                                <span>Terms of service</span>
                            </a>
                        </div>
                        <div
                            class="flex justify-center pt-4 space-x-4 lg:pt-0 lg:col-end-13"
                        >
                            <a
                                rel="noopener noreferrer"
                                href="#"
                                title="Email"
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"
                                    ></path>
                                    <path
                                        d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"
                                    ></path>
                                </svg>
                            </a>
                            <a
                                rel="noopener noreferrer"
                                href="#"
                                title="Twitter"
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 50 50"
                                    fill="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        d="M 50.0625 10.4375 C 48.214844 11.257813 46.234375 11.808594 44.152344 12.058594 C 46.277344 10.785156 47.910156 8.769531 48.675781 6.371094 C 46.691406 7.546875 44.484375 8.402344 42.144531 8.863281 C 40.269531 6.863281 37.597656 5.617188 34.640625 5.617188 C 28.960938 5.617188 24.355469 10.21875 24.355469 15.898438 C 24.355469 16.703125 24.449219 17.488281 24.625 18.242188 C 16.078125 17.8125 8.503906 13.71875 3.429688 7.496094 C 2.542969 9.019531 2.039063 10.785156 2.039063 12.667969 C 2.039063 16.234375 3.851563 19.382813 6.613281 21.230469 C 4.925781 21.175781 3.339844 20.710938 1.953125 19.941406 C 1.953125 19.984375 1.953125 20.027344 1.953125 20.070313 C 1.953125 25.054688 5.5 29.207031 10.199219 30.15625 C 9.339844 30.390625 8.429688 30.515625 7.492188 30.515625 C 6.828125 30.515625 6.183594 30.453125 5.554688 30.328125 C 6.867188 34.410156 10.664063 37.390625 15.160156 37.472656 C 11.644531 40.230469 7.210938 41.871094 2.390625 41.871094 C 1.558594 41.871094 0.742188 41.824219 -0.0585938 41.726563 C 4.488281 44.648438 9.894531 46.347656 15.703125 46.347656 C 34.617188 46.347656 44.960938 30.679688 44.960938 17.09375 C 44.960938 16.648438 44.949219 16.199219 44.933594 15.761719 C 46.941406 14.3125 48.683594 12.5 50.0625 10.4375 Z"
                                    ></path>
                                </svg>
                            </a>
                            <a
                                rel="noopener noreferrer"
                                href="#"
                                title="GitHub"
                                class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 duration-150 text-gray-50"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    class="w-5 h-5"
                                >
                                    <path
                                        d="M10.9,2.1c-4.6,0.5-8.3,4.2-8.8,8.7c-0.5,4.7,2.2,8.9,6.3,10.5C8.7,21.4,9,21.2,9,20.8v-1.6c0,0-0.4,0.1-0.9,0.1 c-1.4,0-2-1.2-2.1-1.9c-0.1-0.4-0.3-0.7-0.6-1C5.1,16.3,5,16.3,5,16.2C5,16,5.3,16,5.4,16c0.6,0,1.1,0.7,1.3,1c0.5,0.8,1.1,1,1.4,1 c0.4,0,0.7-0.1,0.9-0.2c0.1-0.7,0.4-1.4,1-1.8c-2.3-0.5-4-1.8-4-4c0-1.1,0.5-2.2,1.2-3C7.1,8.8,7,8.3,7,7.6C7,7.2,7,6.6,7.3,6 c0,0,1.4,0,2.8,1.3C10.6,7.1,11.3,7,12,7s1.4,0.1,2,0.3C15.3,6,16.8,6,16.8,6C17,6.6,17,7.2,17,7.6c0,0.8-0.1,1.2-0.2,1.4 c0.7,0.8,1.2,1.8,1.2,3c0,2.2-1.7,3.5-4,4c0.6,0.5,1,1.4,1,2.3v2.6c0,0.3,0.3,0.6,0.7,0.5c3.7-1.5,6.3-5.1,6.3-9.3 C22,6.1,16.9,1.4,10.9,2.1z"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <loading :isLoading="loading"></loading>
</template>

<script>
import apiClient, { defaultApiClient } from "../axios";
import Pagination from "./Pagination.vue";
import loading from "./loading.vue";

export default {
    name: "Home",
    components: {
        Pagination,
        loading,
    },
    data() {
        return {
            showLoginModal: false,
            autoCloseTimeout: null, // Lưu ID của timeout
            is_select: "all",
            modalVisible: false,
            modalImages: [], // Mảng ảnh sẽ hiển thị trong modal
            currentImageIndex: 0, // Chỉ số ảnh hiện tại trong slide
            selectedFilters: {
                district: "",
                area: "",
                price: "",
                keyword: "",
            },
            debounceTimeout: null,
            filters: [
                // {
                //     label: "Từ khóa",
                //     placeholder: "Từ khóa, Đường, Quận, Địa điểm...",
                //     icon: "material-icons-outlined search",
                //     type: "keyword",
                // },
                {
                    label: "Khu vực",
                    data: [
                        { name: "Tất cả", value: null },
                        { name: "Ba Đình", value: "Ba Đình" },
                        { name: "Cầu Giấy", value: "Cầu Giấy" },
                        { name: "Hoàn Kiếm", value: "Hoàn Kiếm" },
                        {
                            name: "Hai Bà Trưng",
                            value: "Hai Bà Trưng",
                        },
                        { name: "Hoàng Mai", value: "Hoàng Mai" },
                        { name: "Đống Đa", value: "Đống Đa" },
                        { name: "Tây Hồ", value: "Tây Hồ" },
                        { name: "Thanh Xuân", value: "Thanh Xuân" },
                        { name: "Bắc Từ Liêm", value: "Bắc Từ Liêm" },
                        { name: "Hà Đông", value: "Hà Đông" },
                        { name: "Long Biên", value: "Long Biên" },
                        { name: "Nam Từ Liêm", value: "Nam Từ Liêm" },
                        { name: "Ba Vì", value: "Ba Vì" },
                        { name: "Chương Mỹ", value: "Chương Mỹ" },
                        { name: "Đan Phượng", value: "Đan Phượng" },
                        { name: "Đông Anh", value: "Đông Anh" },
                        { name: "Gia Lâm", value: "Gia Lâm" },
                        { name: "Hoài Đức", value: "Hoài Đức" },
                    ],
                    icon: "material-icons-outlined location_on",
                    type: "district",
                },
                {
                    label: "Diện tích",
                    data: [
                        { name: "Tất cả", value: null },
                        { name: "Dưới 10m²", value: "10" },
                        { name: "Từ 10m² đến 20m²", value: "20" },
                        { name: "Từ 20m² đến 30m²", value: "30" },
                        { name: "Từ 30m² đến 40m²", value: "40" },
                        { name: "Từ 40m² đến 50m²", value: "50" },
                        { name: "Trên 50m²", value: "1000" },
                    ],
                    icon: "material-icons-outlined category",
                    type: "area",
                },
                {
                    label: "Giá thuê",
                    data: [
                        { name: "Tất cả", value: null },
                        { name: "Dưới 1 triệu", value: "1000000" },
                        { name: "Dưới 2 triệu", value: "2000000" },
                        { name: "Dưới 3 triệu", value: "3000000" },
                        { name: "Dưới 4 triệu", value: "4000000" },
                        { name: "Dưới 5 triệu", value: "5000000" },
                        { name: "Trên 5 triệu", value: "1000000000" },
                    ],
                    icon: "material-icons-outlined attach_money",
                    type: "price",
                },
                {
                    label: "Lọc thêm",
                    icon: "material-icons-outlined filter_list",
                    type: "additional",
                },
            ],
            openDropdown: null, // Trạng thái theo dõi dropdown đang mở
            showDropdown: false, // Điều khiển hiển thị menu dropdown
            posts: [
                {
                    id: 1,
                    title: "Phòng trọ giá rẻ Quận 1",
                    location: "123 Đường ABC, Quận 1, TP. Hồ Chí Minh",
                    district: "Quận 1",
                    ward: "Phường 5",
                    price: "3.000.000",
                    area: "20m²",
                    status: "available",
                    posted_by: "Nguyễn Văn A",
                    description:
                        "Phòng trọ giá rẻ, đầy đủ tiện nghi, gần trung tâm, thích hợp cho sinh viên và người đi làm.",
                    images: [
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                    ],
                    type: "room",
                },
                {
                    id: 2,
                    title: "Tìm roommate ở ghép Quận 3",
                    location: "45 Đường XYZ, Quận 3, TP. Hồ Chí Minh",
                    district: "Quận 3",
                    ward: "Phường 10",
                    price: "1.500.000",
                    area: "15m²",
                    status: "available",
                    posted_by: "Trần Thị B",
                    description:
                        "Cần tìm bạn nữ ở ghép, phòng rộng rãi thoáng mát, gần chợ và các trường đại học.",
                    images: [
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                    ],
                    type: "roommate",
                },
                {
                    id: 3,
                    title: "Phòng trọ mới xây Bình Thạnh",
                    location: "78 Đường DEF, Bình Thạnh, TP. Hồ Chí Minh",
                    district: "Bình Thạnh",
                    ward: "Phường 12",
                    price: "2.800.000",
                    area: "25m²",
                    status: "available",
                    posted_by: "Phạm Văn C",
                    description:
                        "Phòng trọ mới xây, có gác lửng, an ninh tốt, gần các trường đại học và siêu thị.",
                    images: [
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                    ],
                    type: "room",
                },
                {
                    id: 4,
                    title: "Cần tìm bạn ở ghép Thủ Đức",
                    location: "22 Đường LMN, Thủ Đức, TP. Hồ Chí Minh",
                    district: "Thủ Đức",
                    ward: "Phường Linh Đông",
                    price: "1.800.000",
                    area: "18m²",
                    status: "available",
                    posted_by: "Lê Thị D",
                    description:
                        "Cần tìm bạn ở ghép, phòng rộng rãi, có sẵn đồ dùng, điện nước giá nhà nước.",

                    images: [
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                        "https://cdn.prod.website-files.com/620e4101b2ce12a1a6bff0e8/637b3248c7cfba284684fd65_ROOMMATE-.jpg",
                    ],
                    type: "roommate",
                },
            ],

            loading: false,
            user: null,
            showNoDataMessage: false,

            currentPage: 1, // Trang hiện tại
            itemsPerPage: 12, // Số sản phẩm mỗi trang
            totalPages: 6, // Số sản phẩm mỗi trang
            total: 0, // tổng trang
        };
    },
    mounted() {
        this.fetchRoomatesData();

        // Kiểm tra và lấy user từ localStorage khi component được mount
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            this.user = JSON.parse(storedUser);
        }
    },
    methods: {
        navigateToRoute(event) {
            const selectedRoute = event.target.value;
            this.$router.push(selectedRoute);
        },
        openModal(images) {
            this.modalImages = images;
            this.currentImageIndex = 0; // Bắt đầu từ ảnh đầu tiên
            this.modalVisible = true;
        },
        closeModal() {
            this.modalVisible = false;
        },
        nextImage() {
            if (this.currentImageIndex < this.modalImages.length - 1) {
                this.currentImageIndex++;
            }
        },
        prevImage() {
            if (this.currentImageIndex > 0) {
                this.currentImageIndex--;
            }
        },
        toggleDropdown(index) {
            // Đóng nếu dropdown đang mở, mở nếu chưa mở
            this.openDropdown = this.openDropdown === index ? null : index;
        },
        toggleAvatarDropdown() {
            // Toggle hiển thị dropdown menu
            this.showDropdown = !this.showDropdown;
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
        selectFilter(item, type) {
            if (type === "district") {
                this.selectedFilters.district = item.name; // Lưu tên quận vào selectedFilters
                this.district = item.value; // Cập nhật giá trị lọc
            } else if (type === "area") {
                this.selectedFilters.area = item.name; // Lưu tên diện tích vào selectedFilters
                this.area = item.value; // Cập nhật giá trị lọc
            } else if (type === "price") {
                this.selectedFilters.price = item.name; // Lưu tên giá thuê vào selectedFilters
                this.price = item.value; // Cập nhật giá trị lọc
            } else if (type === "keyword") {
                this.keyword = item; // Cập nhật giá trị lọc
                // Hủy timeout trước đó nếu người dùng đang nhập tiếp
                if (this.debounceTimeout) {
                    clearTimeout(this.debounceTimeout);
                }

                // Thiết lập timeout mới để gọi API sau 0,5s
                this.debounceTimeout = setTimeout(() => {
                    this.fetchRoomatesData(); // Gọi API sau khi người dùng không nhập trong 500ms
                }, 500);

                this.openDropdown = null;
            }
            if (type !== "keyword") {
                this.fetchRoomatesData(); // Gọi API để lấy dữ liệu mới
                this.openDropdown = null; // Đóng dropdown sau khi chọn
            }
        },
        showModal() {
            this.showLoginModal = true;

            // Hủy timeout cũ nếu có
            if (this.autoCloseTimeout) {
                clearTimeout(this.autoCloseTimeout);
            }

            console.log(this.autoCloseTimeout);

            // Đặt timeout để đóng modal sau 3 giây
            this.autoCloseTimeout = setTimeout(() => {
                this.closeModalError();
            }, 3000);

            console.log(this.autoCloseTimeout);
        },
        closeModalError() {
            this.showLoginModal = false;

            // Hủy timeout khi modal đóng
            if (this.autoCloseTimeout) {
                clearTimeout(this.autoCloseTimeout);
                this.autoCloseTimeout = null;
            }
        },
        async toggleFavorite(post) {
            try {
                const token = localStorage.getItem("access_token");
                if (!token) {
                    this.showLoginModal = true; // Hiển thị modal thông báo
                } else {
                    // Gửi yêu cầu yêu thích
                    this.favoriteItem();
                }
                const url = post.is_favorite
                    ? "/api/v1/favorite"
                    : "/api/v1/favorite";
                const method = post.is_favorite ? "PUT" : "POST";

                const response = await fetch(url, {
                    method,
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${token}`, // Nếu có token
                    },
                    body: JSON.stringify({ post_id: post.id }),
                });

                if (response.ok) {
                    post.is_favorite = !post.is_favorite;
                } else {
                    console.error(
                        "Failed to toggle favorite:",
                        await response.text()
                    );
                }
            } catch (error) {
                console.error("Error toggling favorite:", error);
            }
        },
        async fetchRoomatesData(page = 1) {
            this.loading = true;
            try {
                // Truyền tham số page và itemsPerPage vào API
                const response = await apiClient.get("/roomate", {
                    params: {
                        keyword: this.keyword,
                        area: this.area,
                        district: this.district,
                        type: this.type,
                        price: this.price,
                        page: page,
                        limit: this.itemsPerPage, // hoặc 'per_page' tuỳ theo API của bạn
                    },
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`, // Nếu có token
                    },
                });

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

        async fetchRoomatesDataRoom(page = 1) {
            this.loading = true;
            try {
                // Truyền tham số page và itemsPerPage vào API
                const response = await apiClient.get("/roomate?type=room", {
                    params: {
                        keyword: this.keyword,
                        area: this.area,
                        district: this.district,
                        type: this.type,
                        price: this.price,
                        page: page,
                        limit: this.itemsPerPage, // hoặc 'per_page' tuỳ theo API của bạn
                    },
                });

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
                console.log(this.posts);

                this.loading = false; // Ẩn spinner
            }
        },

        async fetchRoomatesDataRoommate(page = 1) {
            this.loading = true;
            try {
                // Truyền tham số page và itemsPerPage vào API
                const response = await apiClient.get("/roomate?type=roommate", {
                    params: {
                        keyword: this.keyword,
                        area: this.area,
                        district: this.district,
                        type: this.type,
                        price: this.price,
                        page: page,
                        limit: this.itemsPerPage, // hoặc 'per_page' tuỳ theo API của bạn
                    },
                });

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

        async fetchLogout() {
            this.loading = true;
            try {
                const response = await defaultApiClient.post("/logout");
                localStorage.removeItem("user");
                localStorage.removeItem("access_token");
                this.user = null;
                window.location.reload();
            } catch (error) {
                console.error("Error logging out", error);
            } finally {
                this.loading = false; // Ẩn spinner
            }
        },

        handlePageChange(page) {
            this.currentPage = page;
            this.fetchRoomatesData(page); // Gọi lại API với trang mới
        },
    },
};
</script>
