<template>
    <MainLayout>
        <a-card>
            <h1>Dashboard</h1>
            <div style="padding: 30px">
                <a-row :gutter="16" justify="space-between">
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 1 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="money-collect" />
                                Total Income Generated
                            </template>
                            <h1 class="text-data">
                                {{ data.total_income_generated }}
                            </h1>
                        </a-card>
                    </a-col>
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 2 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="money-collect" />
                                Total Funds
                            </template>
                            <h1 class="text-data">{{ data.total_funds }}</h1>
                        </a-card>
                    </a-col>
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 2 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="user" />
                                Total No. of Applicants
                            </template>
                            <h1 class="text-data">
                                {{ data.total_number_applicants }}
                            </h1>
                        </a-card>
                    </a-col>
                </a-row>
                <a-row
                    :gutter="16"
                    style="margin-top: 10px"
                    justify="space-between"
                >
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 1 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="folder-open" />
                                No. of Pending Applicants
                            </template>
                            <h1 class="text-data">
                                {{ data.number_pending_applicants }}
                            </h1>
                        </a-card>
                    </a-col>
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 2 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="folder-open" />
                                No. of Renewals
                            </template>
                            <h1 class="text-data">
                                {{ data.number_renewals }}
                            </h1>
                        </a-card>
                    </a-col>
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 2 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="file" />
                                No. of Ongoing Applications
                            </template>
                            <h1 class="text-data">
                                {{ data.number_ongoing_applications }}
                            </h1>
                        </a-card>
                    </a-col>
                </a-row>
                <a-row
                    :gutter="16"
                    style="margin-top: 10px"
                    justify="space-between"
                >
                    <a-col
                        :xs="{ span: 5, offset: 1 }"
                        :lg="{ span: 6, offset: 1 }"
                    >
                        <a-card :bordered="true">
                            <template #title>
                                <a-icon type="check" />
                                No. of Approved Applications
                            </template>
                            <h1 class="text-data">
                                {{ data.number_approved_applications }}
                            </h1>
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

<style>
.text-data {
    font-size: 1.5rem;
}
</style>
