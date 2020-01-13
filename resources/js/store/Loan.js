import endpoints from "./endpoints";
import call from "../modules/api";

const Loan = {
  namespaced: true,
  state: {
    loans: [],
    settings: [],
  },
  mutations: {
      SET_LOANS : (state, payload) => {
          state.loans = payload
      },
      SET_SETTING : (state, payload) => {
          state.settings = payload
      },
  },
  getters: {
      loans : state => state.loans,
      setting : state => state.settings,
  },

  actions: {
      getLoans : (context) => {
          call('get', endpoints.loans).then(res => {
              context.commit('SET_LOANS', res.data.data);
          })
      },

      getSetting : (context) => {
          call('get', endpoints.loanSettings).then(res => {
              context.commit('SET_SETTING', res.data.data);
          })
      },
  }
};

export default Loan;
