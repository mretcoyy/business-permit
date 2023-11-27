<template>
    <a-modal
        title="
           Business Fees
        "
        v-model="modal.show"
        :width="900"
        @cancel="closeModal()"
        :maskClosable="false"
        okText="Print"
        @ok="handlePrint()"
    >
        <div
            :style="{
                background: '#fff',
                padding: '14px',
                minHeight: '280px',
            }"
        >
            <a-card>
                <a-descriptions title="Business Information">
                    <a-descriptions-item label="Status">{{
                        info.status
                    }}</a-descriptions-item>
                    <a-descriptions-item label="BIN">{{
                        info.bin
                    }}</a-descriptions-item>
                    <a-descriptions-item label="Date Renewed">{{
                        info.date_renewed
                    }}</a-descriptions-item>
                    <a-descriptions-item label="Organization Type">{{
                        info.organization_type
                    }}</a-descriptions-item>
                    <a-descriptions-item label="Business Name">{{
                        info.business_name
                    }}</a-descriptions-item>
                    <a-descriptions-item label="Business Address">
                        {{ info.business_address }}
                    </a-descriptions-item>
                    <a-descriptions-item label="Owner Name">{{
                        info.owner_name
                    }}</a-descriptions-item>
                    <a-descriptions-item label="Owner Address">
                        {{ info.owner_address }}
                    </a-descriptions-item>
                    <a-descriptions-item label="Number of Employees">
                        {{ info.number_of_employees }}
                    </a-descriptions-item>
                </a-descriptions>
            </a-card>
            <a-form :form="form">
                <a-card>
                    <a-row :gutter="12">
                        <a-col :span="8">
                            <a-form-item label="Payor">
                                <a-input
                                    v-decorator="[
                                        'payor',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Payor is required',
                                                },
                                            ],
                                        },
                                    ]"
                                    maxLength="7"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="OR number">
                                <a-input
                                    v-decorator="[
                                        'or_number',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'OR number is required',
                                                },
                                            ],
                                        },
                                    ]"
                                    maxLength="7"
                                /> </a-form-item
                        ></a-col>
                    </a-row>
                    <a-row :gutter="12">
                        <p style="padding-left: 9px; font-weight: bold">
                            Fees:
                        </p>

                        <a-col :span="8" v-if="info.status != 'New'">
                            <a-form-item label="Business Tax">
                                <a-input
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'business_tax',
                                        {
                                            rules: [
                                                {
                                                    required: false,
                                                    message:
                                                        'Business Tax is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Mayor's Permit Fee">
                                <a-input
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'mayors_permit',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Mayor`s Permit is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Occupational Permit Fee">
                                <a-input
                                    inputmode="numeric"
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'occupational_permit',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Mayor`s Permit is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Subscription Fee & Other Fees">
                                <a-input
                                    inputmode="numeric"
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'subscription_other',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Subscription Fee & Other Fees is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Environmental Clearance">
                                <a-input
                                    inputmode="numeric"
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'environmental_clearance',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Environmental Clearance is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Sanitary Permit Fee">
                                <a-input
                                    inputmode="numeric"
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'sanitary_permit_fee',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Sanitary Permit Fee is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Zoning Fee">
                                <a-input
                                    inputmode="numeric"
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    v-decorator="[
                                        'zoning_fee',
                                        {
                                            rules: [
                                                {
                                                    required: true,
                                                    message:
                                                        'Zoning Fee is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>

                        <a-col :span="8">
                            <a-form-item label="Total Fee">
                                <a-input
                                    inputmode="numeric"
                                    @keyup="
                                        () => {
                                            compute();
                                        }
                                    "
                                    :disabled="true"
                                    v-decorator="['total_fee']"
                                /> </a-form-item
                        ></a-col>
                    </a-row>
                </a-card>
            </a-form>
        </div>

        <a-modal
            title="
                        Show Form
                    "
            v-model="modalFile"
            :width="800"
            @cancel="closeModalFile()"
            :maskClosable="false"
            okText="Print"
            @ok="handlePrintForm()"
        >
            <div>
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
        </a-modal>
        <a-modal
            v-model="modalPrint"
            :width="300"
            :maskClosable="false"
            okText="Done"
            centered
            @ok="closeModalPrint()"
            :cancelButtonProps="{ style: { display: 'none' } }"
        >
            Done Printing?
        </a-modal>
    </a-modal>
</template>
<script>
export default {
    props: {
        modal: { type: Object, default: () => ({ show: false }) },
    },
    data() {
        return {
            form: this.$form.createForm(this),
            selectedIndex: null,
            selectedId: null,
            business_id: "",
            fields: [
                "business_tax",
                "mayors_permit",
                "occupational_permit",
                "subscription_other",
                "environmental_clearance",
                "sanitary_permit_fee",
                "zoning_fee",
                "total_fee",
            ],
            info: {},
            pdfsrc: null,
            fileLoading: false,
            modalFile: false,
            modalPrint: false,
            fees: [],
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        closeModalFile() {
            this.modalFile = false;
        },
        closeModalPrint() {
            this.modalPrint = false;
            this.submitData();
            this.pdfsrc = null;
        },
        handlePrintForm() {
            var myIframe = document.getElementById("pdf_frame").contentWindow;
            myIframe.focus();
            myIframe.print();
            this.modalPrint = true;
        },
        printData() {
            axios
                .post(
                    "/tax-computation/view-fees-form",
                    { data: this.info, fees: this.fees },
                    {
                        responseType: "blob",
                    }
                )
                .then((res) => {
                    const file = new Blob([res.data], {
                        type: "application/pdf",
                    });
                    const fileURL = URL.createObjectURL(file);
                    this.pdfsrc = fileURL;
                    this.modalFile = true;
                })
                .catch((error) => {
                    console.log("error");
                    console.log(error);
                });
        },
        handlePrint() {
            let self = this;
            self.fees = [];
            self.form.validateFields(async (errors, values) => {
                if (!errors) {
                    var data = {
                        business_id: this.business_id,
                        payor: self.form.getFieldValue("payor"),
                        or_number: self.form.getFieldValue("or_number"),
                        business_tax: self.form.getFieldValue("business_tax"),
                        mayors_permit: self.form.getFieldValue("mayors_permit"),
                        occupational_permit: self.form.getFieldValue(
                            "occupational_permit"
                        ),
                        subscription_other:
                            self.form.getFieldValue("subscription_other"),
                        environmental_clearance: self.form.getFieldValue(
                            "environmental_clearance"
                        ),
                        sanitary_permit_fee: self.form.getFieldValue(
                            "sanitary_permit_fee"
                        ),
                        zoning_fee: self.form.getFieldValue("zoning_fee"),
                        total_fee: self.form.getFieldValue("total_fee"),
                    };
                    self.fees = data;
                    self.printData();
                }
            });
        },
        async submitData() {
            try {
                await axios({
                    method: "POST",
                    url: "/tax-computation/store",
                    data: this.fees,
                });
                this.modalPrint = false;
                this.modalFile = false;
                this.$emit("onSubmit", false);
                this.$message.success("Submit Succesfully");
            } catch (e) {
                this.modalFile = false;
                this.modalPrint = false;
                console.log(e);
                console.log(e.message);
                this.$error({
                    title: e.response.data.message,
                });
            } finally {
            }
        },
        compute() {
            let total_fee = 0;
            let self = this;
            let business_tax = self.form.getFieldValue("business_tax");
            let mayors_permit = self.form.getFieldValue("mayors_permit");
            let occupational_permit = self.form.getFieldValue(
                "occupational_permit"
            );
            let subscription_other =
                self.form.getFieldValue("subscription_other");
            let environmental_clearance = self.form.getFieldValue(
                "environmental_clearance"
            );
            let sanitary_permit_fee = self.form.getFieldValue(
                "sanitary_permit_fee"
            );
            let zoning_fee = self.form.getFieldValue("zoning_fee");

            total_fee =
                (isNaN(business_tax) ? 0 : parseFloat(business_tax)) +
                (isNaN(mayors_permit) ? 0 : parseFloat(mayors_permit)) +
                (isNaN(occupational_permit)
                    ? 0
                    : parseFloat(occupational_permit)) +
                (isNaN(subscription_other)
                    ? 0
                    : parseFloat(subscription_other)) +
                (isNaN(environmental_clearance)
                    ? 0
                    : parseFloat(environmental_clearance)) +
                (isNaN(sanitary_permit_fee)
                    ? 0
                    : parseFloat(sanitary_permit_fee)) +
                (isNaN(zoning_fee) ? 0 : parseFloat(zoning_fee));
            this.form.setFieldsValue({ total_fee });
        },
    },
    watch: {
        modal(params) {
            console.log(params);
            this.info = {};
            let occupational_permit = 0;
            if (params.show) {
                let data = params.data[0];
                this.info = data;
                this.business_id = data.business_id;
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
                occupational_permit = 200 * Number(data.number_of_employees);
            }

            console.log(occupational_permit);
            this.form.setFieldsValue({ occupational_permit });
            this.compute();
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
