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
            pdfsrc: null,
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit() {
            let form = this.modal.data;

            axios
                .post("/mayors-permit/view-mayors-permit", form, {
                    responseType: "blob",
                })
                .then((res) => {
                    const file = new Blob([res.data], {
                        type: "application/pdf",
                    });
                    let fileURL = URL.createObjectURL(file);
                    this.pdfsrc = fileURL + "#toolbar=0&navpanes=0&scrollbar=0";
                })
                .catch((error) => {});
        },
    },
    watch: {
        modal(params) {
            // this.info = {};
            // if (params.show) {
            //     let data = params.data[0];
            //     this.info = data;
            //     this.business_id = data.business_id;
            //     this.fields.forEach((v) => this.form.getFieldDecorator(v));
            // }
            // const {
            //     business_tax,
            //     mayors_permit,
            //     occupational_permit,
            //     subscription_other,
            //     environmental_clearance,
            //     sanitary_permit_fee,
            //     zoning_fee,
            // } = data;
            // this.form.setFieldsValue({
            //     business_tax,
            //     mayors_permit,
            //     occupational_permit,
            //     subscription_other,
            //     environmental_clearance,
            //     sanitary_permit_fee,
            //     zoning_fee,
            // });
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
