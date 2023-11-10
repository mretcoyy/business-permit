/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;
import "ant-design-vue/dist/antd.css";
import Antd from "ant-design-vue";
Vue.use(Antd);
import "../sass/app.scss";
import store from "./vuex/index";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component("view-login", require("./views/Login.vue").default);
Vue.component("core", require("./layouts/Core.vue").default);

Vue.component("view-register", require("./views/Register.vue").default);

Vue.component(
    "view-user-dashboard",
    require("./views/User/Dashboard.vue").default
);
Vue.component(
    "view-user-application",
    require("./views/User/Application.vue").default
);

Vue.component(
    "form-application",
    require("./components/FormApplication.vue").default
);

Vue.component(
    "view-admin-dashboard",
    require("./views/Admin/Dashboard.vue").default
);

Vue.component(
    "view-admin-application",
    require("./views/Admin/Application.vue").default
);

Vue.component(
    "view-admin-amendment",
    require("./views/Admin/Amendment.vue").default
);

Vue.component(
    "view-admin-menro-approval",
    require("./views/Admin/MenroApproval.vue").default
);

Vue.component(
    "view-admin-mpdc-approval",
    require("./views/Admin/MpdcApproval.vue").default
);

Vue.component(
    "view-admin-engineering-approval",
    require("./views/Admin/EngineeringApproval.vue").default
);

Vue.component(
    "view-admin-sanitary-approval",
    require("./views/Admin/SanitaryApproval.vue").default
);

Vue.component(
    "view-admin-bfp-approval",
    require("./views/Admin/BfpApproval.vue").default
);

Vue.component(
    "view-admin-tax-computation",
    require("./views/Admin/TaxComputation.vue").default
);

Vue.component(
    "view-admin-mayors-permit",
    require("./views/Admin/MayorsPermit.vue").default
);

Vue.component(
    "view-admin-user-management",
    require("./views/Admin/UserManagement.vue").default
);

Vue.component(
    "view-admin-new-application",
    require("./views/Admin/NewApplication.vue").default
);

Vue.component(
    "view-password-reset",
    require("./views/Password-reset.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    el: "#app",
});
