<template>
    <div
        class="flex items-start space-x-3 my-2"
        :class="{
            'justify-end': message.user?.id === currentUserId,
        }"
    >
        <div
            v-if="message.user?.id !== currentUserId"
            class="text-sm text-gray-500"
        >
            {{ message.user?.name || "Unknown User" }}
        </div>

        <div
            class="p-3 rounded-lg max-w-xs break-words"
            :class="{
                'bg-blue-500 text-white self-end':
                    message.user?.id === currentUserId,
                'bg-gray-200 text-black self-start':
                    message.user?.id !== currentUserId,
            }"
        >
            {{ message.message }}
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    message: Object,
});

const currentUserId = ref(null);

onMounted(() => {
    const user = JSON.parse(localStorage.getItem("user"));
    if (user) {
        currentUserId.value = user.id;
    }
});
</script>
