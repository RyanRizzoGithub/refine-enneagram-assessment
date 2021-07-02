<template>
    <div class="graph-holder">
        <div class="graph-container">
            <div class="bars">
                <div><span>0-25%</span></div>
                <div><span>26-50%</span></div>
                <div><span>51-75%</span></div>
                <div><span>76-100%</span></div>
            </div>
            <div class="graph-content">
                <div class="type" v-for="(category, index) in sortedCategories" :key="index">
                    <div class="label">
                        <div>
                            <a :href="`/${category.slug}${queryParams}`" :class="{'high-score': isHighScore() === category.category, 'current-page': $route.name === category.slug}">{{ category.title }}</a>
                        </div>
                    </div>
                    <div class="bar">
                        <span :style="{width: `${scores[category.category]}%`}"></span>
                    </div>
                    <div class="rate">{{scores[category.category]}}%</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import helpers from '../helpers';

    export default {
        props: {
            scores: {
                type: Object,
                required: true,
            },
        },
        data() {
            return {
                categories: [
                    {
                        title:"TYPE 1 - Perfectionist",
                        category: 't1',
                        slug: 'type1',
                    },
                    {
                        title:"TYPE 2 - Helper",
                        category: 't2',
                        slug: 'type2',
                    },
                    {
                        title:"TYPE 3 - Achiever",
                        category: 't3',
                        slug: 'type3',
                    },
                    {
                        title:"TYPE 4 - Individualist",
                        category: 't4',
                        slug: 'type4',
                    },
                    {
                        title:"TYPE 5 - Investigator",
                        category: 't5',
                        slug: 'type5',
                    },
                    {
                        title:"TYPE 6 - Loyalist",
                        category: 't6',
                        slug: 'type6',
                    },
                    {
                        title:"TYPE 7 - Enthusiast",
                        category: 't7',
                        slug: 'type7',
                    },
                    {
                        title:"TYPE 8 - Challenger",
                        category: 't8',
                        slug: 'type8',
                    },
                    {
                        title:"TYPE 9 - Peacemaker",
                        category: 't9',
                        slug: 'type9',
                    }
                ],
                queryParams: '',
            }
        },
        computed: {
            sortedCategories() {
                return this.categories.sort((a, b) => this.scores[b.category] - this.scores[a.category]);
            }
        },
        mounted() {
            if (typeof this.$route.query === 'object' && Object.keys(this.$route.query).length > 0) {
                this.queryParams = this.$route.fullPath.replace(this.$route.path, '');
            }
        },
        methods: {
            isHighScore() {
                return helpers.isHighScore(this.scores);
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .graph-holder {
        margin: 1rem auto;
        max-width: 687px;
        width: 100%;
        padding-top: 1.5rem;

        @media only screen and (max-width: 705px) {
            max-width: 292px;
        }
    }

    .graph-container {
        position: relative;
        text-align: center;
        display: block;
        width: 100%;

        .background {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .bars {
            position: absolute;
            display: flex;
            top: 0;
            right: 75px;
            bottom: 0;
            width: 395px;
            color: #000;
            font-size: 12px;
            font-weight: 600;
            z-index: 1;
            text-align: center;

            @media only screen and (max-width: 705px) {
                display: none;
            }

            span {
                position: relative;
                top: -2rem;
            }

            > div {
                flex: 1;
                padding: 10px 0;

                &:nth-child(1) {
                    margin-right: 1px;
                    background: #ECECEC;
                }

                &:nth-child(2) {
                    margin-right: 1px;
                    background: #DDDDDD;
                }

                &:nth-child(3) {
                    margin-right: 1px;
                    background: #CBCBCB;
                }

                &:nth-child(4) {
                    background: #B0B0B0;
                }
            }
        }

        .graph-content {
            position: relative;
            z-index: 2;

            .type {
                display: flex;

                .label {
                    flex: 1;
                    padding: 0 10px;
                    font-size: 18px;
                    font-weight: 600;
                    text-align: right;

                    @media only screen and (max-width: 326px) {
                        padding: 0 10px 0 0;
                    }

                    div {
                        display: inline-block;

                        a {
                            display: block;
                            color: inherit;
                            font-weight: 600;
                            line-height: 1.2em;
                            margin: 0.3em 0;
                            text-align: right;

                            &.high-score {
                                color: $ts-red;
                            }

                            &.current-page {
                                text-decoration: underline;
                            }
                        }

                        small {
                            position: absolute;
                            top: 10px;
                            display: block;
                            font-size: 10px;
                            font-weight: 600;
                            color: #f1c40f;
                            line-height: 0.5;
                        }
                    }
                }

                &.result1:first-child {
                    color: #3a6c40;
                }

                .bar {
                    display: flex;
                    padding: 7px 0px;
                    width: 395px;

                    span {
                        background: #fff;
                        max-height: 18px;
                    }

                    @media only screen and (max-width: 705px) {
                        display: none;
                    }
                }

                .rate {
                    padding: 0 10px;
                    width: 75px;
                    text-align: left;
                    font-size: 18px;
                    font-weight: 600;

                    @media (min-width: 769px) {
                        color: #212529 !important;
                    }
                }
            }
        }
    }
</style>
