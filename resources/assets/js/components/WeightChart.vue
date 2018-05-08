<template>
    <div>
        <div>
            <canvas id="weight-chart" height="300"></canvas>
        </div>
        <div>
            <div class="btn-group btn-group-sm btn-group-toggle" role="group" data-toggle="buttons">
                <weight-filter @click.native="fetchData(0)">ALLE</weight-filter>
                <weight-filter @click.native="fetchData(365)">1J</weight-filter>
                <weight-filter @click.native="fetchData(180)" :active="true">6M</weight-filter>
                <weight-filter @click.native="fetchData(30)">1M</weight-filter>
                <weight-filter @click.native="fetchData(7)">1W</weight-filter>
            </div>
        </div>
    </div>
</template>

<script>
    Vue.component('weight-filter', require('./WeightFilter.vue'));

    import Chart from 'chart.js';

    export default {
        methods: {
            fetchData(days) {
                axios.get('/graphData/' + days).then((response) => {
                    this.render(response.data);
                });
            },

            render(input) {
                const min = Number.parseInt(input.minWeight) - 2;
                const max = Number.parseInt(input.maxWeight) + 2;
                const step = Number.parseInt((max - min) / 10);

                const canvas = document.querySelector('#weight-chart').getContext('2d');

                new Chart(canvas, {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: 'Gewichtsverlauf',
                            data: input.data,
                            lineTension: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                type: 'time',
                                display: true,
                                distribution: 'linear',
                                time: {
                                    unit: 'day',
                                    displayFormats: {
                                        day: 'DD.MM.YYYY'
                                    }
                                },
                                ticks: {
                                    autoSkip: true
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    min: min,
                                    max: max,
                                    stepSize: step,
                                    autoSkip: true
                                }
                            }]
                        }
                    }
                });


            }
        },

        mounted() {
            Bus.$on('updateGraph', this.fetchData);
            this.fetchData(180);
        }

    }
</script>
