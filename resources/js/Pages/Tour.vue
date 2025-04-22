<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner :BannerName="BannerName" />

    <!-- Destinations Areas -->
    <Destinations :tours="tours" :tourcount="tourcount" :tourType="tourType"/>
    <Footer :easyTourSetting="easyTourSetting"/>
</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/tour/Destinations.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: "TopDestinationsView",
    components: {
        Header,TopDestinationBanner, Destinations, Footer
    },
    props: {
      easyTourSetting: Array,
      tours: Array,
      tourcount: Number,
      tourType: Array,
      isLoggedIn: Boolean,
      user: Object,
      BannerName:String
    },
};
</script>
