<template>

    <!-- Common Banner Area -->
    <Header :easyTourSetting="easyTourSetting" :isLoggedIn="isLoggedIn" :user="user"/>

    <TopDestinationBanner :BannerName="BannerName"/>
    <!-- Tour Booking Submission Areas -->
    <!-- <TourBookingSubmission :oDataProduk="oDataProduk" :oDataProdukImage="oDataProdukImage" :oDataProdukPackage="oDataProdukPackage" :oDataUser="oDataUser" :bookingData="bookingData" :user="user"/> -->
    <component
        :is="TourBookingComponent"
        :oDataProduk="oDataProduk"
        :oDataProdukImage="oDataProdukImage"
        :oDataProdukPackage="oDataProdukPackage"
        :oDataUser="oDataUser"
        :bookingData="bookingData"
        :user="user"
    />

</template>
<script>
import { defineAsyncComponent } from 'vue';
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
// import TourBookingSubmission from '@/components/Payment.vue'

export default {
    name: "BookingSubmissionView",
    components: {
        Header,
        TopDestinationBanner
    },
    props: {
        easyTourSetting: Array,
        oDataProduk: Array,
        oDataProdukImage: Array,
        oDataProdukPackage: Array,
        oDataUser: Array,
        bookingData: {
            type: Object,
            default: () => ({})
        },
        isLoggedIn: Boolean,
        user: Array,
        BannerName: String
    },
    computed: {
        TourBookingComponent() {
            if (this.bookingData.BookingType === 'Hotel') {
                return defineAsyncComponent(() => import('@/components/Payment_Hotel.vue'));
            } else if(this.bookingData.BookingType === 'Tour') {
                return defineAsyncComponent(() => import('@/components/Payment.vue'));
            } else if(this.bookingData.BookingType === 'Transport') {
                return defineAsyncComponent(() => import('@/components/Payment_Transport.vue'));
            }
        }
    }
}

</script>
