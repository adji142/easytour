<template>
    <section id="top_service_andtour" class="section_padding_top">
      <div class="container">
        <!-- Section Heading -->
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section_heading_center">
              <h2>And tour top services</h2>
            </div>
          </div>
        </div>
  
        <!-- Service Data Loop -->
        <div class="row">
          <div
            class="col-lg-3 col-md-6 col-sm-12 col-12"
            v-for="(item, index) in topServices" 
            :key="index"
          >
            <div class="top_service_boxed">
              <!-- Jika data icon ada, tampilkan gambar -->
              <img v-if="item.Icon" :src="item.Icon" alt="icon" />
              <h3>{{ item.HeadLine }}</h3>
              <p v-html="item.Description"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    props: {
      // Pastikan untuk menerima props topServices dari parent (Home.vue)
      topServices: Array,
    },
  };
  </script>