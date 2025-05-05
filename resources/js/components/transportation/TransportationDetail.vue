<template>
    <section id="tour_details_main" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour_details_leftside_wrapper">
                        <div class="tour_details_heading_wrapper">
                            <div class="tour_details_top_heading">
                                <h2>{{ transportationDetail.TransportationName }}</h2>
                                <h5>{{ transportationDetail.TransportationType }}</h5>
                            </div>
                            <!-- <div class="tour_details_top_heading_right">
                                <h4>Excellent</h4>
                                <h6>4.8/5</h6>
                                <p>(1214 reviewes)</p>
                            </div> -->
                        </div>
                        <div class="tour_details_img_wrapper">
                            <div class="image__gallery">
                                <div class="gallery">
                                    <div class="gallery__slideshow">
                                        <div class="gallery__slides">
                                            <div
                                                class="gallery__slide"
                                                v-for="(slide, index) in transportationImage"
                                                :key="index"
                                                v-show="slideIndex === index"
                                            >
                                                <img
                                                    class="gallery__img slick-slide"
                                                    :src="slide.TransportationImage"
                                                    alt="Gallery Slide"
                                                />
                                            </div>
                                        </div>
                                        <a @click.prevent="move(-1)" class="gallery__next">&#10094;</a>
                                        <a @click.prevent="move(1)" class="gallery__prev">&#10095;</a>
                                    </div>

                                    <div class="gallery__content">
                                        <div class="gallery__items">
                                            <div
                                                class="gallery__item"
                                                v-for="(slide, index) in transportationImage"
                                                :key="`item-${index}`"
                                                :class="{ 'gallery__item--is-active': slideIndex === index }"
                                            >
                                                <img
                                                    :src="slide.TransportationImage"
                                                    class="gallery__item-img"
                                                    @click="currentSlide(index)"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tour_details_boxed">
                            <h3 class="heading_theme">Overview</h3>
                            <div class="tour_details_boxed_inner">
                                <p v-html="transportationDetail.TransportationDescription"></p>
                            </div>
                        </div>
                        <div class="tour_details_boxed">
                            <h3 class="heading_theme">Term and Codition</h3>
                            <div class="tour_details_boxed_inner">
                                <p v-html="transportationDetail.TransportationTnC"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tour_details_right_sidebar_wrapper" style="position: relative; z-index: 1;">
                        <div class="tour_detail_right_sidebar" v-for="(item, index) in transportationpackage"  :key="index">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>{{ item.PackageName }}</h3>
                                </div>
                                <div class="tour_package_details_bar_price">
                                    <h5>Price</h5>
                                    <div class="tour_package_bar_price">
                                        <h6 v-if="item.PackagePriceDiscount > 0">
                                            <del> {{ formatPrice(item.PackagePrice) }}</del>
                                        </h6>
                                        <h3>
                                             {{ formatPrice(item.PackagePriceDiscount > 0 ? item.PackagePriceDiscount : item.PackagePrice) }}
                                            <sub> for {{ transportationDetail.TransportationCapacity }}</sub>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="tour_select_offer_bar_bottom">
                                <button class="btn btn_theme btn_md w-100" data-bs-toggle="offcanvas"
                                    :data-bs-target="`#offcanvasRight-${index}`" :aria-controls="offcanvasRight">Select
                                    offer</button>
                            </div>

                            <div class="offcanvas offcanvas-end" tabindex="-1" :id="`offcanvasRight-${index}`" :aria-labelledby="`offcanvasRightLabel-${index}`">
                                <div class="offcanvas-header">
                                    <h5 :id="`offcanvasRightLabel-${index}`">Book now</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>

                                <div class="offcanvas-body">
                                    <div class="side_canvas_wrapper">
                                        <div class="travel_date_side">
                                            <div class="form-group">
                                                <label for="dates">Select your travel date</label>
                                                <input type="date" id="dates" v-model="travelDate" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="select_person_side">
                                            <h3>Select person</h3>

                                            <!-- Adult -->
                                            <div class="select_person_item">
                                                <div class="select_person_left">
                                                <h6>Adult</h6>
                                                <p>12y+</p>
                                                </div>
                                                <div class="select_person_right">
                                                <div class="button-set">
                                                    <button type="button" @click="increase('adult')">
                                                    <i class="fas fa-plus"></i>
                                                    </button>
                                                    <span>{{ adult }}</span>
                                                    <button type="button" @click="decrease('adult')">
                                                    <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                </div>
                                            </div>

                                            <!-- Children -->
                                            <div class="select_person_item">
                                                <div class="select_person_left">
                                                <h6>Children</h6>
                                                <p>2 - 12 years</p>
                                                </div>
                                                <div class="select_person_right">
                                                <div class="button-set">
                                                    <button type="button" @click="increase('children')">
                                                    <i class="fas fa-plus"></i>
                                                    </button>
                                                    <span>{{ children }}</span>
                                                    <button type="button" @click="decrease('children')">
                                                    <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                </div>
                                            </div>

                                            <!-- Infant -->
                                            <div class="select_person_item">
                                                <div class="select_person_left">
                                                <h6>Infant</h6>
                                                <p>Below 2 years</p>
                                                </div>
                                                <div class="select_person_right">
                                                <div class="button-set">
                                                    <button type="button" @click="increase('infant')">
                                                    <i class="fas fa-plus"></i>
                                                    </button>
                                                    <span>{{ infant }}</span>
                                                    <button type="button" @click="decrease('infant')">
                                                    <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                </div>
                                            </div>

                                            <!-- Special Note -->
                                            <div class="write_spical_not">
                                                <label for="textse">Write any special note {{ item.PackageName }}</label>
                                                <textarea rows="5" id="textse" v-model="note" class="form-control" placeholder="Write any special note"></textarea>
                                            </div>

                                            <div class="form-check write_spical_check">
                                                <input class="form-check-input" type="checkbox" id="flexCheckDefaultf1" v-model="acceptedTerms" />
                                                <label class="form-check-label" for="flexCheckDefaultf1">
                                                <span class="main_spical_check">
                                                    <span>I read and accept all <router-link to="#">Terms and conditions</router-link></span>
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="proceed_booking_btn">
                                    <a href="#!" class="btn btn_theme btn_md w-100" @click.prevent="submitBooking(item.TransportationID, item.id, item.RecordOwnerID)">Proceed to Booking {{ item.id }}</a>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { convertDate } from '../../helper';
import { formatToK } from '../../helper';
import Swal from 'sweetalert2';
import axios from 'axios'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

export default {
    name: "TourSearchTwo",

    data() {
        return {
            slideIndex: 0,
            travelDate: '',
            adult: 1,
            children: 0,
            infant: 0,
            note: '',
            acceptedTerms: false
        }
    },

    methods: {

        move(n) {
            if (this.transportationImage.length <= this.slideIndex + n) {
                this.slideIndex = 0
            } else if (this.slideIndex + n < 0) {
                this.slideIndex = this.transportationImage.length - 1
            } else {
                this.slideIndex += n
            }
        },
        currentSlide(index) {
            this.slideIndex = index
        },
        formatDate(Date) {
            return convertDate(Date);
        },
        formatPrice(price) {
            return formatToK(price);
        },
        increase(type) {
            this[type]++;
        },
        decrease(type) {
            if (this[type] > 0) this[type]--;
        },
        submitBooking(_productid,_packageid, _partnerCode) {
            if (this.travelDate == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please define the tour Date.',
                    customClass: {
                        popup: 'sweetalert-popup' // Menambahkan kelas khusus untuk pengaturan z-index
                    },
                    backdrop: true,
                    zIndex: 9999
                });
                return;
            }
            if (this.adult ==0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please add guest count adult, child or infant.',
                    customClass: {
                        popup: 'sweetalert-popup' // Menambahkan kelas khusus untuk pengaturan z-index
                    },
                    backdrop: true,
                    zIndex: 9999
                });
                return;
            }
            if (!this.acceptedTerms) {
                // alert("Please accept the terms and conditions.");
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please accept the terms and conditions.',
                    customClass: {
                        popup: 'sweetalert-popup' // Menambahkan kelas khusus untuk pengaturan z-index
                    },
                    backdrop: true,
                    zIndex: 9999
                });
                return;
            }
            // Handle booking submission logic
            console.log({
                travelDate: this.travelDate,
                adult: this.adult,
                children: this.children,
                infant: this.infant,
                note: this.note
            });

            console.log(this.transportationpackage);

            const formData = {
                BookingType: 'Transport',
                ProductID: _productid,
                PackageID:_packageid,
                AdultBookingPerson: this.adult,
                ChildBookingPerson: this.children,
                InfantBookingPerson: this.infant,
                UserID : -1,
                BookingDate: this.travelDate,
                SpecialRequest: this.note,
                PartnerCode : _partnerCode
            };

            const encoded = btoa(JSON.stringify(formData));
            window.location.href = `/booking/${encodeURIComponent(encoded)}`;
            // console.log(_productid + " " + _packageid);
            // alert("Booking submitted!");
            // axios.post('/booking', formData)
            //     .then(response => {
            //         // alert('Booking submitted successfully!');
            //         console.log(response.data);
            //     })
            //     .catch(error => {
            //         // alert('Failed to submit booking.');
            //     console.error(error);
            // });
        }

    },
    props:{
        easyTourSetting: Array,
        transportationDetail: Array,
        transportationImage: Array,
        transportationpackage: Array,
        isLoggedIn: Boolean,
        user: Object
    }

};
</script>