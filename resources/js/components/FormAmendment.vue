<template>
    <a-modal
        title="Amend Business Information"
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
                minHeight: '280px',
            }"
        >
            <a-form :form="form">
                <a-form-item label="Business Type:">
                    <a-radio-group
                        :disabled="true"
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
                            <a-input
                                type="number"
                                v-decorator="['referenceNo']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-item label="DTI/SEC/CDA Registration No">
                            <a-input type="number" v-decorator="['dtiSecNo']" />
                        </a-form-item>
                        <a-form-item label="DTI/SEC/CDA Date of registration">
                            <a-date-picker
                                style="width: 100%"
                                v-decorator="['dtiSecdateofReg']"
                            />
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
                            <a-radio-group v-decorator="['isTaxIncentive']">
                                <a-radio value="1"> Yes </a-radio>
                                <a-radio value="0"> No </a-radio>
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

                <a-form-item type="number" label="Property Index Number (PIN)">
                    <a-input v-decorator="['pin']" />
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
                    >
                        <a-input v-decorator="['EmergencyContactPerson']" />
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
                <p class="text-center" style="font-weight: bold">
                    Business Files
                </p>
                <a-table
                    :columns="columnsFile"
                    :data-source="dataBusinessFiles"
                >
                    <span slot="action" slot-scope="text, record">
                        <a @click="viewFile(text)">View </a>
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
                            style="word-break: break-word; max-width: 104px"
                        >
                            <div v-if="file.zoning">
                                <p>{{ file.zoning.name }}</p>
                                <b style="font-size: 8px">Zoning Clearance</b>
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
                            style="word-break: break-word; max-width: 104px"
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
                            style="word-break: break-word; max-width: 104px"
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
                    >Update Application</a-button
                >
                <a-button type="danger" style="margin-top: 10px" block
                    >Cancel</a-button
                >
            </a-form>
            <a-modal
                title="
                        Show File
                    "
                v-model="modalFile"
                :width="800"
                @cancel="closeModalFile()"
                :maskClosable="false"
                :okButtonProps="{ style: { display: 'none' } }"
            >
                <div v-if="filetype == 'pdf'">
                    <iframe
                        class="frame-file"
                        id="pdf_frame"
                        height="500"
                        width="100%"
                        :src="pdfsrc"
                        frameborder="0"
                        scrolling="auto"
                    ></iframe>
                </div>
                <div v-else>
                    <img
                        v-bind:src="image_url"
                        id="image"
                        style="max-width: 600px"
                    />
                </div>
            </a-modal>
        </div>
    </a-modal>
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
const columnsFile = [
    {
        dataIndex: "type_label",
        key: "type_label",
        title: "Type",
    },
    {
        dataIndex: "filename",
        key: "filename",
        title: "Filename",
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
        modal: { type: Object, default: () => ({ show: false }) },
    },
    data() {
        return {
            business_id: null,
            form: this.$form.createForm(this),
            formModal: { show: false },
            type: "new",
            organization: "single",
            dataBusinessActivity: [],
            dataBusinessFiles: [],
            filetype: "",
            pdfsrc: null,
            image_url: null,
            columnsFile,
            columns,
            fileLoading: false,
            modalFile: false,
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
            file_default: {
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
                "typeOfBusienss",
                "dateOfApplication",
                "referenceNo",
                "dtiSecNo",
                "dtiSecdateofReg",
                "typeOfOrganization",
                "typeOfBusienss",
                "isTaxIncentive",
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
                "pin",
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
            this.dataBusinessActivity = [];
            this.dataBusinessFiles = [];
            this.form.resetFields();
        },
        viewFile(data) {
            this.filetype = /[^.]+$/.exec(data.filename);
            this.modalFile = true;

            axios
                .post(
                    "bplo/view-requirement",
                    { data },
                    {
                        responseType: "blob",
                    }
                )
                .then((res) => {
                    let ext = this.filetype;
                    if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                        var objectURL = URL.createObjectURL(res.data);
                        this.image_url = objectURL;
                    } else if (ext == "pdf") {
                        const file = new Blob([res.data], {
                            type: "application/pdf",
                        });
                        const fileURL = URL.createObjectURL(file);
                        this.pdfsrc = fileURL;
                    }
                })
                .catch((error) => {
                    console.log("error");
                    console.log(error);
                });
        },
        closeModalFile() {
            this.modalFile = false;
        },
        refreshTable(data) {
            this.dataBusinessActivity.push(data);
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
        formatBusinessFile(data) {
            const keys = Object.keys(data);
            let result = [];
            let id = data["business_file_id"];
            for (const key of keys) {
                const value = data[key];
                if (key != "business_file_id" && value != null) {
                    result.push({
                        business_file_id: id,
                        type_label: key.replace(/_/g, " ").toUpperCase(),
                        type: key,
                        filename: value,
                    });
                }
            }
            console.log(result);
            return result;
        },
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
                                isTaxIncentive:
                                    self.form.getFieldValue("isTaxIncentive"),
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
                                OAddressBuildingName: self.form.getFieldValue(
                                    "OAddressBuildingName"
                                ),
                                OAddressUnitNo:
                                    self.form.getFieldValue("OAddressUnitNo"),
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
            formData.append("business_id", this.business_id);
            const config = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            try {
                await axios(
                    {
                        method: "POST",
                        url: "/amendment/update-data",
                        data: formData,
                    },
                    config
                );
            } catch (e) {
                console.log(error);
                this.$error({
                    title: "Something went wrong!",
                });
            } finally {
                let self = this;
                self.$emit("onSubmit", false);
                self.$message.success("Updated Succesfully");
            }
        },

        checkFilesisFalse(files) {
            let result = false;
            let data = this.dataBusinessFiles;
            console.log("checkFilesisFalse");
            console.log(data);
            const keys = Object.keys(data);
            for (const key of keys) {
                const value = data[key];
                if (key != "business_file_id" && value === null) {
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
            console.log("essential - " + data.essential);
            console.log("non_essential - " + data.non_essential);
            data.capitalization_format = this.formatMoney(data.capitalization);
            data.essential_format = this.formatMoney(data.essential);
            data.non_essential_format = this.formatMoney(data.non_essential);
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
            data.capitalization_format = this.formatMoney(data.capitalization);
            data.essential_format = this.formatMoney(data.essential);
            data.non_essential_format = this.formatMoney(data.non_essential);
            this.dataBusinessActivity.splice(index, 1, data);
            this.$message.success("Business Updated Succesfully!");
        },
        onDeleteBusinessActivity(key) {
            this.dataBusinessActivity.splice(key, 1);
            this.$message.success("Business Deleted Succesfully!");
        },
        onEditBusinessActivity(data, index) {
            console.log(data);
            this.formModal = {
                show: true,
                action: "edit",
                data,
                index,
            };
        },
    },
    watch: {
        modal(params) {
            this.file = Object.assign({}, this.file_default);
            if (params.show) {
                let data = params.data[0];
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
                const {
                    dateOfApplication,
                    referenceNo,
                    dtiSecNo,
                    dtiSecdateofReg,
                    typeOfOrganization,
                    typeOfBusienss,
                    isTaxIncentive,
                    businessDetail: { status, status_val, business_id },
                    businessInformation: {
                        taxPayerLname,
                        taxPayerFname,
                        taxPayerMname,
                        taxPayerBname,
                        taxPayerTname,
                        BAddressHouseNo,
                        BAddressBuildingName,
                        BAddressUnitNo,
                        BAddressStreet,
                        BAddressBarangay,
                        BAddressSubd,
                        BAddressCity,
                        BAddressProvince,
                        BAddressTelNo,
                        BAddressEmail,
                        BusinessArea,
                        pin,
                        TotalNumberofEmployees,
                        LGUEmployeeCount,
                        EmergencyContactPerson,
                    },
                    ownerInformation: {
                        OLname,
                        OFname,
                        OMname,
                        OAddressHouseNo,
                        OAddressBuildingName,
                        OAddressUnitNo,
                        OAddressStreet,
                        OAddressBarangay,
                        OAddressSubd,
                        OAddressCity,
                        OAddressProvince,
                        OAddressTelNo,
                        OAddressEmail,
                    },
                    lessorInformation: {
                        LessorLname,
                        LessorFname,
                        LessorMname,
                        LessorMonthlyRental,
                        LAddressHouseNo,
                        LAddressStreet,
                        LAddressBarangay,
                        LAddressTelNo,
                        LAddressSubd,
                        LAddressCity,
                        LAddressProvince,
                        LAddressEmail,
                    },
                } = data;
                this.form.setFieldsValue({
                    dateOfApplication,
                    referenceNo,
                    dtiSecNo,
                    dtiSecdateofReg,
                    typeOfBusienss: typeOfBusienss.toString(),
                    typeOfOrganization: typeOfOrganization.toString(),
                    isTaxIncentive: isTaxIncentive.toString(),
                    taxPayerLname,
                    taxPayerFname,
                    taxPayerMname,
                    taxPayerBname,
                    taxPayerTname,
                    taxPresidentLname: OLname,
                    taxPresidentFname: OFname,
                    taxPresidentMname: OMname,
                    BAddressHouseNo,
                    BAddressBuildingName,
                    BAddressUnitNo,
                    BAddressStreet,
                    BAddressBarangay,
                    BAddressSubd,
                    BAddressCity,
                    BAddressProvince,
                    BAddressTelNo,
                    BAddressEmail,
                    BusinessArea,
                    pin,
                    TotalNumberofEmployees,
                    LGUEmployeeCount,
                    EmergencyContactPerson,
                    OAddressHouseNo,
                    OAddressBuildingName,
                    OAddressUnitNo,
                    OAddressStreet,
                    OAddressBarangay,
                    OAddressSubd,
                    OAddressCity,
                    OAddressProvince,
                    OAddressTelNo,
                    OAddressEmail,
                    LessorLname,
                    LessorFname,
                    LessorMname,
                    LessorMonthlyRental,
                    LAddressHouseNo,
                    LAddressStreet,
                    LAddressBarangay,
                    LAddressTelNo,
                    LAddressSubd,
                    LAddressCity,
                    LAddressProvince,
                    LAddressEmail,
                });

                let businessActivities = this.formatBusinessActivity(
                    data["businessInformationDetail"]
                );
                let businessFiles = this.formatBusinessFile(
                    data["businessFiles"]
                );
                this.business_id = data["businessDetail"]["business_id"];
                console.log(businessActivities);
                console.log(businessFiles);
                this.dataBusinessActivity = businessActivities;
                this.dataBusinessFiles = businessFiles;
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
