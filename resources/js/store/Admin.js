import endpoints from "./endpoints";
import call from "../modules/api";

const Admin = {
  namespaced: true,
  state: {
    admins: null,
    admin: null,
  },
  mutations: {
      SET_ADMINS : (state, payload) => {
          state.admins = payload
      },

      SET_ADMIN : (state, payload) => {
          state.admin = payload
      },

      SELECT_ADMIN : (state, id) =>{
          state.admin = state.admins.filter(admin =>{
              return admin.id === id
          }).shift();
      }
  },
  getters: {
      admins : state => state.admins,
      admin : state => state.admin,
  },

  actions: {
      getAdmins : (context) => {
          call('get', endpoints.admins).then(res => {
              context.commit('SET_ADMINS', res.data.data);
          })
      },

      getAdmin : (context, id) => {
          call('get', endpoints.getAdmin(id)).then(res => {
              context.commit('SET_ADMIN', res.data.data);
          })
      },

      invite : (context, data) => {
          call("post", endpoints.inviteAdmin, data).then(res => {
              Event.$emit("ApiSuccess", 200, res.data.message);
          });
      },

      save : (data) => {
          call("post", endpoints.saveAdmin(data.id), data).then(res => {
              Event.$emit("ApiSuccess", 200, 'Saved');
          });
      },

      validate : (context, token) =>{
          call('post', endpoints.validate,  token).then( res=>{
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
