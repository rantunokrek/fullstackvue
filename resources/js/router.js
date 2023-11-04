
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)
import AdminHome from './components/pages/AdminHome'
import AdminTag from './admin/pages/tags'
import AdminCategory from './admin/pages/category'
import Adminusers from './admin/pages/adminusers'
import Login from './admin/pages/login'
import Role from './admin/pages/role'
import usecom from './vuex/usecom'
import AssignRole from './admin/pages/assignRole'
const routes = [

    {
        path: '/vuex',
        component: usecom,

    },
    {
        path: '/',
        component: AdminHome,

    },
    {
        path: '/tag',
        component: AdminTag,
        name: 'tag',

    },
    {
        path: '/category',
        component: AdminCategory,
        name: 'category',

    },
    {
        path: '/adminusers',
        component: Adminusers,
        name: 'adminusers',

    },
    {
        path: '/login',
        component: Login,
        name: 'login',

    }
    ,
    {
        path: '/role',
        component: Role,
        name: 'role',

    },
    {
        path: '/assignrole',
        component: AssignRole,
        name: 'assignrole',

    }

]

export default new Router({
    mode: 'history',
    routes

})
