<template>
    <section id="about_two_area" class="section_padding_top">
       <div class="container">
           <div class="row" >
               <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                   <div class="about_two_left">
                       <div class="about_two_left_top">
                           <h5>About us</h5>
                           <h2>{{ easyTourSetting.AboutHeadline }}</h2>
                           <p v-html="easyTourSetting.About"></p>
                       </div>
                       <div class="about_two_left_middel">
                           <div class="about_two_item">
                               <div class="about_two_item_icon">
                                   <img v-if="easyTourSetting.AboutIcon1" :src="easyTourSetting.AboutIcon1" alt="icon">
                               </div>
                               <div class="about_two_item_text">
                                   <h3>{{ easyTourSetting.AboutSubHeadline1 }}</h3>
                                   <p v-html="easyTourSetting.AboutDescriptionSubHeadline1"></p>
                               </div>
                           </div>
                           <div class="about_two_item">
                               <div class="about_two_item_icon">
                                   <img v-if="easyTourSetting.AboutIcon2" :src="easyTourSetting.AboutIcon2" alt="icon">
                               </div>
                               <div class="about_two_item_text">
                                   <h3>{{ easyTourSetting.AboutSubHeadline2 }}</h3>
                                   <p v-html="easyTourSetting.AboutDescriptionSubHeadline2"></p>
                               </div>
                           </div>
                           <div class="about_two_item">
                               <div class="about_two_item_icon">
                                   <img v-if="easyTourSetting.AboutIcon3" :src="easyTourSetting.AboutIcon3" alt="icon">
                               </div>
                               <div class="about_two_item_text">
                                   <h3>{{ easyTourSetting.AboutSubHeadline3 }}</h3>
                                   <p v-html="easyTourSetting.AboutDescriptionSubHeadline3"></p>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                   <div class="about_two_left_img">
                       <img v-if="easyTourSetting.AboutImage" :src="easyTourSetting.AboutImage" alt="img">
                   </div>
               </div>
           </div>

       </div>
   </section>
</template>
<script>

export default {
   name: "About",
   props: {
      // Pastikan untuk menerima props topServices dari parent (Home.vue)
      easyTourSetting: Array,
    },
};
</script>