import endpoints from "./endpoints";

const Auth = {
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
      window.api.call("post", endpoints.login, data).then(res => {
        window.auth.login(res.data);
        dispatch("user");
      });
    },

    register: (context, data) => {
      window.api.call("post", endpoints.register, data).then(() => {
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

    logout: (context) => {
      window.api.call("get", endpoints.logout ).then(() => {
        window.auth.logout();
      });
    }
  }
};

export default Auth;
