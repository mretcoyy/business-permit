<template>
    <MainLayout>
        <a-card>
            <h1>Mayor`s Permit</h1>
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
                    <a @click="print(text.business_id)">Print</a>
                </span>
            </a-table>
        </a-card>

        <FormMayorsPermit
            :modal="formModal"
            @refresh="refreshTable"
            @onSubmit="handleSubmit($event)"
        />
    </MainLayout>
</template>
<script>
import FormMayorsPermit from "../../components/FormMayorsPermit.vue";
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
            form: {},
            search: "",
            filters: {
                business_id: "",
                search_keyword: "",
                status: 1,
                business_status: 17,
            },
        };
    },
    components: {
        MainLayout,
        FormMayorsPermit,
    },
    methods: {
        async refreshTable() {
            const res = await axios.patch(
                "/bplo/changeStatus/" + this.filters.business_id,
                {
                    status: 2,
                }
            );
            this.filters = {
                search_keyword: "",
                status: 1,
                business_status: 17,
            };
            this.getData();
            this.formModal = { show: false };
        },
        handleSubmit(e) {
            this.filters = {
                search_keyword: "",
                status: 1,
                business_status: 17,
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
                container.address = item.businessInformation.taxPayerFname;
                container.Status = item.businessDetail.status;
                container.business_id = item.businessDetail.business_id;
                container.bin = item.businessDetail.bin;
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
            this.filters = {
                search_keyword: this.search,
                status: 1,
                business_status: 17,
            };
            this.getData();
        },
        async print(business_id) {
            this.formModal = { show: true, business_id };
            this.filters.business_id = business_id;
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
