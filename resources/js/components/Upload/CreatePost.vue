<template>
    <div
        class="create-post max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg"
    >
        <h2 class="text-2xl font-bold mb-6">Đăng bài tìm roommate</h2>

        <form @submit.prevent="submitPost">
            <!-- Title -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Tiêu đề</label>
                <input
                    v-model="post.title"
                    type="text"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập tiêu đề bài đăng"
                    required
                />
            </div>

            <!-- Location -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Địa chỉ</label>
                <input
                    v-model="post.location"
                    type="text"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập địa chỉ cụ thể"
                    required
                />
            </div>

            <!-- Quận/Huyện -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Quận/Huyện</label>
                <select
                    v-model="selectedDistrict"
                    class="w-full p-2 border rounded"
                    @change="loadWards"
                >
                    <option
                        v-for="district in districts"
                        :key="district.name"
                        :value="district.name"
                    >
                        {{ district.name }}
                    </option>
                </select>
            </div>

            <div class="mb-4" v-if="selectedDistrict">
                <label class="block text-sm font-medium mb-2">Phường/Xã</label>
                <select
                    v-model="selectedWard"
                    class="w-full p-2 border rounded"
                >
                    <option
                        v-for="ward in filteredWards"
                        :key="ward"
                        :value="ward"
                    >
                        {{ ward }}
                    </option>
                </select>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Giá</label>
                <input
                    v-model="post.price"
                    type="number"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập giá phòng (VNĐ)"
                    required
                />
            </div>

            <!-- Area -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2"
                    >Diện tích (m²)</label
                >
                <input
                    v-model="post.area"
                    type="number"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập diện tích phòng"
                    required
                />
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Trạng thái</label>
                <select v-model="post.status" class="w-full p-2 border rounded">
                    <option value="available">Còn trống</option>
                    <option value="occupied">Đã thuê</option>
                </select>
            </div>

            <!-- Posted by -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Người đăng</label>
                <input
                    v-model="post.posted_by"
                    type="text"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập tên người đăng"
                    required
                />
            </div>

            <!-- Số điện thoại -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2"
                    >Số điện thoại</label
                >
                <input
                    v-model="post.phone"
                    type="text"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập số điện thoại người đăng"
                    required
                />
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Mô tả</label>
                <textarea
                    v-model="post.description"
                    class="w-full p-2 border rounded"
                    placeholder="Nhập mô tả chi tiết về phòng"
                    rows="4"
                    required
                ></textarea>
            </div>

            <!-- Images -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Hình ảnh</label>
                <input
                    type="file"
                    @change="handleFileChange"
                    multiple
                    class="w-full p-2 border rounded mb-2"
                />
                <div v-if="post.images.length > 0">
                    <div class="flex flex-wrap">
                        <div
                            v-for="(image, index) in post.images"
                            :key="index"
                            class="w-24 h-24 mr-2 mb-2"
                        >
                            <img
                                :src="image"
                                alt="Image preview"
                                class="w-full h-full object-cover rounded"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2"
                    >Loại bài đăng</label
                >
                <select v-model="post.type" class="w-full p-2 border rounded">
                    <option value="roommate">Tìm roommate</option>
                    <option value="room">Cho thuê phòng</option>
                </select>
            </div>

            <!-- Submit button -->
            <div class="text-right">
                <button
                    type="submit"
                    class="px-6 py-2 bg-green-500 text-white font-bold rounded"
                >
                    Đăng bài
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import apiClient from "../../axios";

export default {
    data() {
        return {
            post: {
                title: "",
                location: "",
                district: "",
                ward: "",
                price: "",
                area: "",
                status: "available",
                posted_by: "",
                phone: "",
                description: "",
                images: [],
                type: "roommate",
            },

            districts: [
                { name: "Ba Đình" },
                { name: "Hoàn Kiếm" },
                { name: "Tây Hồ" },
                { name: "Long Biên" },
                { name: "Cầu Giấy" },
                { name: "Đống Đa" },
                { name: "Hai Bà Trưng" },
                { name: "Hoàng Mai" },
                { name: "Thanh Xuân" },
                { name: "Nam Từ Liêm" },
                { name: "Bắc Từ Liêm" },
                { name: "Sơn Tây" },
                { name: "Ba Vì" },
                { name: "Phúc Thọ" },
                { name: "Mê Linh" },
                { name: "Chương Mỹ" },
                { name: "Thạch Thất" },
                { name: "Quốc Oai" },
                { name: "Đan Phượng" },
                { name: "Hoài Đức" },
                { name: "Ứng Hòa" },
                { name: "Thanh Oai" },
                { name: "Mỹ Đức" },
                { name: "Sóc Sơn" },
                { name: "Sơn Tây" },
            ],
            wards: [
                {
                    districtName: "Ba Đình",
                    wards: [
                        "Phúc Xá",
                        "Trúc Bạch",
                        "Vĩnh Phúc",
                        "Cống Vị",
                        "Liễu Giai",
                        "Ngọc Hà",
                        "Đội Cấn",
                        "Ba Đình",
                    ],
                },
                {
                    districtName: "Hoàn Kiếm",
                    wards: [
                        "Hàng Bạc",
                        "Hàng Đào",
                        "Cửa Đông",
                        "Hàng Gai",
                        "Chợ Dừa",
                        "Lý Thái Tổ",
                        "Phan Chu Trinh",
                        "Tràng Tiền",
                    ],
                },
                {
                    districtName: "Tây Hồ",
                    wards: [
                        "Tây Hồ",
                        "Quảng An",
                        "Nhật Tân",
                        "Phú Thượng",
                        "Bưởi",
                        "Vĩnh Ngọc",
                        "Thụy Khuê",
                        "Xuân La",
                    ],
                },
                {
                    districtName: "Long Biên",
                    wards: [
                        "Long Biên",
                        "Phúc Lợi",
                        "Gia Thụy",
                        "Bồ Đề",
                        "Sài Đồng",
                        "Việt Hưng",
                        "Ngọc Lâm",
                    ],
                },
                {
                    districtName: "Cầu Giấy",
                    wards: [
                        "Dịch Vọng",
                        "Dịch Vọng Hậu",
                        "Cầu Giấy",
                        "Mai Dịch",
                        "Trung Hòa",
                        "Yên Hòa",
                        "Nghĩa Tân",
                    ],
                },
                {
                    districtName: "Đống Đa",
                    wards: [
                        "Chợ Dừa",
                        "Khâm Thiên",
                        "Ngã Tư Sở",
                        "Thịnh Quang",
                        "Đống Đa",
                        "Tây Sơn",
                        "Quốc Tử Giám",
                    ],
                },
                {
                    districtName: "Hai Bà Trưng",
                    wards: [
                        "Bạch Mai",
                        "Đại Cổ Việt",
                        "Phố Huế",
                        "Lê Đại Hành",
                        "Hai Bà Trưng",
                        "Cầu Dền",
                        "Lê Duẩn",
                    ],
                },
                {
                    districtName: "Hoàng Mai",
                    wards: [
                        "Hoàng Mai",
                        "Hạ Đình",
                        "Thanh Trì",
                        "Đại Kim",
                        "Tân Mai",
                        "Quốc Tuấn",
                        "Vĩnh Hưng",
                    ],
                },
                {
                    districtName: "Thanh Xuân",
                    wards: [
                        "Khương Trung",
                        "Khương Đình",
                        "Nguyễn Trãi",
                        "Thanh Xuân Bắc",
                        "Thanh Xuân Nam",
                        "Tây Mỗ",
                        "Thượng Đình",
                    ],
                },
                {
                    districtName: "Nam Từ Liêm",
                    wards: [
                        "Mỹ Đình 1",
                        "Mỹ Đình 2",
                        "Phú Đô",
                        "Cầu Diễn",
                        "Nam Từ Liêm",
                        "Hòa Mạc",
                        "Đại Mỗ",
                    ],
                },
                {
                    districtName: "Bắc Từ Liêm",
                    wards: [
                        "Phú Diễn",
                        "Minh Khai",
                        "Tây Hồ",
                        "Đông Ngạc",
                        "Cổ Nhuế",
                    ],
                },
            ],
            selectedDistrict: null,
            selectedWard: null,
            filteredWards: [],
        };
    },
    methods: {
        loadWards() {
            const district = this.wards.find(
                (item) => item.districtName === this.selectedDistrict
            );
            this.filteredWards = district ? district.wards : [];
        },
        handleFileChange(event) {
            const files = event.target.files;
            this.post.images = []; // Clear previous images

            // Convert selected files to base64 and store in `post.images`
            Array.from(files).forEach((file) => {
                const reader = new FileReader();
                reader.onload = () => {
                    this.post.images.push(reader.result); // Push the base64 result
                };
                reader.readAsDataURL(file); // Convert the file to base64
            });
        },
        async submitPost() {
            try {
                const dataToSend = {
                    ...this.post, // Sao chép tất cả dữ liệu từ this.post
                    district: this.selectedDistrict, // Thêm district
                    ward: this.selectedWard, // Thêm ward
                };

                const response = await apiClient.post("/roomate", dataToSend); // Gửi dữ liệu đã sửa
                alert("Đăng bài thành công!");
                this.$router.push(`/room/${response.data.id}`); // Điều hướng đến trang chi tiết sau khi đăng thành công
            } catch (error) {
                console.error("Lỗi khi đăng bài:", error);
                alert("Đăng bài thất bại. Vui lòng thử lại.");
            }
        },
    },
};
</script>

<style scoped>
.create-post {
    background-color: #f9f9f9;
}
</style>
