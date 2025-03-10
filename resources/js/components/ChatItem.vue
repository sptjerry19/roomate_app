<template>
    <div
        class="message"
        :class="{
            'is-current-user': $root.currentUserLogin.id === message.user.id,
        }"
    >
        <div class="message-item user-name">
            {{ message.user.name }}
        </div>
        <div class="message-item timestamp">
            | {{ message.created_at.split(" ")[1] }}:
        </div>
        <div class="message-item text-message">
            {{ message.message }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    message: Object,
});
</script>
