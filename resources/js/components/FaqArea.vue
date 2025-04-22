<template>
    <section id="faqs_main_area" class="section_padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section_heading_center">
              <h2>Frequent Answer and Question</h2>
            </div>
          </div>
        </div>
  
        <div class="faqs_area_top">
          <div class="row">
            <div class="col-lg-8">
              <div class="faqs_three_area_wrapper">
                <div class="faqs_item_wrapper">
                  <h3>General Questions</h3>
                  <div class="faqs_main_item">
                    <div class="accordion" id="faqAccordion">
                      <div class="accordion-item" v-for="(faq, index) in faqList" :key="index">
                        <h2 class="accordion-header" :id="'heading' + index">
                          <button class="accordion-button" :class="{ collapsed: index !== 0 }"
                            type="button"
                            data-bs-toggle="collapse"
                            :data-bs-target="'#collapse' + index"
                            :aria-expanded="index === 0 ? 'true' : 'false'"
                            :aria-controls="'collapse' + index">
                            {{ faq.question }}
                          </button>
                        </h2>
                        <div :id="'collapse' + index"
                          class="accordion-collapse collapse"
                          :class="{ show: index === 0 }"
                          :aria-labelledby="'heading' + index"
                          data-bs-parent="#faqAccordion">
                          <div class="accordion-body">
                            <p v-html="faq.answer"></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4">
              <div class="faqs_call_area">
                <img src="../assets/img/icon/call.png" alt="img">
                <h5>Contact us 24/7</h5>
                <h3><a :href="`tel:${easyTourSetting.AppsPhone}`">{{ easyTourSetting.AppsPhone }}</a></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "FaqArea",
    props: {
      faqList: Array,
      easyTourSetting: Object,
      isLoggedIn: Boolean,
      user: Object,
      BannerName: String
    },
  };
  </script>
  