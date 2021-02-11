import Axios from "axios"

export const permission = {
    namespaced: true,
    state: {
        permissionList: {}
    },

    getters: {
        permissionList(state) {
            return state.permissionList
        }
    },

    actions: {
        permissionList(context,payload) {
            Axios.get('/admin/all-permission?page='+payload)
                .then((result) => {
                    context.commit('permissionList', result.data.permissions)
                }).catch((err) => {

                });

        },






    },

    mutations: {
        permissionList(state, payload) {
            return state.permissionList = payload
        }
    }

}
