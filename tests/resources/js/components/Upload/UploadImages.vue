<template>
    <div class="p-8 flex justify-center items-center min-h-screen bg-white">
        <div
            class="w-full md:w-1/2 relative grid grid-cols-1 md:grid-cols-3 border border-gray-300 bg-gray-100 rounded-lg"
        >
            <div
                class="rounded-l-lg p-4 bg-gray-200 flex flex-col justify-center items-center border-0 border-r border-gray-300"
            >
                <label
                    class="cursor-pointer hover:opacity-80 inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                    for="restaurantImage"
                >
                    Select image
                    <input
                        id="restaurantImage"
                        class="text-sm cursor-pointer w-36 hidden"
                        type="file"
                        multiple
                        @change="handleFileUpload"
                        accept="image/*"
                    />
                </label>
                <button
                    @click="uploadImages"
                    :disabled="!selectedImages.length"
                    class="inline-flex items-center shadow-md my-2 px-2 py-2 bg-gray-900 text-gray-50 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                >
                    Upload Images
                </button>
            </div>
            <div
                class="relative order-first md:order-last h-28 md:h-auto flex justify-center items-center border border-dashed border-gray-400 col-span-2 m-2 rounded-lg bg-no-repeat bg-center bg-origin-padding bg-cover"
            >
                <span class="text-gray-400 opacity-75">
                    <div v-if="selectedImages.length > 0">
                        <div class="images-preview">
                            <div
                                v-for="(image, index) in selectedImages"
                                :key="index"
                                class="image-item"
                            >
                                <img
                                    :src="image"
                                    alt="Selected Image"
                                    class="preview-image"
                                />
                            </div>
                        </div>
                    </div>
                    <svg
                        v-else
                        class="w-14 h-14"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="0.7"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
                        />
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <!-- Display upload status -->
    <div v-if="uploadStatus">
        <p>{{ uploadStatus }}</p>
    </div>
</template>

<script>
import apiClient from "../../axios";

export default {
    data() {
        return {
            selectedImages: [], // Holds the base64 strings of the images
            uploadStatus: "", // Holds status messages for the upload process
        };
    },
    methods: {
        handleFileUpload(event) {
            const files = event.target.files;
            this.selectedImages = []; // Reset selected images

            Array.from(files).forEach((file) => {
                const reader = new FileReader();
                reader.readAsDataURL(file); // Convert file to base64
                reader.onload = () => {
                    this.selectedImages.push(reader.result); // Store base64 string
                };
            });
        },

        async uploadImages() {
            try {
                const response = await apiClient.post(
                    "/storage/upload-images",
                    {
                        base64Images: this.selectedImages, // Send the base64 images to API
                    }
                );

                if (response.data) {
                    this.uploadStatus = "Images uploaded successfully!";
                }
            } catch (error) {
                this.uploadStatus = "Failed to upload images.";
                console.error(error);
            }
        },
    },
};
</script>

<style>
.images-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.image-item {
    width: 150px;
    height: 150px;
    overflow: hidden;
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>
