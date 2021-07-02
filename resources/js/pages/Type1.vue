<template>
    <div class="results">
        <Header :scores="scores">
            <ProgressBar :percentage="100" :absolute="false"></ProgressBar>
        </Header>
        <div class="content">
            <CategoryContent first>
                <h1 class="text-center text-uppercase"><span>How You Scored Across All Nine Enneagram Types</span></h1>
                <CategoryBarGraph :scores="scores"></CategoryBarGraph>
                <div class="text-center" v-if="isHighScore()">
                    <a href="/pdfs/type-1-D7KyBniZ7FkelhHx.pdf" class="btn btn-primary" target="_blank" rel="noopener noreferrer">Download Type 1 Report</a>
                </div>
            </CategoryContent>
        </div>
        <Footer></Footer>
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
        }
    },
    methods: {
        isHighScore() {
            return helpers.isHighScore(this.scores) === this.$route.name.replace('type', 't');
        }
    },
    mounted() {
        if (typeof this.$route.query === 'object' && Object.keys(this.$route.query).length > 0) {
            let queryParams = {};
            Object.keys(this.$route.query).map(query => {
                queryParams[query] = parseInt(this.$route.query[query]);
            });

            this.scores = queryParams;
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
