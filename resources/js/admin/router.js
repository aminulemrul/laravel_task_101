
import Vue from 'vue'


import VueRouter from 'vue-router'


Vue.use(VueRouter)


Vue.component('admin-master', require('../components/admin/AdminMaster.vue').default)

import AdminDashboard from '../components/admin/AdminDashboard'


//auth component
import AdminLogin from '../components/admin/auth/AdminLogin'
import AdminLogout from '../components/admin/auth/AdminLogout'


//role component
import RoleAdd from '../components/admin/role/RoleAdd'
import RoleList from '../components/admin/role/RoleList'
import RoleEdit from '../components/admin/role/RoleEdit'

//permission component
import PermissionAdd from '../components/admin/permission/PermissionAdd'
import PermissionList from '../components/admin/permission/PermissionList'
import PermissionEdit from '../components/admin/permission/PermissionEdit'

//department component
import DepartmentAdd from '../components/admin/department/DepartmentAdd'
import DepartmentList from '../components/admin/department/DepartmentList'
import DepartmentEdit from '../components/admin/department/DepartmentEdit'

//work component
import WorkAdd from '../components/admin/work/WorkAdd'
import WorkList from '../components/admin/work/WorkList'
import WorkEdit from '../components/admin/work/WorkEdit'

//user component
import UserAdd from '../components/admin/user/UserAdd'
import UserList from '../components/admin/user/UserList'
import UserEdit from '../components/admin/user/UserEdit'

//user work component
import UserWorkList from '../components/admin/user-work/UserWorkList'
import UserWorkAdd from '../components/admin/user-work/UserWorkAdd'
import UserWorkEdit from '../components/admin/user-work/UserWorkEdit'






const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        //auth route
        {
            path: '/admin/admin-login',
            component: AdminLogin,
            name: 'AdminLogin'
        },
        {
            path: '/admin/logout',
            component: AdminLogout,
            name: 'AdminLogout'
        },
        {
            path: '/admin/admin-dashboard',
            component: AdminDashboard,
            name: 'AdminDashboard'
        },
         //role route
        {
            path: '/admin/role-add',
            component: RoleAdd,
            name: 'RoleAdd'
        },
         {
            path: '/admin/role-list',
            component: RoleList,
            name: 'RoleList',

        },
        {
            path: '/admin/role-edit/:slug',
            component: RoleEdit,
            name: 'RoleEdit'
        },
         //permission route
        {
            path: '/admin/permission-add',
            component: PermissionAdd,
            name: 'PermissionAdd'
        },
         {
            path: '/admin/permission-list',
            component: PermissionList,
            name: 'PermissionList'
        },
         {
            path: '/admin/permission-edit/:id',
            component: PermissionEdit,
            name: 'PermissionEdit'
        },

         //department route
        {
            path: '/admin/department-add',
            component: DepartmentAdd,
            name: 'DepartmentAdd'
        },
         {
            path: '/admin/department-list',
            component: DepartmentList,
            name: 'DepartmentList'
        },
        {
            path: '/admin/depart-edit/:slug',
            component: DepartmentEdit,
            name: 'DepartmentEdit'
        },

        //work route
        {
            path: '/admin/work-add',
            component: WorkAdd,
            name: 'WorkAdd'
        },
         {
            path: '/admin/work-list',
            component: WorkList,
            name: 'WorkList'
        },
        {
            path: '/admin/work-edit/:slug',
            component: WorkEdit,
            name: 'WorkEdit'
        },

        //user route
        {
            path: '/admin/user-add',
            component: UserAdd,
            name: 'UserAdd'
        },
         {
            path: '/admin/user-list',
            component: UserList,
            name: 'UserList'
        },
        {
            path: '/admin/user-edit/:slug',
            component: UserEdit,
            name: 'UserEdit'
        },
        // user work route
        {
            path: '/admin/user-work-add',
            component: UserWorkAdd,
            name: 'UserWorkAdd'
        },
         {
            path: '/admin/user-work-list',
            component: UserWorkList,
            name: 'UserWorkList'
        },
         {
            path: '/admin/user-work-edit/:id',
            component: UserWorkEdit,
            name: 'UserWorkEdit'
        },



    ]
})

router.beforeEach((to, from, next) => {

    let isAuthenticated = '';
    let admin_token = localStorage.getItem('admin_access_token') ? localStorage.getItem('admin_access_token') : false
    if (admin_token) {

        isAuthenticated = admin_token ? true : false;

    } else {
        isAuthenticated = false;
    }

    if (to.name !== 'AdminLogin' && !isAuthenticated) next({ name: 'AdminLogin' })
    else if (to.name === 'AdminLogin' && isAuthenticated) next({ name: 'AdminDashboard' })
    else next()
})



export default router;
