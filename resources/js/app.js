window.Vue = require('vue');
window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import router from "./router/router";
import store from "./store/store";
import Buefy from "buefy";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(fas, fab, far);
Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = true;
Vue.use(Buefy, {
    defaultIconComponent: "vue-fontawesome",
    defaultIconPack: "fas"
});


const app = new Vue({
    el: '#app',
    router,
    store
});
