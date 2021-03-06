/* Core */
import Vue from "vue";
import Buefy from "buefy";

/* Router & Store */
import router from "./router/router";
import store from "./store/store";

/* mixins */
import { Listener, Status } from "./mixins";

/* Styles */
import "../scss/main.scss";
import "@mdi/font/css/materialdesignicons.css";
import "vue-select/dist/vue-select.css";

/* Vue. Component in recursion */
import AsideMenuList from "./components/AsideMenuList";

/* Utilities */
import { filters, helper, validator } from "./utils";

Vue.config.productionTip = true;
Vue.use(Buefy);

window.helper = helper;
window.validator = validator;
Event = new Vue();
Vue.prototype.appName = process.env.MIX_VUE_APP_NAME;

filters.forEach((f) => {
    Vue.filter(f.name, f.execute);
});

/* These components are used in recursion algorithm */
Vue.component("AsideMenuList", AsideMenuList);

const app = new Vue({
    el: "#app",
    router,
    store,
    mixins: [Listener, Status],
});
