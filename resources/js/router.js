
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)
import AdminHome from './components/pages/AdminHome'
const routes = [

    {
        path: '/',
        component: AdminHome,

    },
]

export default new Router({
    mode: 'history',
    routes

})
