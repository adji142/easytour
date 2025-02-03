import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/home.vue";
import profile from "../views/profile.vue";

const router = createRouter({
    history: createWebHistory('/'),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/profile',
            name: 'profile',
            component: profile
        }
    ]
});

export default router;