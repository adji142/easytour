<template>
    <section id="news_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Latest travel news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="news_area_top_left">
                        <a v-if="articleLastest" :href="`/articleviewdetail/${articleLastest.id}`">
                            <img :src="articleLastest.thumbnail" alt="img">
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="news_area_top_right">
                        <h2>
                            <router-link>{{ articleLastest.title }}</router-link>
                        </h2>
                        <p v-html="summaryText"> </p>
                        
                        <a v-if="articleLastest" :href="`/articleviewdetail/${articleLastest.id}`">
                            Read full article <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="new_main_news_box">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12" v-for="(item, index) in paginatedArticles" :key="index">
                        <div class="news_item_boxed">
                            <div class="news_item_img">
                                <a :href="`/articleviewdetail/${item.id}`">
                                    <img :src="item.thumbnail" :alt="item.title" />
                                </a>
                            </div>
                            <div class="news_item_content">
                                <h3>
                                    <a :href="`/articleviewdetail/${item.id}`">{{ item.title }}</a>
                                </h3>
                                <p>{{ getSummary(item.content) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="pagination_area">
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">«</a>
                    </li>
                    <li
                    class="page-item"
                    v-for="page in totalPages"
                    :key="page"
                    :class="{ active: currentPage === page }"
                    >
                    <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                    <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">»</a>
                    </li>
                </ul>
                </div>
            </div>

        </div>
    </section>
</template>
<script>
export default {
  name: "NewsArea",
  props: {
    easyTourSetting: Array,
    article: Array,
    articleLastest: Array,
    articleCount: Number,
    isLoggedIn: Boolean,
    user: Object,
    BannerName: String,
  },
  data() {
    return {
      currentPage: 1,
      perPage: 6, // Jumlah artikel per halaman
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.article.length / this.perPage);
    },
    paginatedArticles() {
      const start = (this.currentPage - 1) * this.perPage;
      return this.article.slice(start, start + this.perPage);
    },
    summaryText() {
      if (this.articleLastest) {
        const stripped = this.articleLastest.content.replace(/<\/?[^>]+(>|$)/g, "");
        return stripped.length > 200 ? stripped.substring(0, 200) + "..." : stripped;
      }
    },
  },
  methods: {
    changePage(page) {
      if (page > 0 && page <= this.totalPages) {
        this.currentPage = page;
      }
    },
    getSummary(html) {
      const text = html.replace(/<\/?[^>]+(>|$)/g, "");
      return text.length > 100 ? text.substring(0, 100) + "..." : text;
    },
    formatDate(dateStr) {
      if (!dateStr) return '';
      const options = { year: 'numeric', month: 'short', day: 'numeric' };
      return new Date(dateStr).toLocaleDateString(undefined, options);
    },
  },
};
</script>

<style scoped>
.page-item.disabled .page-link {
  pointer-events: none;
  opacity: 0.5;
}
.page-item.active .page-link {
  background-color: #007bff;
  color: white;
}
</style>