<template>
    <UserLayout>
        <div class="user-layout-content">
            <div class="top">
                <div class="title">Register</div>
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
                            placeholder="Full Name"
                            :maxLength="25"
                            :disabled="loginBtn"
                            v-decorator="[
                                'fullName',
                                {
                                    rules: [
                                        {
                                            required: true,
                                            message: 'Full Name Required',
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
                        <a-input
                            size="large"
                            type="text"
                            placeholder="Email"
                            :maxLength="25"
                            :disabled="loginBtn"
                            v-decorator="[
                                'username',
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
                            >Register</a-button
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
    </UserLayout>
</template>

<script>
import UserLayout from "../layouts/UserLayout.vue";
import axios from "axios";

export default {
    components: {
        UserLayout,
    },
    data() {
        return {
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
                (err, values) => !err && this.registerAction()
            );
        },
        registerAction() {
            axios({
                method: "POST",
                url: "user/store",
                data: {
                    fullname: this.form.getFieldValue("fullName"),
                    username: this.form.getFieldValue("username"),
                    password: this.form.getFieldValue("password"),
                    repeatPassword: this.form.getFieldValue("repeatPassword"),
                },
            })
                .then(function (response) {})
                .catch((error) => {
                    console.log(error);
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
