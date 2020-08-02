import endpoints from "./endpoints";
import call from "../modules/api";

const Message = {
    namespaced: true,
    state: {
        message: "",
        countries: [],
    },
    getters: {
        getCountries: (state) => {
            return state.countries;
        },
    },
    mutations: {
        SEND_MESSAGE: (state, message) => {
            state.message = message;
        },
        SET_COUNTRIES: (state, countries) => {
            state.countries = countries;
        },
    },
    actions: {
        sendMessage: (context, payload) => {
            call("post", endpoints.sendMessage, payload).then((res) => {
                context.commit("SEND_MESSAGE", res.data.message);
            });
        },
        getCurrency() {
            call("get", endpoints.currency).then((res) => {
                console.log(res.data);
                context.commit("SET_COUNTRIES", res.data);
            });
        },
    },
};

export default Message;
