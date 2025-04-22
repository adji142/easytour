<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner :BannerName="BannerName" />

    <!-- Destinations Areas -->
    <Destinations :transportation="transportation" :transportationcount="transportationcount" :transportationtype="transportationtype"/>
    <Footer :easyTourSetting="easyTourSetting"/>
</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/transportation/Transportation.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: "TransportationPage",
    components: {
        Header,TopDestinationBanner, Destinations, Footer
    },
    props: {
      easyTourSetting: Array,
      transportation: Array,
      transportationcount: Number,
      transportationtype: Array,
      isLoggedIn: Boolean,
      user: Object,
      BannerName:String
    },
};
</script>
