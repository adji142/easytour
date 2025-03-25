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
            <div class="row">
                <div class="col-lg-12">
                    <div class="partner_slider_area owl-theme owl-carousel">
                        <swiper :slides-per-view="8">
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/1.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/2.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/3.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/4.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/5.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>

                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/6.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/7.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/8.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/5.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/3.png" alt="logo"></a>
                                </div>
                            </swiper-slide>
                            <swiper-slide>
                                <div class="partner_logo">
                                    <a href="#!"><img src="../assets/img/partner/2.png" alt="logo"></a>
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
    }
};
</script>