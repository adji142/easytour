<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner />

    <!-- Destinations Areas -->
    <Destinations :tourDetail="tourDetail" :tourImage="tourImage" :tourItinerary="tourItinerary" :tourpackage="tourpackage" />
    <Footer :easyTourSetting="easyTourSetting"/>
</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/tour/TourDetails.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: "TourDetail",
    components: {
        Header,TopDestinationBanner, Destinations, Footer
    },
    props:{
        easyTourSetting: Array,
        tourDetail: Array,
        tourImage: Array,
        tourItinerary: Array,
        tourpackage: Array,
        isLoggedIn: Boolean,
        user: Object
    }
};
</script>
