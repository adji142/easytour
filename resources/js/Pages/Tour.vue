<template>
    <Header :easyTourSetting="easyTourSetting"/>
    <!-- Common Banner Area -->
    <TopDestinationBanner />

    <!-- Destinations Areas -->
    <Destinations />

</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import Destinations from '@/components/tour/Destinations.vue'


export default {
    name: "TopDestinationsView",
    components: {
        Header,TopDestinationBanner, Destinations
    },
    props: {
      easyTourSetting: Array,
    },
};
</script>
