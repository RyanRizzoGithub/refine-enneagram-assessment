<template>
  <div>
    <canvas id="metric-chart"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js';

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
                queryParams[query] = parseInt(this.$route.query[query]);
            });

            this.scores = queryParams;
        }

        this.createChart('metric-chart');
    },
    methods: {
        createChart(chartId) {
            const ctx = document.getElementById(chartId);
            const myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ["Planning", "Execution", "Results", "Self"],
                    datasets: [{
                        data: [
                            this.scores.m1,
                            this.scores.m2,
                            this.scores.m3,
                            this.scores.m4,
                        ],
                        spanGaps: true,
                        skipNull: false,
                        hideNull: true,
                        borderColor: 'rgba(255,255,255,.1)',
                        pointBackgroundColor: '#f37658',
                        borderWidth: 2,
                        lineTension: 0,
                        pointRadius: 7,
                        pointStyle: 'circle',
                        pointBorderColor: '#ffffff',

                        backgroundColor: [
                            'rgba(108, 82, 136, .8)',
                            'rgba(108, 82, 136, .6)',
                            'rgba(108, 82, 136, .4)',
                            'rgba(108, 82, 136, .2)',
                        ],
                    }]
                },
                options: {
                    aspectRatio: 1,
                    //startAngle: 90,
                    legend: {
                        display: false,
                        position: 'bottom',
                    },
                    title: {
                        display: false,
                        //text: 'Chart.js Radar Chart'
                    },
                    scale: {
                        ticks: {
                        beginAtZero: true,
                        steps: 10,
                        stepValue: 2,
                        max: 10
                        }
                    },
                    plugins: {
                        datalabels: {
                            formatter: function(value, context) {
                            return context.chart.data.labels[context.dataIndex];
                            },
                            anchor: 'start',
                            align: 'end',
                            offset: 0 // Gets updated
                        },
                    },
                }
            });
        }
    },
}
</script>
