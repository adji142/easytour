<template>
    <Header :easyTourSetting="easyTourSetting" />
    <!-- Common Banner Area -->
    <Banner :BannerName="BannerName"/>

    <!-- Faqs Area -->
    <FaqArea :easyTourSetting="easyTourSetting" :faqList="faqList"/>

    <Footer :easyTourSetting="easyTourSetting"/>

</template>
<script>
import Banner from '@/components/about/Banner.vue'
import FaqArea from '@/components/FaqArea.vue'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
export default {
    name: "FaqsView",
    components: {
        Banner, FaqArea, Header, Footer
    },
    props:{
        easyTourSetting: Array,
        isLoggedIn: Boolean,
        user: Object,
        BannerName: String,
        faqList: Array,
    }
};
</script>