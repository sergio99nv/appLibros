(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

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
  var pathName = window.location.pathname;

  if (showDeskMenu && (pathName.startsWith("/books") === true || pathName.startsWith("/admins/main") === true)) {
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
  }); //busqueda mobile

  var navMainIconSearch = document.querySelector("#nav-main-i-search");
  var navMainForm = document.querySelector("#nav-main-form");
  var navMainFormClose = document.querySelector("#f-search-close");
  var navMainFormClass = "nav-main-form--full";
  navMainIconSearch.addEventListener("click", function () {
    var hasCssClass = navMainForm.classList.contains(navMainFormClass);

    if (hasCssClass) {
      navMainForm.classList.remove(navMainFormClass);
    } else {
      navMainForm.classList.add(navMainFormClass);
    }
  });
  navMainFormClose.addEventListener("click", function () {
    navMainForm.classList.remove(navMainFormClass);
  });
  var formSearch = document.querySelector("#formSearch");
  var formSearchInput = formSearch.querySelector("#formSearchInput");
  formSearch.addEventListener("submit", function (event) {
    if (formSearchInput.value.trim().length <= 0) {
      event.preventDefault();
      formSearchInput.focus();
    }
  });
});

/***/ }),

/***/ 3:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sergio99nv/appLibros/resources/js/app.js */"./resources/js/app.js");


/***/ })

},[[3,"/js/students/commentary/manifest","/js/students/commentary/vendor"]]]);