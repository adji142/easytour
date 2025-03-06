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
                            <form id="tour_bookking_form_item" @submit.prevent="submitForm">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="First name*" required v-model="formData.FirstName">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="Last name*" v-model="formData.LastName">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="Email address*" required v-model="formData.Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="Mobile number*" required v-model="formData.Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control bg_input" placeholder="Password*" required v-model="formData.Password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control bg_input" placeholder="Retype your Password*" required v-model="formData.RePassword">
                                            <p v-if="passwordMismatch" style="color: red; font-size: 14px;">
                                                Password and retype password must be the same.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="Street address" required v-model="formData.BillingAddress">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control bg_input" placeholder="Apartment, Suite, House no (optional)" v-model="formData.ShippingAddress">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control form-select bg_input" v-model="BillingState" @change="fetchProvinsi" required >
                                                <option value="">National</option>
                                                <option v-for="item in negara" :key="item.id" :value="item.id">{{ item.NationName }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control form-select bg_input" v-model="BillingProvince" @change="fetchKota" :disabled="!BillingState" required>
                                                <option value="">Province</option> 
                                                <option v-for="item in provinsi" :key="item.prov_id" :value="item.prov_id">{{ item.prov_name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-control form-select bg_input" v-model="BillingCity" :disabled="!BillingProvince" required>
                                                <option value="">City</option>
                                                <option v-for="item in kota" :key="item.city_id" :value="item.city_id">{{ item.city_name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="booking_tour_form_submit pt-4">
                            <div class="form-check write_spical_check">
                                <input class="form-check-input" type="checkbox" value="" v-model="formData.termsAccepted" id="flexCheckDefaultf1">
                                <label class="form-check-label" for="flexCheckDefaultf1">
                                    I have read and accept the <router-link to="/terms-service">Terms and
                                        conditions</router-link> and <router-link to="/privacy-policy">Privacy policy</router-link>
                                </label>
                            </div>
                            <button class="btn btn-success btn_md" :disabled="!isFormValid || isLoading " @click="submitForm">
                                <span v-if="isLoading">
                                    <i class="fas fa-spinner fa-spin"></i> Processing...
                                </span>
                                <span v-else>
                                    Sign Up
                                </span>
                            </button>

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
<script setup>
    import { ref, computed  } from 'vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';

    const prop = defineProps({
        negara: Array
    });

    const formData = ref({
        FirstName: '',
        LastName: '',
        Email: '',
        Phone: '',
        BillingAddress: '',
        BillingState: '',
        BillingProvince: '',
        BillingCity: '',
        Password: '',
        RePassword: '',
        termsAccepted: false
    });

    const BillingState = ref('');
    const BillingProvince = ref('');
    const BillingCity = ref('');
    const provinsi = ref([]);
    const kota = ref([]);
    const isLoading = ref(false);

    const fetchProvinsi = async () => {
        BillingProvince.value = '';
        BillingCity.value = '';
        kota.value = [];
        console.log(BillingState.value);
        if (BillingState.value) {
            const response = await axios.get(`/provinsi/${BillingState.value}`);
            provinsi.value = response.data;
        }
    };

    const fetchKota = async () => {
        BillingCity.value = '';
        if (BillingProvince.value) {
            const response = await axios.get(`/kota/${BillingProvince.value}`);
            kota.value = response.data;
        }
    };

    const passwordMismatch = computed(() => {
        return (
            formData.value.Password !== "" &&
            formData.value.RePassword !== "" &&
            formData.value.Password !== formData.value.RePassword
        );
    });

    // Validasi Form
    const isFormValid = computed(() => {
        return (
            formData.value.FirstName &&
            formData.value.LastName &&
            formData.value.Email &&
            formData.value.Phone &&
            formData.value.BillingAddress &&
            BillingState.value &&
            BillingProvince.value &&
            BillingCity.value &&
            !passwordMismatch.value &&
            // formData.value.BillingState &&
            // formData.value.BillingProvince &&
            // formData.value.BillingCity &&
            formData.value.termsAccepted
        );
    });
    console.log(isFormValid);

    const submitForm = async () => {
        if (!isFormValid.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields!',
            });
            return;
        }

        isLoading.value = true;

        try {
            formData.value.BillingState = BillingState.value;
            formData.value.BillingProvince = BillingProvince.value;
            formData.value.BillingCity = BillingCity.value;
            const response = await axios.post('/vendorregistration', formData.value);
            // alert('Pendaftaran berhasil!');
            Swal.fire({
                icon: response.data.success == true ? 'success' : 'error',
                title: response.data.success == true ? 'Success' : 'error',
                text: response.data.message,
            }).then(() => {
                if (response.data.success == true) {
                    window.location.href = '/becomevendor';
                }
            });
            console.log(response);
        } catch (error) {
            console.error('Gagal menyimpan data:', error);
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: error,
            })
        } finally {
            isLoading.value = false;
        }
    };
</script>
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