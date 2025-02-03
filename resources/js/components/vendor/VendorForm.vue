<template>
    <section id="vendor_form_area" class="section_padding_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="vendor_form_heading">
                        <h2>{{ title }}</h2>
                        <p>{{ subTitle }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="vendor_form">
                        <div class="tour_booking_form_box">
                            <form action="!#" id="tour_bookking_form_item">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="First name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="Last name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input"
                                                placeholder="Email address (Optional)">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input"
                                                placeholder="Mobile number*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input"
                                                placeholder="Street address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input"
                                                placeholder="Apartment, Suite, House no (optional)">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control form-select bg_input">
                                                <option value="1">Khulna</option>
                                                <option value="1">New York</option>
                                                <option value="1">Barisal</option>
                                                <option value="1">Nator</option>
                                                <option value="1">Joybangla</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control form-select bg_input">
                                                <option value="1">State</option>
                                                <option value="1">New York</option>
                                                <option value="1">Barisal</option>
                                                <option value="1">Nator</option>
                                                <option value="1">Joybangla</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control form-select bg_input">
                                                <option value="1">Country</option>
                                                <option value="1">New York</option>
                                                <option value="1">Barisal</option>
                                                <option value="1">Nator</option>
                                                <option value="1">Joybangla</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="booking_tour_form_submit pt-4">
                            <div class="form-check write_spical_check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf1">
                                <label class="form-check-label" for="flexCheckDefaultf1">
                                    I have read and accept the <router-link to="/terms-service">Terms and
                                        conditions</router-link> and <router-link to="/privacy-policy">Privacy policy</router-link>
                                </label>
                            </div>
                            <router-link to="/booking-confirmation" class="btn btn_theme btn_md">Sign up</router-link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="vendor_img">
                        <img src="../../assets/img/common/vendor.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

export default {
    name: "VendorForm",
    data() {
        return {
            title:'Become a vendor',
            subTitle: `Eu sint minim tempor anim aliqua officia voluptate incididunt deserunt.
                             Velitgo quis Lorem culpa qui pariatur occaecat.`
        }
    },
};
</script>