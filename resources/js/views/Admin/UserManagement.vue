<template>
    <MainLayout>
        <a-card>
            <h1>User Management</h1>
            <a-row :gutter="16">
                <a-col :span="8">
                    <a-input-search
                        v-model="search"
                        placeholder="Input Name"
                        enter-button="Search"
                        size="large"
                        @search="onSearch"
                    />
                </a-col>

                <a-col :span="8">
                    <a-button type="primary" @click="createUser" size="large"
                        >Create user</a-button
                    >
                </a-col>
            </a-row>

            <br />
            <a-table :columns="columns" :data-source="data" rowKey="id">
                <span slot="action" slot-scope="text, record">
                    <a @click="select(text.id)">Edit</a> |
                    <a @click="viewChangeRole(text.id)" v-if="text.role == 1"
                        >Change Role</a
                    >
                    <a @click="viewLinkBusiness(text.id)" v-if="text.role == 2"
                        >Link Business</a
                    >
                </span>
            </a-table>
        </a-card>
        <FormUser
            :modal="formModal"
            @refresh="refreshTable"
            @onSubmit="handleSubmit($event)"
        />
        <FormChangeRole
            :modal="formModalRole"
            @refresh="refreshTable"
            @onSubmit="handleSubmit($event)"
        />
        <FormLinkBusiness
            :modal="formModalLinkBusiness"
            @refresh="refreshTable"
            @onSubmit="handleSubmit($event)"
        />
    </MainLayout>
</template>
<script>
import FormUser from "../../components/FormUser.vue";
import FormChangeRole from "../../components/FormChangeRole.vue";
import FormLinkBusiness from "../../components/FormLinkBusiness.vue";
import MainLayout from "../../layouts/MainLayout";

const columns = [
    {
        title: "Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Email",
        key: "email",
        dataIndex: "email",
    },
    {
        title: "Role",
        dataIndex: "role_label",
        key: "role_label",
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
            formModalRole: { show: false },
            formModalLinkBusiness: { show: false },
            filters: {
                search_keyword: "",
                user_id: "",
            },
            search: "",
        };
    },
    components: {
        MainLayout,
        FormUser,
        FormChangeRole,
        FormLinkBusiness,
    },
    methods: {
        refreshTable() {
            this.filters = {
                search_keyword: "",
                user_id: "",
            };
            this.getData();
            this.formModal = { show: false };
            this.formModalRole = { show: false };
            this.formModalLinkBusiness = { show: false };
        },
        handleSubmit(e) {
            this.filters = {
                search_keyword: "",
                user_id: "",
            };
            this.getData();
            this.formModal.show = e;
            this.formModalRole.show = e;
            this.formModalLinkBusiness.show = e;
        },
        async getData() {
            const res = await axios.get("/user/list", {
                params: {
                    filters: this.filters,
                },
            });
            this.data = res.data;
        },
        async onSearch() {
            this.filters = { search_keyword: this.search };
            this.getData();
        },
        async select(user_id) {
            this.filters.user_id = user_id;
            const res = await axios.get("/user/list", {
                params: {
                    filters: this.filters,
                },
            });
            let data = res.data;
            this.formModal = { show: true, data, action: "UPDATE" };
        },
        async viewChangeRole(user_id) {
            this.filters.user_id = user_id;
            const res = await axios.get("/user/list", {
                params: {
                    filters: this.filters,
                },
            });
            let data = res.data;
            this.formModalRole = { show: true, data };
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
        async viewLinkBusiness(user_id) {
            this.filters = {
                is_null: true,
                user_id: "",
            };
            const res = await axios.get("/bplo/list", {
                params: {
                    filters: this.filters,
                },
            });
            let data = this.formatData(res.data.data);
            this.formModalLinkBusiness = { show: true, data, user_id };
        },
        async confirm(id, status) {
            const res = await axios.patch("/user/change-role/" + id, {
                status: status,
            });
            this.getData();
        },
        createUser() {
            this.formModal = { show: true, action: "CREATE", data: [] };
        },
    },
    mounted() {
        this.getData();
    },
};
</script>
