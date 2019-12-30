import endpoints from "./endpoints";
import call from "../modules/api";

const Group = {
  namespaced: true,
  state: {
    groups: null,
    group: null,
  },
  mutations: {
      SET_GROUPS : (state, payload) => {
          state.groups = payload
      },

      SET_GROUP : (state, payload) => {
          state.group = payload
      },
  },
  getters: {
      groups : state => state.groups,
      group : state => state.group,
  },

  actions: {
      getGroups : (context) => {
          call('get', endpoints.groups).then(res => {
              context.commit('SET_GROUPS', res.data.data);
          })
      },

      getGroup : (context, id) => {
          call('get', endpoints.groups(id)).then(res => {
              context.commit('SET_GROUP', res.data.data);
          })
      },
  }
};

export default Group;
