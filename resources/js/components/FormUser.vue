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
                        <a-form-item label="Name">
                            <a-input
                                v-decorator="[
                                    'fullName',
                                    {
                                        rules: [
                                            {
                                                required: true,
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
                        </a-col>-->
                    <a-col :span="24">
                        <a-form-item label="Contact Number">
                            <a-input
                                v-decorator="[
                                    'contact_number',
                                    {
                                        rules: [
                                            {
                                                required: true,
                                                message:
                                                    'Contact Number is required',
                                            },
                                        ],
                                    },
                                ]"
                            /> </a-form-item
                    ></a-col>
                    <a-col :span="24">
                        <a-form-item label="Email">
                            <a-input
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
                            /> </a-form-item
                    ></a-col>
                    <a-col :span="24" v-if="display_role">
                        <a-form-item label="Role:" :disabled="true">
                            <a-select
                                v-decorator="['role']"
                                style="width: 100%"
                                placeholder="Role"
                                :options="roles"
                            >
                            </a-select>
                        </a-form-item>
                    </a-col>
                    <a-col :span="24" v-if="action == 'UPDATE'">
                        <a-checkbox v-model="is_change_pass"
                            >Change Password</a-checkbox
                        >
                        <br />
                    </a-col>
                    <a-col :span="24" v-if="is_change_pass">
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
                    <a-col :span="24" v-if="is_change_pass">
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

const roles = [
    {
        label:'Admin',
        value:1,
    },
    {
        label:'User',
        value:2,
    },
    {
        label:'BPLO',
        value:3,
    },
    {
        label:'MENRO',
        value:4,
    },
    {
        label:'MPDC',
        value:5,
    },
    {
        label:'ENGINEERING',
        value:6,
    },
    {
        label:'SANITARY',
        value:7,
    },
    {
        label:'BFP',
        value:8,
    },
    {
        label:'TREASURER',
        value:9,
    }
   
]
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
            fields: [
                "fullName",
                "email",
                "role",
                "password",
                "repeatPassword",
                "contact_number",
            ],
            info: {},
            action: "",
            display_role: false,
            roles: roles,
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
        handleSubmit() {
            this.form.validateFields(
                (err, values) => !err && this.submitData()
            );
        },

        async submitData() {
            let url = "";
            if (this.action == "CREATE") {
                url = "store";
            } else {
                url = "update";
            }
            try {
                const res = await axios({
                    method: "POST",
                    url: `/user/${url}`,
                    data: {
                        id: this.user_id,
                        fullName: this.form.getFieldValue("fullName"),
                        email: this.form.getFieldValue("email"),
                        contact_number:
                            this.form.getFieldValue("contact_number"),
                        role: this.form.getFieldValue("role"),
                        password: this.form.getFieldValue("password"),
                        is_change_pass:
                            this.form.getFieldValue("is_change_pass"),
                    },
                });
                this.$emit("onSubmit", false);
                this.$message.success("Submit Succesfully");
            } catch (e) {
                console.error(e.response);
                if (typeof e.response.data.errors.email[0] !== undefined) {
                    this.$message.error(e.response.data.errors.email[0]);
                }
            }
        },
    },
    watch: {
        modal(params) {
            let data = {};
            if (params.show) {
                this.action = params.action;
                if (this.action == "CREATE") {
                    this.is_change_pass = true;
                    this.display_role = true;
                } else {
                    data = params.data[0];
                    this.fields.forEach((v) => this.form.getFieldDecorator(v));
                    this.user_id = data.id;
                    console.log(data);
                    this.form.setFieldsValue({
                        fullName: data.name,
                        email: data.email,
                        contact_number: data.contact_number,
                        role: data.role.toString(),
                    });
                    if (data.role == 1) {
                        this.display_role = true;
                    } else {
                        this.display_role = false;
                    }
                    this.is_change_pass = false;
                }
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
