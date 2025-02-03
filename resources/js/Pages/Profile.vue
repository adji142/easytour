<script setup>
import MainLayout from '../Layouts/MainLayout.vue';

defineProps({
    user: Object
});
</script>

<template>
    <MainLayout>
        <h1 class="text-xl font-bold">User Profile</h1>
        <p v-if="user">Welcome, {{ user.name }}</p>
        <p v-else>Please log in to see your profile.</p>
    </MainLayout>
</template>
