<template>
    <div class="popup-overlay" @click.self="$emit('close')">
        <div class="popup-content">
            <h2>{{ post.title }}</h2>
            <p>{{ post.description }}</p>
            <button @click="$emit('close')">Đóng</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post: Object,
    },
};
</script>

<style>
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}
.popup-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
}
</style>
