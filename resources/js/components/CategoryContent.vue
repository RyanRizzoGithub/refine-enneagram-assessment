<template>
    <div class="metric-category" :class="{last, first}">
        <div class="category-content">
            <div class="container-fluid">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            first: {
                type: Boolean,
                default: false
            },
            last: {
                type: Boolean,
                default: false
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .metric-category {
        float: left;
        width: 100%;

        &.first {
            padding-top: 5rem;
            margin-top: 5rem;
        }

        &.last {
            padding-bottom: 3.5rem;
        }
    }

    .category-content {
        max-width: 925px;
        padding: 2rem 15px 1rem;
        margin: 0 auto;
        display: flex;
        margin-top: 1rem;
    }
</style>
