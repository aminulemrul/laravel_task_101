import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)



import { user } from './module/user'
import { role } from './module/role'
import { department } from './module/department'
import { work } from './module/work'
import { permission } from './module/permission'


export const store = new Vuex.Store({
    modules: {

        user: user,
        role: role,
        permission: permission,
        department: department,
        work: work,

    }
})
