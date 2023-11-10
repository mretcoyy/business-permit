<template>
    <Default>
        <div class="user-layout-content">
            <div class="top">
                <div class="title">Password Reset</div>
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
                                        {
                                            validator: validateToNextPassword,
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

                    <a-form-item>
                        <a-input-password
                            size="large"
                            placeholder="Repeat Password"
                            :maxLength="16"
                            :disabled="loginBtn"
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
                                            validator: compareToFirstPassword,
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
                            >Password Reset</a-button
                        >
                    </a-form-item>

                    <a-form-item
                        style="width: 120px !important; margin: auto !important"
                    >
                        <a-button href="/login" type="link">
                            Back to Login
                        </a-button>
                    </a-form-item>
                </a-form>
            </div>
        </div>
    </Default>
</template>

<script>
import Default from "../layouts/Default.vue";
import axios from "axios";

export default {
    components: {
        Default,
    },
    props: { token: String, email: String },
    data() {
        return {
            confirmDirty: false,
            loginBtn: false,
            isLoginError: false,
            errorMessage: null,
            form: this.$form.createForm(this),
            fields: ["fullName", "username", "password", "repeatPassword"],
        };
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault();
            this.form.validateFields(
                (err, values) => !err && this.passwordReset()
            );
        },
        passwordReset() {
            let self = this;
            self.loginBtn = true;
            console.log(self.form);
            axios({
                method: "POST",
                url: "password-reset/save-password-reset",
                data: {
                    password: this.form.getFieldValue("password"),
                    email: this.email,
                    token: this.token,
                },
            })
                .then(function (response) {
                    self.$message.success(
                        "Updated Successfully!...Redirecting!..."
                    );
                    self.form.resetFields();
                    self.loginBtn = false;
                    setTimeout(() => {
                        window.location.href = "/";
                    }, 2000);
                    self.loginBtn = false;
                })
                .catch((error) => {});
        },
        validateToNextPassword(rule, value, callback) {
            const form = this.form;
            if (value && this.confirmDirty) {
                form.validateFields(["confirm"], { force: true });
            }
            callback();
        },
        compareToFirstPassword(rule, value, callback) {
            const form = this.form;
            if (value && value !== form.getFieldValue("password")) {
                callback("Two passwords that you enter is inconsistent!");
            } else {
                callback();
            }
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
