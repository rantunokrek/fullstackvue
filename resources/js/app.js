
require('./bootstrap');
import router from './router'
window.Vue = require('vue')
import ViewUi from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUi);
import common from './common';
Vue.mixin(common)
Vue.component('main-app', require('./components/mainapp.vue').default);


const app = new Vue({
    el: '#app',
    router
});
