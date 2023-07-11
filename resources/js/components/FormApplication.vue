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
                <a-form :form="form">
                    <a-form-item label="Business Type:">
                        <a-radio-group
                            v-decorator="[
                                'typeOfBusienss',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message:
                                                'Business Type is required',
                                        },
                                    ],
                                },
                            ]"
                        >
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
                                <a-date-picker
                                    v-decorator="[
                                        'dateOfApplication',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Date of Application is required',
                                                },
                                            ],
                                        },
                                    ]"
                                    style="width: 100%"
                                />
                            </a-form-item>
                            <a-form-item label="Reference No">
                                <a-input
                                    type="number"
                                    v-decorator="['referenceNo']"
                                />
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="DTI/SEC/CDA Registration No">
                                <a-input
                                    type="number"
                                    v-decorator="['dtiSecNo']"
                                />
                            </a-form-item>
                            <a-form-item
                                label="DTI/SEC/CDA Date of registration"
                                v-decorator="['dtiSecdateofReg']"
                            >
                                <a-date-picker style="width: 100%" />
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="Type of Organization:">
                                <a-radio-group
                                    v-decorator="[
                                        'typeOfOrganization',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Type of Organization is required',
                                                },
                                            ],
                                        },
                                    ]"
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
                                <a-radio-group
                                    v-decorator="['hasTaxIncentive']"
                                >
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
                                <a-input
                                    v-decorator="[
                                        'taxPayerLname',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Last Name is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="First Name">
                                <a-input
                                    v-decorator="[
                                        'taxPayerFname',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'First Name is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Middle Name">
                                <a-input
                                    v-decorator="[
                                        'taxPayerMname',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Middle Name is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="24">
                            <a-form-item label="Business Name">
                                <a-input
                                    v-decorator="[
                                        'taxPayerBname',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Business Name is required',
                                                },
                                            ],
                                        },
                                    ]"
                                />
                            </a-form-item>
                            <a-form-item label="Trade name/Franchise">
                                <a-input v-decorator="['taxPayerTname']" />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px; font-weight: bold">
                            Name of the president/Treasurer of corporation:
                        </p>
                        <a-col :span="8">
                            <a-form-item label="Last Name">
                                <a-input
                                    v-decorator="['taxPresidentLname']"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="First Name">
                                <a-input
                                    v-decorator="['taxPresidentFname']"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Middle Name">
                                <a-input
                                    v-decorator="['taxPresidentMname']"
                                /> </a-form-item
                        ></a-col>
                    </a-row>
                    <a-divider />
                    <a-row :gutter="16">
                        <a-col span="11">
                            <p style="text-align: center; font-weight: bold">
                                Business Address
                            </p>
                            <a-form-item label="House No./Bldg. No.">
                                <a-input v-decorator="['BAddressHouseNo']" />
                            </a-form-item>
                            <a-form-item label="Building Name">
                                <a-input
                                    v-decorator="['BAddressBuildingName']"
                                />
                            </a-form-item>
                            <a-form-item label="Unit No.">
                                <a-input v-decorator="['BAddressUnitNo']" />
                            </a-form-item>
                            <a-form-item label="Street">
                                <a-input v-decorator="['BAddressStreet']" />
                            </a-form-item>
                            <a-form-item label="Barangay">
                                <a-input v-decorator="['BAddressBarangay']" />
                            </a-form-item>
                            <a-form-item label="Subdivision">
                                <a-input v-decorator="['BAddressSubd']" />
                            </a-form-item>
                            <a-form-item label="City/Municipality">
                                <a-input v-decorator="['BAddressCity']" />
                            </a-form-item>
                            <a-form-item label="Province">
                                <a-input v-decorator="['BAddressProvince']" />
                            </a-form-item>
                            <a-form-item label="Tel. No.">
                                <a-input
                                    type="number"
                                    v-decorator="['BAddressTelNo']"
                                />
                            </a-form-item>
                            <a-form-item label="Email Address">
                                <a-input
                                    type="email"
                                    v-decorator="['BAddressEmail']"
                                />
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
                                <a-input v-decorator="['OAddressHouseNo']" />
                            </a-form-item>
                            <a-form-item label="Building Name">
                                <a-input
                                    v-decorator="['OAddressBuildingName']"
                                />
                            </a-form-item>
                            <a-form-item label="Unit No.">
                                <a-input v-decorator="['OAddressUnitNo']" />
                            </a-form-item>
                            <a-form-item label="Street">
                                <a-input v-decorator="['OAddressStreet']" />
                            </a-form-item>
                            <a-form-item label="Barangay">
                                <a-input v-decorator="['OAddressBarangay']" />
                            </a-form-item>
                            <a-form-item label="Subdivision">
                                <a-input v-decorator="['OAddressSubd']" />
                            </a-form-item>
                            <a-form-item label="City/Municipality">
                                <a-input v-decorator="['OAddressCity']" />
                            </a-form-item>
                            <a-form-item label="Province">
                                <a-input v-decorator="['OAddressProvince']" />
                            </a-form-item>
                            <a-form-item label="Tel. No.">
                                <a-input
                                    type="number"
                                    v-decorator="['OAddressTelNo']"
                                />
                            </a-form-item>
                            <a-form-item label="Email Address">
                                <a-input
                                    type="email"
                                    v-decorator="['OAddressEmail']"
                                />
                            </a-form-item>
                        </a-col>
                    </a-row>

                    <a-form-item
                        type="number"
                        v-decorator="['PIN']"
                        label="Property Index Number (PIN)"
                    >
                        <a-input />
                    </a-form-item>
                    <a-row :gutter="16">
                        <a-col span="8">
                            <a-form-item label="Business Area (in sq m)">
                                <a-input
                                    type="number"
                                    v-decorator="['BusinessArea']"
                                />
                            </a-form-item>
                        </a-col>
                        <a-col span="8">
                            <a-form-item
                                label="Total Number of Employees in Establishment"
                            >
                                <a-input
                                    type="number"
                                    v-decorator="['TotalNumberofEmployees']"
                                />
                            </a-form-item>
                        </a-col>
                        <a-col span="8">
                            <a-form-item label="# of Employees Residing in LGU">
                                <a-input
                                    type="number"
                                    v-decorator="['LGUEmployeeCount']"
                                />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px">
                            if Place of Business is Rented, please identify the
                            following: <b>Lessor's name</b>
                        </p>
                        <a-col span="6">
                            <a-form-item label="Last Name">
                                <a-input v-decorator="['LessorLname']" />
                            </a-form-item>
                        </a-col>
                        <a-col span="6">
                            <a-form-item label="First Name">
                                <a-input v-decorator="['LessorFname']" />
                            </a-form-item>
                        </a-col>
                        <a-col span="6">
                            <a-form-item label="Middle Name">
                                <a-input v-decorator="['LessorMname']" />
                            </a-form-item>
                        </a-col>
                        <a-col span="6">
                            <a-form-item label="Monthly Rental">
                                <a-input
                                    type="number"
                                    v-decorator="['LessorMonthlyRental']"
                                />
                            </a-form-item>
                        </a-col>

                        <p style="padding-left: 9px; font-weight: bold">
                            Lessor's Address
                        </p>

                        <a-col span="12">
                            <a-form-item label="House No./Bldg. No.">
                                <a-input v-decorator="['LAddressHouseNo']" />
                            </a-form-item>
                            <a-form-item label="Street">
                                <a-input v-decorator="['LAddressStreet']" />
                            </a-form-item>
                            <a-form-item label="Barangay">
                                <a-input v-decorator="['LAddressBarangay']" />
                            </a-form-item>
                            <a-form-item label="Tel. No.">
                                <a-input
                                    type="number"
                                    v-decorator="['LAddressTelNo']"
                                />
                            </a-form-item>
                        </a-col>
                        <a-col span="12">
                            <a-form-item label="Subdivision">
                                <a-input v-decorator="['LAddressSubd']" />
                            </a-form-item>
                            <a-form-item label="City/Municipality">
                                <a-input v-decorator="['LAddressCity']" />
                            </a-form-item>

                            <a-form-item label="Province">
                                <a-input v-decorator="['LAddressProvince']" />
                            </a-form-item>

                            <a-form-item label="Email Address">
                                <a-input
                                    type="email"
                                    v-decorator="['LAddressEmail']"
                                />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px; font-weight: bold">
                            in case of Emergency:
                        </p>
                        <a-form-item
                            label="Contact Person/Tel No./Mobile Phone no./email address"
                            v-decorator="['EmergencyContactPerson']"
                        >
                            <a-input />
                        </a-form-item>
                    </a-row>

                    <a-divider />
                    <p class="text-center" style="font-weight: bold">
                        Business Activity
                    </p>
                    <FormBusinessActivity
                        :modal="formModal"
                        @refresh="refreshTable"
                        @onEdit="handleEditBusinessActivity"
                    />
                    <a-button
                        style="margin-bottom: 10px"
                        @click="handleAddBusinessActivity"
                    >
                        Add Business Activity
                    </a-button>
                    <a-table
                        :columns="columns"
                        :data-source="dataBusinessActivity"
                    >
                        <span slot="action" slot-scope="text, record, index">
                            <a-button
                                type="link"
                                @click="onEditBusinessActivity(record, index)"
                                >Edit</a-button
                            >
                            <a-divider type="vertical" />
                            <a-popconfirm
                                title="Sure to delete?"
                                @confirm="() => onDeleteBusinessActivity(index)"
                            >
                                <a>Delete</a>
                            </a-popconfirm>
                        </span>
                    </a-table>
                    <a-divider />
                    <a-row :gutter="16">
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'barangay')"
                            >
                                <div v-if="file.barangay">
                                    <p>{{ file.barangay.name }}</p>
                                    <b style="font-size: 8px"
                                        >Barangay Clearance</b
                                    >
                                </div>
                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Barangay Clearance
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'zoning')"
                            >
                                <div v-if="file.zoning">
                                    <p>{{ file.zoning.name }}</p>
                                    <b style="font-size: 8px"
                                        >Zoning Clearance</b
                                    >
                                </div>
                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Zoning Clearance
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'sanitary')"
                            >
                                <div v-if="file.sanitary">
                                    <p>{{ file.sanitary.name }}</p>
                                    <b style="font-size: 8px"
                                        >Sanitary/Health Clearance</b
                                    >
                                </div>

                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Sanitary/Health Clearance
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'occupancy')"
                            >
                                <div v-if="file.occupancy">
                                    <p>{{ file.occupancy.name }}</p>
                                    <b style="font-size: 8px"
                                        >Occupancy Permit</b
                                    >
                                </div>

                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Occupancy Permit
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'environment')"
                            >
                                <div v-if="file.environment">
                                    <p>{{ file.environment.name }}</p>
                                    <b style="font-size: 8px"
                                        >Environment Certificate</b
                                    >
                                </div>

                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Environment Certificate
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'community')"
                            >
                                <div v-if="file.community">
                                    <p>{{ file.community.name }}</p>
                                    <b style="font-size: 8px"
                                        >Community Tax Certificate</b
                                    >
                                </div>

                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Community Tax Certificate
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'rpt')"
                            >
                                <div v-if="file.rpt">
                                    <p>{{ file.rpt.name }}</p>
                                    <b style="font-size: 8px"
                                        >Real Property Tax Clearance</b
                                    >
                                </div>

                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Real Property Tax Clearance
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                        <a-col span="3">
                            <a-upload
                                :multiple="false"
                                name="avatar"
                                list-type="picture-card"
                                class="avatar-uploader"
                                :customRequest="dummyRequest"
                                :show-upload-list="false"
                                :before-upload="beforeUpload"
                                @change="(e) => handleChange(e, 'fireSafety')"
                            >
                                <div v-if="file.fireSafety">
                                    <p>{{ file.fireSafety.name }}</p>
                                    <b style="font-size: 8px"
                                        >Fire Safety Inspection Certificate</b
                                    >
                                </div>

                                <div v-else>
                                    <a-icon
                                        :type="fileLoading ? 'loading' : 'plus'"
                                    />
                                    <div class="ant-upload-text">
                                        Upload Fire Safety Inspection
                                        Certificate
                                    </div>
                                </div>
                            </a-upload>
                        </a-col>
                    </a-row>
                    <a-button type="primary" @click="handleSubmit" block
                        >Submit Application</a-button
                    >
                    <a-button type="danger" style="margin-top: 10px" block
                        >Cancel</a-button
                    >
                </a-form>
            </div>
        </a-layout-content>

        <a-layout-footer style="text-align: center">
            Ant Design ©2018 Created by Ant UED
        </a-layout-footer>
    </a-layout>
</template>
<script>
function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener("load", () => callback(reader.result));
    reader.readAsDataURL(img);
}

import FormBusinessActivity from "./FormBusinessActivity";
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
        dataIndex: "capitalization",
        key: "capitalization",
    },
    {
        title: "Essential (for renewal)",
        dataIndex: "essential",
        key: "essential",
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

export default {
    components: {
        FormBusinessActivity,
    },
    data() {
        return {
            form: this.$form.createForm(this),
            formModal: { show: false },
            type: "new",
            organization: "single",
            dataBusinessActivity: [],
            columns,
            fileLoading: false,
            file: {
                barangay: false,
                zoning: false,
                sanitary: false,
                occupancy: false,
                environment: false,
                community: false,
                rpt: false,
                fireSafety: false,
            },
        };
    },
    methods: {
        handleSubmit() {
            this.form.validateFields(async (errors, values) => {
                if (!errors) {
                    try {
                        if (this.dataBusinessActivity.length === 0) {
                            this.$message.error(
                                "Business Activity is required!"
                            );
                        } else if (this.checkFilesisFalse(this.file)) {
                            this.$message.error(
                                "Please upload all file requirements!"
                            );
                        } else {
                            var data = {
                                typeOfBusienss:
                                    this.form.getFieldValue("typeOfBusienss"),
                                dateOfApplication:
                                    this.form.getFieldValue(
                                        "dateOfApplication"
                                    ),
                                referenceNo:
                                    this.form.getFieldValue("referenceNo"),
                                dtiSecNo: this.form.getFieldValue("dtiSecNo"),
                                dtiSecdateofReg:
                                    this.form.getFieldValue("dtiSecdateofReg"),
                                typeOfOrganization:
                                    this.form.getFieldValue(
                                        "typeOfOrganization"
                                    ),
                                hasTaxIncentive:
                                    this.form.getFieldValue("hasTaxIncentive"),
                                taxPayerLname:
                                    this.form.getFieldValue("taxPayerLname"),
                                taxPayerFname:
                                    this.form.getFieldValue("taxPayerFname"),
                                taxPayerMname:
                                    this.form.getFieldValue("taxPayerMname"),
                                taxPayerBname:
                                    this.form.getFieldValue("taxPayerBname"),
                                taxPayerTname:
                                    this.form.getFieldValue("taxPayerTname"),
                                taxPresidentLname:
                                    this.form.getFieldValue(
                                        "taxPresidentLname"
                                    ),
                                taxPresidentFname:
                                    this.form.getFieldValue(
                                        "taxPresidentFname"
                                    ),
                                taxPresidentMname:
                                    this.form.getFieldValue(
                                        "taxPresidentMname"
                                    ),
                                BAddressHouseNo:
                                    this.form.getFieldValue("BAddressHouseNo"),
                                BAddressBuildingName: this.form.getFieldValue(
                                    "BAddressBuildingName"
                                ),
                                BAddressUnitNo:
                                    this.form.getFieldValue("BAddressUnitNo"),
                                BAddressStreet:
                                    this.form.getFieldValue("BAddressStreet"),
                                BAddressBarangay:
                                    this.form.getFieldValue("BAddressBarangay"),
                                BAddressSubd:
                                    this.form.getFieldValue("BAddressSubd"),
                                BAddressCity:
                                    this.form.getFieldValue("BAddressCity"),
                                BAddressProvince:
                                    this.form.getFieldValue("BAddressProvince"),
                                BAddressTelNo:
                                    this.form.getFieldValue("BAddressTelNo"),
                                BAddressEmail:
                                    this.form.getFieldValue("BAddressEmail"),
                                OAddressHouseNo:
                                    this.form.getFieldValue("OAddressHouseNo"),
                                OAddressBuildingName: this.form.getFieldValue(
                                    "OAddressBuildingName"
                                ),
                                OAddressUnitNo:
                                    this.form.getFieldValue("OAddressUnitNo"),
                                OAddressStreet:
                                    this.form.getFieldValue("OAddressStreet"),
                                OAddressBarangay:
                                    this.form.getFieldValue("OAddressBarangay"),
                                OAddressSubd:
                                    this.form.getFieldValue("OAddressSubd"),
                                OAddressCity:
                                    this.form.getFieldValue("OAddressCity"),
                                OAddressProvince:
                                    this.form.getFieldValue("OAddressProvince"),
                                OAddressTelNo:
                                    this.form.getFieldValue("OAddressTelNo"),
                                OAddressEmail:
                                    this.form.getFieldValue("OAddressEmail"),
                                BusinessArea:
                                    this.form.getFieldValue("BusinessArea"),
                                TotalNumberofEmployees: this.form.getFieldValue(
                                    "TotalNumberofEmployees"
                                ),
                                LGUEmployeeCount:
                                    this.form.getFieldValue("LGUEmployeeCount"),
                                LessorLname:
                                    this.form.getFieldValue("LessorLname"),
                                LessorFname:
                                    this.form.getFieldValue("LessorFname"),
                                LessorMname:
                                    this.form.getFieldValue("LessorMname"),
                                LessorMonthlyRental: this.form.getFieldValue(
                                    "LessorMonthlyRental"
                                ),
                                LAddressHouseNo:
                                    this.form.getFieldValue("LAddressHouseNo"),
                                LAddressStreet:
                                    this.form.getFieldValue("LAddressStreet"),
                                LAddressBarangay:
                                    this.form.getFieldValue("LAddressBarangay"),
                                LAddressTelNo:
                                    this.form.getFieldValue("LAddressTelNo"),
                                LAddressSubd:
                                    this.form.getFieldValue("LAddressSubd"),
                                LAddressCity:
                                    this.form.getFieldValue("LAddressCity"),
                                LAddressProvince:
                                    this.form.getFieldValue("LAddressProvince"),
                                LAddressEmail:
                                    this.form.getFieldValue("LAddressEmail"),
                                EmergencyContactPerson: this.form.getFieldValue(
                                    "EmergencyContactPerson"
                                ),
                                FileUploads: this.file,
                                BusinessActivity: this.dataBusinessActivity,
                            };
                            alert("form submit here");
                            console.log(data);
                        }
                    } catch (e) {
                        this.$message.error("Server Error");
                    }
                }
            });
        },
        checkFilesisFalse(files) {
            var result = false;
            for (var i in files) {
                if (files[i] === false) {
                    result = true;
                    break;
                }
            }
            return result;
        },
        dummyRequest({ file, onSuccess }) {
            setTimeout(() => {
                onSuccess("ok");
            }, 0);
        },
        handleChange(info, actionName) {
            if (info.file.status === "uploading") {
                this.fileLoading = true;
                return;
            }
            if (info.file.status === "done") {
                console.log(info.file);
                console.log(actionName);
                this.file[actionName] = info.file;
                this.fileLoading = false;
            }
        },
        beforeUpload(file) {
            // const isJpgOrPng =
            //     file.type === "image/jpeg" || file.type === "image/png";
            // if (!isJpgOrPng) {
            //     this.$message.error("You can only upload JPG file!");
            // }
            // const isLt2M = file.size / 1024 / 1024 < 2;
            // if (!isLt2M) {
            //     this.$message.error("Image must smaller than 2MB!");
            // }
            // return isJpgOrPng && isLt2M;
            return true;
        },
        refreshTable(data) {
            this.dataBusinessActivity.push(data);
            this.formModal = { show: false };
        },
        onChange(e) {
            console.log(`checked = ${e.target.value}`);
        },
        onChangeOrganization(e) {
            //
        },
        handleAddBusinessActivity() {
            this.formModal = { show: true };
        },
        handleEditBusinessActivity({ data, index }) {
            this.formModal = { show: false };
            this.dataBusinessActivity.splice(index, 1, data);
            this.$message.success("Business Updated Succesfully!");
        },
        onDeleteBusinessActivity(key) {
            this.dataBusinessActivity.splice(key, 1);
            this.$message.success("Business Deleted Succesfully!");
        },
        onEditBusinessActivity(data, index) {
            this.formModal = { show: true, action: "edit", data, index };
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
