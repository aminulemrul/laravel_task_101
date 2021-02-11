import Axios from "axios"

export const role = {
    namespaced: true,
    state: {
        roleList: {}
    },

    getters: {
        roleList(state) {
            return state.roleList
        }
    },

    actions: {
        roleList(context,payload) {
            Axios.get('/admin/all-role?page='+payload)
                .then((result) => {
                    context.commit('roleList', result.data.roles)
                }).catch((err) => {

                });

        },

        allRole(context) {
            Axios.get('/admin/all-roles')
                .then((result) => {
                    context.commit('roleList', result.data.roles)
                }).catch((err) => {

                });

        },




    },

    mutations: {
        roleList(state, payload) {
            return state.roleList = payload
        }
    }

}
