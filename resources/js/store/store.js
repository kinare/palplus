import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "vuex",
    storage: window.localStorage
});

export default new Vuex.Store({
    modules: {
    },
    state: {},
    mutations: {},
    actions: {},
    plugins: [vuexLocalStorage.plugin]
});
