import endpoints from "./endpoints";
import call from "../modules/api";

const Member = {
  namespaced: true,
  state: {
    members: null,
    member: null,
  },
  mutations: {
      SET_MEMBERS : (state, payload) => {
          state.members = payload
      },

      SET_MEMBER : (state, payload) => {
          state.member = payload
      },
  },
  getters: {
      members : state => state.members,
      member : state => state.member,
  },

  actions: {
      getMembers : (context) => {
          call('get', endpoints.member).then(res => {
              context.commit('SET_MEMBERS', res.data.data);
          })
      },

      getMember : (context, id) => {
          call('get', endpoints.member(id)).then(res => {
              context.commit('SET_MEMBER', res.data.data);
          })
      },
  }
};

export default Member;
