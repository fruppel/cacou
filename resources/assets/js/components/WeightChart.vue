<template>
    <canvas id="weight-chart" height="300"></canvas>
</template>

<script>
    import Chart from 'chart.js';


    export default {
        methods: {
            fetchData() {
                axios.get('/graphData/1').then((response) => {
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
            this.fetchData();
        }

    }
</script>
