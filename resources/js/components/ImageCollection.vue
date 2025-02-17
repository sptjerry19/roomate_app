<template>
    <div class="Products">
        <!-- Create By Joker Banny -->
        <div class="bg-white min-h-screen">
            <!-- Header Navbar -->
            <nav
                class="fixed top-0 left-0 z-10 w-full border-b border-gray-200 bg-white py-2.5 px-6 sm:px-4"
            >
                <div
                    class="container mx-auto flex max-w-6xl flex-wrap items-center justify-between"
                >
                    <a href="#" class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="mr-3 h-6 text-blue-500 sm:h-9"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                            />
                        </svg>

                        <span
                            class="self-center whitespace-nowrap text-xl font-semibold"
                            >Termcode</span
                        >
                    </a>

                    <!-- avatar -->
                    <div v-if="user" class="mt-2 sm:mt-0 sm:flex md:order-2">
                        <!-- Avatar và thông tin người dùng -->
                        <div class="relative">
                            <img
                                class="w-10 h-10 rounded-full"
                                :src="
                                    user.avatar
                                        ? user.avatar
                                        : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg'
                                "
                                alt="User Avatar"
                            />

                            <span
                                class="top-0 left-7 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"
                            ></span>
                        </div>
                        <button
                            @click="fetchLogout"
                            type="button"
                            class="rounde ml-4 mr-3 hidden border border-red-700 py-1.5 px-6 text-center text-sm font-medium text-red-700 focus:outline-none focus:ring-4 focus:ring-blue-300 md:inline-block rounded-lg"
                        >
                            Logout
                        </button>
                    </div>

                    <div v-else class="mt-2 sm:mt-0 sm:flex md:order-2">
                        <router-link to="login">
                            <!-- Login Button -->
                            <button
                                type="button"
                                class="rounde mr-3 hidden border border-blue-700 py-1.5 px-6 text-center text-sm font-medium text-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 md:inline-block rounded-lg"
                            >
                                Login
                            </button>
                        </router-link>
                        <button
                            type="button"
                            class="rounde mr-3 hidden bg-blue-700 py-1.5 px-6 text-center text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 md:mr-0 md:inline-block rounded-lg"
                        >
                            Register
                        </button>
                        <!-- Register Button -->
                        <button
                            data-collapse-toggle="navbar-sticky"
                            type="button"
                            class="inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 md:hidden"
                            aria-controls="navbar-sticky"
                            aria-expanded="false"
                        >
                            <span class="sr-only">Open main menu</span>
                            <svg
                                class="h-6 w-6"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <div
                        class="hidden w-full items-center justify-between md:order-1 md:flex md:w-auto"
                        id="navbar-sticky"
                    >
                        <ul
                            class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-white md:text-sm md:font-medium"
                        >
                            <li>
                                <router-link
                                    to="/"
                                    class="block rounded bg-blue-700 py-2 pl-3 pr-4 text-white md:bg-transparent md:p-0 md:text-blue-700"
                                    aria-current="page"
                                    >Home</router-link
                                >
                            </li>
                            <li>
                                <router-link
                                    to="/favorite"
                                    class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 md:p-0 md:hover:bg-transparent md:hover:text-blue-700"
                                    >Favorite</router-link
                                >
                            </li>
                            <li>
                                <router-link
                                    to="/admin"
                                    class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 md:p-0 md:hover:bg-transparent md:hover:text-blue-700"
                                    >Admin</router-link
                                >
                            </li>
                            <li>
                                <router-link
                                    to="/collection"
                                    class="block rounded py-2 pl-3 pr-4 text-gray-700 hover:bg-gray-100 md:p-0 md:hover:bg-transparent md:hover:text-blue-700"
                                    >Collection</router-link
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Title -->
            <div class="pt-32 bg-white mb-6">
                <h1 class="text-center text-2xl font-bold text-gray-800">
                    All Products
                </h1>
            </div>
            <!-- Product List -->
            <div class="flex flex-wrap items-center justify-around">
                <!-- Image with click to open dialog -->
                <div
                    v-for="image in images"
                    :key="image.id"
                    class="relative mt-5 flex h-96 w-64 cursor-pointer flex-col overflow-hidden rounded-xl bg-white bg-clip-border text-gray-700 shadow-md transition-opacity hover:opacity-90"
                    @click="openDialog(image.image)"
                >
                    <img
                        alt="nature"
                        class="h-full w-full object-cover object-center"
                        :src="image.image"
                    />
                </div>

                <!-- Backdrop and Dialog -->
                <div
                    v-if="isDialogOpen"
                    @click="closeDialog"
                    class="fixed inset-0 z-50 grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm transition-opacity duration-300"
                >
                    <div
                        @click.stop
                        class="relative m-4 w-3/4 min-w-[75%] max-w-[75%] rounded-lg bg-white font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased shadow-2xl"
                    >
                        <!-- Header -->
                        <div
                            class="flex shrink-0 items-center justify-between p-4 font-sans text-2xl font-semibold leading-snug text-blue-gray-900 antialiased"
                        >
                            <div class="flex items-center gap-3">
                                <img
                                    alt="tania andrew"
                                    :src="selectedImage"
                                    class="relative inline-block h-9 w-9 rounded-full object-cover object-center"
                                />
                                <div class="-mt-px flex flex-col">
                                    <p
                                        class="block font-sans text-sm font-medium leading-normal text-blue-gray-900 antialiased"
                                    >
                                        {{ userName }}
                                    </p>
                                    <p
                                        class="block font-sans text-xs font-normal text-gray-700 antialiased"
                                    >
                                        @canwu
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <button
                                    class="relative h-8 max-h-[32px] w-8 max-w-[32px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-blue-gray-500 transition-all hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    @click="closeDialog"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        aria-hidden="true"
                                        class="h-5 w-5"
                                    >
                                        <path
                                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"
                                        ></path>
                                    </svg>
                                </button>
                                <button
                                    class="select-none rounded-lg bg-green-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-lg hover:shadow-green-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button"
                                    @click="closeDialog"
                                >
                                    Free Download
                                </button>
                            </div>
                        </div>

                        <!-- Image inside Dialog -->
                        <div
                            class="relative border-t border-b border-t-blue-gray-100 border-b-blue-gray-100 p-0 font-sans text-base font-light leading-relaxed text-blue-gray-500 antialiased"
                        >
                            <img
                                alt="nature"
                                class="h-[48rem] w-full object-cover object-center"
                                :src="selectedImage"
                            />
                        </div>

                        <!-- Footer -->
                        <div
                            class="flex shrink-0 flex-wrap items-center justify-between p-4 text-blue-gray-500"
                        >
                            <div class="flex items-center gap-16">
                                <div>
                                    <p
                                        class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased"
                                    >
                                        Views
                                    </p>
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-blue-gray-900 antialiased"
                                    >
                                        {{ views }}
                                    </p>
                                </div>
                                <div>
                                    <p
                                        class="block font-sans text-sm font-normal leading-normal text-gray-700 antialiased"
                                    >
                                        Downloads
                                    </p>
                                    <p
                                        class="block font-sans text-base font-medium leading-relaxed text-blue-gray-900 antialiased"
                                    >
                                        {{ downloads }}
                                    </p>
                                </div>
                            </div>
                            <button
                                class="flex select-none items-center gap-3 rounded-lg border border-blue-gray-500 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-blue-gray-500 transition-all hover:opacity-75 focus:ring focus:ring-blue-gray-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    aria-hidden="true"
                                    class="h-4 w-4"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M15.75 4.5a3 3 0 11.825 2.066l-8.421 4.679a3.002 3.002 0 010 1.51l8.421 4.679a3 3 0 11-.729 1.31l-8.421-4.678a3 3 0 110-4.132l8.421-4.679a3 3 0 01-.096-.755z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                                Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Component phân trang -->
            <Pagination
                class="mt-4"
                :total-pages="totalPages"
                :current-page="currentPage"
                @page-changed="handlePageChange"
            />

            <!-- Footer -->
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
                                    <a
                                        href="/regulations"
                                        class="hover:text-gray-900"
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
                            Đăng ký để nhận ngay ưu đãi của AA++ HOME dành cho
                            lần thuê trọ đầu tiên!
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
    </div>

    <loading :isLoading="loading"></loading>
</template>

<script>
import apiClient, { defaultApiClient } from "../axios";
import Pagination from "./Pagination.vue";
import loading from "./loading.vue";
export default {
    name: "Collection",
    components: {
        Pagination,
        loading,
    },
    data() {
        return {
            isDialogOpen: false,
            loading: false,
            user: null,
            mainImage:
                "https://images.unsplash.com/photo-1485470733090-0aae1788d5af?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2717&q=80",
            profileImage:
                "https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1480&q=80",
            userName: "Tania Andrew",
            views: "44,082,044",
            downloads: "553,031",

            selectedImage: null,
            images: [],

            profileImage: "path_to_profile_image",

            currentPage: 1, // Trang hiện tại
            itemsPerPage: 12, // Số sản phẩm mỗi trang
            totalPages: 6, // Số sản phẩm mỗi trang
        };
    },
    mounted() {
        this.fetchCollection();

        // Kiểm tra và lấy user từ localStorage khi component được mount
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            this.user = JSON.parse(storedUser);
        }
    },
    methods: {
        openDialog(image) {
            this.selectedImage = image;
            this.isDialogOpen = true;
        },
        closeDialog() {
            this.isDialogOpen = false;
            this.selectedImage = null;
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

        async fetchCollection(page = 1) {
            this.loading = true;
            try {
                // Truyền tham số page và itemsPerPage vào API
                const response = await apiClient.get("/storage/upload", {
                    params: {
                        page: page,
                        limit: this.itemsPerPage, // hoặc 'per_page' tuỳ theo API của bạn
                    },
                });
                this.images = response.data.data;
                this.currentPage = response.data.pagination.current_page;
                this.itemsPerPage = response.data.pagination.per_page;
                this.totalPages = response.data.pagination.last_page;
            } catch (error) {
                console.error("Error fetching data", error);
            } finally {
                this.loading = false; // Ẩn spinner
            }
        },

        handlePageChange(page) {
            this.currentPage = page;
            this.fetchCollection(page); // Gọi lại API với trang mới
        },
    },
};
</script>
