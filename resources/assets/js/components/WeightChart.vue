<template>
    <div>
        <div>
            <canvas id="weight-chart" height="300"></canvas>
        </div>
        <div>
            <div class="btn-group btn-group-sm btn-group-toggle" role="group" data-toggle="buttons">
                <label class="btn btn-outline-secondary" @click="fetchData(0)">
                    <input type="radio" name="days" autocomplete="off"> ALLE
                </label>
                <label class="btn btn-outline-secondary" @click="fetchData(365)">
                    <input type="radio" name="days" autocomplete="off"> 1J
                </label>
                <label class="btn btn-outline-secondary active" @click="fetchData(180)">
                    <input type="radio" name="days" autocomplete="off"> 6M
                </label>
                <label class="btn btn-outline-secondary" @click="fetchData(30)">
                    <input type="radio" name="days" autocomplete="off"> 1M
                </label>
                <label class="btn btn-outline-secondary" @click="fetchData(7)">
                    <input type="radio" name="days" autocomplete="off"> 1W
                </label>
            </div>
        </div>
    </div>
</template>

<script>
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
