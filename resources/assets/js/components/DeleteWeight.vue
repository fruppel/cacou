<template>
    <span class="action" @click="action">
        <i class="far fa-trash-alt"></i>
    </span>
</template>

<script>
    export default {
        props: ['url'],

        methods: {
            action() {
                if (confirm('Wirklich löschen?')) {
                    axios.delete(this.url);
                    this.$emit('deleted');
                }
            }
        }
    }
</script>
