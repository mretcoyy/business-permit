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
                <a-menu-item key="1"> nav 1 </a-menu-item>
                <a-menu-item key="2"> nav 2 </a-menu-item>
                <a-menu-item key="3"> nav 3 </a-menu-item>
            </a-menu>
        </a-layout-header>
        <a-layout-content style="padding: 0 50px">
            <a-breadcrumb style="margin: 16px 0">
                <a-breadcrumb-item>Home</a-breadcrumb-item>
                <a-breadcrumb-item>List</a-breadcrumb-item>
                <a-breadcrumb-item>App</a-breadcrumb-item>
            </a-breadcrumb>
            <div
                :style="{
                    background: '#fff',
                    padding: '24px',
                    minHeight: '280px',
                }"
            >
                <a-form>
                    <a-form-item label="Business Type:">
                        <a-radio-group v-model="type" @change="onChange">
                            <a-radio-button value="new"> New </a-radio-button>
                            <a-radio-button value="renewal">
                                Renewal
                            </a-radio-button>
                            <a-radio-button value="additional">
                                Additional
                            </a-radio-button>
                        </a-radio-group>
                    </a-form-item>
                    <a-divider />

                    <a-row :gutter="16">
                        <a-col :span="12">
                            <a-form-item label="Date of Application">
                                <a-date-picker style="width: 100%" />
                            </a-form-item>
                            <a-form-item label="Reference No">
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="DTI/SEC/CDA Registration No">
                                <a-input type="number" />
                            </a-form-item>
                            <a-form-item
                                label="DTI/SEC/CDA Date of registration"
                            >
                                <a-date-picker style="width: 100%" />
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="Type of Organization:">
                                <a-radio-group
                                    v-model="organization"
                                    @change="onChangeOrganization"
                                >
                                    <a-radio-button value="single">
                                        Single
                                    </a-radio-button>
                                    <a-radio-button value="partnership">
                                        Partnership
                                    </a-radio-button>
                                    <a-radio-button value="corporation">
                                        Corporation
                                    </a-radio-button>
                                    <a-radio-button value="cooperative">
                                        Cooperative
                                    </a-radio-button>
                                </a-radio-group>
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item
                                label="Are you enjoying tax incentive from any Goverment Entity:"
                            >
                                <a-radio-group>
                                    <a-radio value="yes"> Yes </a-radio>
                                    <a-radio value="No"> No </a-radio>
                                </a-radio-group>
                            </a-form-item>
                        </a-col>
                    </a-row>
                    <a-divider />
                    <a-row :gutter="16">
                        <p style="padding-left: 9px; font-weight: bold">
                            Tax Payer Name:
                        </p>
                        <a-col :span="8">
                            <a-form-item label="Last Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="First Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Middle Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="24">
                            <a-form-item label="Business Name">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Trade name/Franchise">
                                <a-input />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px; font-weight: bold">
                            Name of the president/Treasurer of corporation:
                        </p>
                        <a-col :span="8">
                            <a-form-item label="Last Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="First Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Middle Name">
                                <a-input /> </a-form-item
                        ></a-col>
                    </a-row>
                    <a-divider />
                    <a-row :gutter="16">
                        <a-col span="11">
                            <p style="text-align: center; font-weight: bold">
                                Business Address
                            </p>
                            <a-form-item label="House No./Bldg. No.">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Building Name">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Unit No.">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Street">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Barangay">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Subdivision">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="City/Municipality">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Province">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Tel. No.">
                                <a-input type="number" />
                            </a-form-item>
                            <a-form-item label="Email Address">
                                <a-input type="email" />
                            </a-form-item>
                        </a-col>
                        <a-col
                            span="2"
                            class="text-center"
                            style="padding-top: 70px"
                            ><a-divider type="vertical" style="height: 100vh"
                        /></a-col>
                        <a-col span="11">
                            <p style="text-align: center; font-weight: bold">
                                Owner's Address
                            </p>
                            <a-form-item label="House No./Bldg. No.">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Building Name">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Unit No.">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Street">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Barangay">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Subdivision">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="City/Municipality">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Province">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Tel. No.">
                                <a-input type="number" />
                            </a-form-item>
                            <a-form-item label="Email Address">
                                <a-input type="email" />
                            </a-form-item>
                        </a-col>
                    </a-row>

                    <a-form-item
                        type="number"
                        label="Property Index Number (PIN)"
                    >
                        <a-input />
                    </a-form-item>
                    <a-row :gutter="16">
                        <a-col span="8">
                            <a-form-item label="Business Area (in sq m)">
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>
                        <a-col span="8">
                            <a-form-item
                                label="Total Number of Employees in Establishment"
                            >
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>
                        <a-col span="8">
                            <a-form-item label="# of Employees Residing in LGU">
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px">
                            if Place of Business is Rented, please identify the
                            following: <b>Lessor's name</b>
                        </p>
                        <a-col span="6">
                            <a-form-item label="Last Name">
                                <a-input />
                            </a-form-item>
                        </a-col>
                        <a-col span="6">
                            <a-form-item label="First Name">
                                <a-input />
                            </a-form-item>
                        </a-col>
                        <a-col span="6">
                            <a-form-item label="Middle Name">
                                <a-input />
                            </a-form-item>
                        </a-col>
                        <a-col span="6">
                            <a-form-item label="Monthly Rental">
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>

                        <p style="padding-left: 9px; font-weight: bold">
                            Lessor's Address
                        </p>

                        <a-col span="12">
                            <a-form-item label="House No./Bldg. No.">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Street">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Barangay">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Tel. No.">
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>
                        <a-col span="12">
                            <a-form-item label="Subdivision">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="City/Municipality">
                                <a-input />
                            </a-form-item>

                            <a-form-item label="Province">
                                <a-input />
                            </a-form-item>

                            <a-form-item label="Email Address">
                                <a-input type="email" />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px; font-weight: bold">
                            in case of Emergency:
                        </p>
                        <a-form-item
                            label="Contact Person/Tel No./Mobile Phone no./email address"
                        >
                            <a-input />
                        </a-form-item>
                    </a-row>
                </a-form>
                <a-divider />
                <p class="text-center" style="font-weight: bold">
                    Business Activity
                </p>
                <ModalBusiness
                    :modal="formModal"
                    @refreshTable="refreshTable"
                ></ModalBusiness>
                <a-button
                    style="margin-bottom: 10px"
                    @click="handleAddBusinessActivity"
                >
                    Add Business Activity
                </a-button>
                <a-table :columns="columns" :data-source="data">
                    <span slot="action" slot-scope="text, record">
                        <a>Edit</a>
                        <a-divider type="vertical" />
                        <a-popconfirm
                            title="Sure to delete?"
                            @confirm="
                                () => onDeleteBusinessActivity(record.key)
                            "
                        >
                            <a>Delete</a>
                        </a-popconfirm>
                    </span>
                </a-table>
            </div>
        </a-layout-content>
        <a-layout-footer style="text-align: center">
            Ant Design ©2018 Created by Ant UED
        </a-layout-footer>
    </a-layout>
</template>
<script>
import ModalBusiness from "../components/ModalBusiness";

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
    components: {
        ModalBusiness,
    },
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
