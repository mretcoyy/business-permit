<template>
    <UserLayout>
        <FormApplication @onDone="handleDone"></FormApplication>
    </UserLayout>
</template>

<script>
import FormApplication from "../../components/FormApplication.vue";
import UserLayout from "../../layouts/UserLayout";

export default {
    components: {
        FormApplication,
        UserLayout,
    },
    methods: {
        handleDone() {
            const h = this.$createElement;
            this.$success({
                title: "Application has been submitted!",
                onOk() {
                    window.location.href = "/user/dashboard";
                },
            });
        },
    },
};
</script>
