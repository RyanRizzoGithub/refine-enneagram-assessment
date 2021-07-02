<template>
    <div>
        <div class="graph">
            <div class="ticks">
                <div class="tick" :class="{score: number === score}" v-for="(number, index) in 10" :key="index">
                    <div v-if="number === score">
                        <DownArrow></DownArrow>
                    </div>
                    {{number}}
                </div>
            </div>
            <div class="scale"></div>
            <div class="legend">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4 text-left">Improvement Needed</div>
                        <div class="col-4 text-center">Making Progress</div>
                        <div class="col-4 text-right">Excellent</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        score: {
            type: Number,
            required: true,
        },
    },
}
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .graph {
        padding: 2rem 0 4rem
    }

    .ticks {
        display: flex;
        align-items: baseline;
        font-size: 1rem;

        .tick {
            flex: 1;
            font-weight: 600;
            width: 10%;
            float: left;
            text-align: center;
            align-self: flex-end;
            padding-bottom: .5rem;
            position: relative;

            &.score {
                color: $graph-active-color;
                font-size: 2rem;
            }

            svg {
                position: absolute;
                left: 50%;
                top: -.75rem;
                transform: translateX(-50%);
            }
        }
    }

    .scale {
        height: 1.75rem;
        width: 100%;
        background: rgba(54,54,55, .3);
        background: linear-gradient(90deg, #ff6961 .0, $graph-bg-center 41%, $graph-bg-center 60%, $graph-bg-right 70%, $graph-bg-right 81%, #03c03c 91%);
        border-radius: .5rem;
    }

    .legend {
        padding-top: .5rem;
        font-weight: 600;
        display: flex;
        font-size: 1rem;

        @media only screen and (max-width: 569px) {
            font-size: .7rem;
        }

        @media only screen and (max-width: 380px) {
            font-size: .5rem;
        }

        div {
            flex: 1;

        }
    }
</style>
