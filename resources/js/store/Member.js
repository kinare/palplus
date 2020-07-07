import endpoints from "./endpoints";
import call from "../modules/api";

const Member = {
    namespaced: true,
    state: {
        members: [],
        member: [],
        nok: [],
    },
    mutations: {
        SET_MEMBERS: (state, payload) => {
            state.members = payload;
        },

        SET_MEMBER: (state, payload) => {
            state.member = payload;
        },
        SET_NOK: (state, payload) => {
            state.nok = payload;
        },
    },
    getters: {
        members: (state) => state.members,
        member: (state) => state.member,
        nok: (state) => state.nok,
    },

    actions: {
        getMembers: (context) => {
            call("get", endpoints.members).then((res) => {
                context.commit("SET_MEMBERS", res.data.data);
            });
        },

        getMember: (context, id) => {
            call("get", endpoints.member(id)).then((res) => {
                context.commit("SET_MEMBER", res.data.data);
            });
        },

        getNok: (context) => {
            call("get", endpoints.nok).then((res) => {
                context.commit("SET_NOK", res.data.data);
            });
        },

        toggleMemberActive: ({ dispatch }, data) => {
            call("post", endpoints.toggleMemberActive, data).then((res) => {
                dispatch("getMembers");
            });
        },

        suspendMember: ({ dispatch }, data) => {
            call("post", endpoints.suspendMember, data).then((res) => {
                dispatch("getMembers");
            });
        },
    },
};

export default Member;