<template>
    <div id="header" class="sticky-top">
        <nav class="navbar navbar-light justify-content-sm-between justify-content-around">
            <router-link to="/" class="navbar-brand">
                <img src="/images/the-refine-network/refine-logo.png" alt="">
            </router-link>
            <div class="text-center" v-if="isPage('home') || isPage('assessment')">
                <span class="navbar-text pb-0">
                    Enneagram Assessment
                </span>
            </div>
            <div class="header-btn-center text-center pt-2" v-if="!isPage('assessment') && !isPage('home') && !isPage(isHighScore().replace('t', 'type'))">
                <a :href="`/${isHighScore().replace('t', 'type')}${queryParams}`" class="btn btn-primary">Your Report</a><br>
            </div>
        </nav>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            scores: {
                type: Object,
            },
        },
        data() {
            return {
                myReportUrl: '',
                queryParams: '',
            }
        },
        mounted() {
            if (typeof this.$route.query === 'object' && Object.keys(this.$route.query).length > 0) {
                this.queryParams = this.$route.fullPath.replace(this.$route.path, '');

            }
        },
        methods: {
            // goTo(id) {
            //     if (document.querySelector(id)) {
            //         return window.scrollTo({
            //             top: document.querySelector(id).offsetTop - 45,
            //             behavior: 'smooth'
            //         });
            //     }
            // },
            isPage(pageSlug) {
                return this.$route.name === pageSlug;
            },
            isHighScore() {
                const type = Object.keys(this.scores).reduce((prev, cur) => {
                    if (prev === '') {
                        prev = cur;
                    } else {
                        if (this.scores[prev] < this.scores[cur]) {
                            prev = cur;
                        }
                    }

                    return prev;
                }, '');
                return type;
            },
        },
    }
</script>



<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    #header {
        .container-fluid {
            background: $sda-white;
        }

        img {
            max-width: 300px;
        }
    }

    .navbar {
        background-color: $sda-white;
        border-bottom: 1px solid #F9F9F9;
        box-shadow: 0px 1px 1px 0px #DFDFDF;
    }

    a {
        margin: 0;

        @media only screen and (max-width: 712px) {
            margin: 0 auto;
        }
    }

    .navbar-brand svg {
        max-width: 100%;
    }

    .header-btn-center {
        @media only screen and (max-width: 390px) {
            margin: 0 auto .5rem
        }
    }

    @media only screen and (max-width: 712px) {
        button {
            display: none;
        }
    }
</style>
