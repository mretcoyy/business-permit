<template>
    <UserLayout>
        <a-card>
            <div style="margin-bottom: 10px; display: flex">
                <h1>My Application</h1>
                <a-button
                    style="margin-left: 20px"
                    type="primary"
                    @click="viewPage('/user/application')"
                >
                    <a-icon type="plus" />
                    New Application</a-button
                >
            </div>
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
                    <!-- <a-tag
                        v-for="tag in Status"
                        :key="tag"
                        :color="
                            tag === 'approval'
                                ? 'volcano'
                                : tag === 'for approval'
                                ? 'geekblue'
                                : 'green'
                        "
                    >
                        {{ tag.toUpperCase() }}
                    </a-tag> -->
                </span>
                <span slot="action" slot-scope="text, record">
                    <a @click="view(record.business_id)">View </a>
                </span>
            </a-table>
        </a-card>
        <FormBusinessView :modal="formModal" @refresh="refreshTable" />
    </UserLayout>
</template>
<script>
import FormBusinessView from "../../components/FormBusinessView.vue";
import UserLayout from "../../layouts/UserLayout";

const columns = [
    {
        title: "Business Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Business Address",
        dataIndex: "address",
        key: "address",
    },
    {
        title: "Status",
        key: "Status",
        dataIndex: "Status",
        scopedSlots: { customRender: "Status" },
    },
    {
        title: "Action",
        key: "action",
        dataIndex: "action",
        scopedSlots: { customRender: "action" },
    },
];

const data = [];

export default {
    data() {
        return {
            data,
            columns,
            formModal: { show: false },
            userId: this.$root.$children[0].user.id,
            filters: {
                user_id: "",
                business_id: "",
            },
        };
    },
    components: {
        UserLayout,
        FormBusinessView,
    },
    created() {
        this.filters.user_id = this.$store.state.user.id;
    },
    methods: {
        viewPage(url) {
            if (url) window.location.href = url;
        },
        refreshTable() {
            this.getData();
            this.formModal = { show: false };
        },
        formatData(data) {
            let map = data.map((item) => {
                const container = {};
                container.referenceNo = item.referenceNo;
                container.name = item.businessInformation.taxPayerBname;
                container.tax_payer = item.businessInformation.taxPayerFullname;
                container.address = item.businessInformation.BAddress;
                container.Status = item.businessDetail.business_status;
                container.business_id = item.businessDetail.business_id;
                return container;
            });
            return map;
        },
        async getData() {
            const res = await axios.get("/bplo/list", {
                params: {
                    filters: this.filters,
                },
            });
            this.data = this.formatData(res.data.data);
        },
        async view(business_id) {
            this.filters.business_id = business_id;
            const res = await axios.get("/bplo/list", {
                params: {
                    filters: this.filters,
                },
            });
            let data = res.data.data;
            this.formModal = { show: true, data };
        },
    },
    mounted() {
        this.filters.user_id = this.$store.state.user.id;

        if (this.filters.user_id != "") {
            this.getData();
        }
    },
};
</script>
