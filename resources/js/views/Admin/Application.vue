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
                    <a @click="update(text)"> Update </a> |
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

        <a-modal
            title="
                     Update Gross
                    "
            v-model="modalGross.show"
            :width="800"
            @cancel="closeModalFile()"
            :maskClosable="false"
            okText="Update Gross"
            @ok="handleUpdateGross()"
        >
            <a-table
                :columns="columnsGross"
                :data-source="dataBusinessActivity"
            >
                <span slot="action" slot-scope="text, record, index">
                    <a-button
                        type="link"
                        @click="onEditBusinessActivity(record, index)"
                        >Edit</a-button
                    >
                    <!-- <a-divider type="vertical" /> -->
                    <!-- <a-popconfirm
                        title="Sure to delete?"
                        @confirm="() => onDeleteBusinessActivity(index)"
                    >
                        <a>Delete</a>
                    </a-popconfirm> -->
                </span>
            </a-table>
        </a-modal>
        <FormBusinessActivity
            :modal="formModalBussActivity"
            @refresh="refreshTable"
            @onEdit="handleEditBusinessActivity"
        />
        <FormBusinessView :modal="formModal" @refresh="refreshTable" />
    </MainLayout>
</template>
<script>
import FormBusinessActivity from "../../components/FormBusinessActivity.vue";
import FormBusinessView from "../../components/FormBusinessView.vue";
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

const columnsGross = [
    {
        dataIndex: "code",
        key: "code",
        title: "Code",
    },
    {
        dataIndex: "lineOfBusiness",
        key: "lineOfBusiness",
        title: "Line of Business",
    },
    {
        title: "No. of Units",
        dataIndex: "noOfUnits",
        key: "noOfUnits",
    },
    {
        title: "Capitalization (for new business)",
        dataIndex: "capitalization_format",
        key: "capitalization_format",
    },
    {
        title: "Essential (for renewal)",
        dataIndex: "essential_format",
        key: "essential_format",
    },
    {
        title: "Non-essential (for renewal)",
        dataIndex: "non_essential_format",
        key: "non_essential_format",
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
            columnsGross,
            formModal: { show: false },
            filters: {
                business_id: "",
                status: 2,
            },
            modalGross: { show: false },
            formModalBussActivity: { show: false },
            dataBusinessActivity: [],
            selectedBusinessId: "",
            selectedId: "",
        };
    },
    components: {
        MainLayout,
        FormBusinessView,
        FormBusinessActivity,
    },
    methods: {
        async handleUpdateGross() {
            const res = await axios.patch(
                "/bplo/update-gross/" + this.selectedBusinessId,
                {
                    data: this.dataBusinessActivity,
                }
            );
            this.modalGross = { show: false };
            this.$message.success("Successfully Updated");
            this.getData();
        },
        closeModalFile() {
            this.modalGross.show = false;
        },
        refreshTable() {
            this.getData();
            this.formModal = { show: false };
        },
        formatMoney(num) {
            var formatter = new Intl.NumberFormat("fil-PH", {
                style: "currency",
                currency: "PHP",
            });
            if (num != undefined) {
                return formatter.format(num);
            } else {
                return formatter.format(0);
            }
        },
        formatBusinessActivity(data) {
            let map = data.map((item, i) => {
                const container = {};
                container.index = i;
                container.id = item.id;
                container.business_id = item.business_id;
                container.code = item.code;
                container.lineOfBusiness = item.line_of_business;
                container.noOfUnits = item.number_of_units;
                container.capitalization_format = this.formatMoney(
                    item.capitalization
                );
                container.essential_format = this.formatMoney(item.essential);
                container.non_essential_format = this.formatMoney(
                    item.non_essential
                );
                container.capitalization = item.capitalization;
                container.essential = item.essential;
                container.non_essential = item.non_essential;
                return container;
            });
            return map;
        },
        update(item) {
            this.modalGross = {
                show: true,
                item,
            };
            this.dataBusinessActivity = this.formatBusinessActivity(
                item.dataBusinessActivity
            );
            this.selectedBusinessId = item.business_id;
        },
        refreshTable(data) {
            data.id = data.id;
            data.business_id = this.selectedBusinessId;
            data.capitalization_format = this.formatMoney(data.capitalization);
            data.essential_format = this.formatMoney(data.essential);
            data.non_essential_format = this.formatMoney(data.non_essential);
            this.dataBusinessActivity.push(data);
            this.formModalBussActivity = { show: false };
        },
        handleAddBusinessActivity() {
            this.formModalBussActivity = { show: true };
        },
        handleEditBusinessActivity({ data, index }) {
            this.formModalBussActivity = { show: false };
            data.id = data.id;
            data.business_id = this.selectedBusinessId;
            data.capitalization_format = this.formatMoney(data.capitalization);
            data.essential_format = this.formatMoney(data.essential);
            data.non_essential_format = this.formatMoney(data.non_essential);
            this.dataBusinessActivity.splice(index, 1, data);

            console.log(this.dataBusinessActivity);
            this.$message.success("Business Updated Succesfully!");
        },
        onDeleteBusinessActivity(key) {
            this.dataBusinessActivity.splice(key, 1);
            this.$message.success("Business Deleted Succesfully!");
        },
        onEditBusinessActivity(data, index) {
            console.log(data);
            this.formModalBussActivity = {
                show: true,
                action: "edit",
                data,
                index,
            };
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
                container.dataBusinessActivity = item.businessInformationDetail;
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
