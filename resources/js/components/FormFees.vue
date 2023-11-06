<template>
    <a-modal
        title="
           Business Fees
        "
        v-model="modal.show"
        :width="1000"
        @cancel="closeModal()"
        :maskClosable="false"
        okText="Submit"
        @ok="handleSubmit()"
    >
        <div
            :style="{
                background: '#fff',
                padding: '24px',
                minHeight: '280px',
            }"
        >
            <a-card>
                <a-descriptions title="Business Information">
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
                </a-descriptions>
            </a-card>
            <a-form :form="form">
                <a-card>
                    <a-row :gutter="16">
                        <p style="padding-left: 9px; font-weight: bold">
                            Fees:
                        </p>
                        <a-col :span="8">
                            <a-form-item label="Business Tax">
                                <a-input
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
                                    v-decorator="['subscription_other']"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Environmental Clearance">
                                <a-input
                                    v-decorator="['environmental_clearance']"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Sanitary Permit Fee">
                                <a-input
                                    v-decorator="['sanitary_permit_fee']"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Zoning Fee">
                                <a-input
                                    v-decorator="['zoning_fee']"
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
    },
    watch: {
        modal(params) {
            this.info = {};
            if (params.show) {
                let data = params.data[0];
                this.info = data;
                this.business_id = data.business_id;
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
            }
            const {
                business_tax,
                mayors_permit,
                occupational_permit,
                subscription_other,
                environmental_clearance,
                sanitary_permit_fee,
                zoning_fee,
            } = data;
            this.form.setFieldsValue({
                business_tax,
                mayors_permit,
                occupational_permit,
                subscription_other,
                environmental_clearance,
                sanitary_permit_fee,
                zoning_fee,
            });
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
