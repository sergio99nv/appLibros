
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@pathRoot/bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)
 

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)
 


Vue.component('login', require('@pathRoot/login/login.vue').default);
const app = new Vue({
     el: '#app',
     data(){
        return{
            url : "/login/validateLogin",
            fieldForm : [
                {
                   field: "username",
                   label:"Correo o telefono", 
                   type:"text" ,
                   rules: {required: value => !!value || 'ingrese su correo o telefono'}
               },
               {   
                   field: "password",
                   label:"Password", 
                   type:"password" ,
                   rules: {required: value => !!value || 'ingrese su  password'}
               },
           ]
        }
     }
 })
 