
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');

 window.Vue = require('vue');
 const VueRouter = require('vue-router').default;
 import lection from "./lection"


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

 
const routes = [
  {
    path: '/lection/:lectionId/',
    component: lection,
    name: 'lection',
    props:true 
  },

];

const router = new VueRouter({      
  
  routes // short for `routes: routes`,
  
});


const app = new Vue({
  router
}).$mount('#app')