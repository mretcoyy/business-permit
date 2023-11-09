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
            this.loading = true;

            console.log(this.form);
            axios
                .post("/save-password-reset", this.form)
                .then((res) => {
                    console.log(res);
                    if (res.data.response == "success") {
                        self.$message.success(
                            "Updated Successfully!...Redirecting!..."
                        );
                        self.form.resetFields();
                        setTimeout(() => {
                            window.location.href = "/";
                        }, 2000);
                    } else {
                    }
                    this.loading = false;
                })
                .catch((error) => {});
        },
    },
};
</script>

<style lang="scss"></style>
