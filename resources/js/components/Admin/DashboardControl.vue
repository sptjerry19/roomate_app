<template>
    <div>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <!-- Sidebar -->
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
            <!-- Main content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-medium text-gray-700 mb-4">
                        Biểu đồ Nhiệt độ và Độ ẩm
                    </h3>
                    <!-- Canvas để hiển thị đồ thị -->
                    <canvas id="envChart" width="400" height="200"></canvas>

                    <!-- Bảng lịch sử dữ liệu -->
                    <h3 class="text-xl font-semibold text-gray-700 mt-6">
                        Lịch sử dữ liệu nhiệt độ và độ ẩm
                    </h3>
                    <table class="min-w-full bg-white mt-4 border">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border">Time</th>
                                <th class="py-2 px-4 border">
                                    Temperature (°C)
                                </th>
                                <th class="py-2 px-4 border">Humidity (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in envData" :key="index">
                                <td class="py-2 px-4 border">
                                    {{ item.time }}
                                </td>
                                <td class="py-2 px-4 border">
                                    {{ item.temperature }}
                                </td>
                                <td class="py-2 px-4 border">
                                    {{ item.humidity }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
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
            envData: [], // Mảng chứa dữ liệu nhiệt độ và độ ẩm, ví dụ: [{ time: '12:00', temperature: 25, humidity: 60 }, ...]
            motors: [],
            loading: false,
            currentPage: 1,
            itemsPerPage: 10,
            totalPages: 1,
            timer: null, // Timer để gọi fetchMotorData() mỗi 5 giây
            chart: null, // Instance của Chart.js
            keyword: "",
        };
    },
    mounted() {
        // Gọi API để lấy dữ liệu môi trường (nhiệt độ và độ ẩm)
        this.fetchEnvData();
        this.initChart();
        // Cài đặt interval để cập nhật dữ liệu motor (nếu cần)
        this.timer = setInterval(() => {
            this.fetchMotorData(this.currentPage);
            // Cũng có thể cập nhật dữ liệu môi trường nếu API cung cấp thường xuyên
            this.fetchEnvData();
        }, 5000);
    },
    beforeDestroy() {
        clearInterval(this.timer);
    },
    methods: {
        fetchEnvData() {
            this.loading = true;
            apiClient
                .get("/api/env") // Giả sử endpoint trả về mảng dữ liệu có cấu trúc: [{ time: ..., temperature: ..., humidity: ... }, ...]
                .then((response) => {
                    this.envData = response.data;
                    this.updateChart(this.envData);
                    this.loading = false;
                })
                .catch((error) => {
                    console.error("Error fetching environment data:", error);
                    this.loading = false;
                });
        },
        fetchMotorData(page) {
            this.loading = true;
            apiClient
                .get(`/api/motor?page=${page}&limit=${this.itemsPerPage}`)
                .then((response) => {
                    this.motors = response.data.motors;
                    this.totalPages = Math.ceil(
                        response.data.total / this.itemsPerPage
                    );
                    this.loading = false;
                })
                .catch((error) => {
                    console.error("Error fetching motor data:", error);
                    this.loading = false;
                });
        },
        initChart() {
            const ctx = document.getElementById("envChart").getContext("2d");
            this.chart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: [], // Các nhãn thời gian
                    datasets: [
                        {
                            label: "Temperature (°C)",
                            data: [],
                            borderColor: "rgba(255,99,132,1)",
                            backgroundColor: "rgba(255,99,132,0.2)",
                            fill: false,
                            tension: 0.1,
                        },
                        {
                            label: "Humidity (%)",
                            data: [],
                            borderColor: "rgba(54, 162, 235, 1)",
                            backgroundColor: "rgba(54, 162, 235, 0.2)",
                            fill: false,
                            tension: 0.1,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: { display: true, text: "Time" },
                        },
                        y: {
                            title: { display: true, text: "Value" },
                        },
                    },
                },
            });
        },
        updateChart(data) {
            if (this.chart) {
                // Cập nhật nhãn và dữ liệu từ mảng 'data'
                this.chart.data.labels = data.map((item) => item.time);
                this.chart.data.datasets[0].data = data.map(
                    (item) => item.temperature
                );
                this.chart.data.datasets[1].data = data.map(
                    (item) => item.humidity
                );
                this.chart.update();
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
            this.fetchMotorData(page);
        },
    },
};
</script>

<style scoped>
/* Bạn có thể thêm CSS bổ sung tại đây */
table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f8f8f8;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
