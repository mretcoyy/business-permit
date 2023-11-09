<template>
    <MainLayout>
        <a-card>
            <h1>Tax Computations</h1>
            <a-row :gutter="16">
                <a-col :span="8">
                    <a-input-search
                        v-model="search"
                        placeholder="Input BIN"
                        enter-button="Search"
                        size="large"
                        @search="onSearch"
                    />
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
        <FormFees
            :modal="formModal"
            @refresh="refreshTable"
            @onSubmit="handleSubmit($event)"
        />
    </MainLayout>
</template>
<script>
import FormFees from "../../components/FormFees.vue";
import MainLayout from "../../layouts/MainLayout";

const columns = [
    {
        title: "Business Name",
        dataIndex: "name",
        key: "name",
    },
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
            form: this.$form.createForm(this),
            fields: ["search"],
            data,
            columns,
            formModal: { show: false },
            filters: {
                business_id: "",
                business_status: 15,
                status: 1,
            },
            search: "",
        };
    },
    components: {
        MainLayout,
        FormFees,
    },
    methods: {
        refreshTable() {
            this.filters = { business_id: "", search_keyword: "" };
            this.getData();
            this.formModal = { show: false };
        },
        handleSubmit(e) {
            this.filters = { business_id: "", search_keyword: "" };
            this.getData();
            this.formModal.show = e;
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
        formatDataSelect(data) {
            let map = data.map((item) => {
                const container = {};
                container.business_id = item.businessDetail.business_id;
                container.bin = item.businessDetail.bin;
                container.date_renewed = item.businessDetail.date_renewed;
                container.organization_type = item.typeOfOrganizationLabel;
                container.business_name =
                    item.businessInformation.taxPayerBname;
                container.business_address = item.businessInformation.BAddress;
                container.owner_name = item.ownerInformation.OFullname;
                container.owner_address = item.ownerInformation.OFulladdress;
                container.number_of_employees =
                    item.businessInformation.TotalNumberofEmployees;
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
        async onSearch() {
            this.filters = { search_keyword: this.search, status: 5 };
            this.getData();
        },
        async select(business_id) {
            this.filters = { business_id, status: "" };
            const res = await axios.get("/bplo/list", {
                params: {
                    filters: this.filters,
                },
            });
            let data = this.formatDataSelect(res.data.data);
            this.formModal = { show: true, data };
        },
        async confirm(id, status) {
            const res = await axios.patch("/bplo/changeStatus/" + id, {
                status: status,
            });
            this.filters = { business_id: "", search_keyword: "" };
            this.getData();
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
