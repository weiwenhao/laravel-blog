
window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

window.Vue = require('vue');
window.axios = require('axios');




window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};


Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
