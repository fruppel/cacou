<template>
    <div class="d-flex">
        <div class="mr-auto p-2">
            <a class="btn btn-secondary" :href="prevUrl"><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="p-2">
            <input type="date" id="datepicker" v-model="currentDate" @change="update">
        </div>
        <div class="ml-auto p-2">
            <a class="btn btn-secondary" :href="nextUrl"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: ['date'],

        data() {
            return {
                currentDate: this.date,
                nextUrl: '/diary/' + moment(this.date).add(1, 'day').format('YYYY-MM-DD'),
                prevUrl: '/diary/' + moment(this.date).subtract(1, 'day').format('YYYY-MM-DD'),
            };
        },

        methods: {
            update() {
                if (moment(this.currentDate).isValid()) {
                    location.href = '/diary/' + this.currentDate;
                }
            }
        }
    }
</script>