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
  getters: {},

  actions: {
    login: ({ dispatch }, data) => {
      call("post", endpoints.login, data).then(res => {
        authService.login(res.headers["infi-authorization"]);
        dispatch("user");
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
        context.commit("SET_USER", res.data && res.data.user);
      });
    },

    logout: () => {
      // window.api.call("post", endpoints.logout, { accessToken }).then(() => {
      authService.logout();
      // });
    }
  }
};

export default AuthStore;
