<template>

    <section id="common_author_area" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="common_author_boxed">
                        <div class="common_author_heading">
                            <h3>Login your account</h3>
                            <h2>Logged in to stay in touch</h2>
                        </div>
                        <div class="common_author_form">
                            <form  @submit.prevent="submitLogin" id="main_author_form">
                                <div class="form-group">
                                    <input v-model="email" type="email" class="form-control" placeholder="Enter user name" />
                                </div>
                                <div class="form-group">
                                    <input v-model="password" type="password" class="form-control" placeholder="Enter password" />
                                    <router-link to="/forgot-password">Forgot password?</router-link>
                                </div>
                                <div class="common_form_submit">
                                    <button class="btn btn_theme btn_md" :disabled="isLoading ">
                                        <span v-if="isLoading">
                                            <i class="fas fa-spinner fa-spin"></i> Processing...
                                        </span>
                                        <span v-else>
                                            Log in
                                        </span>
                                    </button>
                                </div>
                                <div class="have_acount_area other_author_option">
                                    <div class="line_or">
                                        <span>or</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <!-- <a href="#!"><img src="../../assets/img/icon/google.png" alt="icon"></a> -->
                                            <button @click="loginWithGoogle" class="btn btn-light">
                                                <img src="../../assets/img/icon/google.png" alt="Google">
                                                Login with Google
                                            </button>
                                        </li>
                                    </ul>
                                    <p>Dont have an account? <a href="/register">Register now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
/* Tambahkan Background Image */
#common_author_area {
    position: relative;
    background-image: url('../../assets/img/banner/bg.png'); /* Ganti dengan path gambar */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

/* Overlay Abu-abu atau Ungu */
#common_author_area::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(50, 50, 50, 0.6); /* Abu-abu */
    /* background: rgba(128, 0, 128, 0.6); */ /* Jika ingin ungu */
    z-index: 1;
}

/* Pastikan konten di atas overlay */
.container {
    position: relative;
    z-index: 2;
}
</style>
<script>
import { ref, computed  } from 'vue';
import axios from "axios";
import Swal from "sweetalert2";
const isLoading = ref(false);

export default {
    name: "CommonAuthorFour",
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async submitLogin() {
            isLoading.value = true;
            try {
                const response = await axios.post('/action-login', {
                    email: this.email,
                    password: this.password
                });

                console.log(response.data);
                if (response.data.success == true) {
                    window.location.href = response.data.redirect;
                }
                else {
                    Swal.fire("Error", "Login failed! " + response.data.message , "error");
                }
            } catch (error) {
                console.log(error);
            }
            finally {
                isLoading.value = false;
            }
            
        },
        loginWithGoogle() {
            console.log("Login with Google");
        },
    },
};
</script>