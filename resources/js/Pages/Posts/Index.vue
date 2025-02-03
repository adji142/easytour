<script setup>
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js'; // Impor route dari ziggy-js

defineProps({ posts: Array });

const form = useForm({
    title: '',
    content: ''
});

const submit = () => {
    form.post(route('posts.store'), {
        onSuccess: () => form.reset()
    });
};

const updatePost = (post) => {
    form.title = post.title;
    form.content = post.content;
    form.put(route('posts.update', post.id));
};

const deletePost = (id) => {
    if (confirm('Are you sure?')) {
        form.delete(route('posts.destroy', id));
    }
};
</script>

<template>
    <div>
        <h1 class="text-xl font-bold">Post Management</h1>

        <form @submit.prevent="submit" class="mt-4">
            <input v-model="form.title" placeholder="Title" class="border p-2 w-full">
            <textarea v-model="form.content" placeholder="Content" class="border p-2 w-full mt-2"></textarea>
            <button type="submit" class="bg-blue-500 text-white p-2 mt-2">Save</button>
        </form>

        <ul class="mt-4">
            <li v-for="post in posts" :key="post.id" class="border p-2 mt-2">
                <h2 class="font-bold">{{ post.title }}</h2>
                <p>{{ post.content }}</p>
                <button @click="updatePost(post)" class="bg-green-500 text-white p-2 mt-2">Edit</button>
                <button @click="deletePost(post.id)" class="bg-red-500 text-white p-2 mt-2 ml-2">Delete</button>
            </li>
        </ul>
    </div>
</template>
