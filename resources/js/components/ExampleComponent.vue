<template>
    <a-layout id="components-layout-demo-top" class="layout">
        <a-layout-header>
            <div class="logo" />
            <a-menu
                theme="dark"
                mode="horizontal"
                :default-selected-keys="['2']"
                :style="{ lineHeight: '64px' }"
            >
                <a-menu-item key="1"> Dashboard </a-menu-item>
                <a-menu-item key="2"> Business Permit Form </a-menu-item>
                <a-menu-item key="3"> Logout </a-menu-item>
            </a-menu>
        </a-layout-header>

        <a-layout-footer style="text-align: center">
            Ant Design ©2018 Created by Ant UED
        </a-layout-footer>
    </a-layout>
</template>
<script>
const columns = [
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
        dataIndex: "capitalizaion",
        key: "capitalizaion",
    },
    {
        title: "Essential (for renewal)",
        dataIndex: "eseential",
        key: "eseential",
    },
    {
        title: "Non-essential (for renewal)",
        dataIndex: "nonEssential",
        key: "nonEssential",
    },
    {
        title: "Action",
        key: "action",
        scopedSlots: { customRender: "action" },
    },
];

const data = [
    {
        code: "123",
        lineOfBusiness: "123",
        noOfUnits: "123",
        capitalizaion: "123",
        eseential: "123",
        nonEssential: "123",
    },
];

export default {
    data() {
        return {
            type: "new",
            organization: "single",
            data,
            columns,
        };
    },
    methods: {
        onChange(e) {
            console.log(`checked = ${e.target.value}`);
        },
        onChangeOrganization(e) {
            //
        },
        handleAddBusinessActivity() {
            console.log("asd");
        },
        onDeleteBusinessActivity() {
            //
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
