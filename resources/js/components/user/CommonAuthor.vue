<template>

    <section id="common_author_area" class="section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="common_author_boxed">
                            <div class="common_author_heading">
                                <h3>Verify OTP</h3>
                                <h2>Verify your OTP</h2>
                            </div>
                            <div class="common_author_form">
                                <form action="#" id="main_author_form">
                                    <div class="form-group">
                                        <div class="otpCont flex spaceBetween">
                                            <input class="otSc form-control" type="text" maxlength="1">
                                            <input class="otSc form-control" type="text" maxlength="1">
                                            <input class="otSc form-control" type="text" maxlength="1">
                                            <input class="otSc form-control" type="text" maxlength="1">
                                            <input class="otSc form-control" type="text" maxlength="1">
                                        </div>
                                    </div>
                                    <div class="common_form_submit">
                                        <button class="btn btn_theme btn_md">Verify OTP</button>
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
        name: "CommonAuthor"
    };
    </script>