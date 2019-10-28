import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";
import Auth from "./Auth";

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "vuex",
    storage: window.localStorage
});

export default new Vuex.Store({
    modules: {
        Auth : Auth
    },
    state: {},
    mutations: {},
    actions: {},
    plugins: [vuexLocalStorage.plugin]
});
