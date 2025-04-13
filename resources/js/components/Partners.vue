<template>
    <section id="our_partners" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Our partners</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="partner_slider_area owl-theme owl-carousel text-center">
                        <swiper :slides-per-view="8" :pagination="{ clickable: true }">
                            <swiper-slide v-for="(item, index) in bestPartner" :key="index">
                                <div class="partner_logo">
                                    <a href="#!"><img v-if="item.Icon" :src="item.Icon" alt="{{ item.PartnerCode }}" /></a>
                                </div>
                            </swiper-slide>
                        </swiper>
                    </div>
                </div> 
            </div>
        </div>
    </section>
</template>

<script>

// import Swiper core and required components
import SwiperCore, { Pagination } from "swiper";

import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/swiper-bundle.css";


// install Swiper components
SwiperCore.use([Pagination,]);

export default {
    name: "Partners",

    components: {
        Swiper,
        SwiperSlide
    },

    data() {
        return {
            swiper: null,
        };
    },
    props: {
        // Define any props you want to pass to the components here
        bestPartner: Array,
    },
};
</script>