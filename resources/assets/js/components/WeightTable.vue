<template>
    <table class="table">
        <tr>
            <th>Datum</th>
            <th>Gewicht</th>
            <th>Aktionen</th>
        </tr>
        <tr v-for="(weight, index) in items">
            <td>{{ formatDate(weight.created_at) }}</td>
            <td>{{ formatWeight(weight.weight) }} kg</td>
            <td><delete-weight :url="'/weight/' + weight.user_id + '/' + weight.id" @deleted="remove(index)"></delete-weight></td>
        </tr>
    </table>
 </template>

<script>
    import moment from 'moment';

    export default {
        props: ['weights'],

        data() {
            return {
                items: []
            };
        },

        mounted() {
            this.items = this.weights;
        },

        methods: {
            formatWeight(weight) {
                return new Intl.NumberFormat('de-DE', { style: 'decimal' }).format(weight);
            },

            formatDate(date) {
                return moment(date).format('DD.MM.YYYY HH:mm');
            },

            remove(index) {
                this.items.splice(index, 1);
                Bus.$emit('removedWeightRow');
            }
        }
    }
</script>
