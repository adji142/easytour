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
                                        <li>Adult : {{ formatNumber(oDataProdukPackage.TourPackagePrice) }} x {{ adult }} <span>{{ formatNumber(oDataProdukPackage.TourPackagePrice * adult) }}</span></li>
                                        <li>Child : {{ formatNumber(oDataProdukPackage.TourPackageChildPrice) }} x {{ children }} <span>{{ formatNumber(oDataProdukPackage.TourPackageChildPrice * children) }}</span></li>
                                    </ul>
                                    <div class="tour_bokking_subtotal_area">
                                        <h6>Subtotal <span>{{ formatNumber(subtotal) }}</span></h6>   
                                    </div>
                                    <ul>
                                        <li>
                                            Discount ({{ discountPercent }}%)
                                            <span>
                                                -{{ discountPercent > 0 ? formatNumber(
                                                    (oDataProdukPackage.TourPackagePrice - oDataProdukPackage.TourPackageDiscountPrice) * adult
                                                ) : 0 }}
                                            </span>
                                        </li>
                                        <li>Guild Fee <span>{{ formatNumber(oDataProdukPackage.TourPackageGuildFee) }}</span></li>
                                    </ul>
                                    <div class="total_subtotal_booking">
                                        <h6>Total Amount <span>{{ formatNumber(totalAmount) }}</span></h6>
                                    </div>
                                    <div class="coupon_code_submit">
                                        <!-- <button class="btn btn_theme btn_md" @click="payWithXendit" :disabled="isProcessing">
                                            <span v-if="isProcessing">
                                                <i class="fas fa-spinner fa-spin"></i> Processing...
                                            </span>
                                            <span v-else>
                                                Process Booking
                                            </span>
                                        </button> -->
                                        <button class="btn btn_theme btn_md" @click="payWithQris" :disabled="isProcessing">
                                            <span v-if="isProcessing"><i class="fas fa-spinner fa-spin"></i> Processing...</span>
                                            <span v-else>Process Booking</span>
                                        </button>
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
                                        <input type="date" id="dates" class="form-control" :min="oDataProdukPackage.TourStartDate" :max="oDataProdukPackage.TourEndDate" :value="bookingData.BookingDate" readonly>
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

            <div v-if="showPaymentModal" class="payment-modal-overlay">
                <div class="payment-modal">
                    <h4>Complete Your Payment</h4>
                    <iframe :src="invoiceUrl" frameborder="0" class="payment-frame"></iframe>
                    <p>Do not close this window until your payment is completed or canceled.</p>
                    <button class="btn btn_theme btn_md" @click="checkPaymentStatus">Check Payment Status</button>
                </div>
            </div>

            <!-- Modal QRIS -->
            <div v-if="showQRISModal" class="payment-modal-overlay">
                <div class="payment-modal">
                    <h4>QRIS Payment</h4>
                    <img :src="qrisImage" alt="QRIS Code" class="w-full mb-4" />
                    <div class="bg-gray-100 p-3 rounded mb-2 text-sm text-left">
                    <p><strong>How to Pay:</strong></p>
                    <ol class="list-decimal list-inside pl-4">
                        <li>Open your favorite e-wallet app.</li>
                        <li>Scan the QR code above.</li>
                        <li>Enter the exact total and complete your payment.</li>
                        <li>After payment, click "Confirm Payment" below.</li>
                    </ol>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                    <button class="btn btn-secondary" @click="handleCloseQRISModal">Close</button>
                    <button class="btn btn-success" @click="showUploadModal = true">Confirm Payment</button>
                    </div>
                </div>
            </div>


                <!-- Modal Upload -->
            <div v-if="showUploadModal" class="payment-modal-overlay">
                <div class="payment-modal">
                    <h4>Upload Payment Proof</h4>
                    <input type="file" @change="handleFileChange" accept="image/*" class="form-control mb-3" />
                    <textarea v-model="paymentNote" placeholder="Write any notes..." class="form-control" rows="3"></textarea>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                    <button class="btn btn-secondary" @click="showUploadModal = false">Cancel</button>
                    <button class="btn btn-primary" @click="submitQrisPayment" :disabled="isSubmittingProof">
                        <span v-if="isSubmittingProof">
                            <i class="fa fa-spinner fa-spin"></i> Submitting...
                        </span>
                        <span v-else>
                            Submit Payment Proof
                        </span>
                    </button>
                    </div>
                </div>
            </div>



        </section>
    </template>
    <script>

    import { convertDate } from '../helper';
    import { formatToK } from '../helper';
    import { formatNumber } from '../helper';
    import Swal from 'sweetalert2';
    import axios from 'axios'
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    let token = document.head.querySelector('meta[name="csrf-token"]');
    if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                acceptedTerms: false,
                isProcessing: false,
                showPaymentModal: false,
                invoiceUrl: '',
                invoiceId: '',
                checkInterval: null,
                showQRISModal: false,
                showUploadModal: false,
                qrisProofImage: null,
                qrisNote: '',
                qrisImage: `${window.location.origin}/images/qris-static.jpeg`, // pastikan gambarnya ada di /public/images/qris.png
                bookingId: null,
                isSubmittingProof: false,
            }
        },
        mounted() {
            console.log(this.bookingData);
            this.adult = this.bookingData.AdultBookingPerson || 0;
            this.children = this.bookingData.ChildBookingPerson || 0;
            this.infant = this.bookingData.InfantBookingPerson || 0;
            this.note = this.bookingData.SpecialRequest || '';
        },
        beforeUnmount() {
            clearInterval(this.checkInterval);
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
                const price = this.oDataProdukPackage.TourPackagePrice;
                const adultPrice = this.adult * this.oDataProdukPackage.TourPackagePrice;
                const childPrice = this.children * this.oDataProdukPackage.TourPackageChildPrice;

                return (adultPrice + childPrice) ;
                // + (price * this.children * 0.75) + (price * this.infant * 0.5); // Misal anak 75% dan infant 50% dari harga
            },
            // Hitung diskon dalam rupiah
            discountAmount() {
                return this.oDataProdukPackage.TourPackageDiscountPrice > 0 ?(this.oDataProdukPackage.TourPackagePrice - this.oDataProdukPackage.TourPackageDiscountPrice) * this.adult : 0;
            },
            // Hitung pajak
            taxAmount() {
                return (this.subtotal * this.taxPercent) / 100;
            },
            // Hitung total amount
            totalAmount() {
                console.log(this.subtotal);
                console.log(this.discountAmount);
                const guildFee = this.oDataProdukPackage.TourPackageGuildFee; 
                return this.subtotal  - this.discountAmount + guildFee;
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
            async payWithXendit() {
                this.isProcessing = true;
                try {
                    const formData = {
                        "BookingDate": this.bookingData.BookingDate,
                        "UserID": this.user.id,
                        "BookingType" : this.bookingData.BookingType,
                        "ProductID" : this.bookingData.ProductID,
                        "PackageID" : this.bookingData.PackageID,
                        "PartnerCode" : this.bookingData.PartnerCode,
                        "BookingFullName": this.user.name,
                        "BookingEmail" : this.user.email,
                        "BookingPhone" : "",
                        "BookingIdentityID" : "",
                        "AdultBookingPerson" : this.bookingData.AdultBookingPerson,
                        "ChildBookingPerson" : this.bookingData.ChildBookingPerson,
                        "InfantBookingPerson" : this.bookingData.InfantBookingPerson,
                        "TransactionAmt" : this.subtotal,
                        "TransactionTax" : 0,
                        "TransactionDiscount" : this.discountAmount,
                        "DiscountVoucerCode" : "",
                        "DiscountVoucerAmt" : 0,
                        "TotalNetTransaction" : this.totalAmount,
                        "TotalPayment" : this.totalAmount,
                        "PaymentMethod" : "Xendit",
                        "PaymentReff" : "",
                        "PaymentIssued" : "",
                        "SpecialRequest" : this.note,
                        "BookingStatus" : 0
                    }
                    const response = await axios.post('/booking/payxendit', {
                        formData
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    console.log(response.data);

                    // Handle the response from Xendit
                    if (response.data.success) {
                        const data = response.data;
                        this.invoiceUrl = data.payment_url;
                        this.invoiceId = data.invoice_id; // Assuming the invoice ID is returned
                        this.showPaymentModal = true;

                        this.checkInterval = setInterval(this.checkPaymentStatus, 5000);
                        
                    } else {
                        Swal.fire('Error', 'Failed to create payment. Please try again.', 'error');
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error', 'An error occurred while processing your payment.', 'error');
                } finally {
                    this.isProcessing = false;
                }
            },
            async checkPaymentStatus() {
                if (!this.invoiceId) return;
                try {
                    const res = await axios.get(`/booking/status/${this.invoiceId}`);
                    if (res.data.status === 'SETTLED' || res.data.status === 'PAID') {
                        clearInterval(this.checkInterval);
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil',
                            text: 'Anda akan diarahkan ke dashboard...',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            window.location.href = '/userdashboard';
                        }, 2000);
                    }
                } catch (e) {
                    console.error('Gagal cek status pembayaran', e);
                }
            },
            async payWithMidtrans() {
                this.isProcessing = true;
                try {
                    const response = await fetch('/booking/pay', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                            amount: this.totalAmount,
                            name: this.user.name,
                            email: this.user.email,
                        }),
                    });

                    const data = await response.json();
                    const snapToken = data.snap_token;
                    console.log(data);

                    window.snap.pay(snapToken, {
                        onSuccess: (result) => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Successfull',
                                text: 'Saving Your Booking',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            // get VA Number :
                            console.log(result);
                            var PaymentMethodgateWay = result.payment_type;
                            if (result.va_numbers) {
                                PaymentMethodgateWay += "_"+result.va_numbers[0]["bank"]+"_"+result.va_numbers[0]["va_number"]
                            }
                            const formData = {
                                "BookingDate": this.bookingData.BookingDate,
                                "UserID": this.user.id,
                                "BookingType" : this.bookingData.BookingType,
                                "ProductID" : this.bookingData.ProductID,
                                "PackageID" : this.bookingData.PackageID,
                                "PartnerCode" : this.bookingData.PartnerCode,
                                "BookingFullName": this.user.name,
                                "BookingEmail" : this.user.email,
                                "BookingPhone" : "",
                                "BookingIdentityID" : "",
                                "AdultBookingPerson" : this.bookingData.AdultBookingPerson,
                                "ChildBookingPerson" : this.bookingData.ChildBookingPerson,
                                "InfantBookingPerson" : this.bookingData.InfantBookingPerson,
                                "TransactionAmt" : this.subtotal,
                                "TransactionTax" : 0,
                                "TransactionDiscount" : this.discountAmount,
                                "DiscountVoucerCode" : "",
                                "DiscountVoucerAmt" : 0,
                                "TotalNetTransaction" : this.totalAmount,
                                "TotalPayment" : result.gross_amount,
                                "PaymentMethod" : PaymentMethodgateWay,
                                "PaymentReff" : result.order_id,
                                "PaymentIssued" : result.transaction_time,
                                "SpecialRequest" : this.note,
                                "BookingStatus" : 1
                            }

                            axios.post('/booking/savepayment', {
                                formData
                            }).then(res=>{
                                // console.log(res);
                                if(res.data.success){
                                    Swal.fire('Success', 'Payment Saved Successfuly', 'success').then(() => {
                                        window.location.href = '/userdashboard';
                                    });
                                
                                }
                            }).catch(err => {
                                console.log(res);
                            });



                            // console.log(formData);
                        },
                        onPending: (result) => {
                            alert("Menunggu pembayaran!");
                            console.log(result);
                        },
                        onError: (result) => {
                            alert("Pembayaran gagal!");
                            console.log(result);
                        },
                        onClose: () => {
                            alert('Kamu menutup popup tanpa menyelesaikan pembayaran');
                        }
                    });
                } catch (err) {
                    console.error(err);
                } finally {
                    this.isProcessing = false;
                }
            },
            async payWithQris() {
                this.isProcessing = true;
                try {
                    const formData = {
                        "BookingDate": this.bookingData.BookingDate,
                        "UserID": this.user.id,
                        "BookingType" : this.bookingData.BookingType,
                        "ProductID" : this.bookingData.ProductID,
                        "PackageID" : this.bookingData.PackageID,
                        "PartnerCode" : this.bookingData.PartnerCode,
                        "BookingFullName": this.user.name,
                        "BookingEmail" : this.user.email,
                        "BookingPhone" : "",
                        "BookingIdentityID" : "",
                        "AdultBookingPerson" : this.bookingData.AdultBookingPerson,
                        "ChildBookingPerson" : this.bookingData.ChildBookingPerson,
                        "InfantBookingPerson" : this.bookingData.InfantBookingPerson,
                        "TransactionAmt" : this.subtotal,
                        "TransactionTax" : 0,
                        "TransactionDiscount" : this.discountAmount,
                        "DiscountVoucerCode" : "",
                        "DiscountVoucerAmt" : 0,
                        "TotalNetTransaction" : this.totalAmount,
                        "TotalPayment" : this.totalAmount,
                        "PaymentMethod" : "QRIS",
                        "PaymentReff" : "",
                        "PaymentIssued" : "",
                        "SpecialRequest" : this.note,
                        "BookingStatus" : 0,
                        "TourPackagePrice" : this.oDataProdukPackage.TourPackagePrice,
                        "TourPackageChildPrice" : this.oDataProdukPackage.TourPackageChildPrice,
                        "TourPackageGuildFee" : this.oDataProdukPackage.TourPackageGuildFee
                    }
                    const response = await axios.post('/booking/payqris', {
                        formData
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    console.log(response.data.success);

                    // Handle the response from Xendit
                    if (response && response.data && response.data.success) {
                        this.bookingId = response.data.DocNum;
                        this.$nextTick(() => {
                            this.showQRISModal = true;
                        });
                    } else {
                        Swal.fire('Error', 'Failed to create payment. Please try again.', 'error');
                    }
                } catch (error) {
                    console.error(error);
                    Swal.fire('Error', 'An error occurred while processing your payment.', 'error');
                } finally {
                    this.isProcessing = false;
                }
            },
            handleCloseQRISModal() {
                this.showQRISModal = false;
                Swal.fire({
                    icon: 'info',
                    title: 'QRIS Payment',
                    text: 'Please complete your payment by opening your Profile.',
                });
                window.location.href = '/userdashboard';
            },
            handleConfirmQRIS() {
                this.showQRISModal = false;
                this.showUploadModal = true;
            },
            handleFileUpload(e) {
                const file = e.target.files[0];
                if (file) {
                this.qrisProofImage = file;
                }
            },
            async submitQrisPayment() {
                if (!this.qrisProofImage) {
                    Swal.fire('Missing File', 'Please upload your payment screenshot first.', 'warning');
                    return;
                }

                // this.isProcessing = true;
                this.isSubmittingProof = true;
                const formData = new FormData();
                formData.append('BookingID', this.bookingData.id); // gunakan id booking atau data lain
                formData.append('UserID', this.user.id);
                formData.append('note', this.qrisNote);
                formData.append('proof', this.qrisProofImage);

                try {
                    const res = await axios.post('/booking/payproof', {
                        booking_id: this.bookingId,
                        payment_proof: this.qrisProofImage,
                        payment_remark: this.qrisNote
                    }, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });

                    if (res.data.success) {
                        Swal.fire('Success', 'Your payment proof has been submitted.', 'success');
                        window.location.href = '/userdashboard';
                    } else {
                        Swal.fire('Error', 'Failed to submit. Try again later.', 'error');
                    }
                } catch (err) {
                    console.error(err);
                    Swal.fire('Error', 'Something went wrong.', 'error');
                } finally {
                    this.isSubmittingProof = false;
                }
            },
            handleFileChange(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.qrisProofImage = e.target.result; // Base64 string
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Please upload a valid image file');
                }
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
            },
            isLoggedIn: Boolean,
            user: Array
        }
    };
    </script>
    <style scoped>
    .payment-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: auto;
        padding: 1rem;
    }

        .payment-modal {
        background: white;
        padding: 1.5rem;
        border-radius: 8px;
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 0 10px #000;
        text-align: center;
        }

        .payment-frame {
        width: 100%;
        height: 500px;
        border: 1px solid #ccc;
        }
        </style>