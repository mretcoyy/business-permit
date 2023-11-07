<template>
    <a-layout id="components-layout-demo-custom-trigger">
        <a-layout-sider
            v-model="collapsed"
            :trigger="null"
            collapsible
            style="min-height: 100vh"
        >
            <div style="width: 100%; overflow: hidden">
                <img
                    src="/images/dolores.png"
                    alt="logo"
                    style="
                        width: 100%;
                        max-width: 100px;
                        max-height: 100px;
                        margin: 10px auto !important;
                        display: block;
                    "
                />
                <p
                    style="
                        color: white;
                        text-align: center;
                        text-overflow: ellipsis;
                    "
                >
                    {{ email }}
                </p>
            </div>
            <a-menu theme="dark" mode="inline" :default-selected-keys="['0']">
                <a-menu-item @click="viewPage(`/user/dashboard`)" key="1">
                    <a-icon type="dashboard" />
                    <span>Dashboard</span>
                </a-menu-item>
                <a-menu-item @click="viewPage(`/admin/application`)" key="2">
                    <a-icon type="form" />
                    <span>Application</span>
                </a-menu-item>
                <a-menu-item
                    @click="viewPage(`/admin/certificate-approval`)"
                    key="3"
                >
                    <a-icon type="safety-certificate" />
                    <span>Certificate Approval</span>
                </a-menu-item>
                <a-menu-item
                    @click="viewPage(`/admin/clearance-approval`)"
                    key="4"
                >
                    <a-icon type="folder" />
                    <span>Clearance Approval</span>
                </a-menu-item>
                <a-menu-item
                    @click="viewPage(`/admin/tax-computation`)"
                    key="5"
                >
                    <a-icon type="money-collect" />
                    <span>Tax Computation</span>
                </a-menu-item>
                <a-menu-item @click="viewPage(`/admin/mayors-permit`)" key="6">
                    <a-icon type="money-collect" />
                    <span>Mayor's Permit</span>
                </a-menu-item>
                <a-menu-item @click="viewPage(`/admin/amendment`)" key="7">
                    <a-icon type="folder-open" />
                    <span>Amendment</span>
                </a-menu-item>

                <a-menu-item
                    @click="logOut"
                    key="7
            "
                >
                    <a-icon type="logout" />
                    <span>Logout</span>
                </a-menu-item>
            </a-menu>
        </a-layout-sider>
        <a-layout>
            <a-layout-header style="background: #fff; padding: 0">
                <a-icon
                    class="trigger"
                    style="padding-top: 20px"
                    :type="collapsed ? 'menu-unfold' : 'menu-fold'"
                    @click="() => (collapsed = !collapsed)"
                />
            </a-layout-header>
            <a-layout-content
                :style="{
                    margin: '24px 16px',
                    padding: '24px',
                    background: '#fff',
                }"
            >
                <slot></slot>
            </a-layout-content>
        </a-layout>
    </a-layout>
</template>
<script>
export default {
    data() {
        return {
            collapsed: false,
            email: "",
        };
    },
    methods: {
        viewPage(url) {
            if (url) window.location.href = url;
        },
        logOut() {
            axios({
                method: "POST",
                url: "/user/logout",
            })
                .then(function (response) {
                    window.location.href = "/";
                })
                .catch((error) => {});
        },
        async getUser() {
            const res = await axios({
                method: "GET",
                url: "/user/get-user",
            });
            this.email = res.data.email;
        },
    },
    mounted() {
        this.getUser();
    },
};
</script>
<style>
#components-layout-demo-custom-trigger .trigger {
    font-size: 18px;
    line-height: 64px;
    padding: 0 24px;
    cursor: pointer;
    transition: color 0.3s;
}

#components-layout-demo-custom-trigger .trigger:hover {
    color: #1890ff;
}

#components-layout-demo-custom-trigger .logo {
    height: 32px;
    background: rgba(255, 255, 255, 0.2);
    margin: 16px;
}
</style>
