import endpoints from "./endpoints";
import call from "../modules/api";

const Group = {
  namespaced: true,
  state: {
    groups: [],
    group: [],
    setting: [],
    activity: [],
      project: [],
  },
  mutations: {
      SET_GROUPS : (state, payload) => {
          state.groups = payload
      },

      SET_GROUP : (state, payload) => {
          state.group = payload
      },

      SET_SETTING : (state, payload) => {
          state.setting = payload
      },

      SET_ACTIVITY: (state, payload) => {
          state.activity = payload
      },

      SET_PROJECT: (state, payload) => {
          state.project = payload
      },
  },
  getters: {
      groups : state => state.groups,
      group : state => state.group,
      setting : state => state.setting,
      activity : state => state.activity,
      project : state => state.project,
  },

  actions: {
      getGroups : (context) => {
          call('get', endpoints.groups).then(res => {
              context.commit('SET_GROUPS', res.data.data);
          })
      },

      getGroup : (context, id) => {
          call('get', endpoints.group(id)).then(res => {
              context.commit('SET_GROUP', res.data.data);
          })
      },

      getSetting : (context) => {
          call('get', endpoints.membershipSetting).then(res => {
              context.commit('SET_SETTING', res.data.data);
          })
      },

      getActivity : (context) => {
          call('get', endpoints.activity).then(res => {
              context.commit('SET_ACTIVITY', res.data.data);
          })
      },

      getMemberActivity : (context, id) => {
          call('get', endpoints.memberActivity(id)).then(res => {
              context.commit('SET_ACTIVITY', res.data.data);
          })
      },

      getProject : (context) => {
          call('get', endpoints.project).then(res => {
              context.commit('SET_PROJECT', res.data.data);
          })
      },

      myGroups : (context, id) => {
          call('get', endpoints.myGroups(id)).then(res => {
              context.commit('SET_GROUPS', res.data.data);
          })
      },
  }
};

export default Group;
