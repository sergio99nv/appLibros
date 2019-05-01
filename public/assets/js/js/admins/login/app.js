(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/admins/login/app"],{

/***/ "./resources/js/admins/login/app.js":
/*!******************************************!*\
  !*** ./resources/js/admins/login/app.js ***!
  \******************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_router__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-router */ "./node_modules/vue-router/dist/vue-router.esm.js");
/* harmony import */ var vuetify__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuetify */ "./node_modules/vuetify/dist/vuetify.js");
/* harmony import */ var vuetify__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuetify__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var vuetify_dist_vuetify_min_css__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vuetify/dist/vuetify.min.css */ "./node_modules/vuetify/dist/vuetify.min.css");
/* harmony import */ var vuetify_dist_vuetify_min_css__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vuetify_dist_vuetify_min_css__WEBPACK_IMPORTED_MODULE_2__);
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
__webpack_require__(/*! @pathRoot/bootstrap */ "./resources/js/bootstrap.js");

window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

Vue.use(vue_router__WEBPACK_IMPORTED_MODULE_0__["default"]);


Vue.use(vuetify__WEBPACK_IMPORTED_MODULE_1___default.a);
Vue.component('login', __webpack_require__(/*! @pathRoot/login/login.vue */ "./resources/js/login/login.vue")["default"]);
var app = new Vue({
  el: '#app',
  data: function data() {
    return {
      url: "/admins/login/validateLogin",
      fieldForm: [{
        field: "username",
        label: "Username",
        type: "text",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese su username ';
          }
        }
      }, {
        field: "password",
        label: "Password",
        type: "password",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese su  password';
          }
        }
      }]
    };
  }
});

/***/ }),

/***/ 2:
/*!************************************************!*\
  !*** multi ./resources/js/admins/login/app.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sergio99nv/appLibros/resources/js/admins/login/app.js */"./resources/js/admins/login/app.js");


/***/ })

},[[2,"/js/students/commentary/manifest","/js/students/commentary/vendor"]]]);