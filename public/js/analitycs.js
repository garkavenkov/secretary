"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["analitycs"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=script&lang=js":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var _minixs_DateFormat__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../minixs/DateFormat */ "./resources/js/minixs/DateFormat.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'AdultsAndChildrenReport',
  mixins: [_minixs_DateFormat__WEBPACK_IMPORTED_MODULE_0__["default"]],
  data: function data() {
    return {
      formData: {
        report: 'adultsAndChildren',
        settlementId: 0,
        date: new Date().toISOString().slice(0, 10)
      },
      reportIsExpanded: false,
      report: []
    };
  },
  methods: {
    generateReport: function generateReport() {
      var _this = this;
      axios.post('/api/v1/generate-report', this.formData).then(function (res) {
        _this.report = res.data;
      });
    },
    printReport: function printReport() {
      var reportDate = this.formatedDate(this.formData.date);
      var style = "\n            <style>\n                    @media print {\n                        body {\n                            padding-top: 3rem;\n                            background: white;\n                        }\n                        table {\n                            font-size: 0.8rem;\n                            margin: 10mm 0;\n                        }\n                        table thead tr:nth-of-type(2) {\n                            font-size: 0.75rem;\n                        }\n                        table tbody tr:first-of-type {\n                            font-size: 6px;\n                        }\n                        .vertical-text {\n                            writing-mode: vertical-rl;\n                            font-size: 0.75rem;\n                            transform: rotate(180deg);\n                            text-align: center;\n                            padding: 0.3rem;\n                            width: 2.5%;\n                        }\n\n                    }\n                    @media screen {\n                        body {\n                            padding:2rem;\n                        }\n                        table thead tr:last-of-type {\n                            font-size: 0.8rem;\n                        }\n                        table tbody tr:first-of-type {\n                            font-size: 6px;\n                        }\n                        .vertical-text {\n                            writing-mode: vertical-rl;\n                            font-size: 0.8rem;\n                            transform: rotate(180deg);\n                            text-align: center;\n                            padding: 0.5rem;\n                        }\n                    }\n\n                    .footer {\n                        display:flex;\n                        justify-content: space-evenly;\n                        margin-top: 2rem;\n                    }\n                    .footer-col {\n                        font-size: 0.8rem;\n                        width: 2in;\n                        text-align: center;\n                        margin-top: 2rem;\n                        border-top: 1px solid;\n                    }\n                    .footer-col span {\n                        color:grey;\n                    }\n            </style>";
      var footer = "<div class=\"footer\">\n                    <div style=\"font-size:1rem;\">\u0421\u0442\u0430\u0440\u043E\u0441\u0442\u0430</div>\n                    <div class=\"footer-col\">\n                        <span>\u043F\u0456\u0434\u043F\u0438\u0441</span>\n                    </div>\n                    <div class=\"footer-col\">\n                        <span>\u0406\u043D\u0456\u0446\u0438\u0430\u043B\u0438 \u041F\u0440\u0456\u0437\u0432\u0438\u0449\u0435</span>\n                    </div>\n                </div>";
      var prtContent = document.getElementById("report");
      var WinPrint = window.open('', '', 'left=0,top=0,height=500,toolbar=0,scrollbars=0,status=0');
      WinPrint.document.write('<html><head>');
      WinPrint.document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
      WinPrint.document.write('<link rel="stylesheet" href="css/app.css" media="all">');
      WinPrint.document.write(style);
      WinPrint.document.write('</head><body>');
      WinPrint.document.write('<div style="text-align:center; margin-bottom: 1rem;"><h4>');
      WinPrint.document.write("\u0421\u0442\u0430\u043D\u043E\u043C \u043D\u0430 ".concat(reportDate));
      WinPrint.document.write('</h4></div>');
      WinPrint.document.write(prtContent.innerHTML);
      WinPrint.document.write(footer);
      WinPrint.document.write('</body></html>');

      // WinPrint.addEventListener("load", (event) => {
      //     WinPrint.document.close();
      //     WinPrint.focus();
      //     WinPrint.print();
      //     WinPrint.close();
      //     console.log("page is fully loaded");
      // });
      // WinPrint.focus();

      setTimeout(function () {
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
      }, 300);
    }
  },
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)('Settlements', ['settlements']))
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var _minixs_DateFormat__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../minixs/DateFormat */ "./resources/js/minixs/DateFormat.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'Reports',
  mixins: [_minixs_DateFormat__WEBPACK_IMPORTED_MODULE_0__["default"]],
  data: function data() {
    return {
      formData: {
        report: 'membersByAge',
        sex: 0,
        settlementId: 0,
        date: new Date().toISOString().slice(0, 10)
      },
      reportIsExpanded: false,
      report: []
    };
  },
  methods: {
    generateReport: function generateReport() {
      var _this = this;
      axios.post('/api/v1/generate-report', this.formData).then(function (res) {
        _this.report = res.data;
      });
    },
    printReport: function printReport() {
      var reportDate = this.formatedDate(this.formData.date);
      var style = "\n            <style>\n                    @media print {\n                        body {\n                            padding-top: 3rem;\n                            background: white;\n                        }\n                        table {\n                            font-size: 0.8rem;\n                            margin: 10mm 0;\n                        }\n                        table thead tr:last-of-type {\n                            font-size: 0.6rem;\n                        }\n\n                    }\n                    @media screen {\n                        body {\n                            padding:2rem;\n                        }\n                        table thead tr:last-of-type {\n                            font-size: 0.8rem;\n                        }\n                    }\n\n                    // .table {\n                    //     width: 100%;\n                    //     margin-bottom: 1rem;\n                    //     color: #212529;\n                    //     vertical-align: top;\n                    //     border-collapse: collapse;\n                    //     border-style: solid;\n                    //     border-color: #cbccce;\n                    //     border-width: 1px;\n                    // }\n                    // table thead {\n                    //     vertical-align: middle;\n                    //     color: black;\n                    //     border-color: #cbccce;\n                    //     border-style: solid;\n                    //     border-width: 1px;\n                    //     background-color: #e2e3e5;\n                    // }\n\n                    // table tr {\n                    //     border-width: 1px 0;\n                    //     border-style: solid;\n                    //     border-color: #cbccce;\n                    // }\n                    // table tbody tr td:not(:first-of-type) {\n                    //     text-align: center;\n                    // }\n                    // table th, table td {\n                    //     border-width: 0 1px;\n                    //     padding: 0.5rem;\n                    //     border-style: solid;\n                    //     border-color: #cbccce;\n                    // }\n                    .footer {\n                        display:flex;\n                        justify-content: space-evenly;\n                        margin-top: 2rem;\n                    }\n                    .footer-col {\n                        font-size: 0.8rem;\n                        width: 2in;\n                        text-align: center;\n                        margin-top: 2rem;\n                        border-top: 1px solid;\n                    }\n                    .footer-col span {\n                        color:grey;\n                    }\n            </style>";
      var footer = "<div class=\"footer\">\n                    <div style=\"font-size:1rem;\">\u0421\u0442\u0430\u0440\u043E\u0441\u0442\u0430</div>\n                    <div class=\"footer-col\">\n                        <span>\u043F\u0456\u0434\u043F\u0438\u0441</span>\n                    </div>\n                    <div class=\"footer-col\">\n                        <span>\u0406\u043D\u0456\u0446\u0438\u0430\u043B\u0438 \u041F\u0440\u0456\u0437\u0432\u0438\u0449\u0435</span>\n                    </div>\n                </div>";
      var prtContent = document.getElementById("report");

      // var WinPrint = window.open('', '', 'left=0,top=0,height=500,toolbar=0,scrollbars=0,status=0');
      var WinPrint = window.open('', '', 'left=50000,top=50000,width=0,height=0,toolbar=0,scrollbars=0,status=0');
      WinPrint.document.write('<html><head>');
      WinPrint.document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
      WinPrint.document.write('<link rel="stylesheet" href="css/app.css" media="all">');
      WinPrint.document.write(style);
      WinPrint.document.write('</head><body>');
      WinPrint.document.write('<div style="text-align:center; margin-bottom: 1rem;"><h4>');
      WinPrint.document.write("\u0421\u0442\u0430\u043D\u043E\u043C \u043D\u0430 ".concat(reportDate));
      WinPrint.document.write('</h4></div>');
      // console.log(prtContent.innerHTML);
      WinPrint.document.write(prtContent.innerHTML);
      WinPrint.document.write(footer);
      WinPrint.document.write('</body></html>');
      // WinPrint.document.close();

      // WinPrint.addEventListener("load", (event) => {
      //     WinPrint.document.close();
      //     WinPrint.focus();
      //     WinPrint.print();
      //     WinPrint.close();
      //     console.log("page is fully loaded");
      // });
      // WinPrint.focus();

      setTimeout(function () {
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
      }, 300);
    }
  },
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)('Settlements', ['settlements']))
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-1677717e"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  "class": "row"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "card"
};
var _hoisted_4 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "card-header"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "Параметри звіту")], -1 /* HOISTED */);
});
var _hoisted_5 = {
  "class": "card-body"
};
var _hoisted_6 = {
  "class": "mb-3"
};
var _hoisted_7 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "settlement",
    "class": "form-label"
  }, "Населений пункт", -1 /* HOISTED */);
});
var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "0"
  }, "Усі населені пункти", -1 /* HOISTED */);
});
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "mb-3"
};
var _hoisted_11 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "reportDate",
    "class": "form-label"
  }, "Сформувати звіт на дату", -1 /* HOISTED */);
});
var _hoisted_12 = {
  "class": "d-flex justify-content-end"
};
var _hoisted_13 = ["disabled"];
var _hoisted_14 = {
  "class": "card"
};
var _hoisted_15 = {
  "class": "card-header"
};
var _hoisted_16 = {
  "class": "d-flex"
};
var _hoisted_17 = ["title"];
var _hoisted_18 = {
  key: 0
};
var _hoisted_19 = ["disabled"];
var _hoisted_20 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-printer"
  }, null, -1 /* HOISTED */);
});
var _hoisted_21 = [_hoisted_20];
var _hoisted_22 = {
  "class": "card-body",
  id: "report"
};
var _hoisted_23 = {
  "class": "table table-bordered"
};
var _hoisted_24 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", {
    "class": "align-middle"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3"
  }, "Назва населеного пункту"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, "Кількість дворів"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, "Кількість жилих дворів"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Кількість фактично "), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("проживаючого населення")]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Кількість зареєстрованого "), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("населення")]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "6",
    "class": "text-center"
  }, "Дорослі, у тому числі:"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "8",
    "class": "text-center"
  }, "Діти, у тому числі:"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Люди, які обслуговуються службами"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("br"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("соціальної допомоги на дому")]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, "Одинокі матері (батькі)"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, "Одинокі багатодітні матері (батькі)"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, "Багатодітні сім'ї"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "3",
    "class": "vertical-text"
  }, "Неповні сім'ї")]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "Всього"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "Працездатного віку"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "Пенсіонери"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "3",
    "class": "text-center"
  }, "з них:"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "Всього"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "від 0 до 6 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "від 6 до 14 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "vertical-text"
  }, "від 14 до 18 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "4",
    "class": "text-center"
  }, "з них:")]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Інваліди ВВВ"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Учасники бойових дій"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Інваліди всіх груп"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Діти з неповних сімей"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Діти з багатодітних сімей"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Діти інваліди"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "vertical-text"
  }, "Діти сіроти")])], -1 /* HOISTED */);
});
var _hoisted_25 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "1"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "2"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "3"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "4"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "5=6+12"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "6=7+8"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "7"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "8"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "9"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "10"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "11"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "12=13+14+15"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "13"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "14"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "15"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "16"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "17"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "18"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "19"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "20"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "21"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "22"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "23"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "24")], -1 /* HOISTED */);
});
var _hoisted_26 = {
  "class": "text-center"
};
var _hoisted_27 = {
  "class": "text-center"
};
var _hoisted_28 = {
  "class": "text-center"
};
var _hoisted_29 = {
  "class": "text-center"
};
var _hoisted_30 = {
  "class": "text-center"
};
var _hoisted_31 = {
  "class": "text-center"
};
var _hoisted_32 = {
  "class": "text-center"
};
var _hoisted_33 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_34 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_35 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_36 = {
  "class": "text-center"
};
var _hoisted_37 = {
  "class": "text-center"
};
var _hoisted_38 = {
  "class": "text-center"
};
var _hoisted_39 = {
  "class": "text-center"
};
var _hoisted_40 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_41 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_42 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_43 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_44 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_45 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_46 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_47 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});
var _hoisted_48 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", {
    "class": "text-center"
  }, "0", -1 /* HOISTED */);
});

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_breadcrumbs = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("breadcrumbs");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_breadcrumbs), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    id: "settlement",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.formData.settlementId = $event;
    })
  }, [_hoisted_8, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.settlements, function (settlement) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: settlement.id,
      key: settlement.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(settlement.name), 9 /* TEXT, PROPS */, _hoisted_9);
  }), 128 /* KEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.formData.settlementId]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    "class": "form-control",
    id: "reportDate",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.formData.date = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.formData.date]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-outline-primary",
    onClick: _cache[2] || (_cache[2] = function () {
      return $options.generateReport && $options.generateReport.apply($options, arguments);
    }),
    disabled: $data.formData.date == ''
  }, " Сформувати звіт ", 8 /* PROPS */, _hoisted_13)])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, !$data.reportIsExpanded]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([$data.reportIsExpanded ? 'col-md-12' : 'col-md-9'])
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-sm btn-outline-secondary me-3",
    title: $data.reportIsExpanded ? 'Сгорнути' : 'Розгорнути',
    onClick: _cache[3] || (_cache[3] = function ($event) {
      return $data.reportIsExpanded = !$data.reportIsExpanded;
    })
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['mdi', $data.reportIsExpanded ? 'mdi-arrow-expand-right' : 'mdi-arrow-expand-left'])
  }, null, 2 /* CLASS */)], 8 /* PROPS */, _hoisted_17), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Вікові групи населення "), $data.formData != '' && $data.report.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_18, "станом на " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.formatedDate($data.formData.date)), 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-sm btn-outline-primary",
    onClick: _cache[4] || (_cache[4] = function () {
      return $options.printReport && $options.printReport.apply($options, arguments);
    }),
    title: "Роздрукувати звіт",
    disabled: $data.report.length == 0
  }, _hoisted_21, 8 /* PROPS */, _hoisted_19)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_23, [_hoisted_24, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [_hoisted_25, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.report, function (item, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: index
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.settlement), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_26, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.households_total), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.households_living), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_28, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.adults.total + item.children.total), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_29, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.adults.total + item.children.total), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.adults.total), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.adults['18-60']), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_32, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.adults['>60']), 1 /* TEXT */), _hoisted_33, _hoisted_34, _hoisted_35, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.children.total), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_37, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.children['0-5']), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.children['6-13']), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_39, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.children['14-17']), 1 /* TEXT */), _hoisted_40, _hoisted_41, _hoisted_42, _hoisted_43, _hoisted_44, _hoisted_45, _hoisted_46, _hoisted_47, _hoisted_48]);
  }), 128 /* KEYED_FRAGMENT */))])])])])], 2 /* CLASS */)])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-7a8db58a"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  "class": "row"
};
var _hoisted_2 = {
  "class": "col-md-3"
};
var _hoisted_3 = {
  "class": "card"
};
var _hoisted_4 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": "card-header"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, "Параметри звіту")], -1 /* HOISTED */);
});
var _hoisted_5 = {
  "class": "card-body"
};
var _hoisted_6 = {
  "class": "mb-3"
};
var _hoisted_7 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "settlement",
    "class": "form-label"
  }, "Населений пункт", -1 /* HOISTED */);
});
var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "0"
  }, "Усі населені пункти", -1 /* HOISTED */);
});
var _hoisted_9 = ["value"];
var _hoisted_10 = {
  "class": "mb-3"
};
var _hoisted_11 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "sex",
    "class": "form-label"
  }, "Стать", -1 /* HOISTED */);
});
var _hoisted_12 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "0"
  }, "Чоловіки та жінки", -1 /* HOISTED */);
});
var _hoisted_13 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "чоловіча"
  }, "Чоловікі", -1 /* HOISTED */);
});
var _hoisted_14 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "жіноча"
  }, "Жінки", -1 /* HOISTED */);
});
var _hoisted_15 = [_hoisted_12, _hoisted_13, _hoisted_14];
var _hoisted_16 = {
  "class": "mb-3"
};
var _hoisted_17 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "reportDate",
    "class": "form-label"
  }, "Сформувати звіт на дату", -1 /* HOISTED */);
});
var _hoisted_18 = {
  "class": "d-flex justify-content-end"
};
var _hoisted_19 = ["disabled"];
var _hoisted_20 = {
  "class": "card"
};
var _hoisted_21 = {
  "class": "card-header"
};
var _hoisted_22 = {
  "class": "d-flex"
};
var _hoisted_23 = ["title"];
var _hoisted_24 = {
  key: 0
};
var _hoisted_25 = ["disabled"];
var _hoisted_26 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-printer"
  }, null, -1 /* HOISTED */);
});
var _hoisted_27 = [_hoisted_26];
var _hoisted_28 = {
  "class": "card-body",
  id: "report"
};
var _hoisted_29 = {
  "class": "table table-bordered"
};
var _hoisted_30 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", {
    "class": "table-secondary align-middle"
  }, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2"
  }, "Назва населеного пункту"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2"
  }, "Кількість зареєстрованого населення"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "8",
    "class": "text-center"
  }, "Чоловіки"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "8",
    "class": "text-center"
  }, "Жінки")]), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "до 18 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "18 - 35 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "36 - 59 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "60 - 69 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "70 - 79 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "80 - 89 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "90 + років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "усього"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "до 18 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "18 - 35 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "36 - 59 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "60 - 69 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "70 - 79 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "80 - 89 років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "90 + років"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    "class": "text-center"
  }, "усього")])], -1 /* HOISTED */);
});
var _hoisted_31 = {
  "class": "text-center"
};
var _hoisted_32 = {
  "class": "text-center"
};
var _hoisted_33 = {
  "class": "text-center"
};
var _hoisted_34 = {
  "class": "text-center"
};
var _hoisted_35 = {
  "class": "text-center"
};
var _hoisted_36 = {
  "class": "text-center"
};
var _hoisted_37 = {
  "class": "text-center"
};
var _hoisted_38 = {
  "class": "text-center"
};
var _hoisted_39 = {
  "class": "text-center"
};
var _hoisted_40 = {
  "class": "text-center"
};
var _hoisted_41 = {
  "class": "text-center"
};
var _hoisted_42 = {
  "class": "text-center"
};
var _hoisted_43 = {
  "class": "text-center"
};
var _hoisted_44 = {
  "class": "text-center"
};
var _hoisted_45 = {
  "class": "text-center"
};
var _hoisted_46 = {
  "class": "text-center"
};
var _hoisted_47 = {
  "class": "text-center"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_breadcrumbs = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("breadcrumbs");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_breadcrumbs), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    id: "settlement",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.formData.settlementId = $event;
    })
  }, [_hoisted_8, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.settlements, function (settlement) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: settlement.id,
      key: settlement.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(settlement.name), 9 /* TEXT, PROPS */, _hoisted_9);
  }), 128 /* KEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.formData.settlementId]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-control",
    id: "sex",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.formData.sex = $event;
    })
  }, _hoisted_15, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.formData.sex]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [_hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    "class": "form-control",
    id: "reportDate",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $data.formData.date = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.formData.date]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-outline-primary",
    onClick: _cache[3] || (_cache[3] = function () {
      return $options.generateReport && $options.generateReport.apply($options, arguments);
    }),
    disabled: $data.formData.date == ''
  }, " Сформувати звіт ", 8 /* PROPS */, _hoisted_19)])])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, !$data.reportIsExpanded]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)([$data.reportIsExpanded ? 'col-md-12' : 'col-md-9'])
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-sm btn-outline-secondary me-3",
    title: $data.reportIsExpanded ? 'Сгорнути' : 'Розгорнути',
    onClick: _cache[4] || (_cache[4] = function ($event) {
      return $data.reportIsExpanded = !$data.reportIsExpanded;
    })
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['mdi', $data.reportIsExpanded ? 'mdi-arrow-expand-right' : 'mdi-arrow-expand-left'])
  }, null, 2 /* CLASS */)], 8 /* PROPS */, _hoisted_23), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)("Вікові групи населення "), $data.formData != '' && $data.report.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_24, "станом на " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.formatedDate($data.formData.date)), 1 /* TEXT */)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-sm btn-outline-primary",
    onClick: _cache[5] || (_cache[5] = function () {
      return $options.printReport && $options.printReport.apply($options, arguments);
    }),
    title: "Роздрукувати звіт",
    disabled: $data.report.length == 0
  }, _hoisted_27, 8 /* PROPS */, _hoisted_25)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_29, [_hoisted_30, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.report, function (item, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: index
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.settlement), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_31, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.total), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_32, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['0 - 17']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_33, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['18 - 35']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_34, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['36 - 59']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_35, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['60 - 69']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_36, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['70 - 79']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_37, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['80 - 89']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_38, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['> 90']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_39, [item.data['чоловіча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['чоловіча']['total']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_40, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['0 - 17']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_41, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['18 - 35']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_42, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['36 - 59']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_43, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['60 - 69']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_44, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['70 - 79']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_45, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['80 - 89']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_46, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['> 90']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_47, [item.data['жіноча'] ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 0
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(item.data['жіноча']['total']), 1 /* TEXT */)], 64 /* STABLE_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
      key: 1
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" 0 ")], 64 /* STABLE_FRAGMENT */))])]);
  }), 128 /* KEYED_FRAGMENT */))])])])])], 2 /* CLASS */)])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./resources/js/minixs/DateFormat.js":
/*!*******************************************!*\
  !*** ./resources/js/minixs/DateFormat.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  methods: {
    formatedDate: function formatedDate(date) {
      return new Date(date).toISOString().slice(0, 10).split('-').reverse().join('.');
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "table thead tr[data-v-1677717e]:nth-of-type(2) {\n  font-size: 0.8rem;\n}\ntable tbody tr[data-v-1677717e]:first-of-type {\n  font-size: 6px;\n}\n.vertical-text[data-v-1677717e] {\n  writing-mode: vertical-rl;\n  font-size: 0.8rem;\n  transform: rotate(180deg);\n  text-align: center;\n  padding: 0.4rem;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "table thead tr[data-v-7a8db58a]:last-of-type {\n  font-size: 0.8rem;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_style_index_0_id_1677717e_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_style_index_0_id_1677717e_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_style_index_0_id_1677717e_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_style_index_0_id_7a8db58a_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_style_index_0_id_7a8db58a_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_style_index_0_id_7a8db58a_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/modules/Analityc/AdultsAndChildren.vue":
/*!*************************************************************!*\
  !*** ./resources/js/modules/Analityc/AdultsAndChildren.vue ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AdultsAndChildren_vue_vue_type_template_id_1677717e_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true */ "./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true");
/* harmony import */ var _AdultsAndChildren_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdultsAndChildren.vue?vue&type=script&lang=js */ "./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=script&lang=js");
/* harmony import */ var _AdultsAndChildren_vue_vue_type_style_index_0_id_1677717e_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true */ "./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_AdultsAndChildren_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_AdultsAndChildren_vue_vue_type_template_id_1677717e_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-1677717e"],['__file',"resources/js/modules/Analityc/AdultsAndChildren.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/Analityc/MembersByAge.vue":
/*!********************************************************!*\
  !*** ./resources/js/modules/Analityc/MembersByAge.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MembersByAge_vue_vue_type_template_id_7a8db58a_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true */ "./resources/js/modules/Analityc/MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true");
/* harmony import */ var _MembersByAge_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MembersByAge.vue?vue&type=script&lang=js */ "./resources/js/modules/Analityc/MembersByAge.vue?vue&type=script&lang=js");
/* harmony import */ var _MembersByAge_vue_vue_type_style_index_0_id_7a8db58a_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true */ "./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_MembersByAge_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_MembersByAge_vue_vue_type_template_id_7a8db58a_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-7a8db58a"],['__file',"resources/js/modules/Analityc/MembersByAge.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=script&lang=js":
/*!*************************************************************************************!*\
  !*** ./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=script&lang=js ***!
  \*************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AdultsAndChildren.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/Analityc/MembersByAge.vue?vue&type=script&lang=js":
/*!********************************************************************************!*\
  !*** ./resources/js/modules/Analityc/MembersByAge.vue?vue&type=script&lang=js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MembersByAge.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true ***!
  \*******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_template_id_1677717e_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_template_id_1677717e_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=template&id=1677717e&scoped=true");


/***/ }),

/***/ "./resources/js/modules/Analityc/MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true":
/*!**************************************************************************************************!*\
  !*** ./resources/js/modules/Analityc/MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_template_id_7a8db58a_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_template_id_7a8db58a_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=template&id=7a8db58a&scoped=true");


/***/ }),

/***/ "./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true":
/*!**********************************************************************************************************************!*\
  !*** ./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true ***!
  \**********************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdultsAndChildren_vue_vue_type_style_index_0_id_1677717e_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/AdultsAndChildren.vue?vue&type=style&index=0&id=1677717e&lang=scss&scoped=true");


/***/ }),

/***/ "./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true":
/*!*****************************************************************************************************************!*\
  !*** ./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true ***!
  \*****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersByAge_vue_vue_type_style_index_0_id_7a8db58a_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/Analityc/MembersByAge.vue?vue&type=style&index=0&id=7a8db58a&lang=scss&scoped=true");


/***/ })

}]);