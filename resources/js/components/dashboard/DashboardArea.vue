<template>
    <section id="dashboard_main_area" class="section_padding">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="dashboard_sidebar">
                        <div class="dashboard_sidebar_user">
                            <img :src="user.image" alt="img">
                            <h3>{{ user.name }}</h3>
                            <p>{{ user.email }}</p>
                        </div>
                        <div class="dashboard_menu_area">
                            <ul>
                                <li><a href="/userdashboard" class="active"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                                <li><a href="/editprofile"><i class="fas fa-user-circle"></i>My profile</a></li>
                                <li><a href="/logout"><i class="fas fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Modal backdrop (optional) -->
                <div v-if="active" class="modal-backdrop fade show"></div>

                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="dashboard_common_table">
                        <h3>My bookings</h3>

                        <!-- Filter -->
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="startDate">Start Date</label>
                                <input type="date" v-model="startDateModel" class="form-control" />
                            </div>
                            <div class="col-md-5">
                                <label for="endDate">End Date</label>
                                <input type="date" v-model="endDateModel" class="form-control" />
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button class="btn btn-primary w-100" :disabled="isLoading" @click="applyFilter">
                                    <span v-if="isLoading">
                                        <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                        Loading...
                                    </span>
                                    <span v-else>Filter</span>
                                </button>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive-lg table_common_area">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sl no.</th>
                                        <th>Booking ID</th>
                                        <th>Booking type</th>
                                        <th>Booking amount</th>
                                        <th>Paid amount</th>
                                        <th>Booking Status</th>
                                        <th>Rejected</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in bookingList.data" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>#{{ item.DocumentNumber }}</td>
                                        <td>{{ item.BookingType }}</td>
                                        <td>{{ formatPrice(item.TotalNetTransaction) }}</td>
                                        <td>{{ formatPrice(item.TotalPayment) }}</td>
                                        <td :class="item.BookingStatusColor">
                                            {{ item.BookingStatusName }}
                                        </td>
                                        <td>{{ item.RejectFactor }}</td>
                                        <td>
                                            <a v-if="item.BookingStatus === 2" 
                                            :href="`/downloadvoucher/${item.DocumentNumber}`" 
                                            target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>

                                            <!-- Upload Payment Proof -->
                                            <button v-if="item.BookingStatus === 0 || item.BookingStatus === 3"
                                                class="btn btn-sm btn-outline-primary"
                                                @click="openUploadModal(item)">
                                                <i class="fas fa-upload"></i>
                                            </button>

                                            <!-- Cancel Booking -->
                                            <button v-if="item.BookingStatus !== 2"
                                                class="btn btn-sm btn-outline-danger"
                                                @click="cancelBooking(item)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Spinner -->
                        <div class="text-center my-3" v-if="isLoading">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="pagination_area">
                            <ul class="pagination">
                                <li class="page-item" :class="{ disabled: !bookingList.links.prev }">
                                    <a class="page-link" href="#" @click.prevent="goToPage(bookingList.current_page - 1)">
                                        «
                                    </a>
                                </li>
                                <li class="page-item" 
                                    v-for="page in bookingList.last_page" 
                                    :key="page" 
                                    :class="{ active: page === bookingList.current_page }">
                                    <a class="page-link" href="#" @click.prevent="goToPage(page)">
                                        {{ page }}
                                    </a>
                                </li>
                                <li class="page-item" :class="{ disabled: !bookingList.links.next }">
                                    <a class="page-link" href="#" @click.prevent="goToPage(bookingList.current_page + 1)">
                                        »
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
import { formatNumber } from '../../helper';
import Swal from 'sweetalert2';
import axios from 'axios'
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
export default {
    name: "DashboardArea",
    data() {
        return {
            startDateModel: this.startDate,
            endDateModel: this.endDate,
            isLoading: false,
            bookingId: null,
            isSubmittingProof: false,
            showUploadModal: false,
            qrisProofImage: null,
            qrisNote: '',
        };
    },
    props: {
        easyTourSetting: Array,
        bookingList: Object,
        startDate: String,
        endDate: String,
        isLoggedIn: Boolean,
        user: Object
    },
    methods: {
        applyFilter() {
            this.isLoading = true;
            this.$inertia.get('/userdashboard', {
                startDate: this.startDateModel,
                endDate: this.endDateModel
            }, {
                preserveState: true,
                replace: true,
                onFinish: () => {
                    this.isLoading = false;
                }
            });
        },
        goToPage(page) {
            this.isLoading = true;
            this.$inertia.get('/userdashboard', {
                startDate: this.startDateModel,
                endDate: this.endDateModel,
                page: page
            }, {
                preserveState: true,
                replace: true,
                onFinish: () => {
                    this.isLoading = false;
                }
            });
        },
        formatPrice(price) {
            return formatNumber(price);
        },
        getStatusClass(BookingStatusColor) {
            switch (BookingStatusColor.toLowerCase()) {
                case 'expired':
                    return 'text-danger';
                case 'pending':
                    return 'text-warning';
                case 'success':
                    return 'text-success';
                default:
                    return '';
            }
        },
        openUploadModal(item) {
            console.log(item);
            this.bookingId = item.DocumentNumber;
            this.showUploadModal = true; // tampilkan modal upload (nanti kita buat modalnya)
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

            try {
                const res = await axios.post('/booking/payproof', {
                    booking_id: this.bookingId,
                    payment_proof: this.qrisProofImage,
                    payment_remark: this.qrisNote
                }, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });

                if (res.data.success) {
                    this.showUploadModal = false;
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