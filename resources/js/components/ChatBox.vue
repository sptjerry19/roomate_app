<template>
    <div
        class="fixed bottom-5 right-5 bg-white w-80 shadow-lg rounded-lg border border-gray-300"
    >
        <!-- Header -->
        <div
            class="flex items-center justify-between p-3 bg-primary text-white rounded-t-lg"
        >
            <h3 class="text-lg font-semibold">Chat</h3>
            <button @click="closeChat">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>

        <!-- Messages -->
        <div
            ref="messageContainer"
            class="h-60 overflow-y-auto p-3 space-y-2 flex flex-col"
        >
            <div
                v-for="(message, index) in messages"
                :key="index"
                class="p-2 rounded-lg w-fit break-words max-w-[70%]"
                :class="{
                    'bg-blue-500 text-white self-end':
                        message.user_id === currentUserId,
                    'bg-gray-200 text-black self-start':
                        message.user_id !== currentUserId,
                }"
            >
                {{ message.message }}
            </div>
        </div>

        <!-- Input -->
        <div class="p-3 border-t border-gray-300 flex">
            <input
                v-model="newMessage"
                type="text"
                class="flex-1 p-2 border rounded-lg"
                placeholder="Nhập tin nhắn..."
                @keydown.enter="sendMessage"
            />
            <button
                @click="sendMessage"
                class="ml-2 bg-primary text-white px-3 py-2 rounded-lg"
            >
                Gửi
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import echo from "../echo";

export default {
    props: {
        receiverId: Number, // ID của người nhận tin nhắn
        closeChat: Function, // Hàm đóng chat
    },
    data() {
        return {
            currentUserId: null,
            messages: [],
            newMessage: "",
        };
    },
    mounted() {
        const user = JSON.parse(localStorage.getItem("user"));
        if (user) {
            this.currentUserId = user.id;
        }
        this.loadMessages();

        echo.channel("chat").listen(".message.sent", (event) => {
            console.log("Tin nhắn mới:", event.message);
            if (
                event.message.user_id === this.receiverId ||
                event.message.receiver_id === this.currentUserId
            ) {
                this.messages.push(event.message);
                this.scrollToBottom(); // Cuộn xuống khi nhận tin nhắn mới
            }
        });
    },
    methods: {
        async loadMessages() {
            try {
                const response = await axios.get(
                    `/api/v1/messages?receiver_id=${this.receiverId}`,
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "access_token"
                            )}`,
                        },
                    }
                );
                this.messages = response.data.data;
                this.scrollToBottom(); // Cuộn xuống sau khi tải tin nhắn
            } catch (error) {
                console.error("Lỗi khi lấy tin nhắn:", error);
            }
        },

        async sendMessage() {
            if (!this.newMessage.trim()) return;

            try {
                const response = await axios.post(
                    "/api/v1/messages",
                    {
                        message: this.newMessage,
                        receiver_id: this.receiverId,
                    },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "access_token"
                            )}`,
                        },
                    }
                );

                if (response.data.data && response.data.data.message) {
                    this.messages.push({
                        message: response.data.data.message,
                        user_id: this.currentUserId,
                        receiver_id: this.receiverId,
                        created_at: new Date().toISOString(),
                    });
                    this.scrollToBottom(); // Cuộn xuống khi gửi tin nhắn
                }

                this.newMessage = "";
            } catch (error) {
                console.error("Lỗi khi gửi tin nhắn:", error);
            }
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messageContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },
    },
};
</script>
