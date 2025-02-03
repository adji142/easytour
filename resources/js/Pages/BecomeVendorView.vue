<template>
    <Header />
    <!-- Common Banner Area -->
    <Banner />

    <!-- How It Work -->
    <HowWork />

    <!-- About Service Area -->
    <AboutService />

    <!-- Vendor Form Area -->
    <VendorForm />

    <!-- Cta Area -->
    <Cta />
    <Footer />
</template>
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
    }
};
</script>