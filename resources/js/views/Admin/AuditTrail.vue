<template>
    <MainLayout>
        <a-card>
            <h1>Payment</h1>
            <a-row :gutter="16">
                <a-col :span="8">
                    <a-range-picker v-model="date_range" />
                </a-col>
                <a-col :span="8">
                    <a-button type="primary" @click="handleSearch"
                        >Search</a-button
                    >
                </a-col>
            </a-row>
            <br />
            <a-table
                :columns="columns"
                :data-source="data"
                rowKey="business_id"
            >
                <span slot="Status" slot-scope="Status">
                    <a-tag
                        :color="
                            Status === 'Approved'
                                ? 'green'
                                : Status === 'Forapproval'
                                ? 'yellow'
                                : Status === 'Declined'
                                ? 'volcano'
                                : 'blue'
                        "
                        >{{
                            Status == "Forapproval" ? "For Approval" : Status
                        }}</a-tag
                    >
                </span>
                <span slot="action" slot-scope="text, record">
                    <a @click="select(text.business_id)">Select</a>
                </span>
            </a-table>
        </a-card>
    </MainLayout>
</template>
<script>
import MainLayout from "../../layouts/MainLayout";

const columns = [
    {
        title: "Business Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "BIN",
        dataIndex: "bin",
        key: "bin",
    },
    {
        title: "Type",
        dataIndex: "type",
        key: "type",
    },
    {
        title: "Status",
        dataIndex: "status",
        key: "status",
    },
    {
        title: "User",
        key: "user_name",
        dataIndex: "user_name",
    },
];

const data = [];

export default {
    data() {
        return {
            form: this.$form.createForm(this),
            fields: ["search"],
            data,
            columns,
            formModal: { show: false },
            filters: {
                date_from: "",
                date_to: "",
            },
            search: "",
            date_range: "",
        };
    },
    components: {
        MainLayout,
    },
    methods: {
        formatData(data) {
            let map = data.map((item) => {
                const container = {};
                container.name = item.businessInformation.taxPayerBname;
                container.bin = item.businessDetail.bin;
                container.type = item.type;
                container.status = item.status;
                container.user_name = item.user.name;
                return container;
            });

            return map;
        },
        async getData() {
            this.filters = {
                date_from: this.date_from,
                date_to: this.date_to,
            };
            const res = await axios.get("/bplo/audit-list", {
                params: {
                    filters: this.filters,
                },
            });

            console.log(res.data.data);
            this.data = this.formatData(res.data.data);
        },
        async handleSearch() {
            console.log(this.date_range);
            if (this.date_range) {
                let d1 = this.date_range[0]._d;
                let d2 = this.date_range[1]._d;
                let date_from = `${d1.getMonth()}-${d1.getDate()}-${d1.getFullYear()}`;
                let date_to = `${d2.getMonth()}-${d2.getDate()}-${d2.getFullYear()}`;
                this.date_from = date_from;
                this.date_to = date_to;
                this.getData();
            }
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
