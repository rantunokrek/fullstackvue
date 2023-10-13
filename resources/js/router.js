
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)
import AdminHome from './components/pages/AdminHome'
import AdminTag from './components/pages/AdminTag'
import AdminCategory from './components/pages/AdminCategory'
const routes = [

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

    }

]

export default new Router({
    mode: 'history',
    routes

})
