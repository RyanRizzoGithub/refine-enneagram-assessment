<template>
    <div class="list positive-list">
        <h5 class="title" :class="{ 'title-right': right }">{{listTitle}}</h5>
        <ul class="factor-list" :class="{'factor-list-right': right}">
            <li v-for="(factorItem, index) in listItems"
                :key="index"
                class="list-item"
                :class="{
                    'list-item-positive': listIsPositive && scores[factorItem.score] > 0,
                    'list-item-negative': !listIsPositive && scores[factorItem.score] > 0,
                    'list-item-high': scores[factorItem.score] >= 50,
                    'list-item-medium': scores[factorItem.score] >= 25 && scores[factorItem.score] < 50,
                    'list-item-low': scores[factorItem.score] > 1 && scores[factorItem.score] < 25,

                }">
                {{factorItem.title}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            listItems: {
                type: Array,
                required: true,
                default: () => [],
            },
            listTitle: {
                type: String,
                required: true,
                default: '',
            },
            right: {
                type: Boolean,
                default: false,
            },
            scores: {
                type: Object,
                required: true,
            },
        },
        computed: {
            listIsPositive() {
                return this.listTitle === 'Positive';
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .factor-list {
        padding: 0;
        margin: 0;
        color: #D0D0D0;
        list-style: none;
        overflow: hidden;
        padding: 0 3rem;
    }

    .title {
        padding: 0 3rem;

        @media only screen and (max-width: 575px) {
            text-align: center;
        }
    }

    .title-right {
        text-align: right;

        @media only screen and (max-width: 575px) {
            text-align: center;
        }
    }

    .factor-list-right {
        text-align: right;

        @media only screen and (max-width: 575px) {
            text-align: left;
        }
    }

    .list-item {
        position: relative;
        margin-bottom: 1rem;
        line-height: 1rem;
        font-size: 1rem;

        &:after,
        &:before {
            font-size: 3rem;
            position: absolute;
            line-height: 1rem;
            top: 0;
        }
    }

    .list-item-positive {
        color: $sda-light-blue;

        &.list-item-high:after {
            color: #79BF0D;
        }

        &.list-item-medium:after {
            color: #D6E40E;
        }

        &.list-item-low:after {
            color: #FCF928;
        }

        &:after {
            content: "+";
            right: -1.75rem;

            @media only screen and (max-width: 575px) {
                left: -1.75rem;
                right: none;
            }
        }
    }

    .list-item-negative {
        color: #99001C;

        &.list-item-high:before {
            color: #99001C;
        }

        &.list-item-medium:before {
            color: #E37A20;
        }

        &.list-item-low:before {
            color: #EACF15;
        }

        &:before {
            content: "-";
            left: -1.75rem;
            transform: translateY(-.25rem);
        }
    }
</style>
