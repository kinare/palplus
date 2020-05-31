import endpoints from "./endpoints";
import call from "../modules/api";

const Transaction = {
    namespaced: true,
    state: {
        requests: [],
        transactions: [],
        payments: [],
        paypalRequests: [],
    },
    mutations: {
        SET_REQUESTS: (state, payload) => {
            state.requests = payload;
        },
        SET_TRANSACTIONS: (state, payload) => {
            state.transactions = payload;
        },
        SET_PAYMENTS: (state, payload) => {
            state.payments = payload;
        },
        SET_PAYPAL_REQUESTS: (state, payload) => {
            state.paypalRequests = payload;
        },
    },
    getters: {
        requests: (state) => state.requests,
        transactions: (state) => state.transactions,
        payments: (state) => state.payments,
        paypalRequests: (state) => state.paypalRequests,
    },
    actions: {
        getRequests: (context) => {
            call("get", endpoints.requests).then((res) => {
                context.commit("SET_REQUESTS", res.data.data);
            });
        },
        getTransactions: (context) => {
            call("get", endpoints.transactions).then((res) => {
                context.commit("SET_TRANSACTIONS", res.data.data);
            });
        },
        getPayments: (context) => {
            call("get", endpoints.payments).then((res) => {
                context.commit("SET_PAYMENTS", res.data.data);
            });
        },
        getPaypalPayment: (context) => {
            call("get", endpoints.paypalRequests).then((res) => {
                context.commit("SET_PAYPAL_REQUESTS", res.data.data);
            });
        },
    },
};

export default Transaction;