
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@pathRoot/bootstrap');



import VueRouter from 'vue-router'
Vue.use(VueRouter)
 
  
const routes = [
    {
       path: '/', 
       component:  Vue.component('categories', require('./categories').default)
    },

    {
      path: '/libros/:bookCategoryId', 
      component:  Vue.component('books', require('./books').default),
      props:true 
    },

    {
      path: '/videos/:bookCategoryId', 
      component:  Vue.component('videos', require('./videos').default),
      props:true 
    }
    
  ]
 

  const router = new VueRouter({
    routes
  })
  

  const app = new Vue({
    router
  }).$mount('#app')
 