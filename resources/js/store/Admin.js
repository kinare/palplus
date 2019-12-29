import endpoints from "./endpoints";
import call from "../modules/api";

const Admin = {
  namespaced: true,
  state: {
    admins: [],
  },
  mutations: {
      SET_ADMIN : (state, payload) => {
          state.admins = payload
      },
  },
  getters: {
      admins : state => state.admins,
  },

  actions: {
      getAdmins : (context) => {
          call('get', endpoints.admins).then(res => {
              context.commit('SET_ADMIN', res.data.data);
          })
      },

      getAdmin : (context, id) => {
          call('get', endpoints.getAdmin).then(res => {
              context.commit('SET_ADMIN', res.data.data);
          })
      },

      inviteAdmin : (context, email) => {
          call('post', endpoints.inviteAdmin, email).then(() => {
              /*successfullly invited*/
          })
      },

      saveAdmin : (context, data) => {
          call('post', endpoints.saveAdmin(data.id), data).then(() => {
              /*successfullly invited*/
          })
      },
  }
};

export default Admin;
