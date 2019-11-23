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
import Toasted from "vue-toasted";
import { filters, helper, validator} from "./utils";
import Auth from "./modules/auth/Auth";
import Api from "./modules/api/Api";
import Listener from "./mixins/Listener";
import IsOnline from "./mixins/OnlineChecker";



library.add(fas, fab, far);
Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = true;
Vue.use(Buefy, {
    defaultIconComponent: "vue-fontawesome",
    defaultIconPack: "fas"
});

Vue.use(Toasted);

window.auth = new Auth();
window.Event = new Vue();
window.helper = helper;
window.validator = validator;
window.api = new Api(process.env.MIX_VUE_APP_API);
Vue.prototype.appName = process.env.MIX_VUE_APP_NAME;

filters.forEach(f => {
    Vue.filter(f.name, f.execute);
});

const app = new Vue({
    el: '#app',
    router,
    store,
    mixins: [Listener, IsOnline],
});
