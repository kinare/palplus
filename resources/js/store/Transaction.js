import endpoints from "./endpoints";
import call from "../modules/api";

const Transaction = {
  namespaced: true,
  state: {
    requests: null,
    transactions : null,
  },
  mutations: {
      SET_REQUESTS : (state, payload) => {
          state.requests = payload
      },
      SET_TRANSACTIONS : (state, payload) => {
          state.transactions = payload
      },
  },
  getters: {
      requests : state => state.requests,
      transactions : state =>  state.transactions
  },

  actions: {
      getRequests : (context) => {
          call('get', endpoints.requests).then(res => {
              context.commit('SET_REQUESTS', res.data.data);
          })
      },
      getTransactions : (context) => {
          call('get', endpoints.transactions).then(res => {
              context.commit('SET_TRANSACTIONS', res.data.data);
          })
      },
  }
};

export default Transaction;
