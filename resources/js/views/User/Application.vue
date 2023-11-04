<template>
    <UserLayout>
        <FormApplication></FormApplication>
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
};
</script>
