<template>
    <canvas id="weight-chart" height="75"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {

        props: ['labels', 'values'],

        mounted() {

            const canvas = document.querySelector('#weight-chart').getContext('2d');

            const data = {
                labels: this.labels,

                datasets: [
                    {
                        data: this.values
                    }
                ]
            };

            new Chart(canvas, {
                type: 'line',
                data: data
            });

        }

    }
</script>
