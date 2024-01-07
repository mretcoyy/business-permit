<template>
    <a-modal
        title="
           Change Role
        "
        v-model="modal.show"
        :width="300"
        @cancel="closeModal()"
        :maskClosable="false"
        okText="Submit"
        @ok="handleSubmit()"
    >
        <div
            :style="{
                background: '#fff',
            }"
        >
            <a-form :form="form">
                <div
                  
                >
                    <a-form-item label="Role">
                        <!-- <a-radio-group v-decorator="['role']" size="large">
                            <a-radio-button value="1"> Admin </a-radio-button>
                            <a-radio-button value="2"> User </a-radio-button>
                        </a-radio-group> -->
                        <a-select  size="large"
                            v-decorator="['role']"
                            style="width: 100%"
                            placeholder="Role"
                            :options="roles"
                        ></a-select>
                    </a-form-item>
                </div>
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
   
];
export default {
    props: {
        modal: { type: Object, default: () => ({ show: false }) },
    },
    data() {
        return {
            user_id: null,
            form: this.$form.createForm(this),
            selectedIndex: null,
            selectedId: null,
            is_change_pass: false,
            fields: ["role"],
            info: {},
            roles: roles,
        };
    },
    methods: {
        closeModal() {
            this.form.resetFields();
        },
        handleSubmit() {
            this.form.validateFields(
                (err, values) => !err && this.submitData()
            );
        },

        async submitData() {
            await axios({
                method: "PATCH",
                url: "/user/change-role/" + this.user_id,
                data: { role: this.form.getFieldValue("role") },
            });
            this.$emit("onSubmit", false);
            this.$message.success("Submit Succesfully");
        },
    },
    watch: {
        modal(params) {
            let data = {};
            if (params.show) {
                this.fields.forEach((v) => this.form.getFieldDecorator(v));
                data = params.data[0];
                this.user_id = data.id;
                console.log(this.user_id);
                this.form.setFieldsValue({ role: data.role_label.toString() });
                console.log(data);
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
