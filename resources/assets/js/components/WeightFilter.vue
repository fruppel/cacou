<template>
    <label class="btn btn-outline-secondary" :class="{ active: isActive }">
        <input type="radio" name="days" autocomplete="off"> <slot></slot>
    </label>
</template>

<script>
    export default {
        props: ['active'],

        data() {
            return {
                isActive: false
            };
        },

        mounted() {
            this.isActive = this.active;
        }
    }
</script>
