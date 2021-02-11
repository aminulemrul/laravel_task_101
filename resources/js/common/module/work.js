import Axios from "axios"

export const work = {
    namespaced: true,
    state: {
        workList: {}
    },

    getters: {
        workList(state) {
            return state.workList
        }
    },

    actions: {
        workList(context,payload) {
            Axios.get('/admin/all-work?page='+payload)
                .then((result) => {
                    context.commit('workList', result.data.works)
                }).catch((err) => {

                });

        },
        userWorkList(context, payload) {
            let token = localStorage.getItem('admin_access_token')
            Axios.get('/admin/all-user-work?token='+token)
                .then((result) => {
                    context.commit('workList', result.data.user_works)
                }).catch((err) => {

                });
        },
        allWork(context) {
            axios.get('/admin/all-works')
                .then((result) => {
                    context.commit('workList', result.data.works)
                }).catch((err) => {

                });
        }






    },

    mutations: {
        workList(state, payload) {
            return state.workList = payload
        }
    }

}
