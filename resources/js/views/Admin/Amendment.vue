<template>
    <MainLayout>
        <a-card>
            <h1>Amendment Applications</h1>
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
                    <a @click="view(text.business_id)">Amend</a>
                </span>
            </a-table>
        </a-card>
        <FormAmendment
            :modal="formModal"
            @refresh="refreshTable"
            @onSubmit="handleSubmitAmendment($event)"
        />
    </MainLayout>
</template>
<script>
import FormAmendment from "../../components/FormAmendment.vue";
import MainLayout from "../../layouts/MainLayout";

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
            filters: {
                business_id: "",
                status: 2,
            },
        };
    },
    components: {
        MainLayout,
        FormAmendment,
    },
    methods: {
        refreshTable() {
            this.filters = {
                business_id: "",
                status: 2,
            };
            this.getData();
            this.formModal = { show: false };
        },
        handleSubmitAmendment(e) {
            this.filters = {
                business_id: "",
                status: 2,
            };
            this.getData();
            this.formModal.show = e;
        },
        formatData(data) {
            let map = data.map((item) => {
                const container = {};
                container.referenceNo = item.referenceNo;
                container.name = item.businessInformation.taxPayerBname;
                container.tax_payer = item.businessInformation.taxPayerFullname;
                container.address = item.businessInformation.BAddress;
                container.Status = item.businessDetail.status;
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
            // .then(function (response) {})
            // .catch(function (error) {});
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
        this.getData();
    },
};
</script>
