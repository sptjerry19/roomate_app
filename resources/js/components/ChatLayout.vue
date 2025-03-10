<template>
    <div>
        <div class="chat">
            <div class="chat-title">
                <h1>Chatroom</h1>
            </div>
            <div class="messages">
                <ChatItem
                    v-for="(message, index) in list_messages"
                    :key="index"
                    :message="message"
                />
            </div>
            <div class="message-box">
                <textarea
                    v-model="message"
                    class="message-input"
                    placeholder="Type message..."
                    @keydown.enter.prevent="sendMessage"
                ></textarea>
                <button @click="sendMessage" class="message-submit">
                    Send
                </button>
            </div>
        </div>
        <div class="bg"></div>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, nextTick } from "vue";
import axios from "axios"; // Import axios
import ChatItem from "./ChatItem.vue";

const message = ref("");
const list_messages = ref([]);

onBeforeMount(() => {
    loadMessages();
});

async function loadMessages() {
    try {
        const response = await axios.get("/api/v1/messages", {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("access_token")}`,
            },
        });
        list_messages.value = response.data.data;
        console.log(list_messages.value);

        scrollToBottom();
    } catch (error) {
        console.error("Lỗi tải tin nhắn:", error);
    }
}

async function sendMessage() {
    if (!message.value.trim()) return; // Không gửi tin nhắn rỗng

    try {
        const response = await axios.post(
            "/api/v1/messages",
            { message: message.value },
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "access_token"
                    )}`,
                },
            }
        );

        list_messages.value.push(response.data.message); // Thêm tin nhắn vào danh sách
        message.value = ""; // Xóa nội dung input
        scrollToBottom();
    } catch (error) {
        console.error("Lỗi gửi tin nhắn:", error);
    }
}

function scrollToBottom() {
    nextTick(() => {
        const messages = document.querySelector(".messages");
        if (messages) {
            messages.scrollTo({
                top: messages.scrollHeight,
                behavior: "smooth",
            });
        }
    });
}
</script>
