import Axios from "axios"

export const user = {
    namespaced: true,
    state: {
        user: {},
        userList: {}

    },

    getters: {
        getUser(state) {
            return state.user
        },
        userList(state) {
            return state.userList
        },

    },

    actions: {

        getUser(context) {

            let token = localStorage.getItem('admin_access_token')

            if (token) {
                Axios.post('/api/auth/me?token='+token)
                    .then((result) => {
                    context.commit('getUser', result.data)
                }).catch((err) => {

                });
            } else {
                context.commit('getUser', {user: ''})
            }



        },

        userList(context, payload) {
             let token = localStorage.getItem('admin_access_token')
            Axios.get('/admin/all-user?page='+payload)
                .then((result) => {
                    context.commit('userList', result.data.users)
                }).catch((err) => {

                });
        },
        allUser(context) {

            Axios.get('/admin/all-users')
                .then((result) => {
                    context.commit('userList', result.data.users)
                }).catch((err) => {

                });

        }






    },

    mutations: {
        getUser(state, payload) {
            return state.user = payload
        },
        userList(state, payload) {
            return state.userList = payload
        },

    }

}
