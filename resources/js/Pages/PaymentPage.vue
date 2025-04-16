<template>

    <!-- Common Banner Area -->
    <Header easyTourSetting="easyTourSetting"/>

    <TopDestinationBanner />
    <!-- Tour Booking Submission Areas -->
    <TourBookingSubmission :oDataProduk="oDataProduk" :oDataProdukImage="oDataProdukImage" :oDataProdukPackage="oDataProdukPackage" :oDataUser="oDataUser" :bookingData="bookingData"/>


</template>
<script>

import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import TourBookingSubmission from '@/components/Payment.vue'

export default {
    name: "BookingSubmissionView",
    components: {
        Header, TopDestinationBanner, TourBookingSubmission
    },
    props:{
        easyTourSetting: Array,
        oDataProduk: Array,
        oDataProdukImage: Array,
        oDataProdukPackage: Array,
        oDataUser: Array,
        bookingData: {
            type: Object,
            default: () => ({})
        }
    }
};
</script>
