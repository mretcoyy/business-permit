<template>
    <MainLayout>
        <a-card>
            <h1>Business Applications</h1>
            <a-table :columns="columns" :data-source="data">
                <span slot="Status" slot-scope="Status">
                    <a-tag
                        :color="
                            Status === 'Approved'
                                ? 'green'
                                : Status === 'For Approval'
                                ? 'yellow'
                                : Status === 'Decline'
                                ? 'volcano'
                                : 'blue'
                        "
                        >{{ Status }}</a-tag
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
                    <a>View</a> |
                    <a-popconfirm
                        title="Sure to Approve Application?"
                        @confirm="() => {}"
                    >
                        <a>Approve</a>
                    </a-popconfirm>
                    |
                    <a-popconfirm
                        title="Sure to Decline Application?"
                        @confirm="() => {}"
                    >
                        <a>Decline</a>
                    </a-popconfirm>
                </span>
            </a-table>
        </a-card>
    </MainLayout>
</template>
<script>
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
        dataIndex: "address",
        key: "address",
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

const data = [
    {
        key: "1",
        name: "John Brown",
        age: 32,
        address: "New York No. 1 Lake Park",
        Status: "Approved",
    },
    {
        key: "2",
        name: "Jim Green",
        age: 42,
        address: "London No. 1 Lake Park",
        Status: "For Payment",
    },
    {
        key: "3",
        name: "Joe Black",
        age: 32,
        address: "Sidney No. 1 Lake Park",
        Status: "For Approval",
    },
    {
        key: "4",
        name: "Joe Black",
        age: 32,
        address: "Sidney No. 1 Lake Park",
        Status: "Decline",
    },
];

export default {
    data() {
        return {
            data,
            columns,
        };
    },
    components: {
        MainLayout,
    },
};
</script>
