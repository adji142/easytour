<template>
    <section id="tour_booking_submission" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour_details_right_sidebar_wrapper">
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>{{ oDataProdukPackage.TourPackageName }}</h3>
                                </div>
                                <div class="valid_date_area">
                                    <div class="valid_date_area_one">
                                        <h5>Valid from</h5>
                                        <p>{{ formatDate(oDataProdukPackage.TourStartDate) }}</p>
                                    </div>
                                    <div class="valid_date_area_one">
                                        <h5>Valid till</h5>
                                        <p>{{ formatDate(oDataProdukPackage.TourEndDate) }}</p>
                                    </div>
                                </div>
                                <div class="tour_package_details_bar_list">
                                    <h5>Package details</h5>
                                    <p v-html="oDataProdukPackage.TourPackageDescription"></p>
                                </div>
                                <div class="tour_package_details_bar_price">
                                    <h5>Price</h5>
                                    <div class="tour_package_bar_price">
                                        <h6 v-if="oDataProdukPackage.TourPackageDiscountPrice > 0">
                                            <del> {{ formatNumber(oDataProdukPackage.TourPackagePrice) }}</del>
                                        </h6>
                                        <h3>
                                             {{ formatNumber(oDataProdukPackage.TourPackageDiscountPrice > 0 ? oDataProdukPackage.TourPackageDiscountPrice : oDataProdukPackage.TourPackagePrice) }}
                                            <sub>/Per person</sub>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tour_detail_right_sidebar">
                        <div class="tour_details_right_boxed">
                            <div class="tour_details_right_box_heading">
                                <h3>Booking amount</h3>
                            </div>

                            <div class="tour_booking_amount_area">
                                <ul>
                                    <li>Adult Price x {{ adult }} <span>{{ formatNumber((oDataProdukPackage.TourPackageDiscountPrice > 0 ? oDataProdukPackage.TourPackageDiscountPrice : oDataProdukPackage.TourPackagePrice) * adult) }}</span></li>
                                    <li>
                                        Discount ({{ discountPercent }}%)
                                        <span>
                                            -{{ discountPercent > 0 ? formatNumber(
                                                (oDataProdukPackage.TourPackagePrice - oDataProdukPackage.TourPackageDiscountPrice) * adult
                                            ) : 0 }}
                                        </span>
                                    </li>
                                </ul>
                                <div class="tour_bokking_subtotal_area">
                                    <h6>Subtotal <span>{{ formatNumber(subtotal) }}</span></h6>   
                                </div>
                                <div class="total_subtotal_booking">
                                    <h6>Total Amount <span>{{ formatNumber(totalAmount) }}</span></h6>
                                </div>
                                <div class="coupon_code_submit">
                                    <button class="btn btn_theme btn_md">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tour_detail_right_sidebar">
                        <div class="tour_details_right_boxed">
                            <div class="tour_details_right_box_heading">
                                <h3>Travel date</h3>
                            </div>
                            <div class="edit_date_form">
                                <div class="form-group">
                                    <label for="dates">Edit Date</label>
                                    <input type="date" id="dates" class="form-control" :min="oDataProdukPackage.TourStartDate" :max="oDataProdukPackage.TourEndDate" :value="bookingData.BookingDate">
                                </div>
                            </div>
                            <div class="tour_package_details_bar_list">
                                <h5>Tourist</h5>
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
                                    <label for="textse">Write any special note</label>
                                    <textarea rows="5" id="textse" v-model="note" class="form-control" placeholder="Write any special note"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Kupon disini -->
                    </div>
                </div>
                <!-- <div class="col-lg-4">
                    <div class="tour_detail_right_sidebar">
                        <div class="tour_details_right_boxed">
                            <div class="tour_details_right_box_heading">
                                <h3>Coupon code</h3>
                            </div>
                            <div class="coupon_code_area_booking">
                                <form action="#!">
                                    <div class="form-group">
                                        <input type="text" class="form-control bg_input"
                                            placeholder="Enter coupon code">
                                    </div>
                                    <div class="coupon_code_submit">
                                        <button class="btn btn_theme btn_md">Apply voucher</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div> -->
                <div class="col-lg-8">
                    
                </div>
                
            </div>
        </div>
    </section>
</template>
<script>

import { convertDate } from '../helper';
import { formatToK } from '../helper';
import { formatNumber } from '../helper';

export default {
    name: "TourBookingSubmission",
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
    mounted() {
        console.log(this.bookingData);
        this.adult = this.bookingData.AdultBookingPerson || 0;
        this.children = this.bookingData.ChildBookingPerson || 0;
        this.infant = this.bookingData.InfantBookingPerson || 0;
        this.note = this.bookingData.SpecialRequest || '';
    },
    computed: {
        discountPercent() {
            const originalPrice = this.oDataProdukPackage.TourPackagePrice;
            const discountPrice = this.oDataProdukPackage.TourPackageDiscountPrice;

            // Pastikan harga diskon dan harga asli ada, dan harga diskon lebih kecil dari harga asli
            if (discountPrice && originalPrice && discountPrice < originalPrice) {
                const discountAmount = originalPrice - discountPrice;
                const discountPercentage = (discountAmount / originalPrice) * 100;
                return Math.round(discountPercentage);  // Bulatkan ke angka terdekat
            }
            
            return 0;  // Tidak ada diskon jika tidak memenuhi syarat
        },
        // Hitung subtotal
        subtotal() {
            const price = this.oDataProdukPackage.TourPackageDiscountPrice > 0 
                ? this.oDataProdukPackage.TourPackageDiscountPrice 
                : this.oDataProdukPackage.TourPackagePrice;
            
            return (price * this.adult) + (price * this.children * 0.75) + (price * this.infant * 0.5); // Misal anak 75% dan infant 50% dari harga
        },
        // Hitung diskon dalam rupiah
        discountAmount() {
            return (this.oDataProdukPackage.TourPackagePrice - this.oDataProdukPackage.TourPackageDiscountPrice) * this.adult;
        },
        // Hitung pajak
        taxAmount() {
            return (this.subtotal * this.taxPercent) / 100;
        },
        // Hitung total amount
        totalAmount() {
            return this.subtotal  - this.discountAmount;
        }
    },
    methods:{
        formatDate(Date) {
            return convertDate(Date);
        },
        formatPrice(price) {
            return formatToK(price);
        },
        formatNumber(price){
            return formatNumber(price);
        },
        increase(type) {
            this[type]++;
        },
        decrease(type) {
            if (this[type] > 0) this[type]--;
        },
    },
    props:{
        easyTourSetting: Array,
        oDataProduk: Array,
        oDataProdukImage: Array,
        oDataProdukPackage: Array,
        oDataUser: Array,
        bookingData: {
            type: Object,
            default: () => ({})
        }
    }
};
</script>