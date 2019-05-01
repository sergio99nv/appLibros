(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/students/login/app"],{

/***/ "./resources/js/students/login/app.js":
/*!********************************************!*\
  !*** ./resources/js/students/login/app.js ***!
  \********************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuetify__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuetify */ "./node_modules/vuetify/dist/vuetify.js");
/* harmony import */ var vuetify__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vuetify__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuetify_dist_vuetify_min_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuetify/dist/vuetify.min.css */ "./node_modules/vuetify/dist/vuetify.min.css");
/* harmony import */ var vuetify_dist_vuetify_min_css__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuetify_dist_vuetify_min_css__WEBPACK_IMPORTED_MODULE_1__);
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
__webpack_require__(/*! @pathRoot/bootstrap */ "./resources/js/bootstrap.js");

window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");


Vue.use(vuetify__WEBPACK_IMPORTED_MODULE_0___default.a);
Vue.component('login', __webpack_require__(/*! @pathRoot/login/login.vue */ "./resources/js/login/login.vue")["default"]);
var app = new Vue({
  el: '#app',
  data: function data() {
    return {
      url: "/login/validateLogin",
      fieldForm: [{
        field: "username",
        label: "Correo o telefono",
        type: "text",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese su correo o telefono';
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

/***/ 4:
/*!**************************************************!*\
  !*** multi ./resources/js/students/login/app.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sergio99nv/appLibros/resources/js/students/login/app.js */"./resources/js/students/login/app.js");


/***/ })

},[[4,"/js/students/commentary/manifest","/js/students/commentary/vendor"]]]);