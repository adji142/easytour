<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner :BannerName="BannerName"/>

    <!-- Destinations Areas -->
    <Destinations :hotelDetail="hotelDetail" :hotelImage="hotelImage" :hotelRoom="hotelRoom"/>

    <Footer :easyTourSetting="easyTourSetting"/>
</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/hotel/HotelDetail.vue'
import Footer from '@/components/Footer.vue'


export default {
    name: "HotelDetail",
    components: {
        Header,TopDestinationBanner, Destinations, Footer
    },
    props:{
        easyTourSetting: Array,
        hotelDetail: Array,
        hotelImage: Array,
        hotelRoom: Array,
        isLoggedIn: Boolean,
        user: Object,
        BannerName: String
    }
};
</script>
