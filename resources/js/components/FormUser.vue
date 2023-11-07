<template>
    <a-modal
        title="
           User Info
        "
        v-model="modal.show"
        :width="500"
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
            <a-form :form="form">
                <a-row>
                    <a-col :span="24">
                        <a-form-item label="User">
                            <a-input
                                v-decorator="[
                                    'name',
                                    {
                                        rules: [
                                            {
                                                required: false,
                                                message: 'Name is required',
                                            },
                                        ],
                                    },
                                ]"
                            /> </a-form-item
                    ></a-col>
                    <!-- <a-col :span="8">
                            <a-form-item label="Full Address">
                                <a-input
                                    v-decorator="[
                                        'full_address',
                                        {
                                            rules: [
                                                {
                                                    required: false,
                                                    message:
                                                        'Full Address is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Barangay">
                                <a-input v-decorator="['barangay']"></a-input>
                            </a-form-item>
                        </a-col>
                        <a-col :span="8">
                            <a-form-item label="Contact Number">
                                <a-input
                                    v-decorator="[
                                        'contact_number',
                                        {
                                            rules: [
                                                {
                                                    required: false,
                                                    message:
                                                        'Contact Number is required',
                                                },
                                            ],
                                        },
                                    ]"
                                /> </a-form-item
                        ></a-col> -->
                    <a-col :span="24">
                        <a-form-item label="Email">
                            <a-input v-decorator="['email']" /> </a-form-item
                    ></a-col>
                    <a-col :span="24">
                        <a-form-item label="Role" :disabled="true">
                            <a-radio-group v-decorator="['role']">
                                <a-radio-button value="1">
                                    Admin
                                </a-radio-button>
                                <a-radio-button value="2">
                                    User
                                </a-radio-button>
                            </a-radio-group>
                        </a-form-item>
                    </a-col>
                    <a-col :span="24">
                        <a-checkbox v-model="is_change_pass"
                            >Change Password</a-checkbox
                        >
                        <br />
                    </a-col>
                    <a-col :span="24">
                        <a-form-item>
                            <a-input-password
                                size="large"
                                placeholder="Password"
                                :maxLength="16"
                                :disabled="!is_change_pass"
                                v-decorator="[
                                    'password',
                                    {
                                        rules: [
                                            {
                                                required: true,
                                                message: 'Password is required',
                                            },
                                            {
                                                validator:
                                                    validateToNextPassword,
                                            },
                                        ],
                                    },
                                ]"
                            >
                                <a-icon
                                    slot="prefix"
                                    type="lock"
                                    :style="{ color: '#1890FF' }"
                                />
                            </a-input-password>
                        </a-form-item>
                    </a-col>
                    <a-col :span="24">
                        <a-form-item>
                            <a-input-password
                                size="large"
                                placeholder="Repeat Password"
                                :maxLength="16"
                                :disabled="!is_change_pass"
                                v-decorator="[
                                    'repeatPassword',
                                    {
                                        rules: [
                                            {
                                                required: true,
                                                message:
                                                    'Repeat Password is required',
                                            },
                                            {
                                                validator:
                                                    compareToFirstPassword,
                                            },
                                        ],
                                    },
                                ]"
                            >
                                <a-icon
                                    slot="prefix"
                                    type="lock"
                                    :style="{ color: '#1890FF' }"
                                />
                            </a-input-password>
                        </a-form-item>
                    </a-col>
                </a-row>
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
            confirmDirty: false,
            loginBtn: false,
            isLoginError: false,
            errorMessage: null,
            user_id: null,
            form: this.$form.createForm(this),
            selectedIndex: null,
            selectedId: null,
            is_change_pass: false,
            fields: ["name", "email", "role", "password", "repeatPassword"],
            info: {},
        };
    },
    methods: {
        compareToFirstPassword(rule, value, callback) {
            const form = this.form;
            if (value && value !== form.getFieldValue("password")) {
                callback("Two passwords that you enter is inconsistent!");
            } else {
                callback();
            }
        },
        validateToNextPassword(rule, value, callback) {
            const form = this.form;
            if (value && this.confirmDirty) {
                form.validateFields(["confirm"], { force: true });
            }
            callback();
        },
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit(e) {
            e.preventDefault();
            this.form.validateFields(
                (err, values) => !err && this.submitData()
            );
        },

        async submitData(data) {
            // await axios({
            //     method: "POST",
            //     url: "/tax-computation/store",
            //     data: data,
            // });
            // this.$emit("onSubmit", false);
            // this.$message.success("Submit Succesfully");
        },
    },
    watch: {
        modal(params) {
            let data = {};
            if (params.show) {
                data = params.data[0];
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
                this.user_id = data.id;
                console.log(data);
                this.form.setFieldsValue({
                    name: data.name,
                    email: data.email,
                    role: data.role.toString(),
                });
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
