
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@pathRoot/bootstrap');

window.Vue = require('vue');

 
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
 
Vue.component('commentariesList', require('./commentariesList.vue').default);
const app = new Vue({
     el: '#appCommentaries',
     data(){
        return{
            
        }
     }
 })
 