<template>
    <canvas id="weight-chart" height="75"></canvas>
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

            render(data) {
                const canvas = document.querySelector('#weight-chart').getContext('2d');
                const chart = new Chart(canvas, {
                    type: 'line',
                    data: {
                        labels: Object.keys(data),
                        datasets: [
                            {
                                label: 'Gewicht',
                                data: Object.keys(data).map(key => data[key])
                            }
                        ]
                    }
                });
            }
        },

        mounted() {
            this.fetchData();
        }

    }
</script>
