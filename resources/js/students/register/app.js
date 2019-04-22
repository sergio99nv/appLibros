
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
 


Vue.component('register', require('./register.vue').default);
const app = new Vue({
     el: '#app',
     data(){
        return{
            url : "/register/store",
            fieldForm : [
                {
                   field: "firstName",
                   label:"Nombres", 
                   type:"text" ,
                   rules: {required: value => !!value || 'ingrese sus nombres'}
               },
               {
                field: "lastName",
                label:"Apellidos", 
                type:"text" ,
                rules: {required: value => !!value || 'ingrese sus apellidos'}
             },
             {
                field: "email",
                label:"Correo", 
                type:"email" ,
                rules: {required: value => !!value || 'ingrese su correo'}
             },
             {
                field: "phoneNumber",
                label:"telefono", 
                type:"tel" ,
                rules: {required: value => !!value || 'ingrese su telefono'}
             },
             {
                field: "password",
                label:"Contrasena", 
                type:"password" ,
                rules: {required: value => !!value || 'ingrese su contrasena'}
             },
               
           ]
        }
     }
 })
 