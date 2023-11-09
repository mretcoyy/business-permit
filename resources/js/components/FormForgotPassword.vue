<template>
    <a-modal
        title="Forgot Password"
        v-model="modal.show"
        :width="300"
        okText="Send Email"
        @cancel="closeModal()"
        @ok="handleSubmit()"
        :maskClosable="false"
    >
        <a-form :form="form">
            <a-form-item label="Enter Email" labelAlign="left">
                <a-input
                    placeholder="Email"
                    v-decorator="[
                        'email',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'Email is required',
                                },
                            ],
                        },
                    ]"
                />
            </a-form-item>
        </a-form>
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
            saving: false,
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit() {
            this.form.validateFields(async (errors, values) => {
                if (!errors) {
                    try {
                        let email = this.form.getFieldValue("email");
                        const res = await axios.post("/forgot-password", {
                            email,
                        });
                        this.data = res.data;
                        this.saving = true;
                        this.$message.success(this.form.getFieldValue("email"));
                        this.closeModal();
                        // close modal
                        this.$emit("refresh");
                    } catch (e) {
                        this.$message.error("Server Error");
                    }
                    this.saving = false;
                }
            });
        },
    },
};
</script>
