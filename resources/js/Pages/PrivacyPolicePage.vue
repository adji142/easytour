<template>

    <Header :easyTourSetting="easyTourSetting" />
    <!-- Common Banner Area -->
    <Banner :BannerName="BannerName"/>

    <!-- Privacy Policy Areas -->
    <PrivacyPolicyContent :easyTourSetting="easyTourSetting"/>

    <Footer :easyTourSetting="easyTourSetting"/>

</template>
<script>
import Banner from '@/components/about/Banner.vue'
import PrivacyPolicyContent from '@/components/PrivacyPolicyContent.vue'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: "PrivacyPolicyView",
    components: {
        Banner, PrivacyPolicyContent, Header, Footer
    },
    props:{
        easyTourSetting: Array,
        isLoggedIn: Boolean,
        user: Object,
        BannerName: String
    }
};
</script>
