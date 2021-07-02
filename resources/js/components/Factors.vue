<template>
  <div class="factors">
    <h4 class="title">Factors</h4>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <FactorList listTitle="Positive" :listItems="postiveList" :scores="scores" right></FactorList>
            </div>
            <div class="col-12 col-sm-6">
                <FactorList listTitle="Negative" :listItems="negativeList" :scores="scores"></FactorList>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
    export default {
        props: {
            postiveList: {
                type: Array,
                required: true,
                default: () => [],
            },
            negativeList: {
                type: Array,
                required: true,
                default: () => [],
            },
            scores: {
                type: Object,
                required: true,
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .factors {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 4.5rem;
    }

    .title {
        color: $sda-light-blue;
        font-weight: 900;
        text-align: center;
        padding: 0;
        margin: 0 0 2rem;
    }

    .row > div {
        padding: 0;
        margin: 0;

        @media only screen and (max-width: 575px) {
            padding: 1rem 0;
        }



        &:first-of-type {
            border-right: 1px solid #F9F9F9;

            @media only screen and (max-width: 575px) {
                padding: 0 0 1rem;
                border-right: none;
                border-bottom: 1px solid #F9F9F9;
            }
        }

        &:last-of-type {
            border-left: 1px solid #DFDFDF;

            @media only screen and (max-width: 575px) {
                padding: 1rem 0 0;
                border-left: none;
                border-top: 1px solid #DFDFDF;
            }
        }

        .list ::v-deep .factor-list {
            list-style: none;

            &.positive-list {
                padding-right: 3rem;
            }

            &.negative-list {
                padding-left: 3rem;
            }
        }
    }
</style>
