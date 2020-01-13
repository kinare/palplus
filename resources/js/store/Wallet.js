import endpoints from "./endpoints";
import call from "../modules/api";

const Wallet = {
  namespaced: true,
  state: {
    wallets: [],
    transactions : null,
  },
  mutations: {
      SET_WALLETS : (state, payload) => {
          state.wallets = payload
      },
      SET_TRANSACTIONS : (state, payload) => {
          state.transactions = payload
      },
  },
  getters: {
      wallets : state => state.wallets,
      transactions : state =>  state.transactions
  },

  actions: {
      getWallets : (context) => {
          call('get', endpoints.wallets).then(res => {
              context.commit('SET_WALLETS', res.data.data);
          })
      },
      getTransactions : (context) => {
          call('get', endpoints.wallet_transactions).then(res => {
              context.commit('SET_TRANSACTIONS', res.data.data);
          })
      },
  }
};

export default Wallet;
