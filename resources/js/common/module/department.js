import Axios from "axios"

export const department = {
    namespaced: true,
    state: {
        departmentList: {}
    },

    getters: {
        departmentList(state) {
            return state.departmentList
        }
    },

    actions: {
        departmentList(context,payload) {
            Axios.get('/admin/all-department?page='+payload)
                .then((result) => {
                    context.commit('departmentList', result.data.departments)
                }).catch((err) => {

                });

        },
        allDepartment(context) {
            Axios.get('/admin/all-departments')
                .then((result) => {
                    context.commit('departmentList', result.data.departments)
                }).catch((err) => {

                });
        }






    },

    mutations: {
        departmentList(state, payload) {
            return state.departmentList = payload
        }
    }

}
