<template>
    <!-- Common Banner Area -->
    <Header :easyTourSetting="easyTourSetting"/>

    <TopDestinationBanner :BannerName="BannerName"></TopDestinationBanner>

    <!-- Hotel Search Areas -->
    <SearchResult :hotels="hotels" :hotelcount="hotelcount" :isLoggedIn="isLoggedIn" :user="user"/>
    <Footer :easyTourSetting="easyTourSetting"/>
</template>
  
<script>
// @ is an alias to /src
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import SearchResult from '@/components/hotel/HotelList.vue'
import Footer from '@/components/Footer.vue'

export default {
    name: 'HotelSearchView',
    components: {
        Header, TopDestinationBanner, SearchResult, Footer
    },
    props:{
        easyTourSetting: Array,
        hotels: Array,
        hotelcount: Number,
        isLoggedIn: Boolean,
        user: Object,
        BannerName:String
    }
}
</script>