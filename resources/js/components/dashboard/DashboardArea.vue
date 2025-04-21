<template>
    <section id="dashboard_main_area" class="section_padding">
        <div class="container">
            <div class="row">
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
                                <li><a href="/logout" ><i class="fas fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div v-if="active" class="modal-backdrop fade show"></div>

                <div class="col-lg-8">
                    <div class="dashboard_common_table">
                        <h3>My bookings</h3>

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

                        <div class="table-responsive-lg table_common_area">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sl no.</th>
                                        <th>Booking ID</th>
                                        <th>Booking type</th>
                                        <th>Booking amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in bookingList.data" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>#{{ item.DocumentNumber }}</td>
                                        <td>{{ item.BookingType }}</td>
                                        <td>{{ formatPrice(item.TotalNetTransaction) }}</td>
                                        <td><a :href="`/downloadvoucher/${item.DocumentNumber}`" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Spinner saat loading -->
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
    </section>
</template>

<script>
import { formatNumber } from '../../helper';

export default {
    name: "DashboardArea",
    data() {
        return {
            startDateModel: this.startDate,
            endDateModel: this.endDate,
            isLoading: false
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
        }
    }
};
</script>
