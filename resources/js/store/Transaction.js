import endpoints from "./endpoints";
import call from "../modules/api";

const Transaction = {
  namespaced: true,
  state: {
    requests: [],
    transactions : [],
    payments : [],
  },
  mutations: {
      SET_REQUESTS : (state, payload) => {
          state.requests = payload
      },
      SET_TRANSACTIONS : (state, payload) => {
          state.transactions = payload
      },
      SET_PAYMENTS : (state, payload) => {
          state.payments = payload
      },
  },
  getters: {
      requests : state => state.requests,
      transactions : state =>  state.transactions,
      payments : state =>  state.payments
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
      getPayments : (context) => {
          call('get', endpoints.payments).then(res => {
              context.commit('SET_PAYMENTS', res.data.data);
          })
      },
  }
};

export default Transaction;
