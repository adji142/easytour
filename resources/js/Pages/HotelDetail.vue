<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner />

    <!-- Destinations Areas -->
    <Destinations :hotelDetail="hotelDetail" :hotelImage="hotelImage" :hotelRoom="hotelRoom"/>

</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/hotel/HotelDetail.vue'


export default {
    name: "HotelDetail",
    components: {
        Header,TopDestinationBanner, Destinations
    },
    props:{
        easyTourSetting: Array,
        hotelDetail: Array,
        hotelImage: Array,
        hotelRoom: Array,
        isLoggedIn: Boolean,
        user: Object
    }
};
</script>
