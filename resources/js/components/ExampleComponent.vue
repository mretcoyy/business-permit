<template>
    <a-layout id="components-layout-demo-top" class="layout">
        <a-layout-header>
            <div class="logo" />
            <a-menu
                theme="dark"
                mode="horizontal"
                :default-selected-keys="['2']"
                :style="{ lineHeight: '64px' }"
            >
                <a-menu-item key="1"> nav 1 </a-menu-item>
                <a-menu-item key="2"> nav 2 </a-menu-item>
                <a-menu-item key="3"> nav 3 </a-menu-item>
            </a-menu>
        </a-layout-header>
        <a-layout-content style="padding: 0 50px">
            <a-breadcrumb style="margin: 16px 0">
                <a-breadcrumb-item>Home</a-breadcrumb-item>
                <a-breadcrumb-item>List</a-breadcrumb-item>
                <a-breadcrumb-item>App</a-breadcrumb-item>
            </a-breadcrumb>
            <div
                :style="{
                    background: '#fff',
                    padding: '24px',
                    minHeight: '280px',
                }"
            >
                <a-form>
                    <a-form-item label="Business Type:">
                        <a-radio-group v-model="type" @change="onChange">
                            <a-radio-button value="new"> New </a-radio-button>
                            <a-radio-button value="renewal">
                                Renewal
                            </a-radio-button>
                            <a-radio-button value="additional">
                                Additional
                            </a-radio-button>
                        </a-radio-group>
                    </a-form-item>
                    <a-divider />

                    <a-row :gutter="16">
                        <a-col :span="12">
                            <a-form-item label="Date of Application">
                                <a-date-picker style="width: 100%" />
                            </a-form-item>
                            <a-form-item label="Reference No">
                                <a-input type="number" />
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="DTI/SEC/CDA Registration No">
                                <a-input type="number" />
                            </a-form-item>
                            <a-form-item
                                label="DTI/SEC/CDA Date of registration"
                            >
                                <a-date-picker style="width: 100%" />
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="Type of Organization:">
                                <a-radio-group
                                    v-model="organization"
                                    @change="onChangeOrganization"
                                >
                                    <a-radio-button value="single">
                                        Single
                                    </a-radio-button>
                                    <a-radio-button value="partnership">
                                        Partnership
                                    </a-radio-button>
                                    <a-radio-button value="corporation">
                                        Corporation
                                    </a-radio-button>
                                    <a-radio-button value="cooperative">
                                        Cooperative
                                    </a-radio-button>
                                </a-radio-group>
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item
                                label="Are you enjoying tax incentive from any Goverment Entity:"
                            >
                                <a-radio-group>
                                    <a-radio value="yes"> Yes </a-radio>
                                    <a-radio value="No"> No </a-radio>
                                </a-radio-group>
                            </a-form-item>
                        </a-col>
                    </a-row>
                    <a-divider />
                    <a-row :gutter="16">
                        <p style="padding-left: 9px; font-weight: bold">
                            Tax Payer Name:
                        </p>
                        <a-col :span="8">
                            <a-form-item label="Last Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="First Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Middle Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="24">
                            <a-form-item label="Business Name">
                                <a-input />
                            </a-form-item>
                            <a-form-item label="Trade name/Franchise">
                                <a-input />
                            </a-form-item>
                        </a-col>
                        <p style="padding-left: 9px; font-weight: bold">
                            Name of the president/Treasurer of corporation:
                        </p>
                        <a-col :span="8">
                            <a-form-item label="Last Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="First Name">
                                <a-input /> </a-form-item
                        ></a-col>
                        <a-col :span="8">
                            <a-form-item label="Middle Name">
                                <a-input /> </a-form-item
                        ></a-col>
                    </a-row>
                    <a-divider />
                </a-form>
            </div>
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
            type: "new",
            organization: "single",
        };
    },
    methods: {
        onChange(e) {
            console.log(`checked = ${e.target.value}`);
        },
        onChangeOrganization(e) {
            //
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
