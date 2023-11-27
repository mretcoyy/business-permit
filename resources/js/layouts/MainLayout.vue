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
                <a-menu-item
                    v-for="(item, sidebarIndex) in sidebar"
                    :key="sidebarIndex"
                    @click="viewPage(item.url)"
                >
                    <a-icon :type="item.icon" />
                    <span>{{ item.title }}</span>
                </a-menu-item>
                <a-menu-item @click="logOut" :key="sidebar.length + 1">
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
            sidebar: [
                {
                    url: "/admin/new-application",
                    title: "New Application",
                    icon: "form",
                    role: 3,
                },
                {
                    url: "/admin/application",
                    title: "BPLO Approval",
                    icon: "form",
                    role: 3,
                    
                },
                {
                    url: "/admin/menro",
                    title: "MENRO",
                    icon: "safety-certificate",
                    role: 4,
                },
                {
                    url: "/admin/mpdc",
                    title: "MPDC",
                    icon: "safety-certificate",
                    role: 5,
                },
                {
                    url: "/admin/engineering",
                    title: "Engineering",
                    icon: "safety-certificate",
                    role: 6,
                },
                {
                    url: "/admin/sanitary",
                    title: "Sanitary",
                    icon: "safety-certificate",
                    role: 7,
                },
                {
                    url: "/admin/bfp",
                    title: "BFP",
                    icon: "safety-certificate",
                    role: 8,
                },
                {
                    url: "/admin/tax-computation",
                    title: "Payment",
                    icon: "money-collect",
                    role: 9,
                },
                {
                    url: "/admin/mayors-permit",
                    title: "Mayor's Permit",
                    icon: "money-collect",
                    role: 3,
                },
                {
                    url: "/admin/amendment",
                    title: "Amendments",
                    icon: "folder-open",
                    role: 3,
                },
                {
                    url: "/admin/report",
                    title: "Report",
                    icon: "file",
                    role: 3,
                },
                {
                    url: "/admin/user-management",
                    title: "User Management",
                    icon: "user",
                    role: 3,
                },
            ],
        };
    },
    created() {
     this.sidebar = this.sidebar.filter(checkUserPermission);
    },
    methods: {
        checkUserPermission(data) {
            console.log(data);
            if (data.role == this.$root.$children[0].user.role || this.$root.$children[0].user.role == 1) {
                return data;
            }
        },

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
