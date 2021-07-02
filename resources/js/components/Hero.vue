<template>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="row">

                <div class="col-md-6 text-center">
                    <h1 class="text-left">Here’s Your<br> <span>Business Health Score™</span></h1>

                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="mh-player" class="embed-responsive-item" src="https://player.vimeo.com/video/338950266?api=1&amp;player_id=mh-player" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" data-ready="true"></iframe>
                    </div>

                    <button class="btn btn-primary mt-3" @click="goTo('#sales-section')"><PhoneIcon></PhoneIcon> Schedule A Call Today</button>
                </div>

                <div class="col-md-6 mobile-padding">

                    <div class="guage-holder special-dotted-bg">
                        <div class="guage">
                            <span>{{overallScore}}</span>
                        </div>

                        <svg viewBox="0 0 36 36" class="circular-chart orange">
                            <path class="circle"
                                :stroke-dasharray="`${overallScore}, 100`"
                                d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                            />
                        </svg>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                scores: {},
            }
        },
        mounted() {
            if (typeof this.$route.query === 'object' && Object.keys(this.$route.query).length > 0) {
                let queryParams = {};
                Object.keys(this.$route.query).map(query => {
                    if (query == 'm1' || query == 'm2' || query == 'm3' || query == 'm4') {
                        queryParams[query] = parseInt(this.$route.query[query]);
                    }
                });

                this.scores = queryParams;
            }
        },
        computed: {
            overallScore() {
                let overallScore = Object.keys(this.scores).reduce((accumulator, score) => {
                    accumulator += this.scores[score];
                    return accumulator;
                }, 0);

                overallScore = Math.round(overallScore * (100 / (Object.keys(this.scores).length * 10)));
                return overallScore >= 96 ? 95 : overallScore;
            }
        },
        methods: {
            goTo(id) {
                if (document.querySelector(id)) {
                    return window.scrollTo({
                        top: document.querySelector(id).offsetTop - 45,
                        behavior: 'smooth'
                    });
                }
            },
        },
    }
</script>



<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .special-dotted-bg {
        background-image: url('/images/dot-pattern-gold.png');
        background-size: 45rem;
        height: 100%;
        width: 100%;

        @media only screen and (max-width: 767px) {
            background-size: cover;
        }
    }

    .mobile-padding {
        @media only screen and (max-width: 767px) {
            margin-top: 3rem;
        }
    }

    .single-chart {
        width: 33%;
        justify-content: space-around ;
    }

    .circular-chart {
        display: block;
        max-width: 16.4rem;
        max-height: 16.4rem;
        position: absolute;
        stroke: $mh-purple;
    }

    .circle-bg {
        fill: none;
        stroke: #eee;
        stroke-width: 3.8;
    }

    .circle {
        fill: none;
        stroke-width: 1.2;
        stroke-linecap: round;
    }

    .percentage {
        fill: #666;
        font-family: sans-serif;
        font-size: 0.5em;
        text-anchor: middle;
    }

    .guage-holder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;

        .guage {
            background: #ffffff;
            border-radius: 50%;
            height: 15rem;
            width: 15rem;
            display: flex;
            align-items: center;
            justify-content: center;

            span {
                font-size: 3.5rem;
                font-weight: 800;
            }
        }
    }

    .jumbotron {
        background: $mh-gray;

        iframe {
            width: 100%;
        }

        & > svg {
            position: absolute;
        }
    }

</style>
