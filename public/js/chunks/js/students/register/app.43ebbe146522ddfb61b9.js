(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/students/register/app"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/students/register/register.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "register",
  components: {},
  props: {
    url: {
      required: true,
      type: String
    },
    title: {
      type: String,
      required: true
    },
    fieldForm: {
      type: Array,
      required: true
    }
  },
  data: function data() {
    return {
      errorForm: {
        value: false,
        msg: ""
      },
      sendingFormData: false,
      form: {},
      formSended: false,
      gettingFormData: false,
      confirmPassword: {
        value: "",
        type: "password",
        error: ""
      },
      passwordCorrect: false
    };
  },
  created: function created() {
    this.setFormFields();
  },
  methods: {
    /**
    * establecemos  los campos  q se usaran el formulario y adicionamos
    * algunas propiedad para el manejo de errores
    */
    setFormFields: function setFormFields() {
      var _this = this;

      this.fieldForm.forEach(function (element) {
        _this.$set(_this.form, element.field, {
          error: false,
          value: "",
          serverErrorMsg: "",
          rules: element.rules,
          type: element.type
        });
      });
    },

    /**
     * si se recibe un error al validar los campos en el server
     * adicionamos los errores recibidos al campo correspondiente
     * 
     * Si un campo tiene un erro asignamos el error en la propiedad
     * -serverErrorMsg-
     * @param {Object} dataServer  contiene los errores 
     */
    setFieldErrorServer: function setFieldErrorServer(dataServer) {
      for (var _i = 0, _Object$keys = Object.keys(dataServer); _i < _Object$keys.length; _i++) {
        var field = _Object$keys[_i];
        var item = dataServer[field];

        if (this.form[field]) {
          this.form[field].error = true;
          this.form[field].serverErrorMsg = item[0];
        }
      }
    },
    comparePassInputs: function comparePassInputs() {
      if (this.form["password"].value.trim() != this.confirmPassword.value.trim()) {
        return false;
      }

      return true;
    },

    /*
     * metodo para validar  y obtener los campos del formulario,  
     *  si todo esta bien obtenemos y enviamos los datos al server
     */
    dataFormHandler: function dataFormHandler() {
      this.sendingFormData = true;
      this.formSended = true;
      var objectForm = this.form; //validamos

      if (!this.validateData(objectForm)) {
        this.sendingFormData = false;
        return;
      }

      if (!this.comparePassInputs()) {
        this.sendingFormData = false;
        this.confirmPassword.error = "Las contraseñas no coinciden";
        return;
      } //obtenmos la data


      var formData = this.getDataForm(objectForm); //enviamos la data al server

      this.sendDataForm(this.url, formData);
    },

    /**
     * obtenemos los campos del formulario
     * 
     * @param {object}  objectForm los campos del formulario
     * @param {object}  formData retornamos los campos
     */
    getDataForm: function getDataForm(objectForm) {
      var formData = new FormData(); //obtenemos y adicionamos la data del formulario

      for (var _i2 = 0, _Object$keys2 = Object.keys(objectForm); _i2 < _Object$keys2.length; _i2++) {
        var key = _Object$keys2[_i2];
        var fieldItem = objectForm[key];
        formData.append(key, objectForm[key].value);
      }

      return formData;
    },

    /**
     * enviar datos al servidor
     * 
     * @param {string}  url La url donde se enviaran los datos
     * @param {object}  params Los parametros que se enviaran
     */
    sendDataForm: function sendDataForm(url, params) {
      var _this2 = this;

      var token = document.head.querySelector('meta[name="csrf-token"]');
      if (token) window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
      axios.post(url, params).then(function (response) {
        _this2.sendingFormData = false;
        var responseData = response.data;

        if (responseData.error === false) {
          _this2.passwordCorrect = true;
          window.location = responseData.redirecTo;
        } else {
          if (responseData.dataError) {
            _this2.setFieldErrorServer(responseData.dataError);

            _this2.setErrorForm(true, "Revise los campos del formulario");
          } else {
            throw new Error('un error al procesar los datos');
          }
        }
      })["catch"](function (error) {
        _this2.sendingFormData = false;

        _this2.setErrorForm(true, "un error al procesar los datos");

        console.log(error);
      });
    },

    /**
     * metodo para validar si todos los campos estan llenos
     * 
     * @param {object}  objectForm los campos del formulario
     * @return {boolean}  retorna false si  encontro uno o mas campos pendientes
     */
    validateData: function validateData(objectForm) {
      var erros = 0;

      for (var _i3 = 0, _Object$keys3 = Object.keys(objectForm); _i3 < _Object$keys3.length; _i3++) {
        var key = _Object$keys3[_i3];
        var field = objectForm[key];
        if (field.rules.required === false) continue;

        if (field.value.trim().length <= 0) {
          field.error = true;
          ++erros;
        }
      }

      return erros <= 0 ? true : false;
    },

    /**
     * metodo asignado a los input del form, cambia la propiedad --error--
     * a false
     * 
     * @param {string}  field hace referencia a un campo del formulario
     */
    inputHideError: function inputHideError(field) {
      this.form[field].error = false;
      this.form[field].serverErrorMsg = "";
    },

    /**
    * metodo para mostar o ocultar un mensaje de error en el formulario
    * @param {boolean}  error si es true muesta el mensaje
    * @param {string} msg  El mensaje que se mostrara
    */
    setErrorForm: function setErrorForm(error) {
      var msg = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
      this.errorForm.value = error;
      this.errorForm.msg = msg;
    },
    showPass: function showPass() {
      if (this.form["password"].type === 'password') {
        this.form["password"].type = "text";
        this.confirmPassword.type = "text";
      } else {
        this.form["password"].type = "password";
        this.confirmPassword.type = "password";
      }
    }
  },
  computed: {
    isShowingPass: function isShowingPass() {
      return this.form["password"].type == "password" && this.confirmPassword.type == "password";
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.store[data-v-054a5cd6]{\n   max-width: 800px;\n   width: 95%;\n   margin: 40px  auto 0 auto;\n}\n.sc-confirm-password[data-v-054a5cd6]{\n   display: flex;\n}\n.row[data-v-054a5cd6]{\n       padding-left: 16px;\n}\n.error-server[data-v-054a5cd6] {\n     padding: 10px 17px;\n}\n.div-opacity[data-v-054a5cd6]{\n   position: relative;\n}\n.div-opacity[data-v-054a5cd6]::after{\n   position: absolute;\n   content: \"\";\n   background-color: white;\n   opacity: 0.4;\n   left: 0;\n   top: 0;\n   width: 100%;\n   height: 100%;\n}\n.v-progress-linear[data-v-054a5cd6]{\n   margin-top: 0;\n}\n@media only screen and (min-width: 600px) {\n.store-form[data-v-054a5cd6]{\n      display: grid;\n      grid-template-columns: 1fr 1fr;\n      grid-gap: 15px 20px;\n}\n.row[data-v-054a5cd6]{\n       margin-bottom: 20px;\n       padding-left: 0;\n}\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\nbody {\n   background-color: var(--main-content-bg);\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--5-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--5-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--5-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--5-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./register.vue?vue&type=style&index=1&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=template&id=054a5cd6&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/students/register/register.vue?vue&type=template&id=054a5cd6&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "store" },
    [
      _c("v-app", [
        _vm.passwordCorrect
          ? _c("div", [_c("h1", [_vm._v(" cargando ...")])])
          : _vm._e(),
        _vm._v(" "),
        _c(
          "div",
          {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: !_vm.passwordCorrect,
                expression: "!passwordCorrect"
              }
            ],
            staticClass: "v-card  v-sheet theme--light  ",
            class: { "div-opacity": _vm.sendingFormData }
          },
          [
            _vm.sendingFormData
              ? _c("v-progress-linear", { attrs: { indeterminate: true } })
              : _vm._e(),
            _vm._v(" "),
            _c("div", { staticClass: "v-card__title headline" }, [
              _c("h4", [_vm._v(" Registro")])
            ]),
            _vm._v(" "),
            _vm.errorForm.value
              ? _c("div", { staticClass: "error-server  red--text" }, [
                  _vm._v(
                    "\n               " +
                      _vm._s(_vm.errorForm.msg) +
                      "\n         "
                  )
                ])
              : _vm._e(),
            _vm._v(" "),
            _c(
              "form",
              {
                attrs: { action: "" },
                on: {
                  submit: function($event) {
                    $event.preventDefault()
                    return _vm.dataFormHandler()
                  }
                }
              },
              [
                _c(
                  "section",
                  { staticClass: "v-card__text store-form" },
                  [
                    _vm._l(_vm.fieldForm, function(item, index) {
                      return _c(
                        "div",
                        { key: index, staticClass: " store-form__item" },
                        [
                          _c(
                            "v-text-field",
                            _vm._g(
                              {
                                tag: "v-text-field",
                                attrs: {
                                  type: _vm.form[item.field].type,
                                  error: _vm.form[item.field].error,
                                  "error-messages":
                                    _vm.formSended &&
                                    _vm.form[item.field].serverErrorMsg.length
                                      ? [_vm.form[item.field].serverErrorMsg]
                                      : "",
                                  rules: _vm.formSended
                                    ? [_vm.form[item.field].rules.required]
                                    : [],
                                  label: item.label
                                },
                                model: {
                                  value: _vm.form[item.field].value,
                                  callback: function($$v) {
                                    _vm.$set(_vm.form[item.field], "value", $$v)
                                  },
                                  expression: "form[item.field].value"
                                }
                              },
                              _vm.form[item.field].error
                                ? {
                                    "~keyup": function() {
                                      return _vm.inputHideError(item.field)
                                    }
                                  }
                                : {}
                            )
                          )
                        ],
                        1
                      )
                    }),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "sc-confirm-password" },
                      [
                        _c(
                          "v-text-field",
                          _vm._g(
                            {
                              tag: "v-text-field",
                              attrs: {
                                type: _vm.confirmPassword.type,
                                "error-messages":
                                  _vm.formSended &&
                                  _vm.confirmPassword.error.length
                                    ? _vm.confirmPassword.error
                                    : "",
                                label: "confirmar contraseña"
                              },
                              model: {
                                value: _vm.confirmPassword.value,
                                callback: function($$v) {
                                  _vm.$set(_vm.confirmPassword, "value", $$v)
                                },
                                expression: "confirmPassword.value"
                              }
                            },
                            _vm.confirmPassword.error
                              ? {
                                  "~keyup": function() {
                                    return (_vm.confirmPassword.error = "")
                                  }
                                }
                              : {}
                          )
                        ),
                        _vm._v(" "),
                        _c(
                          "v-btn",
                          {
                            attrs: { flat: "", icon: "", color: "black" },
                            on: {
                              click: function($event) {
                                return _vm.showPass()
                              }
                            }
                          },
                          [
                            !_vm.isShowingPass
                              ? _c(
                                  "v-icon",
                                  {
                                    staticClass:
                                      "blue-grey--text text--darken-3",
                                    attrs: { title: "ocultar contraseña" }
                                  },
                                  [_vm._v("visibility_off")]
                                )
                              : _c(
                                  "v-icon",
                                  {
                                    staticClass:
                                      "blue-grey--text text--darken-3",
                                    attrs: { title: "mostar contraseña" }
                                  },
                                  [_vm._v("visibility")]
                                )
                          ],
                          1
                        )
                      ],
                      1
                    )
                  ],
                  2
                ),
                _vm._v(" "),
                _c("div", { staticClass: "v-card__actions" }, [
                  _c("div", { staticClass: "spacer" }),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "v-btn",
                      class: _vm.sendingFormData
                        ? "grey lighten-2"
                        : "blue white--text",
                      attrs: { disabled: _vm.sendingFormData, type: "submit" }
                    },
                    [
                      _c("div", { staticClass: "v-btn__content" }, [
                        !_vm.sendingFormData
                          ? _c("span", [_vm._v("ingresar")])
                          : _c("span", [_vm._v("enviando")])
                      ])
                    ]
                  )
                ])
              ]
            )
          ],
          1
        )
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/students/register/app.js":
/*!***********************************************!*\
  !*** ./resources/js/students/register/app.js ***!
  \***********************************************/
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
Vue.component('register', __webpack_require__(/*! ./register.vue */ "./resources/js/students/register/register.vue")["default"]);
var app = new Vue({
  el: '#app',
  data: function data() {
    return {
      url: "/register/store",
      fieldForm: [{
        field: "firstName",
        label: "Nombres",
        type: "text",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese sus nombres';
          }
        }
      }, {
        field: "lastName",
        label: "Apellidos",
        type: "text",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese sus apellidos';
          }
        }
      }, {
        field: "email",
        label: "Correo",
        type: "email",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese su correo';
          }
        }
      }, {
        field: "phoneNumber",
        label: "telefono",
        type: "tel",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese su telefono';
          }
        }
      }, {
        field: "password",
        label: "Contrasena",
        type: "password",
        rules: {
          required: function required(value) {
            return !!value || 'ingrese su contrasena';
          }
        }
      }]
    };
  }
});

/***/ }),

/***/ "./resources/js/students/register/register.vue":
/*!*****************************************************!*\
  !*** ./resources/js/students/register/register.vue ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _register_vue_vue_type_template_id_054a5cd6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./register.vue?vue&type=template&id=054a5cd6&scoped=true& */ "./resources/js/students/register/register.vue?vue&type=template&id=054a5cd6&scoped=true&");
/* harmony import */ var _register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./register.vue?vue&type=script&lang=js& */ "./resources/js/students/register/register.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css& */ "./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css&");
/* harmony import */ var _register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./register.vue?vue&type=style&index=1&lang=css& */ "./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");







/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_4__["default"])(
  _register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _register_vue_vue_type_template_id_054a5cd6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _register_vue_vue_type_template_id_054a5cd6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "054a5cd6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/students/register/register.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/students/register/register.vue?vue&type=script&lang=js&":
/*!******************************************************************************!*\
  !*** ./resources/js/students/register/register.vue?vue&type=script&lang=js& ***!
  \******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./register.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css&":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css& ***!
  \**************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--5-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--5-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=0&id=054a5cd6&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_0_id_054a5cd6_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css&":
/*!**************************************************************************************!*\
  !*** ./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css& ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--5-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--5-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./register.vue?vue&type=style&index=1&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=style&index=1&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_style_index_1_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/students/register/register.vue?vue&type=template&id=054a5cd6&scoped=true&":
/*!************************************************************************************************!*\
  !*** ./resources/js/students/register/register.vue?vue&type=template&id=054a5cd6&scoped=true& ***!
  \************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_template_id_054a5cd6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./register.vue?vue&type=template&id=054a5cd6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/students/register/register.vue?vue&type=template&id=054a5cd6&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_template_id_054a5cd6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_register_vue_vue_type_template_id_054a5cd6_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ 5:
/*!*****************************************************!*\
  !*** multi ./resources/js/students/register/app.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sergio99nv/appLibros/resources/js/students/register/app.js */"./resources/js/students/register/app.js");


/***/ })

},[[5,"/js/students/commentary/manifest","/js/students/commentary/vendor"]]]);