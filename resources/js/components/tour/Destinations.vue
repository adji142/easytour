<template>
    <section id="top_testinations" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>19 destinations found</h2>
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
                                <Slider v-model="value" class="apply" />
                            </div>
                            <button class="apply" type="button">Apply</button>
                        </div>
                        <!-- <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Filter by Review</h5>
                            </div>
                            <div class="filter_review">
                                <form class="review_star">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                        <label class="form-check-label" for="flexCheckDefault1">
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_asse"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                                        <label class="form-check-label" for="flexCheckDefault2">
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_asse"></i>
                                            <i class="fas fa-star color_asse"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                        <label class="form-check-label" for="flexCheckDefault3">
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_asse"></i>
                                            <i class="fas fa-star color_asse"></i>
                                            <i class="fas fa-star color_asse"></i>
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                        <label class="form-check-label" for="flexCheckDefault5">
                                            <i class="fas fa-star color_theme"></i>
                                            <i class="fas fa-star color_asse"></i>
                                            <i class="fas fa-star color_asse"></i>
                                            <i class="fas fa-star color_asse"></i>
                                            <i class="fas fa-star color_asse"></i>
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div> -->
                        <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Tour type</h5>
                            </div>
                            <div class="tour_search_type">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf1">
                                    <label class="form-check-label" for="flexCheckDefaultf1">
                                        <span class="area_flex_one">
                                            <span>Ecotourism</span>
                                            <span>17</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf2">
                                    <label class="form-check-label" for="flexCheckDefaultf2">
                                        <span class="area_flex_one">
                                            <span>Escorted tour </span>
                                            <span>14</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf3">
                                    <label class="form-check-label" for="flexCheckDefaultf3">
                                        <span class="area_flex_one">
                                            <span>Family trips</span>
                                            <span>30</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf4">
                                    <label class="form-check-label" for="flexCheckDefaultf4">
                                        <span class="area_flex_one">
                                            <span>Group tour</span>
                                            <span>22</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultf5">
                                    <label class="form-check-label" for="flexCheckDefaultf5">
                                        <span class="area_flex_one">
                                            <span>City trips</span>
                                            <span>41</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="left_side_search_boxed">
                            <div class="left_side_search_heading">
                                <h5>Facilities</h5>
                            </div>
                            <div class="tour_search_type">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt1">
                                    <label class="form-check-label" for="flexCheckDefaultt1">
                                        <span class="area_flex_one">
                                            <span>Gymnasium</span>
                                            <span>20</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt2">
                                    <label class="form-check-label" for="flexCheckDefaultt2">
                                        <span class="area_flex_one">
                                            <span>Mountain Bike</span>
                                            <span>14</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt3">
                                    <label class="form-check-label" for="flexCheckDefaultt3">
                                        <span class="area_flex_one">
                                            <span>Wifi</span>
                                            <span>62</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt4">
                                    <label class="form-check-label" for="flexCheckDefaultt4">
                                        <span class="area_flex_one">
                                            <span>Aerobics Room</span>
                                            <span>08</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultt5">
                                    <label class="form-check-label" for="flexCheckDefaultt5">
                                        <span class="area_flex_one">
                                            <span>Golf Cages</span>
                                            <span>12</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="row">

                        <div v-for='(destinationInfo, index) in items' class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="top_destinations_box img_hover">
                                <div class="heart_destinations">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <router-link to="/top-destinations-details">
                                    <img :src="require(`@/assets/img/destination/${destinationInfo.topDestinationImage}.png`)"
                                        alt="{{ destinationInfo.altText }}" />
                                </router-link>

                                <div class="top_destinations_box_content">
                                    <h4><router-link to="/top-destinations-details">{{ destinationInfo.location
}}</router-link></h4>
                                    <p><span class="review_rating">{{ destinationInfo.reviewRating }}</span> <span
                                            class="review_count">({{ destinationInfo.reviewCount }})</span></p>
                                    <h3>{{ destinationInfo.price }} <span>{{ destinationInfo.startForm }}</span></h3>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="pagination_area">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
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
import data from '../../assets/tour/data'

export default {
    name: "Destinations",
    components: {
        Slider
    },
    data() {
        return {
            value: [0, 75],
            items: [],
        }
    },
    mounted() {
        this.items = data.topDestinationData
    },
};
</script>
<style src="@vueform/slider/themes/default.css">

</style>