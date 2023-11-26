<template>
    <MainLayout>
        <a-card>
            <h1>Report</h1>
            <a-form :form="form">
                <a-row :gutter="16">
                    <a-col :span="5">
                        <a-form-item label="Business Type:">
                            <a-radio-group v-decorator="['status']">
                                <a-radio-button value="1"> New </a-radio-button>
                                <a-radio-button value="2">
                                    Renewal
                                </a-radio-button>
                            </a-radio-group>
                        </a-form-item>
                    </a-col>
                    <a-col :span="5">
                        <a-form-item label="Year:">
                            <a-select
                                v-decorator="['year']"
                                style="width: 100%"
                                placeholder="Year"
                                :options="years"
                            >
                            </a-select>
                        </a-form-item>
                    </a-col>
                    <a-col :span="5" style="margin-top: 39px">
                        <a-button
                            style="margin-bottom: 10px"
                            @click="handleSearch"
                        >
                            Search
                        </a-button>
                    </a-col>
                </a-row>
            </a-form>
            <br />
            <a-table
                :columns="columns"
                :data-source="data"
                rowKey="business_id"
                :scroll="{ x: 2000 }"
                :expand-column-width="100"
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
            <br />
            <div style="display: flex; justify-content: end">
                <a-button
                    style="margin-bottom: 10px"
                    @click="handleReport"
                    :disabled="data.length == 0"
                >
                    <download-excel
                        :data="data"
                        name="report.xls"
                        :fields="data_fields"
                        >Export</download-excel
                    >
                </a-button>
            </div>
        </a-card>
    </MainLayout>
</template>
<script>
import MainLayout from "../../layouts/MainLayout";
import JsonExcel from "vue-json-excel";

const columns = [
    {
        title: "Business Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Business Address",
        dataIndex: "business_address",
        key: "business_address",
    },
    {
        title: "Tax Payor Name",
        dataIndex: "tax_payer",
        key: "tax_payer",
    },
    {
        title: "Tax Payor Address",
        dataIndex: "address",
        key: "address",
    },
    {
        title: "BIN",
        dataIndex: "bin",
        key: "bin",
    },
    {
        title: "Date Renewed",
        dataIndex: "date_renewed",
        key: "date_renewed",
    },
    {
        title: "Organization Type",
        dataIndex: "organization_type",
        key: "organization_type",
    },
    {
        title: "Owner Name",
        dataIndex: "owner_name",
        key: "owner_name",
    },
    {
        title: "Owner Address",
        dataIndex: "owner_address",
        key: "owner_address",
    },
    {
        title: "No. of Employees",
        dataIndex: "number_of_employees",
        key: "number_of_employees",
    },
    {
        title: "Status",
        key: "Status",
        dataIndex: "Status",
        scopedSlots: { customRender: "Status" },
    },
];

const data = [];
import { ref } from "vue";
export default {
    data() {
        return {
            form: this.$form.createForm(this),
            fields: ["status", "year"],
            data,
            columns,
            formModal: { show: false },
            filters: {
                business_id: "",
                business_status: 16,
                status: 1,
            },
            search: "",
            data_fields: {
                "Business Name": "name",
                "Business Address": "business_address",
                "Tax Payor": "tax_payer",
                "Tax Payor Address": "owner_address",
                BIN: "bin",
                "Date Renewed": "date_renewed",
                "Organization Type": "organization_type",
                "Owner Name": "owner_name",
                "Owner Address": "owner_address",
                "No. :of Employees": "number_of_employees",
                Status: "Status",
            },
        };
    },
    components: {
        MainLayout,
        JsonExcel,
    },
    methods: {
        handleReport() {},
        async handleSearch() {
            this.filters = {
                year: this.form.getFieldValue("year"),
                business_type: this.form.getFieldValue("status"),
            };
            const res = await axios.get("/report/list", {
                params: {
                    filters: this.filters,
                },
            });
            this.data = this.formatData(res.data.data);
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
                container.status = item.businessDetail.status;
                return container;
            });
            return map;
        },
    },
    computed: {
        years() {
            let min = new Date().getFullYear();
            let years = [];
            let min_year = min - 9;
            let count = 0;
            for (var i = min_year; i <= min; i++) {
                years.push({
                    value: i.toString(),
                    label: i.toString(),
                });
            }
            return years;
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
