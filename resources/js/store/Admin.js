import endpoints from "./endpoints";

const Auth = {
  namespaced: true,
  state: {
    admins: {}
  },
  mutations: {
    SET_ADMINS: (state, admins) => {
      state.admins = admins;
    }
  },
  getters: {},

  actions: {
    invite : (context, data) => {
      window.api.call("post", endpoints.inviteAdmin, data).then(res => {
        Event.$emit("ApiSuccess", 200, res.data.message);
        this.router.push('dashboard/admins')
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
