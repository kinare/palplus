import endpoints from "./endpoints";
import call from "../modules/api";

const Setup = {
    namespaced: true,
    state: {
        setups: [],
        setup : {}
    },
    mutations: {
        SET_SETUPS : (state, payload) => {
            state.setups = payload
        },

        SET_SETUP : (state, payload) => {
            state.setup = payload
        },
    },
    getters: {
        setups : state => state.setups,
        setup : state => state.setup
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
    }
};

export default Setup;
