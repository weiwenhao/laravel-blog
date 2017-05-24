
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//弹出层组件
require('sweetalert');
//引入代码高亮js
window.hljs =  require('./app/highlight.min');
/*hljs.initHighlightingOnLoad();*/
hljs.initHighlightingOnLoad();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//引入饿了么组件库
/*import ElementUI from 'element-ui'
import 'element-ui/lib/theme-default/index.css'
Vue.use(ElementUI)*/

// Vue.component('example', require('./components/Example.vue'));
Vue.component('article-comment', require('./components/Comment.vue'));

Vue.directive('highlightjs', function(el) {  //定义一个vue指令
    let blocks = el.querySelectorAll('pre code');
    Array.prototype.forEach.call(blocks, hljs.highlightBlock);
})


const app = new Vue({
    el: '#app'
});
