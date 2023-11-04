<template>
    <MainLayout>
        <a-card>
            <h1>Business Applications</h1>
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
                    <a @click="view(text.business_id)">View</a> |
                    <a-popconfirm
                        title="Sure to Approve Application?"
                        @confirm="
                            () => {
                                confirm(text.business_id, 5);
                            }
                        "
                    >
                        <a>Approve</a>
                    </a-popconfirm>
                    |
                    <a-popconfirm
                        title="Sure to Decline Application?"
                        @confirm="
                            () => {
                                confirm(text.business_id, 6);
                            }
                        "
                    >
                        <a>Decline</a>
                    </a-popconfirm>
                </span>
            </a-table>
        </a-card>
        <FormBusinessView :modal="formModal" @refresh="refreshTable" />
    </MainLayout>
</template>
<script>
import FormBusinessView from "../components/FormBusinessView.vue";
import MainLayout from "../layouts/MainLayout";

const columns = [
    {
        title: "Business Name",
        dataIndex: "name",
        key: "name",
    },
    // {
    //     title: "Age",
    //     dataIndex: "age",
    //     key: "age",
    // },
    {
        title: "Owner Name",
        dataIndex: "tax_payer",
        key: "tax_payer",
    },
    {
        title: "Address",
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
        };
    },
    components: {
        MainLayout,
        FormBusinessView,
    },
    methods: {
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
                container.address = item.businessInformation.taxPayerFname;
                container.Status = item.businessDetail.status;
                container.business_id = item.businessDetail.business_id;
                return container;
            });

            return map;
        },
        async getData() {
            let filters = {};
            const res = await axios.get("/bplo/list", {
                params: {
                    filters: filters,
                },
            });
            // .then(function (response) {})
            // .catch(function (error) {});
            this.data = this.formatData(res.data.data);
        },
        async view(business_id) {
            let filters = { business_id: business_id };
            const res = await axios.get("/bplo/list", {
                params: {
                    filters: filters,
                },
            });
            let data = res.data.data;
            this.formModal = { show: true, data };
        },
        async confirm(id, status) {
            const res = await axios.patch("/bplo/changeStatus/" + id, {
                status: status,
            });
            this.getData();
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
