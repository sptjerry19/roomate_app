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
                        <router-link to="/">
                            <img
                                src="https://s3-alpha-sig.figma.com/img/94aa/de1b/7c2686b66c34627c8e323577a00ecd80?Expires=1740355200&Key-Pair-Id=APKAQ4GOSFWCW27IBOMQ&Signature=Ex3TtLJcraaGGZJf0Y7z8znbGyYjk5v~jsAocqgG4S6yb9XTHaoeW7vwIQrtxeJfTrbtYSYLeDmxPx7S1EtUkysukNdYrYKCREcKsHI8ExlpdcK2OGYKSf3IcXWN3wYXEIn5anDZeWBRnwjttsdhUk5jTSrP7Iv55dRROUCR4D4ttmgEmNXWXzHolaetcxGHSLSjet1prJG61EK0mux6O5AM1s3CLMLxc~EgOV-iGhOiGZGjGzEoQh~sCXgs~e6uAK~dem-48WN9YhwRRaxLKkv23M5QaoVYCL92mrKu9eZGwdkq5hT44H4pR1IYUNEvf~XiKSDqBjCDPxlmevxnGQ__"
                                alt="Logo"
                                class="h-8 w-8 object-contain"
                            />
                        </router-link>
                        <select
                            class="border border-gray-300 rounded-md py-1.5 px-3 text-sm text-gray-700 focus:border-blue-500 focus:ring focus:ring-blue-300 cursor-pointer"
                            @change="navigateToRoute($event)"
                        >
                            <option value="/room">Phòng Trọ</option>
                            <option value="/">Trang chủ</option>
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
                                    <router-link
                                        :to="`/room/${post.id}`"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                    >
                                        Chi tiết
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

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
                                    <a href="#" class="hover:text-gray-900"
                                        >Giới thiệu</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Quý chế hoạt động</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Quy định sử dụng</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Chính sách bảo mật</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
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
                                    <a href="#" class="hover:text-gray-900"
                                        >Câu hỏi thường gặp</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Hướng dẫn đăng tin</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Quy định đăng tin</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Bảng giá dịch vụ</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
                                        >Hướng dẫn thanh toán</a
                                    >
                                </li>
                                <li>
                                    <a href="#" class="hover:text-gray-900"
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
    name: "Home",
    components: {
        Pagination,
        loading,
    },
    data() {
        return {
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
                {
                    label: "Từ khóa",
                    placeholder: "Từ khóa, Đường, Quận, Địa điểm...",
                    icon: "material-icons-outlined search",
                    type: "keyword",
                },
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
        async fetchRoomatesData(page = 1) {
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
