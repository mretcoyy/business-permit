<template></template>

<script>
export default {
    props: {
        user: {
            type: Object,
        },
    },
    mounted() {
        this.$store.commit("setUser", this.user);
    },
    method: {},
};
</script>
