import Vue from "vue";
import Vuex from "vuex";
import VuexPersist from "vuex-persist";
import { authStore } from "../modules/auth";

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: "vuex",
    storage: window.localStorage
});

export default new Vuex.Store({
    modules: {
        Auth : authStore,
    },
    state: {
        /* User */
        userName: null,
        userEmail: null,
        userAvatar: null,

        /* NavBar */
        isNavBarVisible: true,

        /* FooterBar */
        isFooterBarVisible: true,

        /* Aside */
        isAsideVisible: true,
        isAsideMobileExpanded: false
    },
    mutations: {
        /* A fit-them-all commit */
        basic (state, payload) {
            state[payload.key] = payload.value
        },

        /* User */
        user (state, payload) {
            if (payload.name) {
                state.userName = payload.name
            }
            if (payload.email) {
                state.userEmail = payload.email
            }
            if (payload.avatar) {
                state.userAvatar = payload.avatar
            }
        },

        /* Aside Mobile */
        asideMobileStateToggle (state, payload = null) {
            const htmlClassName = 'has-aside-mobile-expanded'

            let isShow

            if (payload !== null) {
                isShow = payload
            } else {
                isShow = !state.isAsideMobileExpanded
            }

            if (isShow) {
                document.documentElement.classList.add(htmlClassName)
            } else {
                document.documentElement.classList.remove(htmlClassName)
            }

            state.isAsideMobileExpanded = isShow
        }
    },
    actions: {},
    plugins: [vuexLocalStorage.plugin]
});
