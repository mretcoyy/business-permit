<template>
    <MainLayout>
        <a-card>
            <h1>Dashboard</h1>
            <div style="background-color: #f2f2f2; padding: 20px">
                <a-row :gutter="16">
                    <a-col :span="8">
                        <a-card
                            title="Total Income Generated"
                            :bordered="false"
                        >
                            <p>{{ data.total_income_generated }}</p>
                        </a-card>
                    </a-col>
                    <a-col :span="8">
                        <a-card title="Total Funds" :bordered="false">
                            <p>{{ data.total_funds }}</p>
                        </a-card>
                    </a-col>
                    <a-col :span="8">
                        <a-card
                            title="Total No. of Applicants"
                            :bordered="false"
                        >
                            <p>{{ data.total_number_applicants }}</p>
                        </a-card>
                    </a-col>
                </a-row>
                <a-row :gutter="16" style="margin-top: 10px">
                    <a-col :span="8">
                        <a-card
                            title="No. of Pending Applicants"
                            :bordered="false"
                        >
                            <p>{{ data.number_pending_applicants }}</p>
                        </a-card>
                    </a-col>
                    <a-col :span="8">
                        <a-card title="No. of Renewals" :bordered="false">
                            <p>{{ data.number_renewals }}</p>
                        </a-card>
                    </a-col>
                    <a-col :span="8">
                        <a-card
                            title="No. of Ongoing Applications"
                            :bordered="false"
                        >
                            <p>{{ data.number_ongoing_applications }}</p>
                        </a-card>
                    </a-col>
                    <a-col :span="8">
                        <a-card
                            title="No. of Approved Applications"
                            :bordered="false"
                        >
                            <p>{{ data.number_approved_applications }}</p>
                        </a-card>
                    </a-col>
                </a-row>
                <a-row :gutter="16" style="margin-top: 10px">
                    <a-col :span="8">
                        <a-card
                            title="No. of Approved Applications"
                            :bordered="false"
                        >
                            <p>{{ data.number_approved_applications }}</p>
                        </a-card>
                    </a-col>
                </a-row>
            </div>
        </a-card>
    </MainLayout>
</template>
<script>
import MainLayout from "../../layouts/MainLayout";

export default {
    data() {
        return {
            data: [],
        };
    },

    components: {
        MainLayout,
    },
    methods: {
        async getData() {
            const res = await axios.get("/bplo/dashboard");
            this.data = res.data;
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
