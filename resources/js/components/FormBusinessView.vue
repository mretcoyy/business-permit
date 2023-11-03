<template>
    <a-modal
        title="View Business Information"
        v-model="modal.show"
        :width="1000"
        @cancel="closeModal()"
        :maskClosable="false"
    >
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
                                        required: false,
                                        message: 'Business Type is required',
                                    },
                                ],
                            },
                        ]"
                    >
                        <a-radio-button value="1"> New </a-radio-button>
                        <a-radio-button value="2"> Renewal </a-radio-button>
                    </a-radio-group>
                </a-form-item>
                <a-divider />

                <a-row :gutter="16">
                    <a-col :span="12">
                        <a-form-item label="Date of Application">
                            <a-date-picker
                                :disabled="true"
                                v-decorator="[
                                    'dateOfApplication',
                                    {
                                        rules: [
                                            {
                                                required: false,
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
                                :readOnly="true"
                                type="number"
                                v-decorator="['referenceNo']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-item label="DTI/SEC/CDA Registration No">
                            <a-input
                                :readOnly="true"
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
                                                required: false,
                                                message:
                                                    'Type of Organization is required',
                                            },
                                        ],
                                    },
                                ]"
                            >
                                <a-radio-button value="1">
                                    Single
                                </a-radio-button>
                                <a-radio-button value="2">
                                    Partnership
                                </a-radio-button>
                                <a-radio-button value="3">
                                    Corporation
                                </a-radio-button>
                                <a-radio-button value="4">
                                    Cooperative
                                </a-radio-button>
                            </a-radio-group>
                        </a-form-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-item
                            label="Are you enjoying tax incentive from any Goverment Entity:"
                        >
                            <a-radio-group v-decorator="['hasTaxIncentive']">
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
                                                required: false,
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
                                                required: false,
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
                                                required: false,
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
                                                required: false,
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
                            <a-input v-decorator="['BAddressBuildingName']" />
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
                            <a-input v-decorator="['OAddressBuildingName']" />
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
                <!-- <FormBusinessActivity
                    :modal="formModal"
                    @refresh="refreshTable"
                    @onEdit="handleEditBusinessActivity"
                /> -->

                <a-table :columns="columns" :data-source="dataBusinessActivity">
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
            </a-form>
        </div>
    </a-modal>
</template>
<script>
function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener("load", () => callback(reader.result));
    reader.readAsDataURL(img);
}
import MainLayout from "../layouts/MainLayout";
import FormBusinessActivity from "./FormBusinessActivity";
const columns = [
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
        MainLayout,
    },
    props: {
        modal: { type: Object, default: () => ({ show: false }) },
    },
    data() {
        return {
            form: this.$form.createForm(this),
            type: "new",
            organization: "single",
            dataBusinessActivity: [],
            columns,
            fileLoading: false,
            file: {
                barangay: false,
                zoning: false,
                // sanitary: false,
                occupancy: false,
                environment: false,
                community: false,
                rpt: false,
                // fireSafety: false,
            },
            fields: [
                "dateOfApplication",
                "referenceNo",
                "dtiSecNo",
                "dtiSecdateofReg",
                "typeOfOrganization",
                "hasTaxIncentive",
                "taxPayerLname",
                "taxPayerFname",
                "taxPayerMname",
                "taxPayerBname",
                "taxPayerTname",
                "taxPresidentLname",
                "taxPresidentFname",
                "taxPresidentMname",
                "BAddressHouseNo",
                "BAddressBuildingName",
                "BAddressUnitNo",
                "BAddressStreet",
                "BAddressBarangay",
                "BAddressSubd",
                "BAddressCity",
                "BAddressProvince",
                "BAddressTelNo",
                "BAddressEmail",
                "BusinessArea",
                "TotalNumberofEmployees",
                "LGUEmployeeCount",
                "EmergencyContactPerson",
                "OAddressHouseNo",
                "OAddressBuildingName",
                "OAddressUnitNo",
                "OAddressStreet",
                "OAddressBarangay",
                "OAddressSubd",
                "OAddressCity",
                "OAddressProvince",
                "OAddressTelNo",
                "OAddressEmail",
                "LessorLname",
                "LessorFname",
                "LessorMname",
                "LessorMonthlyRental",
                "LAddressHouseNo",
                "LAddressStreet",
                "LAddressBarangay",
                "LAddressTelNo",
                "LAddressSubd",
                "LAddressCity",
                "LAddressProvince",
                "LAddressEmail",
            ],
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },

        refreshTable(data) {
            this.dataBusinessActivity.push(data);
            this.formModal = { show: false };
        },
    },
    watch: {
        modal(params) {
            if (params.show) {
                console.log(this.fields);
                let data = params.data[0];
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
                const {
                    dateOfApplication,
                    referenceNo,
                    dtiSecNo,
                    dtiSecdateofReg,
                    typeOfOrganization,
                    hasTaxIncentive,
                } = data;
                this.form.setFieldsValue({
                    dateOfApplication,
                    referenceNo,
                    dtiSecNo,
                    dtiSecdateofReg,
                    typeOfOrganization,
                    hasTaxIncentive,
                    taxPayerLname: data["businessInformation"]["taxPayerLname"],
                    taxPayerFname: data["businessInformation"]["taxPayerFname"],
                    taxPayerMname: data["businessInformation"]["taxPayerMname"],
                    taxPayerBname: data["businessInformation"]["taxPayerBname"],
                    taxPayerTname: data["businessInformation"]["taxPayerTname"],
                    taxPresidentLname:
                        data["businessInformation"]["taxPresidentLname"],
                    taxPresidentFname:
                        data["businessInformation"]["taxPresidentFname"],
                    taxPresidentMname:
                        data["businessInformation"]["taxPresidentMname"],
                    BAddressHouseNo:
                        data["businessInformation"]["BAddressHouseNo"],
                    BAddressBuildingName:
                        data["businessInformation"]["BAddressBuildingName"],
                    BAddressUnitNo:
                        data["businessInformation"]["BAddressUnitNo"],
                    BAddressStreet:
                        data["businessInformation"]["BAddressStreet"],
                    BAddressBarangay:
                        data["businessInformation"]["BAddressBarangay"],
                    BAddressSubd: data["businessInformation"]["BAddressSubd"],
                    BAddressCity: data["businessInformation"]["BAddressCity"],
                    BAddressProvince:
                        data["businessInformation"]["BAddressProvince"],
                    BAddressTelNo: data["businessInformation"]["BAddressTelNo"],
                    BAddressEmail: data["businessInformation"]["BAddressEmail"],
                    BusinessArea: data["businessInformation"]["BusinessArea"],
                    TotalNumberofEmployees:
                        data["businessInformation"]["TotalNumberofEmployees"],
                    LGUEmployeeCount:
                        data["businessInformation"]["LGUEmployeeCount"],
                    EmergencyContactPerson:
                        data["businessInformation"]["EmergencyContactPerson"],
                    OAddressHouseNo:
                        data["ownerInformation"]["OAddressHouseNo"],
                    OAddressBuildingName:
                        data["ownerInformation"]["OAddressBuildingName"],
                    OAddressUnitNo: data["ownerInformation"]["OAddressUnitNo"],
                    OAddressStreet: data["ownerInformation"]["OAddressStreet"],
                    OAddressBarangay:
                        data["ownerInformation"]["OAddressBarangay"],
                    OAddressSubd: data["ownerInformation"]["OAddressSubd"],
                    OAddressCity: data["ownerInformation"]["OAddressCity"],
                    OAddressProvince:
                        data["ownerInformation"]["OAddressProvince"],
                    OAddressTelNo: data["ownerInformation"]["OAddressTelNo"],
                    OAddressEmail: data["ownerInformation"]["OAddressEmail"],
                    LessorLname: data["lessorInformation"]["LessorLname"],
                    LessorFname: data["lessorInformation"]["LessorFname"],
                    LessorMname: data["lessorInformation"]["LessorMname"],
                    LessorMonthlyRental:
                        data["lessorInformation"]["LessorMonthlyRental"],
                    LAddressHouseNo:
                        data["lessorInformation"]["LAddressHouseNo"],
                    LAddressStreet: data["lessorInformation"]["LAddressStreet"],
                    LAddressBarangay:
                        data["lessorInformation"]["LAddressBarangay"],
                    LAddressTelNo: data["lessorInformation"]["LAddressTelNo"],
                    LAddressSubd: data["lessorInformation"]["LAddressSubd"],
                    LAddressCity: data["lessorInformation"]["LAddressCity"],
                    LAddressProvince:
                        data["lessorInformation"]["LAddressProvince"],
                    LAddressEmail: data["lessorInformation"]["LAddressEmail"],
                });
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
