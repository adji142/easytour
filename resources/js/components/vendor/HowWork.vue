<template>
    <section id="how_it_work_area" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>How it works</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="how_it_boxed">
                        <img :src="easyTourSetting.HiWImage1" alt="img">
                        <h3>{{ easyTourSetting.HiWHeadline1 }}</h3>
                        <p v-html="easyTourSetting.HiWText1"></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="how_it_boxed">
                        <img :src="easyTourSetting.HiWImage2" alt="img">
                        <h3>{{ easyTourSetting.HiWHeadline2 }}</h3>
                        <p v-html="easyTourSetting.HiWText2"></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="how_it_boxed">
                        <img :src="easyTourSetting.HiWImage2" alt="img">
                        <h3>{{ easyTourSetting.HiWHeadline3 }}</h3>
                        <p v-html="easyTourSetting.HiWText3"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

export default {
    name: "HowWork",
    props:{
        easyTourSetting: Array
    }
};
</script>