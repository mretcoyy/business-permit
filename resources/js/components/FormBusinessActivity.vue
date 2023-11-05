<template>
    <a-modal
        :title="
            modal.action === 'edit'
                ? 'Edit Business Activity'
                : 'Add Bussiness Activity'
        "
        v-model="modal.show"
        :width="600"
        :okText="modal.action === 'edit' ? 'Edit Business' : 'Add Bussiness'"
        @cancel="closeModal()"
        @ok="handleSubmit()"
        :maskClosable="false"
    >
        <a-form :form="form">
            <!-- <a-form-item label="Code" labelAlign="left">
                <a-input
                    placeholder="Code"
                    v-decorator="[
                        'code',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'Code is required',
                                },
                            ],
                        },
                    ]"
                />
            </a-form-item> -->
            <a-form-item label="Line of Business" labelAlign="left">
                <a-input
                    placeholder="Line of Business"
                    v-decorator="[
                        'lineOfBusiness',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'Line of Business is required',
                                },
                            ],
                        },
                    ]"
                />
            </a-form-item>
            <a-form-item label="No. of Units" labelAlign="left">
                <a-input
                    placeholder="No. of Units"
                    type="number"
                    v-decorator="[
                        'noOfUnits',
                        {
                            rules: [
                                {
                                    required: true,
                                    message: 'No. of Units is required',
                                },
                            ],
                        },
                    ]"
                />
            </a-form-item>
            <a-form-item
                label="Capitalization (for new business)"
                labelAlign="left"
            >
                <a-input
                    type="number"
                    placeholder="Capitalization (for new business)"
                    v-decorator="['capitalization']"
                />
            </a-form-item>
            <a-form-item label="Essential (for renewal)" labelAlign="left">
                <a-input
                    type="number"
                    placeholder="Essential (for renewal)"
                    v-decorator="['essential']"
                />
            </a-form-item>
            <a-form-item label="Non-essential (for renewal)" labelAlign="left">
                <a-input
                    type="number"
                    placeholder="Non-essential (for renewal)"
                    v-decorator="['non_essential']"
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
            selectedIndex: null,
            fields: [
                "code",
                "lineOfBusiness",
                "noOfUnits",
                "capitalization",
                "essential",
                "non_essential",
            ],
        };
    },
    watch: {
        modal(params) {
            if (params.show && params.action !== "add" && params?.data) {
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
                const {
                    code,
                    lineOfBusiness,
                    noOfUnits,
                    capitalization,
                    essential,
                    non_essential,
                } = params.data;
                this.selectedIndex = params.index;
                this.form.setFieldsValue({
                    code,
                    lineOfBusiness,
                    noOfUnits,
                    capitalization,
                    essential,
                    non_essential,
                });
            }
        },
    },
    methods: {
        closeModal() {
            this.selectedIndex = null;
            this.form.resetFields();
        },
        handleSubmit() {
            this.form.validateFields(async (errors, values) => {
                if (!errors) {
                    try {
                        var data = {
                            code: this.form.getFieldValue("code"),
                            lineOfBusiness:
                                this.form.getFieldValue("lineOfBusiness"),
                            noOfUnits: this.form.getFieldValue("noOfUnits"),
                            capitalization:
                                this.form.getFieldValue("capitalization"),
                            essential: this.form.getFieldValue("essential"),
                            non_essential:
                                this.form.getFieldValue("non_essential"),
                        };

                        if (this.modal.action == "edit") {
                            this.$emit("onEdit", {
                                data,
                                index: this.selectedIndex,
                            });
                        } else {
                            this.$emit("refresh", data);
                            this.$message.success("Added Succesfully");
                        }
                        this.closeModal();
                    } catch (e) {
                        this.$message.error("Server Error");
                    }
                }
            });
        },
    },
};
</script>
