<template>
    <Header :easyTourSetting="easyTourSetting"/>

    <TopDestinationBanner :BannerName="BannerName"></TopDestinationBanner>
    <!-- News Area -->
    <NewsArea :article="article" :articleLastest="articleLastest" :articleCount="articleCount"/>

    <!-- Cta Area -->
    <Footer :easyTourSetting="easyTourSetting"/>

</template>
<script>
import Header from '@/components/Header.vue'
import TopDestinationBanner from '@/components/tour/TopDestinationBanner.vue'
import NewsArea from '@/components/NewsArea.vue'
import Footer from '@/components/Footer.vue'


export default {
    name: "NewsView",
    components: {
        Header,TopDestinationBanner, NewsArea, Footer
    },
    props:{
        easyTourSetting: Array,
        article: Array,
        articleLastest: Array,
        articleCount: Number,
        isLoggedIn: Boolean,
        user: Object,
        BannerName:String
    }
};
</script>
