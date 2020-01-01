import endpoints from "./endpoints";
import call from "../modules/api";

const Loan = {
  namespaced: true,
  state: {
    loans: null,
  },
  mutations: {
      SET_LOANS : (state, payload) => {
          state.loans = payload
      },
  },
  getters: {
      pending : state => state.loans,
      paid : state => state.loans,
  },

  actions: {
      getLoans : (context) => {
          call('get', endpoints.loans).then(res => {
              context.commit('SET_LOANS', res.data.data);
          })
      },
  }
};

export default Loan;
