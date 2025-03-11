<template>
    <div class="flex flex-col h-screen bg-gray-100">
        <div class="p-4 bg-white shadow-md text-center">
            <h1 class="text-xl font-bold">Chatroom</h1>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            <ChatItem
                v-for="(message, index) in list_messages"
                :key="index"
                :message="message"
            />
        </div>

        <div class="p-4 bg-white shadow-md flex">
            <textarea
                v-model="message"
                class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Type message..."
                @keydown.enter.prevent="sendMessage"
            ></textarea>
            <button
                @click="sendMessage"
                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
            >
                Send
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import ChatItem from "./ChatItem.vue";

export default {
    components: { ChatItem },
    data() {
        return {
            message: "",
            list_messages: [],
        };
    },
    mounted() {
        this.loadMessages();
    },
    methods: {
        async loadMessages() {
            try {
                const response = await axios.get("/api/v1/messages", {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`,
                    },
                });

                // Lấy dữ liệu đúng từ `response.data.data`
                this.list_messages = response.data.data || [];

                console.log("Messages:", this.list_messages);

                this.scrollToBottom();
            } catch (error) {
                console.error("Error fetching messages:", error);
            }
        },
        async sendMessage() {
            if (!this.message.trim()) return;

            try {
                const response = await axios.post(
                    "/api/v1/messages",
                    { message: this.message },
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem(
                                "access_token"
                            )}`, // Gửi token
                        },
                    }
                );

                this.list_messages.push(response.data);
                this.message = "";
                this.loadMessages();
                this.scrollToBottom();
            } catch (error) {
                console.error("Error sending message:", error);
            }
        },
        scrollToBottom() {
            this.$nextTick(() => {
                const messages = document.querySelector(".messages");
                if (messages) {
                    messages.scrollTo({
                        top: messages.scrollHeight,
                        behavior: "smooth",
                    });
                }
            });
        },
    },
};
</script>
