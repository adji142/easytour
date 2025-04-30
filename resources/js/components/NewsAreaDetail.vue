<template>
    <section id="news_details_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="news_detail_wrapper">
                        <div class="news_details_content_area" v-html="article.content">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

export default {
    name: "NewsAreaThree",
    props:{
        easyTourSetting: Array,
        article: Array,
        articleCount: Number,
        isLoggedIn: Boolean,
        user: Object,
        BannerName:String
    }
};
</script>