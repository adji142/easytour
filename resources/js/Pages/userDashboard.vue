<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner :BannerName="BannerName"/>

    <!-- Dashboard Area -->
    <DashboardArea :user="user" :bookingList="bookingList" :startDate="startDate" :endDate="endDate"/>


</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import DashboardArea from '@/components/dashboard/DashboardArea.vue'

export default {
    name: "DashboardView",
    components: {
        Header, TopDestinationBanner, DashboardArea
    },
    props:{
        easyTourSetting: Array,
        bookingList: Array,
        startDate: String,
        endDate: String,
        isLoggedIn: Boolean,
        user: Object,
        BannerName: String
    }
};
</script>