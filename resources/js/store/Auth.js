import endpoints from "./endpoints";
import call from "../modules/api";
import {authService} from "../modules/auth";

const Auth = {
  namespaced: true,
  state: {
    user: {},
    admin : {
      access_type: "",
      email: "",
      id: '',
      name: "",
      phone: "",
    }
  },
  mutations: {
    SET_USER: (state, user) => {
      state.user = user;
    },
    SET_ADMIN : (state, admin) => {
      state.admin = admin
    }
  },
  getters: {},

  actions: {
    login: ({ dispatch }, data) => {
      window.api.call("post", endpoints.login, data).then(res => {
        window.auth.login(res.data);
        dispatch("user");
      });
    },

    register: (context, data) => {
      window.api.call("post", endpoints.create, data).then(() => {
        Event.$emit("userSignedUp");
      });
    },

    verifyGoogleToken: (context, token) => {
      console.log(token);
      window.api.call("get", endpoints.verifyGoogle(token)).then(res => {
        window.auth.login(res.data);
      });
    },

    user: context => {
      window.api.call("get", endpoints.user).then(res => {
        context.commit("SET_USER", res.data);
      });
    },

    validate: (context, token) => {
      window.api.call("post", endpoints.validate, {token : token}).then(res => {
        context.commit("SET_ADMIN", res.data.data);
      });
    },

    logout: (context) => {
      call("get", endpoints.logout ).then(() => {
        authService.logout()
      });
    }
  }
};

export default Auth;
