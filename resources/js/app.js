import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js'; // Pastikan ZiggyVue di-import
import { Ziggy } from './ziggy'; // Import konfigurasi Ziggy (jika ada)
import { InertiaProgress } from '@inertiajs/progress';

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import './assets/app.css'
import '../css/app.css';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy) // Gunakan ZiggyVue
            .mount(el);
    },
});

// Aktifkan loading progress
InertiaProgress.init({
    color: '#4B5563', // Warna progress bar (default: biru)
    showSpinner: true, // Menampilkan spinner (default: false)
});
