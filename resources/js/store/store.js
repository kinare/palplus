import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";
import Auth from "./Auth";
import Admin from "./Admin";

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "vuex",
    storage: window.localStorage
});

export default new Vuex.Store({
    modules: {
        Auth : Auth,
        Admin : Admin
    },
    state: {},
    mutations: {},
    actions: {},
    plugins: [vuexLocalStorage.plugin]
});
