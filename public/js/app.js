/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _appHelper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./appHelper */ "./resources/js/appHelper.js");

document.addEventListener("DOMContentLoaded", function (event) {
  var showDeskMenuDeskMedia = 1200;
  var mainAppContent = document.querySelector("#main-app-content");
  var asideMainMenuOverlay = document.querySelector("#asideMainMenuOverlay");
  var asideMainMenu = document.querySelector("#asideMainMenu");
  var mainNavBtnMenu = document.querySelector("#mainNavBtnMenu");
  var showDeskMenu = _appHelper__WEBPACK_IMPORTED_MODULE_0__["default"].matchMediaMinWidth(showDeskMenuDeskMedia);
  console.log(showDeskMenu);

  if (showDeskMenu) {
    asideMainMenu.classList.add("asideMainMenu--open");
    mainAppContent.classList.add("mainAppContent--open");
  }

  mainNavBtnMenu.addEventListener("click", function () {
    var hasCssClass = asideMainMenu.classList.contains("asideMainMenu--open");

    if (hasCssClass) {
      asideMainMenu.classList.remove("asideMainMenu--open");
      mainAppContent.classList.remove("mainAppContent--open");
      asideMainMenuOverlay.classList.remove("v-overlay--active");
    } else {
      asideMainMenu.classList.add("asideMainMenu--open");
      mainAppContent.classList.add("mainAppContent--open");
      asideMainMenuOverlay.classList.add("v-overlay--active");
    }
  });
  asideMainMenuOverlay.addEventListener("click", function () {
    asideMainMenu.classList.remove("asideMainMenu--open");
    mainAppContent.classList.remove("mainAppContent--open");
    asideMainMenuOverlay.classList.remove("v-overlay--active");
  });
  _appHelper__WEBPACK_IMPORTED_MODULE_0__["default"].addEvent(window, "resize", function () {
    var showDeskMenu = _appHelper__WEBPACK_IMPORTED_MODULE_0__["default"].matchMediaMinWidth(showDeskMenuDeskMedia);

    if (showDeskMenu) {
      asideMainMenu.classList.add("asideMainMenu--open");
      mainAppContent.classList.add("mainAppContent--open");
    } else {
      asideMainMenu.classList.remove("asideMainMenu--open");
      mainAppContent.classList.remove("mainAppContent--open");
      asideMainMenuOverlay.classList.remove("v-overlay--active");
    }
  });
});

/***/ }),

/***/ "./resources/js/appHelper.js":
/*!***********************************!*\
  !*** ./resources/js/appHelper.js ***!
  \***********************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance"); }

function _iterableToArray(iter) { if (Symbol.iterator in Object(iter) || Object.prototype.toString.call(iter) === "[object Arguments]") return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = new Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var AppHelper =
/*#__PURE__*/
function () {
  function AppHelper() {
    _classCallCheck(this, AppHelper);
  }

  _createClass(AppHelper, null, [{
    key: "markHtmlElement",

    /**
     * 
     * @param {html} refHtml  El elemento al q le apliramos las clases(CSS)
     * @param {Array} cssClasses  Contine el listado de clases(CSS)
     * @param {Number} time La cantidad de tiempo q durara el efecto 
     */
    value: function markHtmlElement(refHtml, cssClasses) {
      var time = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 3500;

      try {
        var _refHtml$classList;

        (_refHtml$classList = refHtml.classList).add.apply(_refHtml$classList, _toConsumableArray(cssClasses));

        setTimeout(function () {
          var _refHtml$classList2;

          (_refHtml$classList2 = refHtml.classList).remove.apply(_refHtml$classList2, _toConsumableArray(cssClasses));
        }, time);
      } catch (error) {}
    }
  }, {
    key: "getCssProperty",
    value: function getCssProperty(elem, property) {
      return window.getComputedStyle(elem, null).getPropertyValue(property);
    }
  }, {
    key: "addEvent",
    value: function addEvent(object, type, callback) {
      if (object == null || typeof object == 'undefined') return;

      if (object.addEventListener) {
        object.addEventListener(type, callback, false);
      } else if (object.attachEvent) {
        object.attachEvent("on" + type, callback);
      } else {
        object["on" + type] = callback;
      }
    }
  }, {
    key: "matchMediaMinWidth",
    value: function matchMediaMinWidth(size) {
      return window.matchMedia("(min-width: ".concat(size, "px)")).matches;
    }
  }]);

  return AppHelper;
}();

/* harmony default export */ __webpack_exports__["default"] = (AppHelper);

/***/ }),

/***/ 3:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sergio99nv/appLibros/resources/js/app.js */"./resources/js/app.js");


/***/ })

/******/ });