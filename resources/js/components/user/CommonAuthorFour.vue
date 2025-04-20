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
                            <form @submit.prevent="submitLogin" id="main_author_form">
                                <div class="form-group">
                                    <input v-model="email" type="email" class="form-control" placeholder="Enter user name" />
                                </div>
                                <div class="form-group">
                                    <input v-model="password" type="password" class="form-control" placeholder="Enter password" />
                                    <router-link to="/forgot-password">Forgot password?</router-link>
                                </div>
                                <div class="common_form_submit">
                                    <button class="btn btn_theme btn_md" :disabled="isLoading">
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
                                            <button @click="loginWithGoogle" type="button" class="btn btn-light">
                                                <img src="../../assets/img/icon/google.png" alt="Google">
                                                Login with Google
                                            </button>
                                        </li>
                                    </ul>
                                    <p>Don't have an account? <a href="/register">Register now</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    name: "CommonAuthorFour",
    data() {
        return {
            email: "",
            password: "",
            isLoading: false, // REAKTIF sekarang
        };
    },
    methods: {
        async submitLogin() {
            this.isLoading = true;
            try {
                const response = await axios.post('/action-login', {
                    email: this.email,
                    password: this.password
                });

                if (response.data.success === true) {
                    window.location.href = response.data.redirect;
                } else {
                    Swal.fire("Error", "Login failed! " + response.data.message, "error");
                }
            } catch (error) {
                console.error(error);
                Swal.fire("Error", "Terjadi kesalahan saat login.", "error");
            } finally {
                this.isLoading = false;
            }
        },
        loginWithGoogle() {
            window.location.href = "/auth/google";
        },
    },
};
</script>

<style scoped>
#common_author_area {
    position: relative;
    background-image: url('../../assets/img/banner/bg.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

#common_author_area::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(50, 50, 50, 0.6);
    z-index: 1;
}

.container {
    position: relative;
    z-index: 2;
}
</style>
