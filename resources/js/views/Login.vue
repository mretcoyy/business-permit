<template>
    <UserLayout>
        <div class="user-layout-content">
            <div class="top">
                <div class="title">Business Permit</div>
            </div>
            <div class="main">
                <a-form
                    id="formLogin"
                    class="user-layout-login"
                    ref="formLogin"
                    :form="form"
                    @submit="handleSubmit"
                >
                    <a-alert
                        v-if="isLoginError"
                        type="error"
                        showIcon
                        style="margin-bottom: 24px"
                        :message="errorMessage"
                    />
                    <a-form-item>
                        <a-input
                            size="large"
                            type="text"
                            placeholder="Email"
                            :maxLength="25"
                            :disabled="loginBtn"
                            v-decorator="[
                                'email',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Email Required',
                                        },
                                    ],
                                },
                            ]"
                        >
                            <a-icon
                                slot="prefix"
                                type="user"
                                :style="{ color: '#1890FF' }"
                            />
                        </a-input>
                    </a-form-item>

                    <a-form-item>
                        <a-input-password
                            size="large"
                            placeholder="Password"
                            :maxLength="16"
                            :disabled="loginBtn"
                            v-decorator="[
                                'password',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Password is required',
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

                    <a-form-item style="margin-top: 24px">
                        <a-button
                            size="large"
                            type="primary"
                            htmlType="submit"
                            class="login-button"
                            :loading="loginBtn"
                            :disabled="loginBtn"
                            >Login</a-button
                        >
                    </a-form-item>
                    <a-form-item
                        style="width: 180px !important; margin: auto !important"
                    >
                        <a-button href="/register" type="link">
                            Register a new account
                        </a-button>
                    </a-form-item>

                    <a-form-item
                        style="width: 150px !important; margin: auto !important"
                    >
                        <a-button @click="openForgotModal" type="link">
                            Forgot Password!
                        </a-button>
                    </a-form-item>
                </a-form>
            </div>
        </div>
        <FormForgotModal :modal="formModal" @refresh="refreshTable" />
    </UserLayout>
</template>

<script>
import UserLayout from "../layouts/UserLayout.vue";
import FormForgotModal from "../components/FormForgotPassword";
export default {
    components: {
        UserLayout,
        FormForgotModal,
    },
    data() {
        return {
            formModal: { show: false },

            loginBtn: false,

            isLoginError: false,
            errorMessage: null,

            form: this.$form.createForm(this),

            fields: ["email", "password"],
        };
    },

    methods: {
        openForgotModal() {
            this.formModal = { show: true };
        },
        refreshTable() {
            this.formModal = { show: false };
        },
        forgotPassword() {
            //
        },
        handleSubmit(e) {
            e.preventDefault();
            this.form.validateFields(
                (err, values) => !err && this.loginAction()
            );
        },
        loginAction() {
            axios({
                method: 'POST',
                url: 'user/login',
                data:{
                    email: this.form.getFieldValue("email"),
                    password: this.form.getFieldValue("password"),
                }
            }).then(function(response){
                console.log(response);
            }).catch(error => {

            });
        },
    },
};
</script>

<style lang="scss" scoped>
.user-layout-login {
    label {
        font-size: 14px;
    }

    .getCaptcha {
        display: block;
        width: 100%;
        height: 40px;
    }

    .forge-password {
        font-size: 14px;
    }

    button.login-button {
        padding: 0 15px;
        font-size: 16px;
        height: 40px;
        width: 100%;
    }

    .user-login-other {
        text-align: left;
        margin-top: 24px;
        line-height: 22px;

        .item-icon {
            font-size: 24px;
            color: rgba(0, 0, 0, 0.2);
            margin-left: 16px;
            vertical-align: middle;
            cursor: pointer;
            transition: color 0.3s;

            &:hover {
                color: #1890ff;
            }
        }

        .register {
            float: right;
        }
    }
}
</style>
