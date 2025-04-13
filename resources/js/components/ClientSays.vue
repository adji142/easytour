<template>
    <section id="hometwo_clinet_area" class="section_padding">
        <div class="container">
            <div class="client_two_area_bg">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="two_client_area_left">
                            <h2>We Provide Top Destinations
                                Expecially For You
                                Book Now and Enjoy!</h2>
                            <div class="sm_call_area">
                                <img src="../assets/img/icon/sm-call.png" alt="icon">
                                <div class="sm_call_number">
                                    <h5>Call now</h5>
                                    <h2><a href="tel:{{ easyTourSetting.AppsPhone }}">{{ easyTourSetting.AppsPhone }}</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="home_client_wrpper">
                            <h4>Our testimonials</h4>
                            <h2>What our client say about us</h2>
                            <div class="home-two-quote">
                                <img src="../assets/img/icon/quote.png" alt="img">
                                <h3>Awesome service</h3>
                            </div>
                            <div class="home_two_client_slider  owl-theme owl-carousel" >
                                <swiper :slides-per-view="1" :pagination="{ clickable: true }">
                                    <swiper-slide v-for="(item, index) in testimonial" :key="index">
                                        <div class="client_two_content">
                                        <p v-html="item.Testimonnial"></p>
                                        <div class="client_two_author">
                                            <h5>{{ item.SenderName }}</h5>
                                            <h6>{{ item.TestimonnialTitle }}</h6>
                                        </div>
                                        </div>
                                    </swiper-slide>
                                </swiper>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/swiper-bundle.css";

export default {
    name: "ClientSays",

    components: {
        Swiper,
        SwiperSlide,
    },

    data() {
        return {
            swiper: null,
        };
    },
    props: {
        testimonial: Array,
        easyTourSetting: Array,
    },
};
</script>