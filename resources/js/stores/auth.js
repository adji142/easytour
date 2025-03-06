import { defineStore } from 'pinia'
import { router } from '@inertiajs/vue3'

export const useAuthStore = defineStore('auth', {
    actions: {
        logout() {
            router.post('/logout')
        }
    }
})
