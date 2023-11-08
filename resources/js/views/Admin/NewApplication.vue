<template>
    <MainLayout>
        <FormApplication
            @onDone="handleDone"
            :is_admin="true"
        ></FormApplication>
    </MainLayout>
</template>

<script>
import FormApplication from "../../components/FormApplication.vue";
import MainLayout from "../../layouts/MainLayout";

export default {
    components: {
        FormApplication,
        MainLayout,
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
