<template>
    <a-modal
        title="
          Link Business
        "
        v-model="modal.show"
        :width="1000"
        @cancel="closeModal()"
        :maskClosable="false"
        :okButtonProps="{ style: { display: 'none' } }"
    >
        <div
            :style="{
                background: '#fff',
                padding: '24px',
            }"
        >
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
                    <a-popconfirm
                        title="Sure to Link this Business?"
                        @confirm="() => handleLink(text.business_id)"
                    >
                        <a>Link</a>
                    </a-popconfirm>
                </span>
            </a-table>
        </div>
    </a-modal>
</template>
<script>
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
    props: {
        modal: { type: Object, default: () => ({ show: false }) },
    },
    data() {
        return {
            user_id: null,
            data,
            columns,
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        async handleLink(business_id) {
            await axios({
                method: "PATCH",
                url: "/user/link-business/" + business_id,
                data: { user_id: this.user_id },
            });
            this.$emit("onSubmit", false);
            this.$message.success("Submit Succesfully");
        },
    },
    watch: {
        modal(params) {
            let data = {};
            if (params.show) {
                this.user_id = data.id;
                this.data = params.data;
                console.log(this.data);
            }
        },
    },
};
</script>
<style>
#components-layout-demo-top .logo {
    width: 120px;
    height: 31px;
    background: rgba(255, 255, 255, 0.2);
    margin: 16px 24px 16px 0;
    float: left;
}
</style>
