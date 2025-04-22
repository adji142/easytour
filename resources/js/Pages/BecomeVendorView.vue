<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <Banner />

    <!-- How It Work -->
    <HowWork :easyTourSetting="easyTourSetting" />

    <!-- About Service Area -->
    <!-- <AboutService /> -->

    <!-- Vendor Form Area -->
    <VendorForm :negara="negaraData" />

    <!-- Cta Area -->
    <Footer :easyTourSetting="easyTourSetting"/>
</template>

<script setup>
    import { ref } from 'vue';
    import axios from 'axios';

    const prop = defineProps({
        easyTourSetting: Array,
        negara: Array
    });
    const negaraData = prop.negara;
</script>

<script>
import Banner from '@/components/about/Banner.vue'
import HowWork from '@/components/vendor/HowWork.vue'
import AboutService from '@/components/vendor/AboutService.vue'
import VendorForm from '@/components/vendor/VendorForm.vue'
import Cta from '@/components/home/Cta.vue'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: "BecomeVendorView",
    components: {
        Header, Banner, HowWork, AboutService, VendorForm, Cta, Footer
    },
    props:{
        easyTourSetting: Array,
        isLoggedIn: Boolean,
        user: Object
    }
};
</script>