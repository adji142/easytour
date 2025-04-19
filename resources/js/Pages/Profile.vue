<template>
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner />

    <!-- Dashboard Area -->
    <DashboardArea :user="user"/>


</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import DashboardArea from '@/components/dashboard/editProfile.vue'

export default {
    name: "Profile",
    components: {
        Header, TopDestinationBanner, DashboardArea
    },
    props:{
        easyTourSetting: Array,
        isLoggedIn: Boolean,
        user: Object
    }
};
</script>