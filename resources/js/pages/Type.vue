<template>
    <div :class="`results type-${currentType()}`">
        <Header :scores="scores">
            <ProgressBar :percentage="100" :absolute="false"></ProgressBar>
        </Header>
        <div class="content">

            <CategoryContent first>
                <h1 class="text-center text-uppercase"><span>How You Scored Across All Nine Enneagram Types</span></h1>
                <CategoryBarGraph :scores="scores"></CategoryBarGraph>
                <div class="text-center" v-if="isHighScore()">
                    <transition name="fade" appear>
                        <div v-if="results.title">
                            <a :href="results.pdf" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Download Type {{highScoreType()}} Report</a>
                        </div>
                    </transition>
                </div>
            </CategoryContent>

            <transition name="fade" appear>
                <div v-if="results.title">

                    <CategoryContent>
                        <div class="row">
                            <div class="col-12">
                                <div class="type-container">
                                    <div class="type-label-holder">
                                        <div class="type-label">Type</div>
                                        <div class="type-number">{{currentType()}}</div>
                                    </div>
                                    <div class="type-title">
                                        <p class="mobile-type-number">Type {{currentType()}}</p>
                                        <h1 v-html="results.title"></h1>
                                        <p>{{results.subtitle}}</p>
                                    </div>
                                    <div class="type-img">
                                        <div class="type-img-bg">
                                            <img :src="`/images/results/Enneagram_Wings-${currentType()}.png`" :alt="`Enneagram wings for type ${currentType()}`">
                                        </div>
                                    </div>
                                </div>

                                <h2 class="mt-4 mb-3">{{results.s1_title}}</h2>
                                <div v-html="results.s1_content"></div>
                            </div>
                        </div>
                    </CategoryContent>

                    <CategoryContent :last="!isHighScore()">
                        <div class="boxed-section boxed-section-main">
                            <div class="boxed-section-col boxed-section-col-first">
                                <h3 class="text-primary mb-0">Avoids</h3>
                                <p>{{results.internal_drivers_avoids}}</p>
                                <h3 class="text-primary mb-0">Pursues</h3>
                                <p>{{results.internal_drivers_pursues}}</p>
                                <h3 class="text-primary mb-0">Fulfillment</h3>
                                <p class="mb-0">{{results.internal_drivers_fulfillment}}</p>
                            </div>
                            <div class="boxed-section-col boxed-section-col-middle">
                                <h2 class="text-center text-uppercase text-primary mb-0">Internal Drivers</h2>
                                <img :src="`/images/results/Enneagram_Wings-${currentType()}.png`" :alt="`enneagram wings for type ${currentType()}`">
                            </div>
                            <div class="boxed-section-col boxed-section-col-last">
                                <h3 class="text-primary mb-0">Dominate Struggle</h3>
                                <p class="mb-0" v-html="results.internal_drivers_dominate_struggle"></p>
                            </div>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <h2>{{results.s2_title}}</h2>
                        <p>{{results.s2_content}}</p>

                        <div class="border-section">
                            <div class="border-section-col border-section-col-1">
                                <div class="border-section-col-image-holder">
                                    <img :src="`/images/results/Enneagram_Diagram_Paths_REV-${highScoreType()}-${results.path_left}.png`" :alt="`Enneagram wing, ${highScoreType()} to ${results.path_left}`">
                                </div>
                                <div class="border-section-col-description-holder">
                                    <h3 :class="`text-uppercase type-${results.path_left}-color`">Confidence<br> Path</h3>
                                    <p :class="`type-${results.path_left}-color`"><small><i>How you think/behave when you are mentally/emotionally healthy</i></small></p>
                                    <hr :class="`type-${results.path_left}-border-color`">
                                    <p :class="`type-${results.path_left}-color`"><b>Type {{highScoreType()}} moves toward Confident side of Type {{results.path_left}}</b></p>
                                </div>
                                <ul>
                                    <li v-for="(item, index) in results.confidence_path_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="border-section-col border-section-col-2">
                                <div class="border-section-col-image-holder">
                                    <img :src="`/images/results/Enneagram_Diagram_Paths_REV-${highScoreType()}-${results.path_right}.png`" :alt="`Enneagram wing, ${highScoreType()} to ${results.path_right}`">
                                </div>
                                <div class="border-section-col-description-holder">
                                    <h3 :class="`text-uppercase type-${results.path_right}-color`">Insecurity<br> Path</h3>
                                    <p :class="`type-${results.path_right}-color`"><small><i>How you think/behave when mentally/emotionally stressed</i></small></p>
                                    <hr :class="`type-${results.path_right}-border-color`">
                                    <p :class="`type-${results.path_right}-color`"><b>Type {{highScoreType()}} moves toward Insecure side of Type {{results.path_right}}</b></p>
                                </div>
                                <ul>
                                    <li v-for="(item, index) in results.insecurity_path_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="border-section">
                            <div class="border-section-col border-section-col-3">
                                <div class="border-section-col-image-holder">
                                    <img :src="`/images/results/Enneagram_Diagram_Paths_REV-${highScoreType()}-${results.path_left}.png`" :alt="`Enneagram wing, ${highScoreType()} to ${results.path_left}`">
                                </div>
                                <div class="border-section-col-description-holder">
                                    <h3 :class="`text-uppercase type-${results.path_left}-color`">Familiar<br> Path</h3>
                                    <p :class="`type-${results.path_left}-color`"><small><i>How you think/behave with those closest to you, your blind-spot</i></small></p>
                                    <hr :class="`type-${results.path_left}-border-color`">
                                    <p :class="`type-${results.path_left}-color`"><b>Type {{highScoreType()}} moves toward Insecure side of Type {{results.path_left}}</b></p>
                                </div>
                                <ul>
                                    <li v-for="(item, index) in results.familiar_path_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="border-section-col border-section-col-4">
                                <div class="border-section-col-image-holder">
                                    <img :src="`/images/results/Enneagram_Diagram_Paths_REV-${highScoreType()}-${results.path_right}.png`" :alt="`Enneagram wing, ${highScoreType()} to ${results.path_right}`">
                                </div>
                                <div class="border-section-col-description-holder">
                                    <h3 :class="`text-uppercase type-${results.path_right}-color`">Leverage<br> Path</h3>
                                    <p :class="`type-${results.path_right}-color`"><small><i>Learning to leverage natural weaknesses as strengths</i></small></p>
                                    <hr :class="`type-${results.path_right}-border-color`">
                                    <p :class="`type-${results.path_right}-color`"><b>Type {{highScoreType()}} moves toward Confident side of Type {{results.path_right}}</b></p>
                                </div>
                                <ul>
                                    <li v-for="(item, index) in results.leverage_path_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <h2>{{results.s3_title}}</h2>
                        <p>{{results.s3_content}}</p>

                        <div class="row">
                            <div class="col-md-5 align-self-center">
                                <img :src="`/images/results/Enneagram_Wings-${highScoreType()}.png`" alt="Enneagram wings" class="img-restrict-width">
                            </div>
                            <div class="col-md-7 align-self-center">
                                <h3>{{results.wing1_title}}</h3>
                                <p>{{results.wing1_content}}</p>
                                <h3>{{results.wing2_title}}</h3>
                                <p class="mb-0">{{results.wing2_content}}</p>
                            </div>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <div class="boxed-label-title-holder">
                            <h2 class="boxed-label-title">{{results.leadership_style_title}}</h2>
                        </div>
                        <div class="boxed-label-section">
                            <h3>{{results.leadership_style_strengths_title}}</h3>
                            <p>{{results.leadership_style_strengths_content}}</p>
                            <h3>{{results.leadership_style_weaknesses_title}}</h3>
                            <p>{{results.leadership_style_weaknesses_content}}</p>
                            <h3>{{results.leadership_style_lead_title}}</h3>
                            <p class="mb-0">{{results.leadership_style_lead_content}}</p>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <h2>{{results.s4_title}}</h2>
                        <p>{{results.s4_content}}</p>

                        <div class="row">
                            <div class="col-md-5 align-self-center">
                                <img :src="results.s4_triads_img" alt="Enneagram triads" class="img-restrict-width">
                            </div>
                            <div class="col-md-7 align-self-center">
                                <h3>{{results.triad_title}}</h3>
                                <h4 class=""><i>{{results.triad_subtitle}}</i></h4>
                                <p class="number-callout" v-for="(item, index) in results.triad_items" :key="index" v-html="item"></p>
                            </div>
                        </div>

                        <h4 class=""><i>{{results.triad_subtitle2}}</i></h4>
                        <p class="number-callout" v-for="(item, index) in results.triad_items2" :key="index" :class="`number-callout ${index + 1 == results.triad_items.length ? 'mb-0' : ''}`" v-html="item"></p>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <h2>{{results.s5_title}}</h2>
                        <p>{{results.s5_content}}</p>
                        <div class="boxed-label-section">
                            <h3>{{results.s5_box_title}}</h3>
                            <p class="mb-0">{{results.s5_box_content}}</p>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <h2>{{results.s6_title}}</h2>
                        <p>{{results.s6_content}}</p>

                        <div class="boxed-label-section">
                            <h3>{{results.s6_box_title}}</h3>
                            <div v-html="results.s6_box_content"></div>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <div class="row">
                            <div class="col-md-7 align-self-center d-none d-md-block">
                                <img src="/images/results/Enneagram_Diagram_Triads-01.png" alt="Enneagram interpersonal styles" class="img-restrict-width">
                            </div>
                            <div class="col-md-5 align-self-center">
                                <h2>{{results.s7_title}}</h2>
                                <p>{{results.s7_content}}</p>
                                <img src="/images/results/Enneagram_Diagram_Triads-01.png" alt="Enneagram interpersonal styles" class="img-restrict-width d-md-none">
                                <h3>{{results.ir_stances_assertive_style_title}}</h3>
                                <p>{{results.ir_stances_assertive_style_content}}</p>
                                <h3>{{results.ir_stances_dutiful_style_title}}</h3>
                                <p>{{results.ir_stances_dutiful_style_content}}</p>
                                <h3>{{results.ir_stances_assertive_withdrawn_style_title}}</h3>
                                <p>{{results.ir_stances_assertive_withdrawn_style_content}}</p>
                            </div>
                        </div>

                        <h3>{{results.ir_stances_title}}</h3>
                        <ul class="limit-padding mb-0">
                            <li v-for="(item, index) in results.ir_stances_items" :key="index">
                                <p class="mb-0" v-html="item"></p>
                            </li>
                        </ul>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()">
                        <h2>{{results.s8_title}}</h2>
                        <div v-html="results.s8_content"></div>
                        <img src="/images/results/Enneagram_Diagram_Triads-07.png" alt="Enneagram harmonic triad" class="img-restrict-width d-md-none">
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <h3>{{results.nc_harmonic_reactive_style_title}}</h3>
                                <ul class="limit-padding">
                                    <li v-for="(item, index) in results.nc_harmonic_reactive_style_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                                <h3>{{results.nc_harmonic_logical_title}}</h3>
                                <ul class="limit-padding">
                                    <li v-for="(item, index) in results.nc_harmonic_logical_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                                <h3>{{results.nc_harmonic_optimistic_title}}</h3>
                                <ul class="limit-padding">
                                    <li v-for="(item, index) in results.nc_harmonic_optimistic_items" :key="index">
                                        <p class="mb-0">{{item}}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 align-self-center">
                                <img src="/images/results/Enneagram_Diagram_Triads-07.png" alt="Enneagram harmonic triad" class="img-restrict-width d-none d-md-block">
                                <div class="boxed-label-section">
                                    <h3>{{results.conflict_triggers_title}}</h3>
                                    <p class="mb-0">{{results.conflict_triggers_content}}</p>
                                </div>
                            </div>
                        </div>
                    </CategoryContent>

                    <CategoryContent v-if="isHighScore()" last>
                        <div class="boxed-label-title-holder">
                            <h2 class="boxed-label-title">{{results.next_steps_title}}</h2>
                        </div>
                        <div class="boxed-label-section boxed-label-section-next-steps">
                            <h3 class="mb-0 number-callout"><span>1. </span>{{results.next_steps_grow_together_title}}</h3>
                            <p class="number-callout">{{results.next_steps_grow_together_content}}</p>
                            <h3 class="mb-0 number-callout"><span>2. </span>{{results.next_steps_unsure_of_your_results_title}}</h3>
                            <p class="number-callout">{{results.next_steps_unsure_of_your_results_content}}</p>
                            <h3 class="mb-0 number-callout"><span>3. </span>{{results.next_steps_hire_a_coach_title}}</h3>
                            <p class="mb-0 number-callout">{{results.next_steps_hire_a_coach_content}}</p>
                        </div>
                    </CategoryContent>

                </div>
            </transition>
        </div>

        <div v-show="results.title">
            <Footer ></Footer>
        </div>
    </div>
</template>

<script>
import helpers from '../helpers';

export default {
    data() {
        return {
            scores: {
                t1: 0,
                t2: 0,
                t3: 0,
                t4: 0,
                t5: 0,
                t6: 0,
                t7: 0,
                t8: 0,
                t9: 0,
            },
            results: {},
        }
    },
    methods: {
        isHighScore() {
            return helpers.isHighScore(this.scores) === this.$route.name.replace('type', 't');
        },
        highScoreType() {
            return helpers.isHighScore(this.scores) === this.$route.name.replace('type', 't') ? this.$route.name.replace('type', '') : 0;
        },
        currentType() {
            return this.$route.name.replace('type', '');
        },
    },
    mounted() {
        if (typeof this.$route.query === 'object' && Object.keys(this.$route.query).length > 0) {
            let queryParams = {};
            Object.keys(this.$route.query).map(query => {
                queryParams[query] = parseInt(this.$route.query[query]);
            });

            this.scores = queryParams;

            axios
                .get(`/results/type/${this.$route.name.replace('type', '')}/${this.highScoreType()}`)
                .then(response => {
                    this.results = response.data;
                });
        }
    },
}
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    html {
        background: $onsite-white;
    }

    .metric-chart-holder {
        max-width: 1200px;
        padding: 3rem 1rem 1.5rem;
        margin: 0 auto;

        .metric-chart-holder-heading {
            max-width: 887px;
            display: block;
            margin: 0 auto;
        }

        h2 {
            font-size: 3.1rem;

            @media only screen and (max-width: 890px) {
                font-size: 2.25rem;
            }

            @media only screen and (max-width: 663px) {
                font-size: 2.1rem;
            }

            @media only screen and (max-width: 624px) {
                font-size: 2rem;
            }

            @media only screen and (max-width: 597px) {
                font-size: 1.8rem;
            }

            @media only screen and (max-width: 513px) {
                font-size: 1.5rem;
            }

            @media only screen and (max-width: 433px) {
                font-size: 1.85rem;
            }
        }

        p {
            font-weight: 600;
        }

        .mh-chart-section {
            position: relative;
            max-width: 300px;
            margin: 0 auto;
        }
    }
</style>
