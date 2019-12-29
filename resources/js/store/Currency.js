import endpoints from "./endpoints";
import call from "../modules/api";

const Currency = {
  namespaced: true,
  state: {
    currency: [],
  },
  mutations: {
      SET_CURRENCY : (state, payload) => {
          state.currency = payload
      },
  },
  getters: {
      currency : state => state.currency,
  },

  actions: {
      getCurrency : (context) => {
          call('get', endpoints.currency).then(res => {
              context.commit('SET_CURRENCY', res.data.data);
          })
      },
  }
};

export default Currency;
