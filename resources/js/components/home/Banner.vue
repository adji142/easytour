<template>
    <section
      id="home_one_banner"
      :style="{
        backgroundImage: `url('${easyTourSetting.BannerImage}')`,
        backgroundSize: 'cover',
        backgroundPosition: 'center',
        backgroundRepeat: 'no-repeat'
      }"
    >
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="banner_one_text">
              <h1>{{ easyTourSetting.BannerHeadline }}</h1>
              <h3>{{ easyTourSetting.BannerSubHeadline }}</h3>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "Banner",
    props: {
      easyTourSetting: Object,
      isLoggedIn: Boolean,
      user: Object
    },
  };
  </script>
  