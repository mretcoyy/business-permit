<template>
    <a-modal
        title="View Business Information"
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
                                :disabled="true"
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
                            <a-radio-group
                                v-decorator="['isTaxIncentive']"
                                :disabled="true"
                            >
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
                                :readOnly="true"
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
                                :readOnly="true"
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
                                :readOnly="true"
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
                                :readOnly="true"
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
                            <a-input
                                :readOnly="true"
                                v-decorator="['taxPayerTname']"
                            />
                        </a-form-item>
                    </a-col>
                    <p style="padding-left: 9px; font-weight: bold">
                        Name of the president/Treasurer of corporation:
                    </p>
                    <a-col :span="8">
                        <a-form-item label="Last Name">
                            <a-input
                                :readOnly="true"
                                v-decorator="['taxPresidentLname']"
                            /> </a-form-item
                    ></a-col>
                    <a-col :span="8">
                        <a-form-item label="First Name">
                            <a-input
                                :readOnly="true"
                                v-decorator="['taxPresidentFname']"
                            /> </a-form-item
                    ></a-col>
                    <a-col :span="8">
                        <a-form-item label="Middle Name">
                            <a-input
                                :readOnly="true"
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
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressHouseNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Building Name">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressBuildingName']"
                            />
                        </a-form-item>
                        <a-form-item label="Unit No.">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressUnitNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Street">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressStreet']"
                            />
                        </a-form-item>
                        <a-form-item label="Barangay">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressBarangay']"
                            />
                        </a-form-item>
                        <a-form-item label="Subdivision">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressSubd']"
                            />
                        </a-form-item>
                        <a-form-item label="City/Municipality">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressCity']"
                            />
                        </a-form-item>
                        <a-form-item label="Province">
                            <a-input
                                :readOnly="true"
                                v-decorator="['BAddressProvince']"
                            />
                        </a-form-item>
                        <a-form-item label="Tel. No.">
                            <a-input
                                :readOnly="true"
                                type="number"
                                v-decorator="['BAddressTelNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Email Address">
                            <a-input
                                :readOnly="true"
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
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressHouseNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Building Name">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressBuildingName']"
                            />
                        </a-form-item>
                        <a-form-item label="Unit No.">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressUnitNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Street">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressStreet']"
                            />
                        </a-form-item>
                        <a-form-item label="Barangay">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressBarangay']"
                            />
                        </a-form-item>
                        <a-form-item label="Subdivision">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressSubd']"
                            />
                        </a-form-item>
                        <a-form-item label="City/Municipality">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressCity']"
                            />
                        </a-form-item>
                        <a-form-item label="Province">
                            <a-input
                                :readOnly="true"
                                v-decorator="['OAddressProvince']"
                            />
                        </a-form-item>
                        <a-form-item label="Tel. No.">
                            <a-input
                                :readOnly="true"
                                type="number"
                                v-decorator="['OAddressTelNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Email Address">
                            <a-input
                                :readOnly="true"
                                type="email"
                                v-decorator="['OAddressEmail']"
                            />
                        </a-form-item>
                    </a-col>
                </a-row>

                <a-form-item type="number" label="Property Index Number (PIN)">
                    <a-input :readOnly="true" v-decorator="['pin']" />
                </a-form-item>
                <a-row :gutter="16">
                    <a-col span="8">
                        <a-form-item label="Business Area (in sq m)">
                            <a-input
                                :readOnly="true"
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
                                :readOnly="true"
                                type="number"
                                v-decorator="['TotalNumberofEmployees']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col span="8">
                        <a-form-item label="# of Employees Residing in LGU">
                            <a-input
                                :readOnly="true"
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
                            <a-input
                                :readOnly="true"
                                v-decorator="['LessorLname']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col span="6">
                        <a-form-item label="First Name">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LessorFname']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col span="6">
                        <a-form-item label="Middle Name">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LessorMname']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col span="6">
                        <a-form-item label="Monthly Rental">
                            <a-input
                                :readOnly="true"
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
                            <a-input
                                :readOnly="true"
                                v-decorator="['LAddressHouseNo']"
                            />
                        </a-form-item>
                        <a-form-item label="Street">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LAddressStreet']"
                            />
                        </a-form-item>
                        <a-form-item label="Barangay">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LAddressBarangay']"
                            />
                        </a-form-item>
                        <a-form-item label="Tel. No.">
                            <a-input
                                :readOnly="true"
                                type="number"
                                v-decorator="['LAddressTelNo']"
                            />
                        </a-form-item>
                    </a-col>
                    <a-col span="12">
                        <a-form-item label="Subdivision">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LAddressSubd']"
                            />
                        </a-form-item>
                        <a-form-item label="City/Municipality">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LAddressCity']"
                            />
                        </a-form-item>

                        <a-form-item label="Province">
                            <a-input
                                :readOnly="true"
                                v-decorator="['LAddressProvince']"
                            />
                        </a-form-item>

                        <a-form-item label="Email Address">
                            <a-input
                                :readOnly="true"
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
                        <a-input
                            :readOnly="true"
                            v-decorator="['EmergencyContactPerson']"
                        />
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

                <a-table
                    :columns="columns"
                    :data-source="dataBusinessActivity"
                    rowKey="index"
                >
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
                    <div
                        v-else
                        style="
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                    >
                        <img
                            v-bind:src="image_url"
                            id="image"
                            style="max-width: 600px"
                        />
                    </div>
                </a-modal>
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
        dataIndex: "non_essential",
        key: "non_essential",
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
            dataBusinessFiles: [],
            filetype: "",
            pdfsrc: null,
            image_url: null,
            columns,
            columnsFile,
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
            fields: [
                "typeOfBusienss",
                "dateOfApplication",
                "referenceNo",
                "dtiSecNo",
                "dtiSecdateofReg",
                "typeOfOrganization",
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

        formatBusinessActivity(data) {
            var formatter = new Intl.NumberFormat("fil-PH", {
                style: "currency",
                currency: "PHP",
            });
            console.log(data);

            let map = data.map((item, i) => {
                const container = {};
                container.index = i;
                container.id = item.id;
                container.code = item.code;
                container.lineOfBusiness = item.line_of_business;
                container.noOfUnits = item.number_of_units;
                container.capitalization = formatter.format(
                    item.capitalization
                );
                container.essential = formatter.format(item.essential);
                container.non_essential = formatter.format(item.non_essential);
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
    },
    watch: {
        modal(params) {
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
                    businessDetail: { status, status_val },
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
                    pin: pin,
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
