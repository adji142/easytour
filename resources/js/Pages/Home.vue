<template>

    <Header />
  
    <!-- Banner Area -->
    <Banner />

    <TopService />

    <About />

    <ClientSays />

    <Partners/>

    <Footer />
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
    }
  }
  </script>