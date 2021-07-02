<template>
    <div class="progress-container">
        <div class="show-percenatge" v-if="show">
            {{percentage}}%
        </div>
        <div class="progress" :class="{'progress-absolute': absolute}">
            <div class="progress-bar" :class="{'disable-transition': disableTransition}" role="progressbar" :style="{width: `${percentage}%`}" :aria-valuenow="percentage" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            percentage: Number,
            absolute: {
                type: Boolean,
                default: false
            },
            show: {
                type: Boolean,
                default: false
            },
            disableTransition: {
                type: Boolean,
                default: false
            },
        }
    }
</script>

<style lang="scss">
    @import '@/sass/_global_variables';

    .progress-container {
        position: relative;
    }

    .progress-absolute {
        position: absolute;
        width: 100%;
    }

    .show-percenatge {
        padding-top: .25rem;
        text-align: center;
        color: $sda-white;
        font-weight: 700;
        font-size: 1.25rem;
        line-height: 1.25rem;
        padding-bottom: .5rem;
    }

    .progress-bar {

        &.disable-transition {
            transition: none;
        }
    }
</style>
