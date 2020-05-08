import endpoints from "./endpoints";
import { authService } from "..";
import call from "../../api";

const AuthStore = {
    namespaced: true,
    state: {
        user: {}
    },
    mutations: {
        SET_USER: (state, user) => {
            state.user = user;
        }
    },
    getters: {
        user: state => state.user
    },

    actions: {
        login: ({ dispatch }, data) => {
            call("post", endpoints.login, data).then(res => {
                // console.log(res.data.access_token)
                authService.login(res.data.access_token);
            });
        },

        register: (context, data) => {
            call("post", endpoints.register, data).then(() => {
                Event.$emit("userSignedUp");
            });
        },

        forgotPass: (context, email) => {
            call("post", endpoints.forgotPass(email)).then(res => {
                console.log(res);
            });
        },

        setPassword: (context, data) => {
            call("post", endpoints.setPass, data).then(res => {
                console.log(res);
            });
        },

        user: context => {
            call("get", endpoints.user).then(res => {
                context.commit("SET_USER", res.data.data);
            });
        },

        logout: () => {
            call("get", endpoints.logout).then(() => {
                authService.logout();
            });
        }
    }
};

export default AuthStore;