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
            </a-row>
            <br />
            <a-table :columns="columns" :data-source="data" rowKey="id">
                <span slot="action" slot-scope="text, record">
                    <a @click="select(text.id)">Edit</a> |
                    <a @click="viewChangeRole(text.id)">Change Role</a>
                    |
                    <a @click="viewLinkBusiness(text.id)">Link Business</a>
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
    </MainLayout>
</template>
<script>
import FormUser from "../../components/FormUser.vue";
import FormChangeRole from "../../components/FormChangeRole.vue";
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
    },
    methods: {
        refreshTable() {
            this.getData();
            this.formModal = { show: false };
            this.formModalRole = { show: false };
        },
        handleSubmit(e) {
            this.getData();
            this.formModal.show = e;
            this.formModal.show = e;
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
            this.formModal = { show: true, data };
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
        viewLinkBusiness(user_id) {},
        async confirm(id, status) {
            const res = await axios.patch("/user/change-role/" + id, {
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
