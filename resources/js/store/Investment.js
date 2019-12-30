import endpoints from "./endpoints";
import call from "../modules/api";

const Investment = {
  namespaced: true,
  state: {
    opportunity: null,
  },
  mutations: {
      SET_OPPORTUNITIES : (state, payload) => {
          state.opportunity = payload
      },
  },
  getters: {
      opportunity : state => state.opportunity,
  },

  actions: {
      getOpportunites : (context) => {
          call('get', endpoints.opportunities).then(res => {
              context.commit('SET_OPPORTUNITIES', res.data.data);
          })
      },
  }
};

export default Investment;
