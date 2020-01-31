import endpoints from "./endpoints";
import call from "../modules/api";

const Setup = {
    namespaced: true,
    state: {
        setups: [],
        adSetups: [],
        setup : {},
        adSetup : {}
    },
    mutations: {
        SET_SETUPS : (state, payload) => {
            state.setups = payload
        },

        SET_SETUP : (state, payload) => {
            state.setup = payload
        },

        SET_AD_SETUPS : (state, payload) => {
            state.adSetups = payload
        },

        SET_AD_SETUP : (state, payload) => {
            state.adSetup = payload
        },
    },
    getters: {
        setups : state => state.setups,
        setup : state => state.setup,
        adSetups : state => state.adSetups,
        adSetup : state => state.adSetup,
    },

    actions: {
        getSetups : (context) => {
            call('get', endpoints.setups).then(res => {
                context.commit('SET_SETUPS', res.data.data);
            })
        },

        getSetup : (context, id) => {
            call('get', endpoints.setup(id)).then(res => {
                context.commit('SET_SETUP', res.data.data);
            })
        },

        saveSetup : ({dispatch}, data) => {
            call('post', endpoints.setups, data).then(res => {
                dispatch('getSetups');
            })
        },

        getAdSetups : (context) => {
            call('get', endpoints.adSetups).then(res => {
                context.commit('SET_AD_SETUPS', res.data.data);
            })
        },

        getAdSetup : (context, id) => {
            call('get', endpoints.adSetup(id)).then(res => {
                context.commit('SET_AD_SETUP', res.data.data);
            })
        },

        saveAdSetup : ({dispatch}, data) => {
            call('post', endpoints.adSetups, data).then(res => {
                dispatch('getAdSetups');
            })
        },

    }
};

export default Setup;
