<template>
    <section id="common_author_area" class="section_padding">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="common_author_boxed">
                        <div class="common_author_heading">
                            <h3>Register account</h3>
                            <h2>Register your account</h2>
                        </div>
                        <div class="common_author_form">
                            <form @submit.prevent="register" id="main_author_form">
                                <div class="form-group">
                                    <input v-model="form.firstName" type="text" class="form-control" name="firstName" placeholder="Enter first name*" required />
                                </div>
                                <div class="form-group">
                                    <input v-model="form.lastName" type="text" class="form-control" name="lastName" placeholder="Enter last name*" required />
                                </div>
                                <div class="form-group">
                                    <input v-model="form.email" type="email" class="form-control" name="email" placeholder="Your email address*" required />
                                </div>
                                <div class="form-group">
                                    <input v-model="form.phone" type="text" class="form-control" name="phone" placeholder="Mobile number*" required />
                                </div>
                                <div class="form-group">
                                    <input v-model="form.password" type="password" class="form-control" name="password" placeholder="Password" required />
                                </div>
                                <div class="form-group">
                                    <input v-model="form.repassword" type="password" class="form-control" name="repassword" placeholder="Retype your Password*" required />
                                    <p v-if="passwordMismatch" style="color: red; font-size: 14px;">
                                        Password and retype password must be the same.
                                    </p>
                                </div>
                                <div class="common_form_submit">
                                    <button class="btn btn_theme btn_md" :disabled="isLoading">
                                        {{ isLoading ? "Registering..." : "Register" }}
                                    </button>
                                </div>
                                <div class="have_acount_area other_author_option">
                                    <div class="line_or">
                                        <span>or</span>
                                    </div>
                                    <ul>
                                        <li>
                                            <button @click.prevent="loginWithGoogle" class="btn btn-light">
                                                <img src="../../assets/img/icon/google.png" alt="Google">
                                                Login with Google
                                            </button>
                                        </li>
                                    </ul>
                                    <p>Already have an account? <a href="/login">Login Now</a></p>
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
    name: "CommonAuthorThree",
    data() {
        return {
            form: {
                firstName: "",
                lastName: "",
                email: "",
                phone: "",
                password: "",
                repassword: ""
            },
            isLoading: false,
            successMessage: null,
            errorMessage: null,
        };
    },
    computed: {
        passwordMismatch() {
            return this.form.password && this.form.repassword && this.form.password !== this.form.repassword;
        }
    },
    methods: {
        async register() {
            if (this.passwordMismatch) {
                Swal.fire("Error", "Password and retype password must be the same.", "error");
                return;
            }

            this.isLoading = true;
            try {
                const response = await axios.post("/registration-login", this.form);

                if (response.data.success === true) {
                    Swal.fire("Success", "Registration successful!", "success").then(() => {
                        window.location.href = "/";
                    });
                } else {
                    Swal.fire("Error", response.data.message || "Registration failed!", "error");
                }
            } catch (error) {
                Swal.fire("Error", error.response?.data?.message || "Registration failed", "error");
            } finally {
                this.isLoading = false;
            }
        },
        loginWithGoogle() {
            window.location.href = "/auth/google";
        }
    },
    mounted() {
        document.title = "Register Account";
        const successMessage = window.successMessage;
        const errorMessage = window.errorMessage;

        console.log("Success Message:", successMessage);

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Horrayy!',
                text: successMessage,
                confirmButtonText: 'OK'
            });
        }

        if (errorMessage) {
            if (errorMessage.includes('CSRF token mismatch')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Whooops!',
                    text: 'Your session has expired. Please refresh the page and try again.',
                    confirmButtonText: 'OK'
                }).then(() => window.location.reload());
            } else if (errorMessage.includes('User is already registered')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Whooops!',
                    text: 'User is already registered. Please login instead.',
                    confirmButtonText: 'OK'
                }).then(() => window.location.href = '/login');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Whooops!',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                }).then(() => window.location.reload());
            }
        }
    }
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
