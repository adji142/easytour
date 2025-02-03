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
                            <form action="#" id="main_author_form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter user name" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Enter password" />
                                    <router-link to="/forgot-password">Forgot password?</router-link>
                                </div>
                                <div class="common_form_submit">
                                    <button class="btn btn_theme btn_md">Log in</button>
                                </div>
                                <div class="have_acount_area">
                                    <p>Dont have an account? <router-link to="/register">Register now</router-link></p>
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

export default {
    name: "CommonAuthorFour"
};
</script>