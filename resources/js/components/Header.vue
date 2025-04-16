<template>
    <div>
        <header class="main_header_arae">
            <!-- Top Bar -->
            <div class="topbar-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <ul class="topbar-list">
                                <li>
                                    <a :href="easyTourSetting.FacebookPage"><i class="fab fa-facebook"></i></a>
                                    <a :href="easyTourSetting.TwitterPage"><i class="fab fa-twitter-square"></i></a>
                                    <a :href="easyTourSetting.InstagramPage"><i class="fab fa-instagram"></i></a>
                                    <a :href="easyTourSetting.YoutubePage"><i class="fab fa-youtube"></i></a>
                                </li>
                                <li><a href="#!"><span>{{ easyTourSetting.AppsPhone }}</span></a></li>
                                <li><a href="#!"><span>{{ easyTourSetting.AppsEmail }}</span></a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <ul class="topbar-others-options">
                                <!-- <li><router-link to="/login">Login</router-link></li> -->
                                <li><a href="/login">Login</a></li>
                                <li><a href="/register">Sign up</a></li>
                                <li>
                                    <div class="dropdown language-option">
                                        <select v-model="language">
                                            <option value="English">English</option>

                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown language-option">

                                        <select v-model="currency">
                                            <option value="IDR">IDR</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Navbar Bar -->
            <div class="navbar-area" :class="{ 'is-sticky': isSticky }">
                <div class="main-responsive-nav">
                    <div class="container">
                        <div class="main-responsive-menu mean-container">
                            <nav class="navbar">
                                <div class="container">
                                    <div class="logo">
                                        <router-link to="/">
                                            <img src="../assets/img/logo.png" alt="logo">
                                        </router-link>
                                    </div>
                                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbar-content">
                                        <div class="hamburger-toggle">
                                            <div class="hamburger">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="collapse navbar-collapse mean-nav" id="navbar-content">
                                        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                                            <li class="nav-item dropdown">
                                                <a href="/" class="dropdown-item dropdown-toggle">
                                                    Home
                                                </a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a href="/tourdestionation" class="dropdown-item dropdown-toggle">
                                                    Tours
                                                </a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a href="/" class="dropdown-item dropdown-toggle">
                                                    Vihacle
                                                </a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a href="/" class="dropdown-item dropdown-toggle">
                                                    Hotels
                                                </a>
                                            </li>
                                            
                                            
                                            <li class="nav-item dropdown">
                                                <a href="/" class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                                    Pages
                                                </a>
                                                <ul class="dropdown-menu shadow">
                                                    <li class="nav-item">
                                                        <a href="/" class="dropdown-item">
                                                            Article
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/" class="dropdown-item">
                                                            FAQ
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/" class="dropdown-item">
                                                            Testimonials
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="/" class="dropdown-item">
                                                            Privacy Policy
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a href="/" class="dropdown-item dropdown-toggle">
                                                    Contact
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <a href="/" class="dropdown-item dropdown-toggle">
                                                    About Us
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="main-navbar">
                    <div class="container">
                        <nav class="navbar navbar-expand-md navbar-light">
                            <router-link class="navbar-brand" to="/">
                                <img src="../assets/img/logo.png" alt="logo">
                            </router-link>

                            <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="/" class="nav-link" :class="{ active: isActive('Home') }">
                                            Home
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/tourdestionation" class="nav-link" :class="{ active: isActive('Tour') }">
                                            Tours
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Vihacle
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Hotels
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Pages
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a href="/" class="nav-link">
                                                    Article
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/" class="nav-link">
                                                    FAQ
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/" class="nav-link">
                                                    Testimonials
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="/" class="nav-link">
                                                    Privacy Policy
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/" class="nav-link">
                                            Contact
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="/" class="nav-link">
                                            About Us
                                        </a>
                                    </li>
                                </ul>
                                <div class="others-options d-flex align-items-center">
                                    <div class="option-item">
                                        <a href="/becomevendor" class="btn  btn_navber">Become a
                                            partner</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="others-option-for-responsive">
                    <div class="container">
                        <div class="container">
                            <div class="option-inner">
                                <div class="others-options d-flex align-items-center">
                                    <div class="option-item">
                                        <a href="#" class="search-box"><i class="fas fa-search"></i></a>
                                    </div>
                                    <div class="option-item">
                                        <router-link to="/contact" class="btn btn_navber">Get free quote</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</template>
<script>
import { route } from 'ziggy-js';
export default {
    name: 'Header',
    data() {
        return {
            language: 'English',
            currency: 'IDR',
            isSticky: false,
        }
    },

    mounted() {
        window.addEventListener('scroll', () => {
            let scroll = window.scrollY
            if (scroll >= 200) {
                this.isSticky = true
            } else {
                this.isSticky = false
            }
        })

        document.addEventListener('click', function (e) {
            // Hamburger menu
            if (e.target.classList.contains('hamburger-toggle')) {
                e.target.children[0].classList.toggle('active');
            }
        })
    },
    props: {
        easyTourSetting: Array,
    },
    methods: {
        isActive(pageName) {
            console.log(pageName + " > " + this.$page.component);
            return this.$page.component === pageName;
        }
    }
}
</script>

