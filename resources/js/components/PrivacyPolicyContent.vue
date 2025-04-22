<template>
    <section id="tour_details_main" class="section_padding">
       <div class="container">
           <div class="row">
               <div class="col-lg-12">
                   <div class="terms_service_content">
                       <p v-html="easyTourSetting.PrivacyPolicy"></p>
                   </div>
               </div>
           </div>
       </div>
   </section>

</template>
<script>

export default {
   name: "PrivacyPolicyContent",
   props:{
        easyTourSetting: Array,
        isLoggedIn: Boolean,
        user: Object,
        BannerName: String
    }
};
</script>