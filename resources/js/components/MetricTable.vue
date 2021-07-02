<template>
    <div class="metrix-table">
        <ul class="metrix-table-list">
            <li class="metrix-table-list-item dot-1">
                <ul>
                    <li class="metric-title">Planning - Clarity around your vision and specific milestones that lead to fulfilling your vision.</li>
                    <li class="metric-score"><span>{{scores.m1}}</span></li>
                </ul>
            </li>
            <li class="metrix-table-list-item dot-2">
                <ul>
                    <li class="metric-title">Execution - Alignment across your team and systems so you can grow healthily and deliver predictable, high quality results.</li>
                    <li class="metric-score"><span>{{scores.m2}}</span></li>
                </ul>
            </li>
            <li class="metrix-table-list-item dot-3">
                <ul>
                    <li class="metric-title">Results - Predictable scalability from good decision making based on proper performance data in every area of your business.</li>
                    <li class="metric-score"><span>{{scores.m3}}</span></li>
                </ul>
            </li>
            <li class="metrix-table-list-item dot-4">
                <ul>
                    <li class="metric-title">Self - Your ability to show up as the best version of yourself so you can win at both work and life.</li>
                    <li class="metric-score"><span>{{scores.m4}}</span></li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        scores: Object
    },
}
</script>

<style lang="scss" scoped>
    @import '@/sass/_global_variables';

    .metrix-table-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;

        @media only screen and (max-width: 767px) {
            padding-top: 2rem;
        }

        & > ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .metric-title {
            width: 100%;
            float: left;
            padding: .5rem;
            font-size: .8rem;
            font-weight: 600;
            padding-left: 36px;
        }

        .metric-score {
            width: 3rem;
            float: left;
            border-left: 1px solid $mh-yellow;
            padding: .5rem;
            font-weight: 600;
            text-align: center;
            display: flex;
            align-items: center;

            span {
                width: 100%;
            }
        }

        .metric-overall {
            font-size: 1.2rem;
        }

        .metrix-table-list-item {
            display: inline-block;
            width: 100%;
            border-bottom: 1px solid $mh-yellow;
            float: left;
            position: relative;

            &:last-of-type {
                border-bottom: none;
            }

            ul {
                list-style: none;
                padding-left: 0;
                margin-bottom: 0;
                display: flex;
                align-items: stretch;
                width: 100%;
                float: left;
            }
        }
    }

    .dot-1 ul .metric-title:before,
    .dot-2 ul .metric-title:before,
    .dot-3 ul .metric-title:before,
    .dot-4 ul .metric-title:before {
        content: '';
        height: 12px;
        width: 12px;
        display: block;
        position: absolute;
        border-radius: 6px;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
    }

    .dot-1 ul .metric-title:before {
        background: rgba(108, 82, 136, .8);
    }

    .dot-2 ul .metric-title:before {
        background: rgba(108, 82, 136, .6);
    }

    .dot-3 ul .metric-title:before {
        background: rgba(108, 82, 136, .4);
    }

    .dot-4 ul .metric-title:before {
        background: rgba(108, 82, 136, .2);
    }

</style>
