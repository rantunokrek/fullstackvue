
import Router from 'vue-router'
import Vue from 'vue'
Vue.use(Router)
import firstPage from './components/pages/FirstPage'
const routes = [

    {
        path: '/firstPage',
        component: firstPage,

    },
]

export default new Router({
    mode: 'history',
    routes

})
