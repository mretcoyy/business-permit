<template>
    <MainLayout>
        <a-card>
            <h1>Dashboard</h1>
        </a-card>
    </MainLayout>
</template>
<script>
import MainLayout from "../../layouts/MainLayout";

const data = [];

export default {
    data() {
        return {
            data,
            columns,
            filters: {
                business_id: "",
                status: 1,
            },
        };
    },

    components: {
        MainLayout,
    },
    methods: {
        formatData(data) {
            let map = data.map((item) => {
                const container = {};
                return container;
            });
            return map;
        },
        async getData() {
            const res = await axios.get("/bplo/dashboard");
            this.data = this.formatData(res.data.data);
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
