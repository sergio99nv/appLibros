
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@pathRoot/bootstrap');
 
 

Vue.component('users', require('./users').default);
const app = new Vue({
     el: '#app',
 })
 