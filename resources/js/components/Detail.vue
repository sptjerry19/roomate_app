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
                            <option value="/">Chi tiết</option>
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

            <div class="content min-h-screen">
                <div class="flex justify-center mt-28">
                    <!-- bài đăng -->
                    <div
                        class="room-detail md:max-w-screen-md sm:max-w-screen-sm container p-6 bg-white rounded-lg shadow-lg"
                    >
                        <!-- Tiêu đề phòng trọ -->
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">
                            {{ roomDetail.title }}
                        </h2>

                        <!-- Slide ảnh -->
                        <div class="relative mb-6">
                            <div class="flex items-center justify-center">
                                <!-- Hiển thị ảnh chính -->
                                <div class="relative w-full max-w-3xl mx-auto">
                                    <img
                                        :src="modalImages[currentImageIndex]"
                                        :alt="
                                            'Room Image ' +
                                            (currentImageIndex + 1)
                                        "
                                        class="w-full h-80 object-cover rounded-lg shadow-lg"
                                    />
                                    <!-- Nút chuyển ảnh -->
                                    <button
                                        v-if="currentImageIndex > 0"
                                        @click="prevImage"
                                        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black text-white p-3 rounded-full shadow-lg"
                                    >
                                        &lt;
                                    </button>
                                    <button
                                        v-if="
                                            currentImageIndex <
                                            modalImages.length - 1
                                        "
                                        @click="nextImage"
                                        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black text-white p-3 rounded-full shadow-lg"
                                    >
                                        &gt;
                                    </button>
                                </div>
                            </div>

                            <!-- Hiển thị số ảnh hiện tại -->
                            <div class="mt-2 text-center text-sm text-gray-600">
                                {{ currentImageIndex + 1 }} /
                                {{ modalImages.length }} ảnh
                            </div>

                            <!-- Hiển thị tất cả ảnh nhỏ bên dưới ảnh chính -->
                            <div class="flex justify-start space-x-2">
                                <div
                                    v-for="(image, index) in modalImages"
                                    :key="index"
                                    class="w-20 h-20 cursor-pointer"
                                    :class="{
                                        'border-4 rounded-lg border-blue-500':
                                            index === currentImageIndex,
                                    }"
                                    @click="selectImage(index)"
                                >
                                    <img
                                        :src="image"
                                        :alt="'Thumbnail ' + (index + 1)"
                                        class="w-full h-full object-cover rounded-lg"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin phòng trọ -->
                        <div
                            class="space-y-6 bg-blue-200 mt-12 px-5 py-8 rounded-xl"
                        >
                            <div class="flex flex-wrap gap-6">
                                <div class="flex-1">
                                    <p
                                        class="text-lg font-semibold text-gray-600"
                                    >
                                        Vị trí:
                                    </p>
                                    <p class="text-gray-700">
                                        {{ roomDetail.location }}
                                    </p>
                                </div>
                                <div class="flex-1">
                                    <p
                                        class="text-lg font-semibold text-gray-600"
                                    >
                                        Diện tích:
                                    </p>
                                    <p class="text-gray-700">
                                        {{ roomDetail.area }} m²
                                    </p>
                                </div>
                                <div class="flex-1">
                                    <p
                                        class="text-lg font-semibold text-gray-600"
                                    >
                                        Giá:
                                    </p>
                                    <p class="text-gray-700">
                                        {{ roomDetail.price }} VNĐ/tháng
                                    </p>
                                </div>
                            </div>

                            <!-- Mô tả -->
                            <div>
                                <p class="text-lg font-semibold text-gray-600">
                                    Mô tả:
                                </p>
                                <p class="text-gray-700">
                                    {{ roomDetail.description }}
                                </p>
                            </div>

                            <!-- Đăng bởi -->
                            <div>
                                <p class="text-lg font-semibold text-gray-600">
                                    Đăng bởi:
                                </p>
                                <p class="text-gray-700">
                                    {{
                                        roomDetail.posted_by ||
                                        "Chưa có thông tin"
                                    }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Người đăng -->
                    <div
                        class="room-detail ml-6 h-full md:max-w-sm sm:max-w-screen-sm container p-6 bg-white rounded-lg shadow-lg"
                    >
                        <h2 class="text-xl font-bold">Người đăng</h2>
                        <div class="flex mt-6">
                            <!-- Avatar -->
                            <div>
                                <img
                                    :src="defaultAvatar"
                                    alt="User Avatar"
                                    class="w-24 h-24 object-cover rounded-full"
                                />
                            </div>

                            <!-- Thông tin người đăng -->
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold text-gray-800">
                                    {{ roomDetail.posted_by }}
                                </h3>

                                <!-- Số điện thoại với icon -->
                                <div
                                    class="flex items-center text-gray-700 mt-2"
                                >
                                    <svg
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
                                            d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"
                                        />
                                    </svg>
                                    <span>{{ roomDetail.phone }}</span>
                                </div>

                                <!-- Nút nhắn tin -->
                                <button
                                    class="mt-4 bg-primary text-white px-4 py-2 rounded-lg flex items-center hover:bg-primary/90 transition"
                                >
                                    <svg
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
                                            d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"
                                        />
                                    </svg>
                                    Nhắn tin
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tin đăng cùng khu vực -->
                <div class="equal-area mt-20">
                    <h2 class="text-center text-4xl font-bold size-20 w-full">
                        Tin đăng cùng khu vực
                    </h2>
                    <div class="flex justify-center">
                        <div
                            class="room-slider flex space-x-4 overflow-x-auto p-4"
                            :style="{ maxWidth: maxWidth }"
                        >
                            <div
                                class="room-item flex-none w-64"
                                v-for="room in roomItems"
                                :key="room.id"
                            >
                                <router-link :to="`/room/${room.id}`">
                                    <div class="room-image">
                                        <img
                                            :src="room.images[0]"
                                            alt="Room Image"
                                            class="w-full h-48 object-cover rounded-lg shadow-lg"
                                        />
                                    </div>
                                    <div class="room-info mt-2">
                                        <h3
                                            class="text-md font-bold text-gray-900"
                                        >
                                            {{ room.title }}
                                        </h3>
                                        <p class="text-sm text-gray-700">
                                            {{ room.location }}
                                        </p>
                                    </div>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="bg-primary text-white py-10">
                    <div
                        class="container mx-auto gap-8 px-4 flex justify-around"
                    >
                        <!-- cột 1 + 2 -->
                        <div class="flex justify-around max-w-6xl">
                            <!-- Cột 1 -->
                            <div class="">
                                <h3
                                    class="text-lg font-semibold text-white mb-4"
                                >
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
                                <h3
                                    class="text-lg font-semibold text-white mb-4"
                                >
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
                                Đăng ký để nhận ngay ưu đãi của AA++ HOME dành
                                cho lần thuê trọ đầu tiên!
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
                            <p
                                class="mt-4 text-center text-gray-500 font-medium"
                            >
                                AA++ HOME
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <loading :isLoading="loading"></loading>
</template>

<script>
import apiClient from "../axios";
import loading from "./loading.vue";

export default {
    data() {
        return {
            loading: true,
            roomDetail: {}, // Data to hold the room details
            modalImages: [], // Danh sách ảnh trong modal
            currentImageIndex: 0, // Chỉ số ảnh hiện tại
            modalVisible: false, // Hiển thị modal
            roomItems: [],
            maxWidth: "100%",
            user: null,
            showDropdown: false, // Điều khiển hiển thị menu dropdown
            defaultAvatar:
                "https://diaocdangmuasaigon.com/wp-content/uploads/2024/09/anh-avatar-vo-tri-7ImqGGy.jpg",
        };
    },
    mounted() {
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            this.user = JSON.parse(storedUser);
        }
        this.fetchRoomDetail();
        this.setMaxWidth(); // Gọi hàm thiết lập maxWidth khi load trang
        window.addEventListener("resize", this.setMaxWidth); // Lắng nghe sự kiện resize
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.setMaxWidth);
    },
    watch: {
        // Theo dõi sự thay đổi của route.params.id
        "$route.params.id": {
            immediate: true,
            handler() {
                this.fetchRoomDetail(); // Gọi API khi id thay đổi
            },
        },
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
        selectImage(index) {
            this.currentImageIndex = index;
        },
        setMaxWidth() {
            const screenWidth = window.innerWidth;
            if (screenWidth <= 768) {
                this.maxWidth = "100%"; // Nếu màn hình nhỏ hơn hoặc bằng 768px, chiếm toàn bộ chiều rộng
            } else {
                this.maxWidth = "80%"; // Nếu màn hình lớn hơn 768px, chiếm 2/3 chiều rộng
            }
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
        async fetchRoomDetail() {
            try {
                const postId = this.$route.params.id; // Lấy postId từ URL
                console.log(`Fetching details for postId: ${postId}`);
                const response = await apiClient.get(`/roomate/${postId}`);
                console.log("Room details:", response.data);
                this.roomDetail = response.data;
                this.modalImages = response.data.images;

                this.fetchRoomatesData();

                window.scrollTo({ top: 0, behavior: "smooth" });
            } catch (error) {
                console.error("Error fetching data", error);
                // Hiển thị lỗi cho người dùng
                this.$toast.error(
                    "Không thể tải thông tin phòng trọ. Vui lòng thử lại sau."
                );
            } finally {
                this.loading = false;
            }
        },
        async fetchRoomatesData(page = 1) {
            this.loading = true;
            try {
                // Truyền tham số page và itemsPerPage vào API
                const response = await apiClient.get("/roomate", {
                    params: {
                        district: this.roomDetail.district,
                        page: page,
                        limit: this.itemsPerPage, // hoặc 'per_page' tuỳ theo API của bạn
                    },
                });

                // Kiểm tra nếu dữ liệu rỗng
                if (response.data.data.length === 0) {
                    this.roomItems = []; // Đặt danh sách bài đăng thành rỗng
                    this.totalPages = 0;
                    this.currentPage = 0;
                    this.showNoDataMessage = true; // Biến để hiển thị thông báo "Không tìm thấy bài đăng nào"
                } else {
                    this.roomItems = response.data.data;
                    this.currentPage = response.data.pagination.current_page;
                    this.itemsPerPage = response.data.pagination.per_page;
                    this.totalPages = response.data.pagination.last_page;
                    this.showNoDataMessage = false; // Ẩn thông báo nếu có dữ liệu
                }
            } catch (error) {
                console.error("Error fetching data", error);
            } finally {
                this.loading = false; // Ẩn spinner
            }
        },
    },
};
</script>

<style scoped>
.room-slider {
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
}

.room-item {
    scroll-snap-align: start;
}
</style>
