
<template>
    <section id="explore_area" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>{{ filteredHotels.length }} hotel found</h2>
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
                                <h5>Filter by hotel star</h5>
                            </div>
                            <div class="filter_review">
                                <form class="review_star">
                                    <div class="form-check" v-for="n in 5" :key="n">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            :value="n"
                                            v-model="selectedRatings"
                                            :id="'rating' + n">
                                        <label class="form-check-label" :for="'rating' + n">
                                            <i v-for="i in 5" :key="i" class="fas fa-star" :class="i <= n ? 'color_theme' : 'color_asse'"></i>
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div v-for='(item, index) in paginatedHotels' :key="index" class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="theme_common_box_two img_hover">
                                <div class="theme_two_box_img">
                                    <a :href="'/searchhotel/details/'+ item.id">
                                        <img v-if="item.RoomImage" :src="item.RoomImage" alt="icon" />
                                    </a>
                                    <p><i class="fas fa-map-marker-alt"></i>{{ item.city_name }}</p>
                                </div>
                                <div class="theme_two_box_content">
                                    <h4>
                                        <a :href="'/searchhotel/details/'+ item.id">{{ item.HotelName }}</a>
                                    </h4>
                                    
                                    <h3><span class="review_rating">{{ formatPrice(item.FinalPrice) }}</span> <span>Price Start From</span></h3>
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
import Slider from '@vueform/slider'
import { formatToK } from '../../helper';

export default {
    name: "SearchResult",
    components: {
        Slider
    },
    data() {
        return {
            value: [0, 75000], // Slider range for price filtering
            items: [], // Initial data
            selectedRatings: [],
            currentPage: 1,
            perPage: 9,
        };
    },
    computed: {
        // Filter tours based on price range
        filteredHotels() {
            console.log(this.hotels);
            console.log(this.selectedRatings);
            return this.hotels.filter(hotel => {
                const withinPriceRange = (hotel.FinalPrice / 1000 ) >= this.value[0] && (hotel.FinalPrice / 1000) <= this.value[1];
                const matchesRating = this.selectedRatings.length === 0 || this.selectedRatings.includes(hotel.HotelRating);
                return withinPriceRange && matchesRating;
            });
        },
        paginatedHotels() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.filteredHotels.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.filteredHotels.length / this.perPage);
        }
    },
    mounted() {
        console.log(this.paginatedHotels);
        // this.items = data.hotelData
    },
    props:{
        easyTourSetting: Array,
        hotels: Array,
        hotelcount: Number,
        isLoggedIn: Boolean,
        user: Object
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
<style src="@vueform/slider/themes/default.css">

</style>