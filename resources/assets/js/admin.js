
/**
 * 包含 jquery bootstrap axios vue 等常用js
 */
/*;

*/
// window._ = require('lodash')

window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css'; //引入了css文件

Vue.use(ElementUI); //使用elemeui

/*Vue.component('example', require('./components/Example.vue'));
const app = new Vue({
    el: '#app',
    render : h => h(App)  //何解?
});*/
