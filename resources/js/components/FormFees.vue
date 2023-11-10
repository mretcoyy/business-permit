<template>
    <a-modal
        title="
           Business Fees
        "
        v-model="modal.show"
        :width="900"
        @cancel="closeModal()"
        :maskClosable="false"
        okText="Submit"
        @ok="handleSubmit()"
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
                                                    required: false,
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
                                                    required: false,
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
                                    v-decorator="['subscription_other']"
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
                                    v-decorator="['environmental_clearance']"
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
                                    v-decorator="['sanitary_permit_fee']"
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
                                    v-decorator="['zoning_fee']"
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
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit() {
            let self = this;
            self.form.validateFields(async (errors, values) => {
                if (!errors) {
                    var data = {
                        business_id: this.business_id,
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
                    self.submitData(data);
                }
            });
        },
        async submitData(data) {
            await axios({
                method: "POST",
                url: "/tax-computation/store",
                data: data,
            });
            this.$emit("onSubmit", false);
            this.$message.success("Submit Succesfully");
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
