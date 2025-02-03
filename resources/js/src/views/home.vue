<template>
    <div class="home">
        <h1>Welcome to EasyTour</h1>
        <router-link to="/profile">Profile</router-link>
    </div>
</template>

<script>
export default {
    name: 'Home'
}
</script>

<style scoped>
.home {
    text-align: center;
    margin-top: 50px;
}
</style>