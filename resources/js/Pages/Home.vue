<template>

    <Header />
  
    <!-- Banner Area -->
    <Banner />
  
    <Footer />
  </template>
  
  <script>
  import Header from '@/components/Header.vue'
  import Footer from '@/components/Footer.vue'
  import Banner from '@/components/home/Banner.vue'
  
  export default {
    name: 'App',
    components: {
      Header, Footer, Banner
    }
  }
  </script>