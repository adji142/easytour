<template>
    <!-- Common Banner Area -->
    <Header :easyTourSetting="easyTourSetting"/>

    <TopDestinationBanner ></TopDestinationBanner>

    <!-- Hotel Search Areas -->
    <SearchResult :hotels="hotels" :hotelcount="hotelcount" :isLoggedIn="isLoggedIn" :user="user"/>

</template>
  
<script>
// @ is an alias to /src
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import SearchResult from '@/components/hotel/HotelList.vue'
export default {
    name: 'HotelSearchView',
    components: {
        Header, TopDestinationBanner, SearchResult
    },
    props:{
        easyTourSetting: Array,
        hotels: Array,
        hotelcount: Number,
        isLoggedIn: Boolean,
        user: Object
    }
}
</script>