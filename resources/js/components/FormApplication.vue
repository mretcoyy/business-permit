<template>
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
                        <a-input type="number" v-decorator="['referenceNo']" />
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="DTI/SEC/CDA Registration No">
                        <a-input type="number" v-decorator="['dtiSecNo']" />
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
                            <a-radio-button value="1"> Single </a-radio-button>
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
                                            message: 'Last Name is required',
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
                                            message: 'First Name is required',
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
                                            message: 'Middle Name is required',
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
                        <a-input type="email" v-decorator="['BAddressEmail']" />
                    </a-form-item>
                </a-col>
                <a-col span="2" class="text-center" style="padding-top: 70px"
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
                        <a-input type="email" v-decorator="['OAddressEmail']" />
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
                        <a-input type="number" v-decorator="['BusinessArea']" />
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
                        <a-input type="email" v-decorator="['LAddressEmail']" />
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
                        style="word-break: break-word; max-width: 104px"
                    >
                        <div v-if="file.barangay">
                            <p>{{ file.barangay.name }}</p>
                            <b style="font-size: 8px">Barangay Clearance</b>
                        </div>
                        <div v-else>
                            <a-icon :type="fileLoading ? 'loading' : 'plus'" />
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
                        style="word-break: break-word; max-width: 104px"
                    >
                        <div v-if="file.zoning">
                            <p>{{ file.zoning.name }}</p>
                            <b style="font-size: 8px">Zoning Clearance</b>
                        </div>
                        <div v-else>
                            <a-icon :type="fileLoading ? 'loading' : 'plus'" />
                            <div class="ant-upload-text">
                                Upload Zoning Clearance
                            </div>
                        </div>
                    </a-upload>
                </a-col>
                <!-- <a-col span="3">
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
                    </a-col> -->
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
                        style="word-break: break-word; max-width: 104px"
                    >
                        <div v-if="file.occupancy">
                            <p>{{ file.occupancy.name }}</p>
                            <b style="font-size: 8px">Occupancy Permit</b>
                        </div>

                        <div v-else>
                            <a-icon :type="fileLoading ? 'loading' : 'plus'" />
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
                        style="word-break: break-word; max-width: 104px"
                    >
                        <div v-if="file.environment">
                            <p>
                                {{ file.environment.name }}
                            </p>
                            <b style="font-size: 8px"
                                >Environment Certificate</b
                            >
                        </div>

                        <div v-else>
                            <a-icon :type="fileLoading ? 'loading' : 'plus'" />
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
                        style="word-break: break-word; max-width: 104px"
                    >
                        <div v-if="file.community">
                            <p>{{ file.community.name }}</p>
                            <b style="font-size: 8px"
                                >Community Tax Certificate</b
                            >
                        </div>

                        <div v-else>
                            <a-icon :type="fileLoading ? 'loading' : 'plus'" />
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
                        style="word-break: break-word; max-width: 104px"
                    >
                        <div v-if="file.rpt">
                            <p>{{ file.rpt.name }}</p>
                            <b style="font-size: 8px"
                                >Real Property Tax Clearance</b
                            >
                        </div>

                        <div v-else>
                            <a-icon :type="fileLoading ? 'loading' : 'plus'" />
                            <div class="ant-upload-text">
                                Upload Real Property Tax Clearance
                            </div>
                        </div>
                    </a-upload>
                </a-col>
                <!-- <a-col span="3">
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
                                    Upload Fire Safety Inspection Certificate
                                </div>
                            </div>
                        </a-upload>
                    </a-col> -->
            </a-row>
            <a-button type="primary" @click="handleSubmit" block
                >Submit Application</a-button
            >
            <a-button type="danger" style="margin-top: 10px" block
                >Cancel</a-button
            >
        </a-form>
    </div>
</template>
<script>
function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener("load", () => callback(reader.result));
    reader.readAsDataURL(img);
}
import FormBusinessActivity from "./FormBusinessActivity";
const columns = [
    // {
    //     dataIndex: "code",
    //     key: "code",
    //     title: "Code",
    // },
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
        dataIndex: "non_essential",
        key: "non_essential",
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
    props: {
        is_admin: { type: Boolean, default: () => false },
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
                // sanitary: false,
                occupancy: false,
                environment: false,
                community: false,
                rpt: false,
                // fireSafety: false,
            },
        };
    },
    methods: {
        handleSubmit() {
            let self = this;
            self.form.validateFields(async (errors, values) => {
                if (!errors) {
                    if (self.dataBusinessActivity.length === 0) {
                        self.$message.error("Business Activity is required!");
                    } else if (self.checkFilesisFalse(self.file)) {
                        self.$message.error(
                            "Please upload all file requirements!"
                        );
                    } else {
                        var data = {
                            typeOfBusienss:
                                self.form.getFieldValue("typeOfBusienss"),
                            business: {
                                dateOfApplication:
                                    self.form.getFieldValue(
                                        "dateOfApplication"
                                    ),
                                referenceNo:
                                    self.form.getFieldValue("referenceNo"),
                                dtiSecNo: self.form.getFieldValue("dtiSecNo"),
                                dtiSecdateofReg:
                                    self.form.getFieldValue("dtiSecdateofReg"),
                                typeOfOrganization:
                                    self.form.getFieldValue(
                                        "typeOfOrganization"
                                    ),
                                hasTaxIncentive:
                                    self.form.getFieldValue("hasTaxIncentive"),
                            },
                            businessInformation: {
                                taxPayerLname:
                                    self.form.getFieldValue("taxPayerLname"),
                                taxPayerFname:
                                    self.form.getFieldValue("taxPayerFname"),
                                taxPayerMname:
                                    self.form.getFieldValue("taxPayerMname"),
                                taxPayerBname:
                                    self.form.getFieldValue("taxPayerBname"),
                                taxPayerTname:
                                    self.form.getFieldValue("taxPayerTname"),
                                taxPresidentLname:
                                    self.form.getFieldValue(
                                        "taxPresidentLname"
                                    ),
                                taxPresidentFname:
                                    self.form.getFieldValue(
                                        "taxPresidentFname"
                                    ),
                                taxPresidentMname:
                                    self.form.getFieldValue(
                                        "taxPresidentMname"
                                    ),
                                BAddressHouseNo:
                                    self.form.getFieldValue("BAddressHouseNo"),
                                BAddressBuildingName: self.form.getFieldValue(
                                    "BAddressBuildingName"
                                ),
                                BAddressUnitNo:
                                    self.form.getFieldValue("BAddressUnitNo"),
                                BAddressStreet:
                                    self.form.getFieldValue("BAddressStreet"),
                                BAddressBarangay:
                                    self.form.getFieldValue("BAddressBarangay"),
                                BAddressSubd:
                                    self.form.getFieldValue("BAddressSubd"),
                                BAddressCity:
                                    self.form.getFieldValue("BAddressCity"),
                                BAddressProvince:
                                    self.form.getFieldValue("BAddressProvince"),
                                BAddressTelNo:
                                    self.form.getFieldValue("BAddressTelNo"),
                                BAddressEmail:
                                    self.form.getFieldValue("BAddressEmail"),
                                BusinessArea:
                                    self.form.getFieldValue("BusinessArea"),
                                TotalNumberofEmployees: self.form.getFieldValue(
                                    "TotalNumberofEmployees"
                                ),
                                LGUEmployeeCount:
                                    self.form.getFieldValue("LGUEmployeeCount"),
                                EmergencyContactPerson: self.form.getFieldValue(
                                    "EmergencyContactPerson"
                                ),
                            },
                            ownerAddress: {
                                OAddressHouseNo:
                                    self.form.getFieldValue("OAddressHouseNo"),
                                OAddressBuildingName: self.form.getFieldValue(
                                    "OAddressBuildingName"
                                ),
                                OAddressUnitNo:
                                    self.form.getFieldValue("OAddressUnitNo"),
                                OAddressStreet:
                                    self.form.getFieldValue("OAddressStreet"),
                                OAddressBarangay:
                                    self.form.getFieldValue("OAddressBarangay"),
                                OAddressSubd:
                                    self.form.getFieldValue("OAddressSubd"),
                                OAddressCity:
                                    self.form.getFieldValue("OAddressCity"),
                                OAddressProvince:
                                    self.form.getFieldValue("OAddressProvince"),
                                OAddressTelNo:
                                    self.form.getFieldValue("OAddressTelNo"),
                                OAddressEmail:
                                    self.form.getFieldValue("OAddressEmail"),
                            },
                            lessorInformation: {
                                LessorLname:
                                    self.form.getFieldValue("LessorLname"),
                                LessorFname:
                                    self.form.getFieldValue("LessorFname"),
                                LessorMname:
                                    self.form.getFieldValue("LessorMname"),
                                LessorMonthlyRental: self.form.getFieldValue(
                                    "LessorMonthlyRental"
                                ),
                                LAddressHouseNo:
                                    self.form.getFieldValue("LAddressHouseNo"),
                                LAddressStreet:
                                    self.form.getFieldValue("LAddressStreet"),
                                LAddressBarangay:
                                    self.form.getFieldValue("LAddressBarangay"),
                                LAddressTelNo:
                                    self.form.getFieldValue("LAddressTelNo"),
                                LAddressSubd:
                                    self.form.getFieldValue("LAddressSubd"),
                                LAddressCity:
                                    self.form.getFieldValue("LAddressCity"),
                                LAddressProvince:
                                    self.form.getFieldValue("LAddressProvince"),
                                LAddressEmail:
                                    self.form.getFieldValue("LAddressEmail"),
                            },
                            FileUploads: self.file,
                            BusinessActivity: self.dataBusinessActivity,
                            Admin: self.is_admin,
                        };

                        self.submitData(data);
                    }
                }
            });
        },

        async submitData(data) {
            let formData = new FormData();
            let files = this.file;
            for (let properties in files) {
                formData.append(
                    "file[" + properties + "]",
                    this.file[properties]
                );
            }
            formData.append("data", JSON.stringify(data));
            const config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };
            return axios(
                {
                    method: "POST",
                    url: "bplo/store",
                    data: formData,
                },
                config
            )
                .then(function (response) {
                    this.emitDone();
                })
                .catch((error) => {
                    console.log(error);
                    this.$error({
                        title: "Something went wrong!",
                    });
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
                this.fileLoading = false;
                return;
            }
            // if (info.file.status === "done") {
            if (Object.keys(info).length !== 0) {
                console.log(info.file);
                console.log(actionName);
                this.file[actionName] = info.file;
                console.log(this.file);
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
            return false;
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
        emitDone() {
            this.form.resetFields();
            this.$emit("onDone");
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
