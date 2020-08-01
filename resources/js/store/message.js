import endpoints from "./endpoints";
import call from "../modules/api";

const Message = {
    namespaced: true,
    state: {
        message: "",
    },
    mutations: {
        SEND_MESSAGE: (state, message) => {
            state.message = message;
        },
    },
    actions: {
        sendMessage: (context, payload) => {
            call("post", endpoints.sendMessage, payload).then((res) => {
                context.commit("SEND_MESSAGE", res.data.message);
            });
        },
    },
};

export default Message;