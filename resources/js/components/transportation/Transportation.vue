<template>
    <section id="top_destinations" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>{{ filteredTransportation.length }} Transportation found</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_side_search_area">
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Filter by price</h5>
                            </div>
                            <div class="filter-price">
                                <Slider v-model="value" class="apply" :min="0" :max="99999" />
                            </div>
                            <button class="apply" type="button">Apply</button>
                        </div>
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Transportation Type</h5>
                            </div>
                            <div class="tour_search_type">
                                <div class="form-check" v-for="(type, index) in transportationtype" :key="index">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        :value="type"
                                        v-model="selectedTypes"
                                        :id="'transportation-type-' + index"
                                    />
                                    <label class="form-check-label" :for="'transportation-type-' + index">
                                        <span class="area_flex_one">
                                            <span>{{ type }}</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row">
                        <div v-for='(item, index) in paginatedTours' :key="index" class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="top_destinations_box img_hover">
                                <div class="heart_destinations">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <img v-if="item.TransportationImage" :src="item.TransportationImage" alt="icon" />
                                <div class="top_destinations_box_content">
                                    <h4>
                                        <a :href="'/transportationpage/details/' + item.id">{{ item.TransportationName }}</a>
                                    </h4>
                                    <h3>{{ formatPrice(item.FinalPrice) }} <span>Starting From</span></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="pagination_area">
                                <ul class="pagination">
                                    <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage - 1)">
                                            <span>&laquo;</span>
                                        </a>
                                    </li>

                                    <li class="page-item" v-for="page in totalPages" :key="page" :class="{ active: currentPage === page }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(page)">
                                            {{ page }}
                                        </a>
                                    </li>

                                    <li class="page-item" :class="{ disabled: currentPage === totalPages }">
                                        <a class="page-link" href="#" @click.prevent="goToPage(currentPage + 1)">
                                            <span>&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Slider from '@vueform/slider';
import data from '../../assets/tour/data';
import { formatToK } from '../../helper';

export default {
    name: "Transportation",
    components: {
        Slider
    },
    data() {
        return {
            value: [0, 75000], // Slider range for price filtering
            items: [], // Initial data
            selectedTypes: [],
            currentPage: 1,
            perPage: 9,
        };
    },
    computed: {
        // Filter tours based on price range
        filteredTransportation() {
            return this.transportation.filter(tour => {
                const withinPriceRange = (tour.FinalPrice / 1000 ) >= this.value[0] && (tour.FinalPrice / 1000) <= this.value[1];
                const matchesTourType = this.selectedTypes.length === 0 || this.selectedTypes.includes(tour.TransportationType);
                return withinPriceRange && matchesTourType;
            });
        },
        paginatedTours() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.filteredTransportation.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.filteredTransportation.length / this.perPage);
        }
    },
    mounted() {
        this.items = data.topDestinationData;
    },
    props: {
      easyTourSetting: Array,
      transportation: Array,
      transportationcount: Number,
      transportationtype: Array,
      isLoggedIn: Boolean,
      user: Object,
      BannerName:String
    },
    methods: {
        formatPrice(price) {
            return formatToK(price);
        },
        goToPage(page) {
            if (page >= 1 && page <= this.totalPages) {
                this.currentPage = page;
            }
        }
    }
};
</script>

<style src="@vueform/slider/themes/default.css"></style>