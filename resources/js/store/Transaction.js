import endpoints from "./endpoints";
import call from "../modules/api";

const Transaction = {
  namespaced: true,
  state: {
    requests: null,
    deposits : null,
    withdrawals : null,
  },
  mutations: {
      SET_REQUESTS : (state, payload) => {
          state.requests = payload
      },
      SET_DEPOSITS : (state, payload) => {
          state.deposits = payload
      },
      SET_WITHDRAWALS : (state, payload) => {
          state.withdrawals = payload
      },
  },
  getters: {
      requests : state => state.requests,
      deposits : state => state.deposits,
      withdrawals : state => state.withdrawals,
  },

  actions: {
      getRequests : (context) => {
          call('get', endpoints.requests).then(res => {
              context.commit('SET_REQUESTS', res.data.data);
          })
      },
      getDeposits : (context) => {
          call('get', endpoints.deposits).then(res => {
              context.commit('SET_DEPOSITS', res.data.data);
          })
      },
      getWithdrawals : (context) => {
          call('get', endpoints.withdrawals).then(res => {
              context.commit('SET_WITHDRAWALS', res.data.data);
          })
      }
  }
};

export default Transaction;
