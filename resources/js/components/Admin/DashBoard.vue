<template>
    <div>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <div
                @click="sidebarOpen = false"
                class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"
            ></div>

            <div
                class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0"
            >
                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center">
                        <svg
                            class="w-12 h-12"
                            viewBox="0 0 512 512"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                                fill="#4C51BF"
                                stroke="#4C51BF"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></path>
                            <path
                                d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                                fill="white"
                            ></path>
                        </svg>

                        <span class="mx-2 text-2xl font-semibold text-white"
                            >Dashboard</span
                        >
                    </div>
                </div>

                <nav class="mt-10">
                    <router-link
                        to="/admin"
                        class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                    >
                        <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                            ></path>
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"
                            ></path>
                        </svg>

                        <span class="mx-3">Dashboard</span>
                    </router-link>

                    <router-link
                        to="/admin/controls"
                        class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    >
                        <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"
                            ></path>
                        </svg>

                        <span class="mx-3">Controls</span>
                    </router-link>

                    <router-link
                        to="/image-upload"
                        class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    >
                        <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                            ></path>
                        </svg>

                        <span class="mx-3">Upload Images</span>
                    </router-link>

                    <router-link
                        to="/"
                        class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    >
                        <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                            ></path>
                        </svg>

                        <span class="mx-3">Home</span>
                    </router-link>
                </nav>
            </div>
            <div class="flex flex-col flex-1 overflow-hidden">
                <header
                    class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600"
                >
                    <div class="flex items-center">
                        <button
                            @click="sidebarOpen = true"
                            class="text-gray-500 focus:outline-none lg:hidden"
                        >
                            <svg
                                class="w-6 h-6"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M4 6H20M4 12H20M4 18H11"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                ></path>
                            </svg>
                        </button>

                        <div class="relative mx-4 lg:mx-0">
                            <span
                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                            >
                                <svg
                                    class="w-5 h-5 text-gray-500"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                </svg>
                            </span>

                            <input
                                class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600"
                                type="text"
                                v-model="keyword"
                                @change="handlePageChange(page)"
                                placeholder="Search"
                            />
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div
                            x-data="{ notificationOpen: false }"
                            class="relative"
                        >
                            <button
                                @click="notificationOpen = !notificationOpen"
                                class="flex mx-4 text-gray-600 focus:outline-none"
                            >
                                <svg
                                    class="w-6 h-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    ></path>
                                </svg>
                            </button>

                            <div
                                x-show="notificationOpen"
                                @click="notificationOpen = false"
                                class="fixed inset-0 z-10 w-full h-full"
                                style="display: none"
                            ></div>

                            <div
                                x-show="notificationOpen"
                                class="absolute right-0 z-10 mt-2 overflow-hidden bg-white rounded-lg shadow-xl w-80"
                                style="width: 20rem; display: none"
                            >
                                <a
                                    href="#"
                                    class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600"
                                >
                                    <img
                                        class="object-cover w-8 h-8 mx-1 rounded-full"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=334&amp;q=80"
                                        alt="avatar"
                                    />
                                    <p class="mx-2 text-sm">
                                        <span class="font-bold" href="#"
                                            >Sara Salah</span
                                        >
                                        replied on the
                                        <span
                                            class="font-bold text-indigo-400"
                                            href="#"
                                            >Upload Image</span
                                        >
                                        artical . 2m
                                    </p>
                                </a>
                                <a
                                    href="#"
                                    class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600"
                                >
                                    <img
                                        class="object-cover w-8 h-8 mx-1 rounded-full"
                                        src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80"
                                        alt="avatar"
                                    />
                                    <p class="mx-2 text-sm">
                                        <span class="font-bold" href="#"
                                            >Slick Net</span
                                        >
                                        start following you . 45m
                                    </p>
                                </a>
                                <a
                                    href="#"
                                    class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600"
                                >
                                    <img
                                        class="object-cover w-8 h-8 mx-1 rounded-full"
                                        src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=334&amp;q=80"
                                        alt="avatar"
                                    />
                                    <p class="mx-2 text-sm">
                                        <span class="font-bold" href="#"
                                            >Jane Doe</span
                                        >
                                        Like Your reply on
                                        <span
                                            class="font-bold text-indigo-400"
                                            href="#"
                                            >Test with TDD</span
                                        >
                                        artical . 1h
                                    </p>
                                </a>
                                <a
                                    href="#"
                                    class="flex items-center px-4 py-3 -mx-2 text-gray-600 hover:text-white hover:bg-indigo-600"
                                >
                                    <img
                                        class="object-cover w-8 h-8 mx-1 rounded-full"
                                        src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=398&amp;q=80"
                                        alt="avatar"
                                    />
                                    <p class="mx-2 text-sm">
                                        <span class="font-bold" href="#"
                                            >Abigail Bennett</span
                                        >
                                        start following you . 3h
                                    </p>
                                </a>
                            </div>
                        </div>

                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button
                                @click="dropdownOpen = !dropdownOpen"
                                class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none"
                            >
                                <img
                                    class="object-cover w-full h-full"
                                    src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80"
                                    alt="Your avatar"
                                />
                            </button>

                            <div
                                x-show="dropdownOpen"
                                @click="dropdownOpen = false"
                                class="fixed inset-0 z-10 w-full h-full"
                                style="display: none"
                            ></div>

                            <div
                                x-show="dropdownOpen"
                                class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                                style="display: none"
                            >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                                    >Profile</a
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                                    >Products</a
                                >
                                <a
                                    href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                                    >Logout</a
                                >
                            </div>
                        </div>
                    </div>
                </header>
                <main
                    class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200"
                >
                    <div class="container px-6 py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700 mb-4">
                            Danh sách Motor
                        </h3>

                        <!-- Bảng hiển thị danh sách motor -->
                        <div class="flex flex-col mt-8">
                            <div
                                class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
                            >
                                <div
                                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg"
                                >
                                    <table class="min-w-full">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                                >
                                                    Tên Motor
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50"
                                                >
                                                    Ngày tạo
                                                </th>
                                                <th
                                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50"
                                                >
                                                    Chi tiết
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody class="bg-white">
                                            <tr
                                                v-for="motor in motors"
                                                :key="motor.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                                >
                                                    {{ motor.name }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                                >
                                                    {{ motor.created_at }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                                >
                                                    <button
                                                        @click="
                                                            showDetail(motor)
                                                        "
                                                        class="bg-indigo-600 hover:bg-indigo-800 text-white px-3 py-1 rounded"
                                                    >
                                                        Chi tiết
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Component phân trang -->
                                    <PaginationVue
                                        class="mt-4"
                                        :total-pages="totalPages"
                                        :current-page="currentPage"
                                        @page-changed="handlePageChange"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Phần hiển thị chi tiết motor với đồ thị vận tốc theo thời gian -->
                        <div
                            v-if="selectedMotor"
                            class="mt-8 p-4 border rounded shadow"
                        >
                            <h3 class="text-2xl font-medium mb-4">
                                Chi tiết Motor: {{ selectedMotor.name }}
                            </h3>
                            <canvas
                                id="motorChart"
                                ref="motorChart"
                                width="600"
                                height="400"
                            ></canvas>
                            <button
                                @click="closeDetail"
                                class="mt-4 bg-red-600 hover:bg-red-800 text-white px-3 py-1 rounded"
                            >
                                Đóng
                            </button>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<script>
import apiClient from "../../axios";
import loadingVue from "../loading.vue";
import PaginationVue from "../Pagination.vue";
import Chart from "chart.js/auto";

export default {
    name: "MotorList",
    components: {
        PaginationVue,
        loadingVue,
    },
    data() {
        return {
            motors: [],
            loading: false,
            currentPage: 1,
            itemsPerPage: 10,
            totalPages: 1,
            selectedMotor: null, // Motor được chọn để xem chi tiết
            chart: null, // Instance Chart.js
            timer: null, // Timer để gọi fetchMotorData() mỗi 5 giây
        };
    },
    mounted() {
        // Gọi lần đầu khi component được mount
        this.fetchMotorData();
        // Cài đặt interval để gọi fetchMotorData() mỗi 5 giây
        this.timer = setInterval(() => {
            this.fetchMotorData(this.currentPage);
        }, 5000);
    },
    beforeDestroy() {
        // Dọn dẹp timer khi component bị huỷ (hoặc sử dụng destroyed() nếu dùng Vue 2)
        clearInterval(this.timer);
    },
    methods: {
        async fetchMotorData(page = 1) {
            this.loading = true;
            try {
                const response = await apiClient.get("/motor", {
                    params: {
                        page: page,
                        limit: this.itemsPerPage,
                    },
                });
                // Giả sử API trả về cấu trúc:
                // { status: "success", message: "...", data: [...], pagination: { current_page, per_page, last_page, ... } }
                this.motors = response.data.data;
                this.currentPage = response.data.pagination.current_page;
                this.itemsPerPage = response.data.pagination.per_page;
                this.totalPages = response.data.pagination.last_page;
            } catch (error) {
                console.error("Error fetching motor data", error);
            } finally {
                this.loading = false;
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
            this.fetchMotorData(page);
        },
        showDetail(motor) {
            this.selectedMotor = motor;
            // Sau khi DOM cập nhật, vẽ đồ thị
            this.$nextTick(() => {
                this.renderChart();
            });
        },
        closeDetail() {
            this.selectedMotor = null;
            if (this.chart) {
                this.chart.destroy();
                this.chart = null;
            }
        },
        renderChart() {
            // Hủy đồ thị cũ nếu có
            if (this.chart) {
                this.chart.destroy();
            }
            // Lấy dữ liệu từ motor được chọn
            const labels = this.selectedMotor.data.map((item) => item.time);
            const speeds = this.selectedMotor.data.map((item) => item.speed);

            const ctx = this.$refs.motorChart.getContext("2d");
            this.chart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Vận tốc (mm/s)",
                            data: speeds,
                            borderColor: "rgba(75,192,192,1)",
                            backgroundColor: "rgba(75,192,192,0.2)",
                            fill: false,
                            tension: 0.1,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Time (đơn vị)",
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Speed (mm/s)",
                            },
                        },
                    },
                },
            });
        },
    },
};
</script>
