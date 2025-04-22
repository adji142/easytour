<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner :BannerName="BannerName"/>

    <!-- Destinations Areas -->
    <Destinations :transportationDetail="transportationDetail" :transportationImage="transportationImage" :transportationpackage="transportationpackage" />
    <Footer :easyTourSetting="easyTourSetting"/>
</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/transportation/TransportationDetail.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: "TourDetail",
    components: {
        Header,TopDestinationBanner, Destinations, Footer
    },
    props:{
        easyTourSetting: Array,
        transportationDetail: Array,
        transportationImage: Array,
        transportationpackage: Array,
        isLoggedIn: Boolean,
        user: Object,
        BannerName: String
    }
};
</script>
