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
                            <form action="#" id="main_author_form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter first name*" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter last name*" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"placeholder="your email address*" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Mobile number*" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Retype your Password*" required>
                                    <!-- <p v-if="passwordMismatch" style="color: red; font-size: 14px;">
                                        Password and retype password must be the same.
                                    </p> -->
                                </div>
                                <div class="common_form_submit">
                                    <button class="btn btn_theme btn_md">Register</button>
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
import axios from "axios";
import Swal from "sweetalert2";

export default {
    name: "CommonAuthorThree",
    data() {
        return {
            form: {
                name: "",
                email: "",
                password: ""
            },
            isLoading: false
        };
    },
    methods: {
        async register() {
            this.isLoading = true;
            try {
                const response = await axios.post("/api/register", this.form);

                if (response.success == true) {
                    Swal.fire("Success", "Registration successful!", "success").then(() => {
                        window.location.href = response.redirect;
                    });
                }
                else {
                    Swal.fire("Error", "Registration failed! ". response.message , "error");
                }
            } catch (error) {
                Swal.fire("Error", "Registration failed", "error");
            }
            this.isLoading = false;
        },
        loginWithGoogle() {
            window.location.href = "/auth/google";
        }
    },
    mounted() {
        document.title = "Register Account";
        const successMessage = window.successMessage;
        const errorMessage = window.errorMessage;

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
                }).then(() => {
                    window.location.reload();
                });
            }
            else if(errorMessage.includes('User is already registered')) {

                Swal.fire({
                    icon: 'error',
                    title: 'Whooops!',
                    text: 'User is already registered. Please login instead.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '/login';
                });
            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Whooops!',
                    text: errorMessage,
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            }
            
        }
    }
};
</script>