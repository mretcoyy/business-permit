<template>
    <a-layout id="components-layout-demo-top" class="layout">
        <a-layout-header>
            <!-- <div class="logo" /> -->
            <!-- <img 
                src="/images/dolores.png" 
                alt="logo"
                style="height: 25px width: 25px"
            > -->
            <!-- :default-selected-keys="['1']" -->
            <a-menu
                theme="dark"
                mode="horizontal"
                :style="{ lineHeight: '64px' }"
            >
                <a-menu-item key="1">
                    <a href="/dashboard">Dashboard </a></a-menu-item
                >
                <a-menu-item key="2">
                    <a href="/application">Application </a></a-menu-item
                >
                <a-menu-item key="3">
                    <a href="/amendment">Amendment </a></a-menu-item
                >
                <a-menu-item key="4">
                    <span @click="logOut">Logout </span></a-menu-item
                >
            </a-menu>
        </a-layout-header>
        <a-layout-content style="padding: 0 50px">
            <!-- <a-breadcrumb style="margin: 16px 0">
                <a-breadcrumb-item>Home</a-breadcrumb-item>
                <a-breadcrumb-item>List</a-breadcrumb-item>
                <a-breadcrumb-item>App</a-breadcrumb-item>
            </a-breadcrumb> -->
            <slot></slot>
        </a-layout-content>

        <a-layout-footer style="text-align: center">
            Ant Design ©2018 Created by Ant UED
        </a-layout-footer>
    </a-layout>
</template>
<script>
export default {
    data() {
        return {
            //
        };
    },
    methods: {
        logOut() {
            let self = this;
            axios({
                method: "POST",
                url: "user/logout",
            })
                .then(function (response) {
                    window.location.href = "/";
                })
                .catch((error) => {});
        },
    },
};
</script>
