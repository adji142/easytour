<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <!-- Navbar -->
        <nav class="bg-blue-500 text-white p-4">
            <ul class="flex space-x-4">
                <li><Link href="/" class="hover:underline">Home</Link></li>
                <li><Link href="/about" class="hover:underline">About</Link></li>
                <li><Link href="/profile" class="hover:underline">Profile</Link></li>
                <li><Link href="/posts" class="hover:underline">Post</Link></li>
            </ul>
        </nav>

        <!-- Content -->
        <div class="p-4">
            <slot />
        </div>
    </div>
</template>
