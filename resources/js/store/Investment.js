import endpoints from "./endpoints";
import call from "../modules/api";

const Investment = {
    namespaced: true,
    state: {
        opportunities: [],
    },
    mutations: {
        SET_OPPORTUNITIES: (state, payload) => {
            state.opportunities = payload
        },
    },
    getters: {
        opportunities: state => state.opportunities,
    },

    actions: {
        getOpportunities: (context) => {
            call('get', endpoints.opportunities).then(res => {
                context.commit('SET_OPPORTUNITIES', res.data.data);
            })
        },
        deleteOpportunity(item_id) {
            call('delete', `${endpoints.opportunities}/${item_id}`).then(res => {
                context.dispatch('getOpportunities');
            })
        }
    }
};

export default Investment;