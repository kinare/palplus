import endpoints from "./endpoints";
import call from "../modules/api";

const Setup = {
    namespaced: true,
    state: {
        setups: [],
    },
    mutations: {
        SET_SETUPS : (state, payload) => {
            state.setups = payload
        },
    },
    getters: {
        setups : state => state.setups,
    },

    actions: {
        getSetups : (context) => {
            call('get', endpoints.setups).then(res => {
                context.commit('SET_SETUPS', res.data.data);
            })
        },
    }
};

export default Setup;
