<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Quản lý bài đăng tìm bạn ở ghép</h1>

        <router-link to="/">
            <button class="bg-blue-500 text-white px-4 py-2 rounded mr-3">
                Trang chủ
            </button>
        </router-link>

        <!-- Nút thêm mới -->
        <button
            @click="openModal()"
            class="bg-blue-500 text-white px-4 py-2 rounded"
        >
            Thêm bài đăng
        </button>

        <!-- Bảng danh sách bài đăng -->
        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Tiêu đề</th>
                    <th class="border p-2">Địa chỉ</th>
                    <th class="border p-2">Giá</th>
                    <th class="border p-2">Diện tích</th>
                    <th class="border p-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id" class="text-center">
                    <td class="border p-2">{{ post.title }}</td>
                    <td class="border p-2">{{ post.location }}</td>
                    <td class="border p-2">
                        {{ formatPrice(post.price) }} VND
                    </td>
                    <td class="border p-2">{{ post.area }} m²</td>
                    <td class="border p-2">
                        <button
                            @click="openModal(post)"
                            class="bg-yellow-500 text-white px-2 py-1 rounded"
                        >
                            Sửa
                        </button>
                        <button
                            @click="deletePost(post.id)"
                            class="bg-red-500 text-white px-2 py-1 rounded ml-2"
                        >
                            Xóa
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal Create & Update -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center"
        >
            <div class="bg-white p-6 rounded shadow-md w-1/3">
                <h2 class="text-xl font-bold mb-4">
                    {{ editMode ? "Cập nhật bài đăng" : "Thêm bài đăng" }}
                </h2>

                <!-- Form nhập dữ liệu -->
                <form @submit.prevent="editMode ? updatePost() : createPost()">
                    <input
                        type="text"
                        v-model="formData.title"
                        placeholder="Tiêu đề"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="text"
                        v-model="formData.location"
                        placeholder="Địa chỉ"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="text"
                        v-model="formData.district"
                        placeholder="Quận/Huyện"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="text"
                        v-model="formData.ward"
                        placeholder="Phường/Xã"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="number"
                        v-model="formData.price"
                        placeholder="Giá thuê (VND)"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="number"
                        v-model="formData.area"
                        placeholder="Diện tích (m²)"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="text"
                        v-model="formData.posted_by"
                        placeholder="Người đăng"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <input
                        type="text"
                        v-model="formData.phone"
                        placeholder="Số điện thoại"
                        class="border p-2 w-full mb-2"
                        required
                    />
                    <QuillEditor
                        v-model:content="formData.description"
                        content-type="html"
                    />

                    <div class="flex justify-end space-x-2">
                        <button
                            type="button"
                            @click="closeModal"
                            class="bg-gray-500 text-white px-4 py-2 rounded"
                        >
                            Hủy
                        </button>
                        <button
                            type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded"
                        >
                            {{ editMode ? "Cập nhật" : "Thêm" }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Component phân trang -->
        <Pagination
            class="mt-4"
            :total-pages="totalPages"
            :current-page="currentPage"
            @page-changed="handlePageChange"
        />
    </div>
</template>

<script>
import axios from "axios";
import Pagination from "../Pagination.vue";
import { QuillEditor } from "@vueup/vue-quill";

export default {
    components: {
        Pagination,
        QuillEditor,
    },
    data() {
        return {
            posts: [], // Danh sách bài đăng
            showModal: false,
            editMode: false,
            formData: {
                title: "",
                location: "",
                district: "",
                ward: "",
                price: "",
                area: "",
                posted_by: "",
                phone: "",
                description: "",
                images: [],
                type: "",
                status: "available",
            },
            token: localStorage.getItem("access_token"),

            currentPage: 1, // Trang hiện tại
            itemsPerPage: 12, // Số sản phẩm mỗi trang
            totalPages: 6, // Số sản phẩm mỗi trang
            total: 0, // tổng trang
        };
    },
    methods: {
        formatPrice(price) {
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
        // Lấy danh sách bài đăng
        async fetchPosts() {
            try {
                const token = localStorage.getItem("access_token");
                const response = await axios.get("/api/v1/roomate/manage", {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                this.posts = response.data.data;
                this.currentPage = response.data.pagination.current_page;
                this.itemsPerPage = response.data.pagination.per_page;
                this.totalPages = response.data.pagination.last_page;
                this.total = response.data.pagination.total;
                console.log("Danh sách bài đăng:", this.posts);
            } catch (error) {
                console.error("Lỗi khi tải bài đăng:", error);
            }
        },

        // Mở modal (tạo mới hoặc chỉnh sửa)
        openModal(post = null) {
            if (post) {
                this.editMode = true;
                this.formData = { ...post };
                this.formData.price = parseFloat(
                    post.price?.replace(/\./g, "") || 0
                );
                this.formData.description = post.description ?? "";
            } else {
                this.editMode = false;
                this.formData = {
                    title: "",
                    location: "",
                    district: "",
                    ward: "",
                    price: "",
                    area: "",
                    posted_by: "",
                    phone: "",
                    description: "",
                    images: [],
                    type: "",
                    status: "available",
                };
            }
            this.showModal = true;
        },
        // Đóng modal
        closeModal() {
            this.showModal = false;
        },

        // Tạo bài đăng mới
        async createPost() {
            try {
                const token = localStorage.getItem("access_token"); // Lấy token từ localStorage

                await axios.post("/api/v1/roomate", this.formData, {
                    headers: {
                        Authorization: `Bearer ${token}`, // Thêm token trực tiếp
                        "Content-Type": "application/json",
                    },
                });

                this.fetchPosts(); // Cập nhật danh sách
                this.closeModal();
            } catch (error) {
                console.error("Lỗi khi tạo bài đăng:", error);
            }
        },

        async updatePost() {
            try {
                const token = localStorage.getItem("access_token");

                console.log("Form data gửi đi:", this.formData);

                await axios.put(
                    `/api/v1/roomate/manage/${this.formData.id}`,
                    this.formData,
                    {
                        headers: {
                            Authorization: `Bearer ${token}`,
                            "Content-Type": "application/json",
                        },
                    }
                );

                this.fetchPosts(); // Cập nhật danh sách
                this.closeModal();
            } catch (error) {
                console.error("Lỗi khi cập nhật bài đăng:", error);
            }
        },

        // Xóa bài đăng
        async deletePost(id) {
            if (!confirm("Bạn có chắc chắn muốn xóa bài đăng này?")) return;
            try {
                await axios.delete(`/api/v1/roomate/manage/${id}`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });
                this.fetchPosts(); // Cập nhật danh sách
            } catch (error) {
                console.error("Lỗi khi xóa bài đăng:", error);
            }
        },
    },
    mounted() {
        this.fetchPosts();
    },
};
</script>
