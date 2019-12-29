import endpoints from "./endpoints";
import call from "../modules/api";

const Wallet = {
  namespaced: true,
  state: {
    wallets: {},
    deposits : [],
    withdrawals : [],
  },
  mutations: {
      SET_WALLLETS : (state, payload) => {
          state.wallets = payload
      },
      SET_DEPOSITS : (state, payload) => {
          state.wallets = payload
      },
      SET_WITHDRAWALS : (state, payload) => {
          state.wallets = payload
      },
  },
  getters: {
      wallets : state => state.wallets,
      deposits : state => state.deposits,
      withdrawals : state => state.withdrawals,
  },

  actions: {
      getWallets : (context) => {
          call('get', endpoints.wallets).then(res => {
              context.commit('SET_WALLLETS', res.data.data);
          })
      },
      getDeposits : (context) => {
          call('get', endpoints.depotits).then(res => {
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

export default Wallet;
