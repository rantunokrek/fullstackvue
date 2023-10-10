
require('./bootstrap');
import router from './router'
window.Vue = require('vue');

Vue.component('main-app', require('./components/mainapp.vue').default);


const app = new Vue({
    el: '#app',
    router
});
