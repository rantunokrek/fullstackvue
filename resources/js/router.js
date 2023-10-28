
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)
import AdminHome from './components/pages/AdminHome'
import AdminTag from './admin/pages/tags'
import AdminCategory from './admin/pages/category'
import Adminusers from './admin/pages/adminusers'
import Login from './admin/pages/login'
import usecom from './vuex/usecom'
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
        name: 'tag-url',

    },
    {
        path: '/category',
        component: AdminCategory,
        name: 'category-url',

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

]

export default new Router({
    mode: 'history',
    routes

})
