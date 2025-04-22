<template>
    <div>
        <footer id="footer_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="footer_heading_area">
                            <h5>Need any help?</h5>
                        </div>
                        <div class="footer_first_area">
                            <div class="footer_inquery_area">
                                <h5>Call 24/7 for any help</h5>
                                <h3> <a href="tel:{{ easyTourSetting.AppsPhone }}">{{ easyTourSetting.AppsPhone }}</a></h3>
                            </div>
                            <div class="footer_inquery_area">
                                <h5>Mail to our support team</h5>
                                <h3> <a href="mailto:{{ easyTourSetting.AppsEmail }}">{{ easyTourSetting.AppsEmail }}</a></h3>
                            </div>
                            <div class="footer_inquery_area">
                                <h5>Follow us on</h5>
                                <ul class="soical_icon_footer">
                                    <li><a :href="easyTourSetting.FacebookPage"><i class="fab fa-facebook"></i></a></li>
                                    <li><a :href="easyTourSetting.TwitterPage"><i class="fab fa-tiktok"></i></a></li>
                                    <li><a :href="easyTourSetting.InstagramPage"><i class="fab fa-instagram"></i></a></li>
                                    <li><a :href="easyTourSetting.YoutubePage"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 offset-lg-1 col-md-6 col-sm-6 col-12">
                        <div class="footer_heading_area">
                            <h5>Company</h5>
                        </div>
                        <div class="footer_link_area">
                            <ul>
                                <li><a :href="baseUrl + '#about_two_area'">About Us</a></li>
                                <li><a href="#hometwo_clinet_area">Testimonials</a></li>
                                <li><a href="/becomevendor">Work with Us</a></li>
                                <li><a href="#">Article</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                        <div class="footer_heading_area">
                            <h5>Support</h5>
                        </div>
                        <div class="footer_link_area">
                            <ul>
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Register</a></li>
                                <li><a href="/faq">Faq</a></li>
                                <li><a href="/contact">Contact</a></li>
                                <li><a href="/privacy-police">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                        <div class="footer_heading_area">
                            <h5>Our Services</h5>
                        </div>
                        <div class="footer_link_area">
                            <ul>
                                <li><a href="/tourdestination">List Tour Package</a></li>
                                <li><a href="/searchhotel">List Accomodation</a></li>
                                <li><a href="/transportationpage">List Transportation</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="copyright_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="copyright_left">
                            <p>Copyright © {{ new Date().getFullYear() }} All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="co-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="copyright_right">
                            <img src="../assets/img/easytour.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'Footer',
    props: {
        easyTourSetting: Array
    },
    data() {
        return {
        baseUrl: window.location.origin, // ambil dari browser
        };
    },
}
</script>
