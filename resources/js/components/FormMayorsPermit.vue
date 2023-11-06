<template>
    <a-modal
        title="
           Mayors Permit
        "
        v-model="modal.show"
        :width="1000"
        @cancel="closeModal()"
        :maskClosable="false"
        okText="Print"
        @ok="handleSubmit()"
    >
        <div
            :style="{
                background: '#fff',
                padding: '24px',
                minHeight: '280px',
            }"
        ></div>
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
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit() {},
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
