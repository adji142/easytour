<template>

    <Header :easyTourSetting="easyTourSetting"/>
  
    <!-- Banner Area -->
    <Banner :easyTourSetting="easyTourSetting" />

    <TopService :topServices="topServices" />

    <About :easyTourSetting="easyTourSetting" />

    <ClientSays :testimonial="testimonial" :easyTourSetting="easyTourSetting"/>

    <Partners :bestPartner="bestPartner"/>

    <Footer :easyTourSetting="easyTourSetting"/>
  </template>
  
  <script>
  import Header from '@/components/Header.vue'
  import Footer from '@/components/Footer.vue'
  import Banner from '@/components/home/Banner.vue'
  import TopService from '@/components/TopService.vue'
  import About from '@/components/About.vue'
  import ClientSays from '@/components/ClientSays.vue'
  import Partners from '@/components/Partners.vue'

  
  export default {
    name: 'App',
    components: {
      Header, Footer, Banner, TopService, About, ClientSays, Partners
    },
    props: {
      // Define any props you want to pass to the components here
      topServices: Array,
      easyTourSetting: Array,
      testimonial: Array,
      bestPartner: Array,
    },
  }
  </script>