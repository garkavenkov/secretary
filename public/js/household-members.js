"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["household-members"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=script&setup=true&lang=js":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=script&setup=true&lang=js ***!
  \******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");


// define components props for the slider component

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  __name: 'RangeInput',
  props: {
    'min': {
      type: [String, Number],
      required: true
    },
    'max': {
      type: [String, Number],
      required: true
    },
    'minValue': {
      type: [String, Number],
      required: true
    },
    'maxValue': {
      type: [String, Number],
      required: true
    }
  },
  emits: ["update:minValue", "update:maxValue"],
  setup: function setup(__props, _ref) {
    var expose = _ref.expose,
      emit = _ref.emit;
    expose();
    var min = __props.min,
      max = __props.max,
      minValue = __props.minValue,
      maxValue = __props.maxValue;

    // define emits for the slider component

    // define refs for the slider element and slider values
    var slider = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var rangeMin = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var rangeMax = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(null);
    var sliderMinValue = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(minValue);
    var sliderMaxValue = (0,vue__WEBPACK_IMPORTED_MODULE_0__.ref)(maxValue);

    // function to get the percentage of a value between the min and max values
    var getPercent = function getPercent(value, min, max) {
      return (value - min) / (max - min) * 100;
    };
    var updateMinRange = function updateMinRange(e) {
      if (e.target.value < sliderMaxValue.value) {
        sliderMinValue.value = parseInt(e.target.value);
      } else {
        rangeMin.value.value = sliderMinValue.value;
      }
    };
    var updateMaxRange = function updateMaxRange(e) {
      if (e.target.value > sliderMinValue.value) {
        sliderMaxValue.value = parseInt(e.target.value);
      } else {
        rangeMax.value.value = sliderMaxValue.value;
      }
    };

    // function to get the difference between the min and max values
    var sliderDifference = (0,vue__WEBPACK_IMPORTED_MODULE_0__.computed)(function () {
      return Math.abs(sliderMaxValue.value - sliderMinValue.value);
    });

    // function to set the css variables for width, left, and right
    var setCSSProps = function setCSSProps(left, right) {
      slider.value.style.setProperty("--progressLeft", "".concat(left, "%"));
      slider.value.style.setProperty("--progressRight", "".concat(right, "%"));
    };
    (0,vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect)(function () {
      if (slider.value) {
        emit("update:minValue", sliderMinValue.value);
        emit("update:maxValue", sliderMaxValue.value);

        // calculate values in percentages        
        var leftPercent = getPercent(sliderMinValue.value, min, max);
        var rightPercent = 100 - getPercent(sliderMaxValue.value, min, max);

        // set the CSS variables        
        setCSSProps(leftPercent, rightPercent);
      }
    });
    var __returned__ = {
      emit: emit,
      slider: slider,
      rangeMin: rangeMin,
      rangeMax: rangeMax,
      sliderMinValue: sliderMinValue,
      sliderMaxValue: sliderMaxValue,
      getPercent: getPercent,
      updateMinRange: updateMinRange,
      updateMaxRange: updateMaxRange,
      sliderDifference: sliderDifference,
      setCSSProps: setCSSProps,
      computed: vue__WEBPACK_IMPORTED_MODULE_0__.computed,
      ref: vue__WEBPACK_IMPORTED_MODULE_0__.ref,
      watchEffect: vue__WEBPACK_IMPORTED_MODULE_0__.watchEffect
    };
    Object.defineProperty(__returned__, '__isScriptSetup', {
      enumerable: false,
      value: true
    });
    return __returned__;
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=script&lang=js":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=script&lang=js ***!
  \******************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/ui/ModalForm.vue */ "./resources/js/components/ui/ModalForm.vue");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'DocumentGenerationForm',
  props: {
    records: {
      type: Array,
      required: true
    }
  },
  data: function data() {
    return {
      reportName: '',
      reports: [{
        id: 1,
        code: "familyComposition",
        name: "Довідка про стан родини",
        params: []
      }, {
        id: 2,
        code: "landOwned",
        name: "Звіт про склад земельної ділянки",
        params: [{
          id: 1,
          required: true,
          code: "year",
          name: 'Рік звітності',
          type: 'number',
          mask: /[1-9][0-9]{3}/,
          // ???
          "default": new Date().getFullYear()
        }]
      }],
      reportParams: [],
      paramsValue: {}
    };
  },
  methods: {
    submitData: function submitData() {
      var _this = this;
      var data = _objectSpread({
        report: this.reportName,
        member_id: this.records.map(function (r) {
          return r.id;
        }).join(',')
      }, this.paramsValue);
      axios.post('api/v1/generate-report', data, {
        responseType: 'arraybuffer'
      }).then(function (res) {
        var url = window.URL.createObjectURL(new Blob([res.data]));
        var link = document.createElement('a');
        link.href = url;
        var fileName = _this.getFileName();
        link.setAttribute('download', fileName);
        document.body.appendChild(link);
        link.click();
      });
    },
    getFileName: function getFileName() {
      var _this2 = this;
      var document_name = this.reports.find(function (r) {
        return r.code == _this2.reportName;
      })['name'];
      var persons = this.records.length;
      if (persons > 1) {
        var cnt = persons < 5 ? cnt = 'особи' : persons > 11 && persons % 10 == 1 ? 'особа' : 'осіб';
        return "".concat(document_name, "(").concat(persons, " ").concat(cnt, ").zip");
      } else {
        var member_name = this.records[0].full_name;
        return "".concat(member_name, ".").concat(document_name, ".docx");
      }
    },
    closeForm: function closeForm() {
      this.reportParams = [];
      this.paramsValue = Object.assign({});
      this.reportName = '';
    }
  },
  watch: {
    'reportName': function reportName(newVal) {
      var _this3 = this;
      if (newVal !== 0) {
        var report = this.reports.find(function (r) {
          return r.code == newVal;
        });
        this.paramsValue = Object.assign({});
        if (report) {
          this.reportParams = _toConsumableArray(report.params);
          var required = this.reportParams.filter(function (p) {
            return p.required;
          });
          if (required.length > 0) {
            required.forEach(function (r) {
              console.log(r.code, r["default"]);
              _this3.paramsValue[r.code] = r["default"];
            });
          }
        } else {
          this.reportParams = [];
        }
      }
    }
  },
  components: {
    ModalForm: _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Main.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Main.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
/* harmony import */ var _components_ui_DataTable_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/ui/DataTable.vue */ "./resources/js/components/ui/DataTable.vue");
/* harmony import */ var _components_ui_ButtonSelectRecords_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../components/ui/ButtonSelectRecords.vue */ "./resources/js/components/ui/ButtonSelectRecords.vue");
/* harmony import */ var _MembersFilterForm_vue__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./MembersFilterForm.vue */ "./resources/js/modules/HouseholdMembers/MembersFilterForm.vue");
/* harmony import */ var _DocumentGenerationForm_vue__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./DocumentGenerationForm.vue */ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }







/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'HouseholdMembersMain',
  data: function data() {
    return {
      perPageItems: [10, 15, 20],
      modalTitle: '',
      modalSubmitCaption: ''
    };
  },
  provide: function provide() {
    var _this = this;
    return {
      modalTitle: (0,vue__WEBPACK_IMPORTED_MODULE_1__.computed)(function () {
        return _this.modalTitle;
      }),
      modalSubmitCaption: (0,vue__WEBPACK_IMPORTED_MODULE_1__.computed)(function () {
        return _this.modalSubmitCaption;
      })
    };
  },
  methods: _objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_6__.mapActions)('HouseholdMembers', ['toggleSelectAll', 'toggleSelectMode', 'selectMultipleRecords'])), {}, {
    openFilterForm: function openFilterForm() {
      this.modalTitle = 'Фільтр членів домогосподарств';
      this.modalSubmitCaption = 'Застосувати';
      // let filterForm = new Modal(document.getElementById('MembersFilterForm'));
      var filterForm = new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Modal(document.getElementById("".concat(this.$options.name, "FilterForm")));
      filterForm.show();
    },
    resetFilter: function resetFilter() {
      this.filter.settlement_id = 0;
      this.filter.isFiltered = false;
      this.filter.age.selected = false;
      this.filter.age.value = [0, 100];
      this.filter.additionalParams = {};
      this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
    },
    perPageChanged: function perPageChanged(value) {
      this.$store.dispatch('HouseholdMembers/changePerPage', value);
    },
    pageChanged: function pageChanged(page) {
      this.$store.dispatch('HouseholdMembers/changePage', page);
    },
    searchData: function searchData(row, searchText) {
      return row['full_name'].includes(searchText) || row['household_number'].includes(searchText);
    },
    // searchData(value) {
    //     console.log(value);
    // },
    showDocument: function showDocument(id) {
      this.$router.push({
        name: 'household-member',
        params: {
          id: id
        }
      });
    },
    openDocumentsForm: function openDocumentsForm() {
      this.modalTitle = 'Генерація документів';
      this.modalSubmitCaption = 'Згенерувати';
      var reportWizardForm = new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Modal(document.getElementById("DocumentGenerationForm"));
      reportWizardForm.show();
    }
  }),
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_6__.mapGetters)('HouseholdMembers', ['members', 'filter', 'pagination', 'entities', 'inSelectMode', 'isIndeterminate', 'selectedRecords', 'selectedRecordsCount', 'isAllSelected', 'toggleSelectAllTitle'])),
  components: {
    DataTable: _components_ui_DataTable_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    MembersFilterForm: _MembersFilterForm_vue__WEBPACK_IMPORTED_MODULE_4__["default"],
    ButtonSelectRecords: _components_ui_ButtonSelectRecords_vue__WEBPACK_IMPORTED_MODULE_3__["default"],
    DocumentGenerationForm: _DocumentGenerationForm_vue__WEBPACK_IMPORTED_MODULE_5__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=script&lang=js":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var _mixins_AdditionalParamsFilter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../mixins/AdditionalParamsFilter */ "./resources/js/mixins/AdditionalParamsFilter.js");
/* harmony import */ var _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/ui/ModalForm.vue */ "./resources/js/components/ui/ModalForm.vue");
/* harmony import */ var _components_ui_AdditionalParamFormFilter_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../components/ui/AdditionalParamFormFilter.vue */ "./resources/js/components/ui/AdditionalParamFormFilter.vue");
/* harmony import */ var _components_ui_RangeInput_vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../components/ui/RangeInput.vue */ "./resources/js/components/ui/RangeInput.vue");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }





/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'MembersFilterForm',
  mixins: [_mixins_AdditionalParamsFilter__WEBPACK_IMPORTED_MODULE_0__["default"]],
  data: function data() {
    return {
      // params: [],
      // ageFilterType: 'all',
      filterByAge: false,
      oldestAge: null
      // firstAgeValue: null,
      // secondAgeValue: null,
      // ageRange: []
    };
  },

  methods: {
    submitData: function submitData() {
      this.filter.isFiltered = true;
      this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
    },
    getAgeOfOldestPerson: function getAgeOfOldestPerson() {
      var _this = this;
      axios.get('api/v1/get-age-of-oldest-person').then(function (res) {
        _this.oldestAge = res.data !== '' ? res.data : 100;
        _this.filter.age.values[1] = _this.oldestAge;
      });
    },
    clearFormData: function clearFormData() {}
  },
  computed: _objectSpread(_objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_4__.mapGetters)('HouseholdMembers', ['filter'])), (0,vuex__WEBPACK_IMPORTED_MODULE_4__.mapGetters)('Settlements', ['settlements'])), {}, {
    filterIsNotReady: function filterIsNotReady() {
      return this.filter.settlement_id == 0; // && (this.filter.household_type_id == 0);
    },
    ageRangeInformation: function ageRangeInformation() {
      if (!this.filter.age.selected || this.filter.age.values[0] == 0 && this.filter.age.values[1] == this.oldestAge) {
        return 'різного віку';
      } else if (this.filter.age.values[0] == 0) {
        var year = this.filter.age.values[1] % 10;
        var str = this.filter.age.values[1] == 11 || year == 0 || year > 4 ? 'років' : year == 1 ? 'рік' : 'роки';
        return "\u0432\u043A\u043B\u044E\u0447\u043D\u043E \u043F\u043E <b>".concat(this.filter.age.values[1], "</b> ").concat(str);
      } else if (this.filter.age.values[1] == this.oldestAge) {
        var _str = this.filter.age.values[0] % 10 == 1 ? this.filter.age.values[0] == 11 ? 'років' : 'року' : 'років';
        // let str = ( (this.filter.age.values[0] == 11) || (this.filter.age.values[0] % 10 == 1) ) ? 'року' : 'років';                

        return "\u043F\u043E\u0447\u0438\u043D\u0430\u044E\u0447\u0438 \u0437 <b>".concat(this.filter.age.values[0], "</b> ").concat(_str);
      } else {
        var _year = this.filter.age.values[1] % 10;
        var _str2 = this.filter.age.values[1] > 10 && this.filter.age.values[1] <= 14 || _year == 0 || _year > 4 ? 'років' : _year == 1 ? 'рік' : 'роки';
        return "\u0432\u043A\u043B\u044E\u0447\u043D\u043E \u0437 <b>".concat(this.filter.age.values[0], "</b> \u043F\u043E <b>").concat(this.filter.age.values[1], "</b> ").concat(_str2);
      }
    }
  }),
  created: function created() {
    this.fetchAdditionalParamsForFilter('App\\Models\\HouseholdMember', 'boolean');
    this.getAgeOfOldestPerson();
  },
  components: {
    ModalForm: _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    AdditionalParamsFormFilter: _components_ui_AdditionalParamFormFilter_vue__WEBPACK_IMPORTED_MODULE_2__["default"],
    RangeInput: _components_ui_RangeInput_vue__WEBPACK_IMPORTED_MODULE_3__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var vuex_dist_vuex_cjs_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex/dist/vuex.cjs.js */ "./node_modules/vuex/dist/vuex.cjs.js");
/* harmony import */ var vuex_dist_vuex_cjs_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(vuex_dist_vuex_cjs_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _components_Page404_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/Page404.vue */ "./resources/js/components/Page404.vue");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'HouseholdMembersShow',
  props: {
    'id': {
      type: [String, Number],
      required: true
    }
  },
  components: {
    Page404: _components_Page404_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      notFoundMessage: ''
    };
  },
  methods: _objectSpread({}, (0,vuex_dist_vuex_cjs_js__WEBPACK_IMPORTED_MODULE_1__.mapActions)('HouseholdMembers', ['fetchRecord'])),
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_2__.mapGetters)('HouseholdMembers', ['member'])),
  created: function created() {
    // this.$store.dispatch('HouseholdMembers/fetchRecord', this.id);

    this.fetchRecord(this.id);
    // .catch(err => console.log(err));
  },

  watch: {
    '$route': function $route(to, from) {
      if (to.params.id !== from.params.id && to.name == from.name) {
        this.$store.dispatch('HouseholdMembers/fetchRecord', to.params.id);
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=script&lang=js":
/*!*****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AdditionalParams_AdditionalParamsList_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../AdditionalParams/AdditionalParamsList.vue */ "./resources/js/modules/AdditionalParams/AdditionalParamsList.vue");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'HouseholdMemberAdditionalParams',
  data: function data() {
    return {
      params: []
    };
  },
  methods: {
    refreshData: function refreshData() {},
    fetchAdditionalParams: function fetchAdditionalParams() {
      var _this = this;
      axios.get("/api/v1/household-members/".concat(this.$route.params.id, "/additional-data")).then(function (res) {
        _this.params = res.data.data;
      });
    }
  },
  created: function created() {
    this.fetchAdditionalParams();
  },
  watch: {
    '$route': function $route(to, from) {
      if (to.params.id !== from.params.id) {
        this.fetchAdditionalParams();
      }
    }
  },
  components: {
    AdditionalParamsList: _AdditionalParams_AdditionalParamsList_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=script&lang=js":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/ui/ModalForm.vue */ "./resources/js/components/ui/ModalForm.vue");
/* harmony import */ var _mixins_FormValidator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../mixins/FormValidator */ "./resources/js/mixins/FormValidator.js");
/* harmony import */ var _mixins_SubmitData__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../mixins/SubmitData */ "./resources/js/mixins/SubmitData.js");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'LandYearForm',
  mixins: [_mixins_FormValidator__WEBPACK_IMPORTED_MODULE_1__["default"], _mixins_SubmitData__WEBPACK_IMPORTED_MODULE_2__["default"]],
  props: {
    'formData': {
      type: Object,
      required: true
    },
    'action': {
      type: String,
      required: false,
      "default": 'create'
    },
    'title': {
      type: String,
      required: true
    },
    'submitCaption': {
      type: String,
      required: true
    }
  },
  emits: ['refreshData'],
  data: function data() {
    return {
      apiUrl: '/api/v1/household-member-lands'
    };
  },
  methods: {
    closeForm: function closeForm() {
      //     this.$emit('closeYearForm');
    }
  },
  components: {
    ModalForm: _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var _components_ui_TableRow_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/ui/TableRow.vue */ "./resources/js/components/ui/TableRow.vue");
/* harmony import */ var _LandYearForm_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LandYearForm.vue */ "./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue");
/* harmony import */ var _components_ui_YearsPaginator_vue__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../components/ui/YearsPaginator.vue */ "./resources/js/components/ui/YearsPaginator.vue");
/* harmony import */ var _mixins_YearsCUD__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../mixins/YearsCUD */ "./resources/js/mixins/YearsCUD.js");
/* harmony import */ var _mixins_PrepareDataForDownload__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../../mixins/PrepareDataForDownload */ "./resources/js/mixins/PrepareDataForDownload.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }






/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'MemberLandYearsTab',
  mixins: [_mixins_YearsCUD__WEBPACK_IMPORTED_MODULE_3__["default"], _mixins_PrepareDataForDownload__WEBPACK_IMPORTED_MODULE_4__["default"]],
  components: {
    TableRow: _components_ui_TableRow_vue__WEBPACK_IMPORTED_MODULE_0__["default"],
    LandYearForm: _LandYearForm_vue__WEBPACK_IMPORTED_MODULE_1__["default"],
    YearsPaginator: _components_ui_YearsPaginator_vue__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  data: function data() {
    return {
      yearData: {
        id: null,
        member_id: null,
        year: new Date().getFullYear(),
        maintenance: 0,
        personal_agriculture: 0,
        hay_cutting: 0,
        pastures: 0,
        land_share: 0,
        property_share: 0
      },
      action: '',
      title: '',
      submitCaption: '',
      owner: 'member_id',
      yearFormId: 'LandYearForm',
      apiUrl: '/api/v1/household-member-lands',
      years: [],
      meta: [],
      perPage: 5
    };
  },
  methods: {
    closeYearForm: function closeYearForm() {
      this.yearData.id = null;
      this.yearData.year = new Date().getFullYear();
      this.yearData.maintenance = 0;
      this.yearData.personal_agriculture = 0;
      this.yearData.hay_cutting = 0;
      this.yearData.pastures = 0;
      this.yearData.land_share = 0;
      this.yearData.property_shar = 0;
    },
    landOwnedReport: function landOwnedReport(year) {
      var _this = this;
      var data = {
        report: 'landOwned',
        year: year,
        // member_id: this.ownerId
        member_id: this.$route.params.id
      };
      axios.post('/api/v1/generate-report', data, {
        responseType: 'arraybuffer'
      }).then(function (res) {
        // const url = window.URL.createObjectURL(new Blob([res.data]));
        // const link = document.createElement('a');

        // link.href = url;
        var fileName = "".concat(_this.member.surname, " ").concat(_this.member.name, " ").concat(_this.member.patronymic, ". \u0414\u043E\u0432\u0456\u0434\u043A\u0430 \u043F\u0440\u043E \u0441\u043A\u043B\u0430\u0434 \u0437\u0435\u043C\u0435\u043B\u044C\u043D\u043E\u0457 \u0434\u0456\u043B\u044F\u043D\u043A\u0438.docx");
        _this.prepareDataForDownload(res, fileName);
        // link.setAttribute('download', fileName);
        // document.body.appendChild(link);

        // link.click();
      });
    },
    fetchYears: function fetchYears(url) {
      var _this2 = this;
      if (url == undefined) {
        url = "/api/v1/household-members/".concat(this.$route.params.id, "/land-years?per_page=").concat(this.perPage);
      }
      axios.get(url).then(function (res) {
        _this2.years = res.data.data.reverse();
        _this2.meta = res.data.meta;
      });
    }
  },
  computed: _objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_5__.mapGetters)('HouseholdMembers', {
    'owner_id': 'memberId',
    'member': 'member'
  })),
  created: function created() {
    this.fetchYears();
  },
  watch: {
    '$route': function $route(to, from) {
      if (to.params.id !== from.params.id) {
        this.fetchYears();
      }
    },
    'perPage': function perPage(newVal, oldVal) {
      if (newVal) {
        this.fetchYears();
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=script&lang=js":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=script&lang=js ***!
  \*********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm-bundler.js");
/* harmony import */ var _mixins_FormValidator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../mixins/FormValidator */ "./resources/js/mixins/FormValidator.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'MemberMainInfoTab',
  mixins: [_mixins_FormValidator__WEBPACK_IMPORTED_MODULE_0__["default"]],
  // props: {
  //     'formData': {
  //         type: Object,
  //         required: true,
  //     },
  // },
  emits: ['refreshData'],
  data: function data() {
    return {
      isInEditMode: false,
      _formData: {}
      // formData:{} // JSON.parse(JSON.stringify(this.info)),
    };
  },

  methods: {
    editData: function editData() {
      this.isInEditMode = true;
      this._formData = JSON.parse(JSON.stringify(this.formData));
    },
    cancelEdit: function cancelEdit() {
      this.isInEditMode = false;
      this.errors = [];
      this._formData = {};
      // this.formData = Object.assign({}, this.info);
      this.$store.dispatch('HouseholdMembers/fetchRecord', this.memberId);
      // this.$emit('refreshData');
    },
    saveData: function saveData() {
      var _this = this;
      var data = Object.assign({}, this.formData);
      if (data.work_place_id == 0) {
        delete data.work_place_id;
      }
      axios.patch("/api/v1/household-members/".concat(this.formData.id), data).then(function (res) {
        _this.$toast(res.data.message);
        _this.$emit('refreshData');
        _this.$store.dispatch('Households/fetchRecord', _this.formData.household_id);
      })["catch"](function (err) {
        var _err$response;
        _this.errors = (_err$response = err.response) === null || _err$response === void 0 ? void 0 : _err$response.data.errors;
      });
    },
    deleteData: function deleteData() {
      var _this2 = this;
      this.$confirmDelete('Ви дійсно бажаєти видалити інформацію о члені домогосподарства').then(function (res) {
        if (res.isConfirmed) {
          axios["delete"]("/api/v1/household-members/".concat(_this2.formData.id)).then(function (res) {
            _this2.$toast(res.data.message);
            _this2.$router.push({
              name: 'households.show.members',
              params: {
                id: _this2.formData.household_id
              }
            });
          })["catch"](function (err) {
            _this2.$errorMessage('Неможливо видалити члена домогосподарства', err.response.data.message, 'Зрозуміло');
          });
        }
      });
    }
  },
  computed: _objectSpread(_objectSpread(_objectSpread(_objectSpread({}, (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)('FamilyRelationshipTypes', {
    'relationshipTypes': 'types'
  })), (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)('WorkPlaces', ['places'])), (0,vuex__WEBPACK_IMPORTED_MODULE_1__.mapGetters)('HouseholdMembers', {
    formData: 'member',
    memberId: 'memberId'
  })), {}, {
    isEmploymentInformationDisabled: function isEmploymentInformationDisabled() {
      // console.log('Something happened');
      // this.$nextTick(() => {
      if (this.isInEditMode) {
        if (this.formData.work_place_id > 0) {
          return false;
        }
      }
      // })
      return true;
    },
    readyForSave: function readyForSave() {
      return JSON.stringify(this.formData) !== JSON.stringify(this._formData);
    } // deathDateIsSetted() {
    //     console.log('Death date was changed');
    //     if (this.isInEditMode) {
    //         if (this.formData.death_date === null) {
    //             return false;
    //         }
    //         return true;
    //     }
    //     return false;
    // }
  }),
  created: function created() {
    // this.formData = Object.assign({}, this.info);
  },
  watch: {
    'formData.death_date': function formDataDeath_date(newVal) {
      if (newVal == "") {
        this.formData.death_date = null;
        this.formData.death_register_number = '';
        if (this.errors['death_register_number']) delete this.errors['death_register_number'];
        this.formData.death_register_office = '';
        if (this.errors['death_register_office']) delete this.errors['death_register_office'];
      }
    },
    'formData.work_place_id': function formDataWork_place_id(newVal) {
      if (newVal) console.log('WorkPlace  has been changed');
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=script&lang=js":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/ui/ModalForm.vue */ "./resources/js/components/ui/ModalForm.vue");
/* harmony import */ var _mixins_FormValidator__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../mixins/FormValidator */ "./resources/js/mixins/FormValidator.js");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'MovementForm',
  mixins: [_mixins_FormValidator__WEBPACK_IMPORTED_MODULE_1__["default"]],
  props: {
    'formData': {
      type: Object,
      required: true
    },
    'action': {
      type: String,
      required: false,
      "default": 'create'
    },
    'title': {
      type: String,
      required: true
    },
    'submitCaption': {
      type: String,
      required: true
    },
    'movementTypes': {
      type: Array,
      required: true
    }
  },
  emits: ['refreshData'],
  data: function data() {
    return {
      apiUrl: '/api/v1/household-member-lands'
    };
  },
  methods: {
    submitData: function submitData() {
      var _this = this;
      if (this.action == 'create') {
        axios.post('/api/v1/household-member-movements', this.formData).then(function (res) {
          _this.$toast(res.data.message);
          axios.get("/api/v1/household-members/".concat(_this.formData.member_id)).then(function (res) {
            _this.$emit('refreshData');
            _this.clearForm();
          });
        })["catch"](function (err) {
          _this.errors = err.response.data.errors;
        });
      } else if (this.action == 'update') {
        axios.patch("/api/v1/household-member-movements/".concat(this.formData.id), this.formData).then(function (res) {
          _this.$toast(res.data.message);
          axios.get("/api/v1/household-members/".concat(_this.formData.member_id)).then(function (res) {
            _this.$emit('refreshData');
          });
        })["catch"](function (err) {
          _this.errors = err.response.data.errors;
        });
      }
    },
    clearForm: function clearForm() {
      this.formData.date = null;
      this.formData.movement_type_id = 0;
      this.formData.comment = '';
      this.errors = [];
    },
    closeForm: function closeForm() {
      this.clearForm();
    }
  },
  components: {
    ModalForm: _components_ui_ModalForm_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.esm.js");
/* harmony import */ var _MovementForm_vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MovementForm.vue */ "./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'MemberMovementsTab',
  components: {
    MovementForm: _MovementForm_vue__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  data: function data() {
    return {
      movementTypes: [],
      eventForm: {
        member_id: null,
        date: null,
        movement_type_id: 0,
        comment: ''
      },
      title: '',
      movementAction: '',
      submitCaption: '',
      movements: []
    };
  },
  methods: {
    showMovementEventForm: function showMovementEventForm() {
      this.title = 'Додати подію';
      this.submitCaption = 'Додати';
      this.movementAction = 'create';
      this.eventForm.member_id = this.$route.params.id;
      var movementForm = new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Modal(document.getElementById('MovementForm'));
      movementForm.show();
    },
    editMovementEvent: function editMovementEvent(event) {
      Object.assign(this.eventForm, event);
      this.title = 'Редагувати подію';
      this.submitCaption = 'Зберегти';
      this.movementAction = 'update';
      var movementForm = new bootstrap__WEBPACK_IMPORTED_MODULE_0__.Modal(document.getElementById('MovementForm'));
      movementForm.show();
    },
    closeForm: function closeForm() {
      this.clearMovementEventForm();
    },
    deleteMovementEvent: function deleteMovementEvent(id) {
      var _this = this;
      this.$confirmDelete('Ви дійсно бажаєте видалити інформацію о реєстрації / переміщенні').then(function (res) {
        if (res.isConfirmed) {
          axios["delete"]("/api/v1/household-member-movements/".concat(id)).then(function (res) {
            _this.$toast(res.data.message);
            _this.$emit('refreshData');
          });
        }
      });
    },
    fetchMovementEvents: function fetchMovementEvents() {
      var _this2 = this;
      axios.get("/api/v1/household-members/".concat(this.$route.params.id, "/movements")).then(function (res) {
        _this2.movements = res.data.data;
      });
    }
  },
  created: function created() {
    var _this3 = this;
    this.fetchMovementEvents();
    axios.get('/api/v1/movement-types').then(function (res) {
      _this3.movementTypes = res.data.data;
    });
  },
  watch: {
    '$route': function $route(to, from) {
      if (to.params.id !== from.params.id) {
        this.fetchMovementEvents();
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-14d7fecd"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  "class": "slider"
};
var _hoisted_2 = {
  "class": "progress",
  ref: "slider"
};
var _hoisted_3 = {
  "class": "range-input"
};
var _hoisted_4 = ["min", "max", "value"];
var _hoisted_5 = ["min", "max", "value"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, null, 512 /* NEED_PATCH */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "range",
    ref: "rangeMin",
    id: "rangeMin",
    name: "rangeMin",
    min: $props.min,
    max: $props.max,
    value: $props.minValue,
    onInput: $setup.updateMinRange
  }, null, 40 /* PROPS, HYDRATE_EVENTS */, _hoisted_4), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "range",
    ref: "rangeMax",
    id: "rangeMax",
    name: "rangeMax",
    min: $props.min,
    max: $props.max,
    value: $props.maxValue,
    onInput: $setup.updateMaxRange
  }, null, 40 /* PROPS, HYDRATE_EVENTS */, _hoisted_5)])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-48caf8d6"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  "class": "row mb-3"
};
var _hoisted_2 = {
  "class": "col"
};
var _hoisted_3 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "reportName",
    "class": "form-label"
  }, "Назва документу", -1 /* HOISTED */);
});
var _hoisted_4 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
    value: "",
    disabled: ""
  }, "Оберіть документ", -1 /* HOISTED */);
});
var _hoisted_5 = ["value"];
var _hoisted_6 = {
  key: 0,
  "class": "row mb-3"
};
var _hoisted_7 = {
  "class": "col"
};
var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, " Заповніть параметри для звіту ", -1 /* HOISTED */);
});
var _hoisted_9 = {
  "class": "row"
};
var _hoisted_10 = ["for"];
var _hoisted_11 = {
  "class": "col"
};
var _hoisted_12 = ["id", "onUpdate:modelValue"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_ModalForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ModalForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_ModalForm, {
    formId: "DocumentGenerationForm",
    onSubmitData: $options.submitData,
    sumbitIsDisabled: $data.reportName == '',
    onCloseForm: $options.closeForm
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
        "class": "form-control",
        id: "reportName",
        "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
          return $data.reportName = $event;
        })
      }, [_hoisted_4, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.reports, function (report) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
          key: report.id,
          value: report.code
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(report.name), 9 /* TEXT, PROPS */, _hoisted_5);
      }), 128 /* KEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.reportName]])])]), $data.reportParams.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.reportParams, function (param) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", {
          key: param.id
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
          "for": param.code,
          "class": "col col-form-label"
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(param.name), 9 /* TEXT, PROPS */, _hoisted_10), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          "class": "form-control",
          id: param.code,
          type: "number",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return $data.paramsValue[param.code] = $event;
          },
          autocomplete: "false"
        }, null, 8 /* PROPS */, _hoisted_12), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.paramsValue[param.code]]])])])]);
      }), 128 /* KEYED_FRAGMENT */))])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["onSubmitData", "sumbitIsDisabled", "onCloseForm"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Main.vue?vue&type=template&id=20271158":
/*!****************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Main.vue?vue&type=template&id=20271158 ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "card"
};
var _hoisted_2 = {
  "class": "card-header"
};
var _hoisted_3 = {
  "class": "dictionary-name__wrapper"
};
var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Члени домогосподарств", -1 /* HOISTED */);
var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-refresh"
}, null, -1 /* HOISTED */);
var _hoisted_6 = [_hoisted_5];
var _hoisted_7 = {
  key: 1,
  "class": "d-flext flex-gap-1 ms-3"
};
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-printer"
}, null, -1 /* HOISTED */);
var _hoisted_9 = [_hoisted_8];
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-filter-outline"
}, null, -1 /* HOISTED */);
var _hoisted_11 = [_hoisted_10];
var _hoisted_12 = {
  "class": "card-body"
};
var _hoisted_13 = {
  key: 0,
  "class": "align-middle text-center"
};
var _hoisted_14 = ["indeterminate", "checked", "title"];
var _hoisted_15 = {
  key: 1
};
var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  "data-sort-field": "full_name",
  "data-field-type": "string",
  "class": "sortable"
}, " Призвіще ім'я по батькові ", -1 /* HOISTED */);
var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  "class": "text-center"
}, "Дата народження", -1 /* HOISTED */);
var _hoisted_18 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  "data-sort-field": "full_age",
  "data-field-type": "number",
  "class": "sortable",
  style: {
    "min-width": "70px"
  }
}, " Вік ", -1 /* HOISTED */);
var _hoisted_19 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Адреса", -1 /* HOISTED */);
var _hoisted_20 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  "data-sort-field": "household_number",
  "data-field-type": "string",
  "class": "sortable"
}, " Домогосподарство ", -1 /* HOISTED */);
var _hoisted_21 = {
  key: 0,
  "class": "text-center",
  style: {
    "line-height": "24px"
  }
};
var _hoisted_22 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-eye-outline"
}, null, -1 /* HOISTED */);
var _hoisted_23 = {
  key: 1,
  "class": "text-center",
  style: {
    "line-height": "24px"
  }
};
var _hoisted_24 = ["onUpdate:modelValue", "onClick"];
var _hoisted_25 = {
  "class": "text-center"
};
var _hoisted_26 = {
  "class": "text-center"
};
var _hoisted_27 = {
  "class": "text-center"
};
var _hoisted_28 = {
  key: 1,
  "class": "text-muted text-center p-3"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_ButtonSelectRecords = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ButtonSelectRecords");
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");
  var _component_DataTable = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DataTable");
  var _component_MembersFilterForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("MembersFilterForm");
  var _component_DocumentGenerationForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DocumentGenerationForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <breadcrumbs /> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-sm btn-outline-primary ms-2",
    onClick: _cache[0] || (_cache[0] = function ($event) {
      return _ctx.$store.dispatch('HouseholdMembers/fetchRecords');
    }),
    title: "Оновити дані"
  }, _hoisted_6), _ctx.members.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_ButtonSelectRecords, {
    key: 0,
    title: _ctx.inSelectMode ? 'Викмнути режим відбору записів' : 'Увімкнути режим відбору записів',
    btnClass: [_ctx.inSelectMode ? 'btn-primary' : 'btn-outline-primary'],
    inSelectMode: _ctx.inSelectMode,
    selectedRecordsCount: _ctx.selectedRecordsCount,
    onToggleSelectMode: _ctx.toggleSelectMode
  }, null, 8 /* PROPS */, ["title", "btnClass", "inSelectMode", "selectedRecordsCount", "onToggleSelectMode"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), _ctx.selectedRecordsCount > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button type=\"button\"\n                            class=\"btn btn-sm btn-outline-info\"\n                            title=\"Додаткові параметри\"\n                            @click=\"() => {}\">\n                        <span class=\"mdi mdi-tag-multiple\"></span>\n                    </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button type=\"button\"\n                            class=\"btn btn-sm btn-outline-info ms-2\"\n                            title=\"Формування звіту\"\n                            @click=\"() => {}\">                            \n                        <span class=\"mdi mdi-file-document-arrow-right-outline\"></span>\n                    </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    "class": "btn btn-sm btn-outline-info ms-2",
    title: "Друк документів",
    onClick: _cache[1] || (_cache[1] = function () {
      return $options.openDocumentsForm && $options.openDocumentsForm.apply($options, arguments);
    })
  }, _hoisted_9)])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['btn btn-sm btn-outline-secondary', _ctx.filter.isFiltered ? 'active' : '']),
    onClick: [_cache[2] || (_cache[2] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.openFilterForm && $options.openFilterForm.apply($options, arguments);
    }, ["exact"])), _cache[3] || (_cache[3] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function () {
      return $options.resetFilter && $options.resetFilter.apply($options, arguments);
    }, ["ctrl"]))],
    title: "Фільтр членів домогосподарств"
  }, _hoisted_11, 2 /* CLASS */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [_ctx.members.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_DataTable, {
    key: 0,
    dataTable: _ctx.members,
    perPageItems: $data.perPageItems,
    externalPagination: _ctx.pagination,
    tableHeaderClass: "table-dark",
    tableClass: "table-bordered",
    sortByDefaultField: "id",
    onPageChanged: $options.pageChanged,
    onPerPageChanged: $options.perPageChanged
  }, {
    header: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [_ctx.inSelectMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("th", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "checkbox",
        "class": "form-check-input cursor-pointer",
        name: "selectAll",
        id: "selectAll",
        indeterminate: _ctx.isIndeterminate,
        checked: _ctx.isAllSelected,
        title: _ctx.toggleSelectAllTitle,
        onChange: _cache[4] || (_cache[4] = function ($event) {
          return _ctx.toggleSelectAll($event);
        })
      }, null, 40 /* PROPS, HYDRATE_EVENTS */, _hoisted_14)])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("th", _hoisted_15)), _hoisted_16, _hoisted_17, _hoisted_18, _hoisted_19, _hoisted_20])];
    }),
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function (slotProps) {
      return [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(slotProps.paginatedData, function (record) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
          key: record.id,
          "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
            'table-primary': record.selected
          })
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" @click.ctrl=\"showDocument(record.id)\"> "), !_ctx.inSelectMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", _hoisted_21, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
          to: {
            name: 'household-member',
            params: {
              id: record.id
            }
          }
        }, {
          "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
            return [_hoisted_22];
          }),
          _: 2 /* DYNAMIC */
        }, 1032 /* PROPS, DYNAMIC_SLOTS */, ["to"])])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("td", _hoisted_23, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          "class": "form-check-input cursor-pointer",
          type: "checkbox",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return record.selected = $event;
          },
          onClick: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
            return _ctx.selectMultipleRecords({
              e: $event,
              id: record.id
            });
          }, ["shift"])
        }, null, 8 /* PROPS */, _hoisted_24), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, record.selected]])])), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(record.full_name), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(record.birthdate_formatted), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_26, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(record.full_age), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(record.address), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
          to: {
            name: 'households.show.info',
            params: {
              id: record.household_id
            }
          },
          style: {
            "text-decoration": "none"
          }
        }, {
          "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
            return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(record.household_number), 1 /* TEXT */)];
          }),

          _: 2 /* DYNAMIC */
        }, 1032 /* PROPS, DYNAMIC_SLOTS */, ["to"])])], 2 /* CLASS */);
      }), 128 /* KEYED_FRAGMENT */))];
    }),

    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["dataTable", "perPageItems", "externalPagination", "onPageChanged", "onPerPageChanged"])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_28, " Немає даних для відображення. "))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_MembersFilterForm, {
    onResetFilter: $options.resetFilter
  }, null, 8 /* PROPS */, ["onResetFilter"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_DocumentGenerationForm, {
    records: _ctx.selectedRecords
  }, null, 8 /* PROPS */, ["records"])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=template&id=66a1c046":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=template&id=66a1c046 ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row mb-3"
};
var _hoisted_2 = {
  "class": "col"
};
var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "0"
}, "Усі населені пункти", -1 /* HOISTED */);
var _hoisted_4 = ["value"];
var _hoisted_5 = {
  "class": "row mb-3"
};
var _hoisted_6 = {
  "class": "col"
};
var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "all"
}, "Всі", -1 /* HOISTED */);
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "чоловіча"
}, "Чоловіча", -1 /* HOISTED */);
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "жіноча"
}, "Жіноча", -1 /* HOISTED */);
var _hoisted_10 = [_hoisted_7, _hoisted_8, _hoisted_9];
var _hoisted_11 = {
  "class": "row mb-3"
};
var _hoisted_12 = {
  "class": "col"
};
var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "form-check-label",
  "for": "filterByAge"
}, " Відобразити за віком ", -1 /* HOISTED */);
var _hoisted_14 = {
  "class": "col d-flex justify-content-end"
};
var _hoisted_15 = ["innerHTML"];
var _hoisted_16 = {
  key: 0,
  "class": "row mb-3"
};
var _hoisted_17 = {
  "class": "col"
};
var _hoisted_18 = ["disabled"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_RangeInput = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("RangeInput");
  var _component_AdditionalParamsFormFilter = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("AdditionalParamsFormFilter");
  var _component_ModalForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ModalForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_ModalForm, {
    formId: "HouseholdMembersMainFilterForm",
    onSubmitData: $options.submitData,
    onCloseForm: $options.clearFormData,
    modalClass: ""
  }, {
    footer: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
        "class": "btn btn-outline-secondary",
        onClick: _cache[5] || (_cache[5] = function ($event) {
          return _ctx.$emit('resetFilter');
        }),
        title: "Скинути фильтр",
        disabled: !_ctx.filter.isFiltered
      }, " Скинути ", 8 /* PROPS */, _hoisted_18)];
    }),
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
        "for": "memberSettlement",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["form-label", {
          'filtered': _ctx.filter.settlement_id !== 0
        }])
      }, "Населений пункт", 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
        "class": "form-control",
        id: "memberSettlement",
        "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
          return _ctx.filter.settlement_id = $event;
        })
      }, [_hoisted_3, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.settlements, function (settlement) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
          value: settlement.id,
          key: settlement.id
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(settlement.name), 9 /* TEXT, PROPS */, _hoisted_4);
      }), 128 /* KEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, _ctx.filter.settlement_id]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
        "for": "memberSex",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["form-label", {
          'filtered': _ctx.filter.sex !== 'all'
        }])
      }, "Стать", 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
        "class": "form-control",
        id: "memberSex",
        "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
          return _ctx.filter.sex = $event;
        })
      }, _hoisted_10, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, _ctx.filter.sex]])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        "class": "form-check-input ms-2",
        type: "checkbox",
        value: "",
        id: "filterByAge",
        "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
          return _ctx.filter.age.selected = $event;
        })
      }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, _ctx.filter.age.selected]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
        "class": "text-muted",
        innerHTML: $options.ageRangeInformation
      }, null, 8 /* PROPS */, _hoisted_15)])]), _ctx.filter.age.selected ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_16, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [$data.oldestAge ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_RangeInput, {
        key: 0,
        min: "0",
        max: $data.oldestAge,
        minValue: _ctx.filter.age.values[0],
        "onUpdate:minValue": _cache[3] || (_cache[3] = function ($event) {
          return _ctx.filter.age.values[0] = $event;
        }),
        maxValue: _ctx.filter.age.values[1],
        "onUpdate:maxValue": _cache[4] || (_cache[4] = function ($event) {
          return _ctx.filter.age.values[1] = $event;
        })
      }, null, 8 /* PROPS */, ["max", "minValue", "maxValue"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_AdditionalParamsFormFilter, {
        params: _ctx.params,
        filter: _ctx.filter
      }, null, 8 /* PROPS */, ["params", "filter"])];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["onSubmitData", "onCloseForm"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=template&id=0c75a49c&scoped=true":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=template&id=0c75a49c&scoped=true ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-0c75a49c"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  key: 1,
  "class": "card"
};
var _hoisted_2 = {
  "class": "card-header"
};
var _hoisted_3 = {
  "class": "card-body"
};
var _hoisted_4 = {
  "class": "px-3 pt-3"
};
var _hoisted_5 = {
  "class": "nav nav-tabs px-3"
};
var _hoisted_6 = {
  "class": "nav-item"
};
var _hoisted_7 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-account-details-outline me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_8 = {
  "class": "nav-item"
};
var _hoisted_9 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-land-fields me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_10 = {
  "class": "nav-item"
};
var _hoisted_11 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-transit-transfer me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_12 = {
  "class": "nav-item"
};
var _hoisted_13 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-tag-multiple me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_14 = {
  "class": "pt-2"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _ctx$member, _ctx$member2;
  var _component_breadcrumbs = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("breadcrumbs");
  var _component_router_link = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-link");
  var _component_router_view = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("router-view");
  var _component_Page404 = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("Page404");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(_ctx$member = _ctx.member) !== null && _ctx$member !== void 0 && _ctx$member.id ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_breadcrumbs, {
    key: 0
  })) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (_ctx$member2 = _ctx.member) !== null && _ctx$member2 !== void 0 && _ctx$member2.id ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h5", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.member.full_name), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h6", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.member.address) + " | ", 1 /* TEXT */), _ctx.member.household_id ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_router_link, {
    key: 0,
    to: {
      name: 'households.show.info',
      params: {
        id: _ctx.member.household_id
      }
    },
    onClick: _cache[0] || (_cache[0] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return _ctx.$router.push({
        name: 'households.show.members',
        params: {
          id: _ctx.member.household_id
        }
      });
    }, ["ctrl", "prevent"]))
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.member.household_number), 1 /* TEXT */)];
    }),

    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'household-member.info'
    },
    "class": "nav-link"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Головна інформація ")];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'household-member.lands'
    },
    "class": "nav-link"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Земля ")];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'household-member.movements'
    },
    "class": "nav-link"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Реєстрація / Переміщення ")];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", _hoisted_12, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_link, {
    to: {
      name: 'household-member.additional-data'
    },
    "class": "nav-link"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Додаткові дані ")];
    }),
    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["to"])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_router_view)])])])])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_Page404, {
    key: 2,
    message: "\u0427\u043B\u0435\u043D \u0434\u043E\u043C\u043E\u0433\u043E\u0441\u043F\u043E\u0434\u0430\u0440\u0441\u0442\u0432\u0430 \u0437 id:".concat($props.id, " \u0432\u0456\u0434\u0441\u0443\u0442\u043D\u0456\u0439"),
    resource: "img/404/member.png",
    fallbackUrl: "household-members",
    fallbackUrlMessage: "Повернутись до переліку членів домогосподарств"
  }, null, 8 /* PROPS */, ["message"]))], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=template&id=5680580f":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=template&id=5680580f ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_AdditionalParamsList = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("AdditionalParamsList");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_AdditionalParamsList, {
    owner: "App\\Models\\HouseholdMember",
    ownerId: _ctx.$route.params.id,
    additionalParams: $data.params,
    onRefreshData: $options.refreshData
  }, null, 8 /* PROPS */, ["ownerId", "additionalParams", "onRefreshData"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=template&id=0c1a8eae":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=template&id=0c1a8eae ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row mb-3"
};
var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landYear",
  "class": "col-form-label col-md-9"
}, " Рік ", -1 /* HOISTED */);
var _hoisted_3 = {
  id: "landYearValidation",
  "class": "invalid-feedback col-md-12"
};
var _hoisted_4 = {
  "class": "row mb-3"
};
var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landMaintenance",
  "class": "col-form-label col-md-9"
}, " під забудовою ", -1 /* HOISTED */);
var _hoisted_6 = {
  id: "landMaintenanceValidation",
  "class": "invalid-feedback col-md-12"
};
var _hoisted_7 = {
  "class": "row mb-3"
};
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landPersonalAgriculture",
  "class": "col-form-label col-md-9"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" для ведення "), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("abbr", {
  title: "особистого селянського господарства"
}, "ОСГ")], -1 /* HOISTED */);
var _hoisted_9 = {
  id: "landPersonalAgricultureValidation",
  "class": "invalid-feedback col-md-12"
};
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landHayCatting",
  "class": "col-form-label col-md-9"
}, " сінокосіння ", -1 /* HOISTED */);
var _hoisted_11 = {
  id: "landHayCutting",
  "class": "invalid-feedback col-md-12"
};
var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landPastures",
  "class": "col-form-label col-md-9"
}, " пасовища ", -1 /* HOISTED */);
var _hoisted_13 = {
  id: "landPastures",
  "class": "invalid-feedback col-md-12"
};
var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landShare",
  "class": "col-form-label col-md-9"
}, " земельний пай ", -1 /* HOISTED */);
var _hoisted_15 = {
  id: "landShare",
  "class": "invalid-feedback col-md-12"
};
var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "landPropertyShare",
  "class": "col-form-label col-md-9"
}, " майновий пай ", -1 /* HOISTED */);
var _hoisted_17 = {
  id: "landShare",
  "class": "invalid-feedback col-md-12"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_ModalForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ModalForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_ModalForm, {
    formId: "LandYearForm",
    submitCaption: $props.submitCaption,
    title: $props.title,
    onCloseForm: $options.closeForm,
    onSubmitData: _ctx.submitData,
    modalContentClass: "second-modal"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('year') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('year') ? 'is-invalid' : '']),
        id: "landYear",
        name: "landYear",
        "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
          return $props.formData.year = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.year]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('year')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [_hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('maintenance') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control col-md-3', _ctx.hasError('maintenance') ? 'is-invalid' : '']),
        id: "landMaintenance",
        "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
          return $props.formData.maintenance = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.maintenance]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('maintenance')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('personal_agriculture') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('personal_agriculture') ? 'is-invalid' : '']),
        id: "landPersonalAgriculture",
        "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
          return $props.formData.personal_agriculture = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.personal_agriculture]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('personal_agriculture')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['row mb-3', _ctx.hasError('hay_cutting') ? 'is-invalid' : ''])
      }, [_hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('hay_cutting') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('hay_cutting') ? 'is-invalid' : '']),
        id: "landHayCatting",
        "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
          return $props.formData.hay_cutting = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.hay_cutting]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('hay_cutting')), 1 /* TEXT */)], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['row mb-3', _ctx.hasError('pastures') ? 'is-invalid' : ''])
      }, [_hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('pastures') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('pastures') ? 'is-invalid' : '']),
        id: "landPastures",
        "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
          return $props.formData.pastures = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.pastures]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('pastures')), 1 /* TEXT */)], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['row mb-3', _ctx.hasError('land_share') ? 'is-invalid' : ''])
      }, [_hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('land_share') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('land_share') ? 'is-invalid' : '']),
        id: "landShare",
        "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
          return $props.formData.land_share = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.land_share]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('land_share')), 1 /* TEXT */)], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['row mb-3', _ctx.hasError('property_share') ? 'is-invalid' : ''])
      }, [_hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['col-md-3', _ctx.hasError('property_share') ? 'is-invalid' : ''])
      }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "text",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('property_share') ? 'is-invalid' : '']),
        id: "landPropertyShare",
        "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
          return $props.formData.property_share = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.property_share]])], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('property_share')), 1 /* TEXT */)], 2 /* CLASS */)];
    }),

    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["submitCaption", "title", "onCloseForm", "onSubmitData"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=template&id=49939cce":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=template&id=49939cce ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "table table-sm table-bordered table-years"
};
var _hoisted_2 = {
  "class": "bg-body-secondary"
};
var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-plus-thick"
}, null, -1 /* HOISTED */);
var _hoisted_4 = {
  "class": "dropdown"
};
var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
  "class": "btn btn-sm btn-light btn-transparent",
  type: "button",
  "data-bs-toggle": "dropdown",
  "aria-expanded": "false",
  title: "Операції з даними за рік"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-cog"
})], -1 /* HOISTED */);
var _hoisted_6 = {
  "class": "dropdown-menu dropdown-menu-end"
};
var _hoisted_7 = ["onClick"];
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-land-fields me-2",
  style: {
    "color": "green"
  }
}, null, -1 /* HOISTED */);
var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("hr", {
  "class": "dropdown-divider"
})], -1 /* HOISTED */);
var _hoisted_10 = ["onClick"];
var _hoisted_11 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-pencil text-warning me-2"
}, null, -1 /* HOISTED */);
var _hoisted_12 = ["onClick"];
var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-trash-can text-danger me-2"
}, null, -1 /* HOISTED */);
var _hoisted_14 = {
  "class": "table-group-divider"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_TableRow = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("TableRow");
  var _component_YearsPaginator = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("YearsPaginator");
  var _component_LandYearForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("LandYearForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "button",
    "class": "btn btn-sm btn-outline-secondary btn-transparent",
    onClick: _cache[0] || (_cache[0] = function ($event) {
      return _ctx.newYearData($event);
    })
  }, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Додати рік ")])]), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.years, function (year) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("th", {
      key: year.year
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)((0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(year.year) + " ", 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [_hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("\n                                ---- place widget for available reports ??????\n\n                                <li v-for=\"report in reports\" :key=`year+report.id`>\n                                    <a class=\"dropdown-item\" @click=\"report.code\">  // arguments in report ????\n                                        <span :class=\"['me-2', report.icon]\" style=\"color:green;\"></span>\n                                        {{report.name}}\n                                    </a>\n                                </li>\n                             "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "dropdown-item",
      onClick: function onClick($event) {
        return $options.landOwnedReport(year.year);
      }
    }, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Звіт про склад земельної ділянки ")], 8 /* PROPS */, _hoisted_7)]), _hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "dropdown-item",
      onClick: function onClick($event) {
        return _ctx.editYear(year);
      }
    }, [_hoisted_11, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Редагувати дані ")], 8 /* PROPS */, _hoisted_10)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "dropdown-item",
      onClick: function onClick($event) {
        return _ctx.deleteYear(year);
      }
    }, [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Видалити дані ")], 8 /* PROPS */, _hoisted_12)])])])]);
  }), 128 /* KEYED_FRAGMENT */))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "total",
    rowTitle: "<b>Площа земельних ділянок - усього</b>"
  }, null, 8 /* PROPS */, ["years"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "maintenance",
    rowTitle: "під забудовою",
    rowTitleClass: "ps-3"
  }, null, 8 /* PROPS */, ["years"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "personal_agriculture",
    rowTitle: "для ведення  <abbr title='особистого селянського господарства'>ОСГ</abbr>",
    rowTitleClass: "ps-3"
  }, null, 8 /* PROPS */, ["years"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "hay_cutting",
    rowTitle: "сінокосіння",
    rowTitleClass: "ps-3"
  }, null, 8 /* PROPS */, ["years"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "pastures",
    rowTitle: "пасовища",
    rowTitleClass: "ps-3"
  }, null, 8 /* PROPS */, ["years"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "land_share",
    rowTitle: "земельний пай",
    rowTitleClass: "ps-3"
  }, null, 8 /* PROPS */, ["years"]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_TableRow, {
    years: $data.years,
    field: "property_share",
    rowTitle: "майновий пай",
    rowTitleClass: "ps-3"
  }, null, 8 /* PROPS */, ["years"])])]), $data.years.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_YearsPaginator, {
    key: 0,
    modelValue: $data.perPage,
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.perPage = $event;
    }),
    meta: $data.meta,
    onFetchYears: $options.fetchYears
  }, null, 8 /* PROPS */, ["modelValue", "meta", "onFetchYears"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Teleport, {
    to: "body"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_LandYearForm, {
    formData: $data.yearData,
    title: $data.title,
    submitCaption: $data.submitCaption,
    action: $data.action,
    onCloseYearForm: $options.closeYearForm,
    onRefreshData: $options.fetchYears
  }, null, 8 /* PROPS */, ["formData", "title", "submitCaption", "action", "onCloseYearForm", "onRefreshData"])]))], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=template&id=76ceeaee":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=template&id=76ceeaee ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row"
};
var _hoisted_2 = {
  "class": "col-md-5 border-end"
};
var _hoisted_3 = {
  "class": "row mb-3"
};
var _hoisted_4 = {
  "class": "col"
};
var _hoisted_5 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberSurname",
  "class": "form-label"
}, "Прізвище", -1 /* HOISTED */);
var _hoisted_6 = ["disabled"];
var _hoisted_7 = {
  id: "memberSurnameValidation",
  "class": "invalid-feedback"
};
var _hoisted_8 = {
  "class": "row mb-3"
};
var _hoisted_9 = {
  "class": "col"
};
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberName",
  "class": "form-label"
}, "Ім'я", -1 /* HOISTED */);
var _hoisted_11 = ["disabled"];
var _hoisted_12 = {
  id: "memberNameValidation",
  "class": "invalid-feedback"
};
var _hoisted_13 = {
  "class": "col"
};
var _hoisted_14 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberPatronymic",
  "class": "form-label"
}, "По батькові", -1 /* HOISTED */);
var _hoisted_15 = ["disabled"];
var _hoisted_16 = {
  id: "memberPatronymicValidation",
  "class": "invalid-feedback"
};
var _hoisted_17 = {
  "class": "row mb-3"
};
var _hoisted_18 = {
  "class": "col"
};
var _hoisted_19 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberBirthdate",
  "class": "form-label"
}, "Дата народження", -1 /* HOISTED */);
var _hoisted_20 = ["disabled"];
var _hoisted_21 = {
  id: "memberBirthdayValidation",
  "class": "invalid-feedback"
};
var _hoisted_22 = {
  "class": "col"
};
var _hoisted_23 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberSex",
  "class": "form-label"
}, "Стать", -1 /* HOISTED */);
var _hoisted_24 = ["disabled"];
var _hoisted_25 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("datalist", {
  id: "sex"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "чоловіча"
}), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "жіноча"
})], -1 /* HOISTED */);
var _hoisted_26 = {
  id: "memberSexValidation",
  "class": "invalid-feedback"
};
var _hoisted_27 = {
  "class": "row mb-3"
};
var _hoisted_28 = {
  "class": "col"
};
var _hoisted_29 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "familyRelationshipType",
  "class": "form-label"
}, "Родинні стосунки", -1 /* HOISTED */);
var _hoisted_30 = ["disabled"];
var _hoisted_31 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  disabled: "",
  value: "0"
}, "Оберить тип родинних стосунків", -1 /* HOISTED */);
var _hoisted_32 = ["value"];
var _hoisted_33 = {
  id: "familyRelationshipTypeValidation",
  "class": "invalid-feedback"
};
var _hoisted_34 = {
  "class": "row mb-3"
};
var _hoisted_35 = {
  "class": "col"
};
var _hoisted_36 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberDeathDate",
  "class": "form-label"
}, "Дата смерті", -1 /* HOISTED */);
var _hoisted_37 = ["disabled"];
var _hoisted_38 = {
  id: "memberDeathDateValidation",
  "class": "invalid-feedback"
};
var _hoisted_39 = {
  "class": "col"
};
var _hoisted_40 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberDeathNumber",
  "class": "form-label"
}, "Номер свідоцтва", -1 /* HOISTED */);
var _hoisted_41 = ["disabled"];
var _hoisted_42 = {
  id: "memberDeathNumberValidation",
  "class": "invalid-feedback"
};
var _hoisted_43 = {
  "class": "row mb-3"
};
var _hoisted_44 = {
  "class": "col"
};
var _hoisted_45 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "memberDeathRegisterOffice",
  "class": "form-label"
}, "Орган", -1 /* HOISTED */);
var _hoisted_46 = ["disabled"];
var _hoisted_47 = {
  id: "memberDeathPlaceValidation",
  "class": "invalid-feedback"
};
var _hoisted_48 = {
  "class": "col-md-7"
};
var _hoisted_49 = {
  "class": "row mb-3"
};
var _hoisted_50 = {
  "class": "col"
};
var _hoisted_51 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "workPlace",
  "class": "form-label"
}, "Місце роботи залежно від територіального розташування", -1 /* HOISTED */);
var _hoisted_52 = ["disabled"];
var _hoisted_53 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  disabled: "",
  value: "0"
}, "Оберить місце роботи", -1 /* HOISTED */);
var _hoisted_54 = ["value"];
var _hoisted_55 = {
  id: "workPlaceValidation",
  "class": "invalid-feedback"
};
var _hoisted_56 = {
  "class": "row mb-3"
};
var _hoisted_57 = {
  "class": "col"
};
var _hoisted_58 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "employmentInformation",
  "class": "form-label"
}, "Відомості про зайнятість / незайнятість", -1 /* HOISTED */);
var _hoisted_59 = ["disabled"];
var _hoisted_60 = {
  id: "employmentInformationValidation",
  "class": "invalid-feedback"
};
var _hoisted_61 = {
  "class": "row mb-3"
};
var _hoisted_62 = {
  "class": "col"
};
var _hoisted_63 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "socialInformation",
  "class": "form-label"
}, "Відомості про пенсію, інвалідність, отримання соціальної допомоги", -1 /* HOISTED */);
var _hoisted_64 = ["disabled"];
var _hoisted_65 = {
  id: "socialInformationValidation",
  "class": "invalid-feedback"
};
var _hoisted_66 = {
  "class": "row mb-3"
};
var _hoisted_67 = {
  "class": "col"
};
var _hoisted_68 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "additionalInformation",
  "class": "form-label"
}, "Додаткова інформація", -1 /* HOISTED */);
var _hoisted_69 = ["disabled"];
var _hoisted_70 = {
  id: "additionalInformationValidation",
  "class": "invalid-feedback"
};
var _hoisted_71 = {
  "class": "row"
};
var _hoisted_72 = {
  "class": "d-flex justify-content-between"
};
var _hoisted_73 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-trash-can-outline"
}, null, -1 /* HOISTED */);
var _hoisted_74 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-pencil"
}, null, -1 /* HOISTED */);
var _hoisted_75 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-check-all"
}, null, -1 /* HOISTED */);

function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [_hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    id: "memberSurname",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('surname') ? 'is-invalid' : '']),
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return _ctx.formData.surname = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_6), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.surname]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('surname')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div class=\"col\">\n                <label  for=\"memberName\" class=\"form-label\">Ім'я</label>\n                <input  type=\"text\"\n                        :class=\"['form-control', hasError('name') ? 'is-invalid' : '']\"\n                        id=\"memberName\"\n                        v-model=\"formData.name\"\n                        :disabled=\"!isInEditMode\">\n                <div id=\"memberNameValidation\" class=\"invalid-feedback\">\n                    {{ getError('name') }}\n                </div>\n            </div>\n            <div class=\"col\">\n                <label  for=\"memberPatronymic\" class=\"form-label\">По батькові</label>\n                <input  type=\"text\"\n                        :class=\"['form-control', hasError('patronymic') ? 'is-invalid' : '']\"\n                        id=\"memberPatronymic\"\n                        v-model=\"formData.patronymic\"\n                        :disabled=\"!isInEditMode\">\n                <div id=\"memberPatronymicValidation\" class=\"invalid-feedback\">\n                    {{ getError('patronymic') }}\n                </div>\n            </div> ")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [_hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('name') ? 'is-invalid' : '']),
    id: "memberName",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return _ctx.formData.name = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_11), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.name]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('name')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [_hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('patronymic') ? 'is-invalid' : '']),
    id: "memberPatronymic",
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return _ctx.formData.patronymic = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_15), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.patronymic]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('patronymic')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_17, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_18, [_hoisted_19, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('birthdate') ? 'is-invalid' : '']),
    id: "memberBirthdate",
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return _ctx.formData.birthdate = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_20), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.birthdate]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('birthdate')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [_hoisted_23, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    list: "sex",
    id: "memberSex",
    placeholder: "Type to search...",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('sex') ? 'is-invalid' : '']),
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return _ctx.formData.sex = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_24), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.sex]]), _hoisted_25, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('sex')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div class=\"col\">\n                <label for=\"familyRelationshipType\" class=\"form-label\">Родинні стосунки</label>\n                <select :class=\"['form-control', hasError('family_relationship_type_id') ? 'is-invalid' : '']\"\n                        aria-label=\"Default select example\"\n                        v-model=\"formData.family_relationship_type_id\"\n                        :disabled=\"!isInEditMode\">\n                    <option disabled value=\"0\">Оберить тип родинних стосунків</option>\n                    <option :value=\"relationship.id\" v-for=\"relationship in relationshipTypes\" :key=\"relationship.id\">\n                        {{relationship.name}}\n                    </option>\n                </select>\n                <div id=\"familyRelationshipTypeValidation\" class=\"invalid-feedback\">\n                    {{ getError('family_relationship_type_id') }}\n                </div>\n            </div> ")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_27, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [_hoisted_29, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('family_relationship_type_id') ? 'is-invalid' : '']),
    "aria-label": "Default select example",
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return _ctx.formData.family_relationship_type_id = $event;
    }),
    id: "familyRelationshipType",
    disabled: !$data.isInEditMode
  }, [_hoisted_31, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.relationshipTypes, function (relationship) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: relationship.id,
      key: relationship.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(relationship.name), 9 /* TEXT, PROPS */, _hoisted_32);
  }), 128 /* KEYED_FRAGMENT */))], 10 /* CLASS, PROPS */, _hoisted_30), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, _ctx.formData.family_relationship_type_id]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_33, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('family_relationship_type_id')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [_hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    id: "memberDeathDate",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('death_date') ? 'is-invalid' : '']),
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return _ctx.formData.death_date = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_37), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.death_date]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('death_date')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [_hoisted_40, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    id: "memberDeathNumber",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('death_register_number') ? 'is-invalid' : '']),
    "onUpdate:modelValue": _cache[7] || (_cache[7] = function ($event) {
      return _ctx.formData.death_register_number = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_41), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.death_register_number]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_42, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('death_register_number')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_44, [_hoisted_45, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    id: "memberDeathRegisterOffice",
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('death_register_office') ? 'is-invalid' : '']),
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return _ctx.formData.death_register_office = $event;
    }),
    disabled: !$data.isInEditMode
  }, null, 10 /* CLASS, PROPS */, _hoisted_46), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.death_register_office]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_47, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('death_register_office')), 1 /* TEXT */)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_48, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div class=\"row mb-3\">\n            <div class=\"col-md-9\">\n                <label  for=\"memberAddress\" class=\"form-label\">Адреса</label>\n                <input  type=\"text\"\n                        class=\"form-control\"\n                        id=\"memberAddress\"\n                        v-model=\"formData.address\"\n                        disabled>\n            </div>\n            <div class=\"col-md-3\">\n                <label  for=\"memberHouseholdNumber\" class=\"form-label\">№ домогосподарства</label>\n                <input  type=\"text\"\n                        class=\"form-control\"\n                        id=\"memberHouseholdNumber\"\n                        v-model=\"formData.household_number\"\n                        disabled>\n            </div>\n        </div> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_49, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [_hoisted_51, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-select', _ctx.hasError('work_place_id') ? 'is-invalid' : '']),
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return _ctx.formData.work_place_id = $event;
    }),
    disabled: !$data.isInEditMode,
    id: "workPlace"
  }, [_hoisted_53, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(_ctx.places, function (place) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: place.id,
      key: place.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(place.name), 9 /* TEXT, PROPS */, _hoisted_54);
  }), 128 /* KEYED_FRAGMENT */))], 10 /* CLASS, PROPS */, _hoisted_52), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, _ctx.formData.work_place_id]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_55, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('work_place_id')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_57, [_hoisted_58, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('employment_information') ? 'is-invalid' : '']),
    id: "employmentInformation",
    rows: "2",
    "onUpdate:modelValue": _cache[10] || (_cache[10] = function ($event) {
      return _ctx.formData.employment_information = $event;
    }),
    disabled: $options.isEmploymentInformationDisabled
  }, "\n                ", 10 /* CLASS, PROPS */, _hoisted_59), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.employment_information]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_60, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('employment_information')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_61, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_62, [_hoisted_63, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('social_information') ? 'is-invalid' : '']),
    id: "socialInformation",
    rows: "2",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return _ctx.formData.social_information = $event;
    }),
    disabled: !$data.isInEditMode
  }, "\n                ", 10 /* CLASS, PROPS */, _hoisted_64), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.social_information]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_65, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('social_information')), 1 /* TEXT */)])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_66, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_67, [_hoisted_68, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('additional_information') ? 'is-invalid' : '']),
    id: "additionalInformation",
    rows: "2",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return _ctx.formData.additional_information = $event;
    }),
    disabled: !$data.isInEditMode
  }, "\n                ", 10 /* CLASS, PROPS */, _hoisted_69), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, _ctx.formData.additional_information]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_70, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('additional_information')), 1 /* TEXT */)])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_71, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_72, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [!$data.isInEditMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 0,
    "class": "btn btn-sm btn-outline-danger",
    title: "Видалити члена домогосподарства",
    onClick: _cache[13] || (_cache[13] = function () {
      return $options.deleteData && $options.deleteData.apply($options, arguments);
    })
  }, [_hoisted_73, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Видалити ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [!$data.isInEditMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 0,
    "class": "btn btn-sm btn-outline-secondary",
    title: "Редагувати дані",
    onClick: _cache[14] || (_cache[14] = function () {
      return $options.editData && $options.editData.apply($options, arguments);
    })
  }, [_hoisted_74, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Редагувати ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.isInEditMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 1,
    "class": "btn btn-sm btn-outline-secondary",
    title: "Відмінити редагування",
    onClick: _cache[15] || (_cache[15] = function () {
      return $options.cancelEdit && $options.cancelEdit.apply($options, arguments);
    })
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <span class=\"mdi mdi-check-all\"></span> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Відмінити ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.isInEditMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 2,
    "class": "btn btn-sm btn-outline-primary ms-3",
    title: "Зберегти дані",
    onClick: _cache[16] || (_cache[16] = function () {
      return $options.saveData && $options.saveData.apply($options, arguments);
    })
  }, [_hoisted_75, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Зберегти ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=template&id=017bd0d6":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=template&id=017bd0d6 ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row mb-3"
};
var _hoisted_2 = {
  "class": "col-md-8"
};
var _hoisted_3 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "movementEventType",
  "class": "form-label"
}, "Подія", -1 /* HOISTED */);
var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  disabled: "",
  value: "0"
}, "Оберить подію", -1 /* HOISTED */);
var _hoisted_5 = ["value"];
var _hoisted_6 = {
  id: "movementEventValidation",
  "class": "invalid-feedback"
};
var _hoisted_7 = {
  "class": "col-md-4"
};
var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "movementEventDate",
  "class": "form-label"
}, "Дата", -1 /* HOISTED */);
var _hoisted_9 = {
  id: "movementEventValidation",
  "class": "invalid-feedback"
};
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", {
  "class": "row mb-3"
}, null, -1 /* HOISTED */);
var _hoisted_11 = {
  "class": "row mb-3"
};
var _hoisted_12 = {
  "class": "col"
};
var _hoisted_13 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "for": "movementEventComment",
  "class": "form-label"
}, "Примітка", -1 /* HOISTED */);
var _hoisted_14 = {
  id: "movementEventCommentValidation",
  "class": "invalid-feedback"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_ModalForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("ModalForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_ModalForm, {
    formId: "MovementForm",
    submitCaption: $props.submitCaption,
    title: $props.title,
    onCloseForm: $options.closeForm,
    onSubmitData: $options.submitData,
    modalContentClass: "second-modal"
  }, {
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [_hoisted_3, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('movement_type_id') ? 'is-invalid' : '']),
        "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
          return $props.formData.movement_type_id = $event;
        }),
        id: "movementEventType"
      }, [_hoisted_4, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.movementTypes, function (movementType) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
          value: movementType.id,
          key: movementType.id
        }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(movementType.name), 9 /* TEXT, PROPS */, _hoisted_5);
      }), 128 /* KEYED_FRAGMENT */))], 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $props.formData.movement_type_id]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('movement_type_id')), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
        type: "date",
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('date') ? 'is-invalid' : '']),
        id: "movementEventDate",
        "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
          return $props.formData.date = $event;
        })
      }, null, 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.date]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('date')), 1 /* TEXT */)])]), _hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_12, [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(['form-control', _ctx.hasError('comment') ? 'is-invalid' : '']),
        id: "movementEventComment",
        rows: "2",
        "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
          return $props.formData.comment = $event;
        })
      }, "\n                    ", 2 /* CLASS */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $props.formData.comment]]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(_ctx.getError('comment')), 1 /* TEXT */)])])];
    }),

    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["submitCaption", "title", "onCloseForm", "onSubmitData"]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=template&id=1952aa12":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=template&id=1952aa12 ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "mb-3"
};
var _hoisted_2 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-calendar me-1"
}, null, -1 /* HOISTED */);
var _hoisted_3 = {
  key: 0,
  "class": "table table-sm table-bordered"
};
var _hoisted_4 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", {
  "class": "bg-body-secondary"
}, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  style: {
    "width": "150px"
  }
}, "Дата"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Подія"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", null, "Коментар"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
  style: {
    "width": "100px"
  }
})])], -1 /* HOISTED */);
var _hoisted_5 = {
  "class": "text-center"
};
var _hoisted_6 = ["onClick"];
var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-pencil"
}, null, -1 /* HOISTED */);
var _hoisted_8 = [_hoisted_7];
var _hoisted_9 = ["onClick"];
var _hoisted_10 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "mdi mdi-trash-can-outline"
}, null, -1 /* HOISTED */);
var _hoisted_11 = [_hoisted_10];
var _hoisted_12 = {
  key: 1,
  "class": "text-center text-muted"
};
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _$data$movements;
  var _component_MovementForm = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("MovementForm");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    "class": "btn btn-sm btn-outline-secondary",
    title: "Додати подію",
    onClick: _cache[0] || (_cache[0] = function () {
      return $options.showMovementEventForm && $options.showMovementEventForm.apply($options, arguments);
    })
  }, [_hoisted_2, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Додати подію ")])]), (_$data$movements = $data.movements) !== null && _$data$movements !== void 0 && _$data$movements.length ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("table", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.movements, function (event, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
      key: index,
      "class": "align-middle"
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(event.date_formatted), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(event.movement_type), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(event.comment), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-sm btn-outline-warning btn-transparent me-3",
      title: "Редагувати подію",
      onClick: function onClick($event) {
        return $options.editMovementEvent(event);
      }
    }, _hoisted_8, 8 /* PROPS */, _hoisted_6), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
      "class": "btn btn-sm btn-outline-danger btn-transparent",
      title: "Видалити подію",
      onClick: function onClick($event) {
        return $options.deleteMovementEvent(event.id);
      }
    }, _hoisted_11, 8 /* PROPS */, _hoisted_9)])]);
  }), 128 /* KEYED_FRAGMENT */))])])) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_12, " Інформація відсутня ")), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Teleport, {
    to: "body"
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_MovementForm, {
    formData: $data.eventForm,
    title: $data.title,
    submitCaption: $data.submitCaption,
    action: $data.movementAction,
    movementTypes: $data.movementTypes,
    onRefreshData: $options.fetchMovementEvents
  }, null, 8 /* PROPS */, ["formData", "title", "submitCaption", "action", "movementTypes", "onRefreshData"])]))], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
___CSS_LOADER_EXPORT___.push([module.id, ".slider[data-v-14d7fecd] {\n  height: 5px;\n  border-radius: 5px;\n  background: #ddd;\n  position: relative;\n  overflow: hidden;\n}\n.progress[data-v-14d7fecd] {\n  height: 5px;\n  left: var(--progressLeft);\n  right: var(--progressRight);\n  position: absolute;\n  border-radius: 5px;\n  background: rgba(44, 80, 179, 0.8274509804);\n}\n.range-input[data-v-14d7fecd] {\n  position: relative;\n}\n.range-input input[type=range][data-v-14d7fecd] {\n  position: absolute;\n  top: -5px;\n  height: 5px;\n  width: 100%;\n  background: none;\n  pointer-events: none;\n  -webkit-appearance: none;\n}\n.range-input input[type=range][data-v-14d7fecd]:focus-within {\n  outline: none;\n}\n.range-input input[type=range][data-v-14d7fecd]::-webkit-slider-thumb {\n  height: 20px;\n  width: 20px;\n  position: relative;\n  border-radius: 5px;\n  pointer-events: auto;\n  -webkit-appearance: none;\n  background: rgb(44, 80, 179);\n  -webkit-transition: background 0.3s;\n  transition: background 0.3s;\n  border: 1px solid #fff;\n}\n.range-input input[type=range][data-v-14d7fecd]:last-child::-webkit-slider-thumb {\n  z-index: 10;\n}\n.range-input input[type=range][data-v-14d7fecd]:active::-webkit-slider-thumb,\n.range-input input[type=range][data-v-14d7fecd]:focus-visible::-webkit-slider-thumb {\n  background: var(--bs-info);\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
___CSS_LOADER_EXPORT___.push([module.id, ".report[data-v-48caf8d6] {\n  max-width: 20ch;\n  min-width: 20ch;\n  border: 1px solid #d7d7d7;\n  border-radius: 0.2rem;\n  padding: 0.5rem;\n  box-shadow: 0px 1px 0px 2px #eee;\n}\n.report span[data-v-48caf8d6] {\n  display: inline-block;\n  text-wrap: balance;\n  text-align: center;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true ***!
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
___CSS_LOADER_EXPORT___.push([module.id, "a.router-link-exact-active[data-v-0c75a49c] {\n  background: linear-gradient(#e9ecef, #f8fafc);\n  color: var(--bs-nav-tabs-link-active-color);\n  border-color: var(--bs-nav-tabs-link-active-border-color) !important;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_style_index_0_id_14d7fecd_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_style_index_0_id_14d7fecd_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_style_index_0_id_14d7fecd_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_style_index_0_id_48caf8d6_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_style_index_0_id_48caf8d6_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_style_index_0_id_48caf8d6_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_style_index_0_id_0c75a49c_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_style_index_0_id_0c75a49c_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_style_index_0_id_0c75a49c_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/ui/RangeInput.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/ui/RangeInput.vue ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _RangeInput_vue_vue_type_template_id_14d7fecd_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true */ "./resources/js/components/ui/RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true");
/* harmony import */ var _RangeInput_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./RangeInput.vue?vue&type=script&setup=true&lang=js */ "./resources/js/components/ui/RangeInput.vue?vue&type=script&setup=true&lang=js");
/* harmony import */ var _RangeInput_vue_vue_type_style_index_0_id_14d7fecd_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true */ "./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_RangeInput_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_RangeInput_vue_vue_type_template_id_14d7fecd_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-14d7fecd"],['__file',"resources/js/components/ui/RangeInput.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue":
/*!**************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _DocumentGenerationForm_vue_vue_type_template_id_48caf8d6_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true */ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true");
/* harmony import */ var _DocumentGenerationForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DocumentGenerationForm.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=script&lang=js");
/* harmony import */ var _DocumentGenerationForm_vue_vue_type_style_index_0_id_48caf8d6_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true */ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_DocumentGenerationForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_DocumentGenerationForm_vue_vue_type_template_id_48caf8d6_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-48caf8d6"],['__file',"resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Main.vue":
/*!********************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Main.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Main_vue_vue_type_template_id_20271158__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Main.vue?vue&type=template&id=20271158 */ "./resources/js/modules/HouseholdMembers/Main.vue?vue&type=template&id=20271158");
/* harmony import */ var _Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Main.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Main.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Main_vue_vue_type_template_id_20271158__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Main.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/MembersFilterForm.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/MembersFilterForm.vue ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MembersFilterForm_vue_vue_type_template_id_66a1c046__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MembersFilterForm.vue?vue&type=template&id=66a1c046 */ "./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=template&id=66a1c046");
/* harmony import */ var _MembersFilterForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MembersFilterForm.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_MembersFilterForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_MembersFilterForm_vue_vue_type_template_id_66a1c046__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/MembersFilterForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Show.vue":
/*!********************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Show.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Show_vue_vue_type_template_id_0c75a49c_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Show.vue?vue&type=template&id=0c75a49c&scoped=true */ "./resources/js/modules/HouseholdMembers/Show.vue?vue&type=template&id=0c75a49c&scoped=true");
/* harmony import */ var _Show_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Show.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Show.vue?vue&type=script&lang=js");
/* harmony import */ var _Show_vue_vue_type_style_index_0_id_0c75a49c_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true */ "./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_Show_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Show_vue_vue_type_template_id_0c75a49c_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-0c75a49c"],['__file',"resources/js/modules/HouseholdMembers/Show.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue":
/*!*************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _AdditionalParams_vue_vue_type_template_id_5680580f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdditionalParams.vue?vue&type=template&id=5680580f */ "./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=template&id=5680580f");
/* harmony import */ var _AdditionalParams_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdditionalParams.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_AdditionalParams_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_AdditionalParams_vue_vue_type_template_id_5680580f__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _LandYearForm_vue_vue_type_template_id_0c1a8eae__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LandYearForm.vue?vue&type=template&id=0c1a8eae */ "./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=template&id=0c1a8eae");
/* harmony import */ var _LandYearForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LandYearForm.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_LandYearForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_LandYearForm_vue_vue_type_template_id_0c1a8eae__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue":
/*!******************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _LandYears_vue_vue_type_template_id_49939cce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LandYears.vue?vue&type=template&id=49939cce */ "./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=template&id=49939cce");
/* harmony import */ var _LandYears_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LandYears.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_LandYears_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_LandYears_vue_vue_type_template_id_49939cce__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Tabs/LandYears.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MainInfo_vue_vue_type_template_id_76ceeaee__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MainInfo.vue?vue&type=template&id=76ceeaee */ "./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=template&id=76ceeaee");
/* harmony import */ var _MainInfo_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MainInfo.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_MainInfo_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_MainInfo_vue_vue_type_template_id_76ceeaee__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue":
/*!*********************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _MovementForm_vue_vue_type_template_id_017bd0d6__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MovementForm.vue?vue&type=template&id=017bd0d6 */ "./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=template&id=017bd0d6");
/* harmony import */ var _MovementForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MovementForm.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_MovementForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_MovementForm_vue_vue_type_template_id_017bd0d6__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/Movements.vue":
/*!******************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/Movements.vue ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Movements_vue_vue_type_template_id_1952aa12__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Movements.vue?vue&type=template&id=1952aa12 */ "./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=template&id=1952aa12");
/* harmony import */ var _Movements_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Movements.vue?vue&type=script&lang=js */ "./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=script&lang=js");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_Movements_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Movements_vue_vue_type_template_id_1952aa12__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/modules/HouseholdMembers/Tabs/Movements.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/ui/RangeInput.vue?vue&type=script&setup=true&lang=js":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/ui/RangeInput.vue?vue&type=script&setup=true&lang=js ***!
  \**************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_script_setup_true_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RangeInput.vue?vue&type=script&setup=true&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=script&setup=true&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=script&lang=js":
/*!**************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DocumentGenerationForm.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Main.vue?vue&type=script&lang=js":
/*!********************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Main.vue?vue&type=script&lang=js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Main.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Main.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=script&lang=js":
/*!*********************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=script&lang=js ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersFilterForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersFilterForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MembersFilterForm.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Show.vue?vue&type=script&lang=js":
/*!********************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Show.vue?vue&type=script&lang=js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Show.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=script&lang=js":
/*!*************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=script&lang=js ***!
  \*************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdditionalParams_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdditionalParams_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AdditionalParams.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=script&lang=js":
/*!*********************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=script&lang=js ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYearForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYearForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LandYearForm.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=script&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=script&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYears_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYears_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LandYears.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=script&lang=js":
/*!*****************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=script&lang=js ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MainInfo_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MainInfo_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MainInfo.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=script&lang=js":
/*!*********************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=script&lang=js ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MovementForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MovementForm_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MovementForm.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=script&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=script&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Movements_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Movements_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Movements.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/ui/RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true":
/*!*********************************************************************************************!*\
  !*** ./resources/js/components/ui/RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_template_id_14d7fecd_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_template_id_14d7fecd_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=template&id=14d7fecd&scoped=true");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true":
/*!********************************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true ***!
  \********************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_template_id_48caf8d6_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_template_id_48caf8d6_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=template&id=48caf8d6&scoped=true");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Main.vue?vue&type=template&id=20271158":
/*!**************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Main.vue?vue&type=template&id=20271158 ***!
  \**************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_template_id_20271158__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_template_id_20271158__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Main.vue?vue&type=template&id=20271158 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Main.vue?vue&type=template&id=20271158");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=template&id=66a1c046":
/*!***************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=template&id=66a1c046 ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersFilterForm_vue_vue_type_template_id_66a1c046__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MembersFilterForm_vue_vue_type_template_id_66a1c046__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MembersFilterForm.vue?vue&type=template&id=66a1c046 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/MembersFilterForm.vue?vue&type=template&id=66a1c046");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Show.vue?vue&type=template&id=0c75a49c&scoped=true":
/*!**************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Show.vue?vue&type=template&id=0c75a49c&scoped=true ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_template_id_0c75a49c_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_template_id_0c75a49c_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Show.vue?vue&type=template&id=0c75a49c&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=template&id=0c75a49c&scoped=true");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=template&id=5680580f":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=template&id=5680580f ***!
  \*******************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdditionalParams_vue_vue_type_template_id_5680580f__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_AdditionalParams_vue_vue_type_template_id_5680580f__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./AdditionalParams.vue?vue&type=template&id=5680580f */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/AdditionalParams.vue?vue&type=template&id=5680580f");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=template&id=0c1a8eae":
/*!***************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=template&id=0c1a8eae ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYearForm_vue_vue_type_template_id_0c1a8eae__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYearForm_vue_vue_type_template_id_0c1a8eae__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LandYearForm.vue?vue&type=template&id=0c1a8eae */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYearForm.vue?vue&type=template&id=0c1a8eae");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=template&id=49939cce":
/*!************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=template&id=49939cce ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYears_vue_vue_type_template_id_49939cce__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_LandYears_vue_vue_type_template_id_49939cce__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./LandYears.vue?vue&type=template&id=49939cce */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/LandYears.vue?vue&type=template&id=49939cce");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=template&id=76ceeaee":
/*!***********************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=template&id=76ceeaee ***!
  \***********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MainInfo_vue_vue_type_template_id_76ceeaee__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MainInfo_vue_vue_type_template_id_76ceeaee__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MainInfo.vue?vue&type=template&id=76ceeaee */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MainInfo.vue?vue&type=template&id=76ceeaee");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=template&id=017bd0d6":
/*!***************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=template&id=017bd0d6 ***!
  \***************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MovementForm_vue_vue_type_template_id_017bd0d6__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_MovementForm_vue_vue_type_template_id_017bd0d6__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./MovementForm.vue?vue&type=template&id=017bd0d6 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/MovementForm.vue?vue&type=template&id=017bd0d6");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=template&id=1952aa12":
/*!************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=template&id=1952aa12 ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Movements_vue_vue_type_template_id_1952aa12__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Movements_vue_vue_type_template_id_1952aa12__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Movements.vue?vue&type=template&id=1952aa12 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Tabs/Movements.vue?vue&type=template&id=1952aa12");


/***/ }),

/***/ "./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_RangeInput_vue_vue_type_style_index_0_id_14d7fecd_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/RangeInput.vue?vue&type=style&index=0&id=14d7fecd&lang=scss&scoped=true");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true":
/*!***********************************************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true ***!
  \***********************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DocumentGenerationForm_vue_vue_type_style_index_0_id_48caf8d6_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/DocumentGenerationForm.vue?vue&type=style&index=0&id=48caf8d6&lang=scss&scoped=true");


/***/ }),

/***/ "./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true":
/*!*****************************************************************************************************************!*\
  !*** ./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true ***!
  \*****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Show_vue_vue_type_style_index_0_id_0c75a49c_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/HouseholdMembers/Show.vue?vue&type=style&index=0&id=0c75a49c&lang=scss&scoped=true");


/***/ }),

/***/ "./node_modules/vuex/dist/vuex.cjs.js":
/*!********************************************!*\
  !*** ./node_modules/vuex/dist/vuex.cjs.js ***!
  \********************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/*!
 * vuex v4.0.2
 * (c) 2021 Evan You
 * @license MIT
 */


var vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");
var devtoolsApi = __webpack_require__(/*! @vue/devtools-api */ "./node_modules/@vue/devtools-api/lib/esm/index.js");

var storeKey = 'store';

function useStore (key) {
  if ( key === void 0 ) key = null;

  return vue.inject(key !== null ? key : storeKey)
}

/**
 * Get the first item that pass the test
 * by second argument function
 *
 * @param {Array} list
 * @param {Function} f
 * @return {*}
 */
function find (list, f) {
  return list.filter(f)[0]
}

/**
 * Deep copy the given object considering circular structure.
 * This function caches all nested objects and its copies.
 * If it detects circular structure, use cached copy to avoid infinite loop.
 *
 * @param {*} obj
 * @param {Array<Object>} cache
 * @return {*}
 */
function deepCopy (obj, cache) {
  if ( cache === void 0 ) cache = [];

  // just return if obj is immutable value
  if (obj === null || typeof obj !== 'object') {
    return obj
  }

  // if obj is hit, it is in circular structure
  var hit = find(cache, function (c) { return c.original === obj; });
  if (hit) {
    return hit.copy
  }

  var copy = Array.isArray(obj) ? [] : {};
  // put the copy into cache at first
  // because we want to refer it in recursive deepCopy
  cache.push({
    original: obj,
    copy: copy
  });

  Object.keys(obj).forEach(function (key) {
    copy[key] = deepCopy(obj[key], cache);
  });

  return copy
}

/**
 * forEach for object
 */
function forEachValue (obj, fn) {
  Object.keys(obj).forEach(function (key) { return fn(obj[key], key); });
}

function isObject (obj) {
  return obj !== null && typeof obj === 'object'
}

function isPromise (val) {
  return val && typeof val.then === 'function'
}

function assert (condition, msg) {
  if (!condition) { throw new Error(("[vuex] " + msg)) }
}

function partial (fn, arg) {
  return function () {
    return fn(arg)
  }
}

function genericSubscribe (fn, subs, options) {
  if (subs.indexOf(fn) < 0) {
    options && options.prepend
      ? subs.unshift(fn)
      : subs.push(fn);
  }
  return function () {
    var i = subs.indexOf(fn);
    if (i > -1) {
      subs.splice(i, 1);
    }
  }
}

function resetStore (store, hot) {
  store._actions = Object.create(null);
  store._mutations = Object.create(null);
  store._wrappedGetters = Object.create(null);
  store._modulesNamespaceMap = Object.create(null);
  var state = store.state;
  // init all modules
  installModule(store, state, [], store._modules.root, true);
  // reset state
  resetStoreState(store, state, hot);
}

function resetStoreState (store, state, hot) {
  var oldState = store._state;

  // bind store public getters
  store.getters = {};
  // reset local getters cache
  store._makeLocalGettersCache = Object.create(null);
  var wrappedGetters = store._wrappedGetters;
  var computedObj = {};
  forEachValue(wrappedGetters, function (fn, key) {
    // use computed to leverage its lazy-caching mechanism
    // direct inline function use will lead to closure preserving oldState.
    // using partial to return function with only arguments preserved in closure environment.
    computedObj[key] = partial(fn, store);
    Object.defineProperty(store.getters, key, {
      // TODO: use `computed` when it's possible. at the moment we can't due to
      // https://github.com/vuejs/vuex/pull/1883
      get: function () { return computedObj[key](); },
      enumerable: true // for local getters
    });
  });

  store._state = vue.reactive({
    data: state
  });

  // enable strict mode for new state
  if (store.strict) {
    enableStrictMode(store);
  }

  if (oldState) {
    if (hot) {
      // dispatch changes in all subscribed watchers
      // to force getter re-evaluation for hot reloading.
      store._withCommit(function () {
        oldState.data = null;
      });
    }
  }
}

function installModule (store, rootState, path, module, hot) {
  var isRoot = !path.length;
  var namespace = store._modules.getNamespace(path);

  // register in namespace map
  if (module.namespaced) {
    if (store._modulesNamespaceMap[namespace] && ("development" !== 'production')) {
      console.error(("[vuex] duplicate namespace " + namespace + " for the namespaced module " + (path.join('/'))));
    }
    store._modulesNamespaceMap[namespace] = module;
  }

  // set state
  if (!isRoot && !hot) {
    var parentState = getNestedState(rootState, path.slice(0, -1));
    var moduleName = path[path.length - 1];
    store._withCommit(function () {
      if ((true)) {
        if (moduleName in parentState) {
          console.warn(
            ("[vuex] state field \"" + moduleName + "\" was overridden by a module with the same name at \"" + (path.join('.')) + "\"")
          );
        }
      }
      parentState[moduleName] = module.state;
    });
  }

  var local = module.context = makeLocalContext(store, namespace, path);

  module.forEachMutation(function (mutation, key) {
    var namespacedType = namespace + key;
    registerMutation(store, namespacedType, mutation, local);
  });

  module.forEachAction(function (action, key) {
    var type = action.root ? key : namespace + key;
    var handler = action.handler || action;
    registerAction(store, type, handler, local);
  });

  module.forEachGetter(function (getter, key) {
    var namespacedType = namespace + key;
    registerGetter(store, namespacedType, getter, local);
  });

  module.forEachChild(function (child, key) {
    installModule(store, rootState, path.concat(key), child, hot);
  });
}

/**
 * make localized dispatch, commit, getters and state
 * if there is no namespace, just use root ones
 */
function makeLocalContext (store, namespace, path) {
  var noNamespace = namespace === '';

  var local = {
    dispatch: noNamespace ? store.dispatch : function (_type, _payload, _options) {
      var args = unifyObjectStyle(_type, _payload, _options);
      var payload = args.payload;
      var options = args.options;
      var type = args.type;

      if (!options || !options.root) {
        type = namespace + type;
        if (( true) && !store._actions[type]) {
          console.error(("[vuex] unknown local action type: " + (args.type) + ", global type: " + type));
          return
        }
      }

      return store.dispatch(type, payload)
    },

    commit: noNamespace ? store.commit : function (_type, _payload, _options) {
      var args = unifyObjectStyle(_type, _payload, _options);
      var payload = args.payload;
      var options = args.options;
      var type = args.type;

      if (!options || !options.root) {
        type = namespace + type;
        if (( true) && !store._mutations[type]) {
          console.error(("[vuex] unknown local mutation type: " + (args.type) + ", global type: " + type));
          return
        }
      }

      store.commit(type, payload, options);
    }
  };

  // getters and state object must be gotten lazily
  // because they will be changed by state update
  Object.defineProperties(local, {
    getters: {
      get: noNamespace
        ? function () { return store.getters; }
        : function () { return makeLocalGetters(store, namespace); }
    },
    state: {
      get: function () { return getNestedState(store.state, path); }
    }
  });

  return local
}

function makeLocalGetters (store, namespace) {
  if (!store._makeLocalGettersCache[namespace]) {
    var gettersProxy = {};
    var splitPos = namespace.length;
    Object.keys(store.getters).forEach(function (type) {
      // skip if the target getter is not match this namespace
      if (type.slice(0, splitPos) !== namespace) { return }

      // extract local getter type
      var localType = type.slice(splitPos);

      // Add a port to the getters proxy.
      // Define as getter property because
      // we do not want to evaluate the getters in this time.
      Object.defineProperty(gettersProxy, localType, {
        get: function () { return store.getters[type]; },
        enumerable: true
      });
    });
    store._makeLocalGettersCache[namespace] = gettersProxy;
  }

  return store._makeLocalGettersCache[namespace]
}

function registerMutation (store, type, handler, local) {
  var entry = store._mutations[type] || (store._mutations[type] = []);
  entry.push(function wrappedMutationHandler (payload) {
    handler.call(store, local.state, payload);
  });
}

function registerAction (store, type, handler, local) {
  var entry = store._actions[type] || (store._actions[type] = []);
  entry.push(function wrappedActionHandler (payload) {
    var res = handler.call(store, {
      dispatch: local.dispatch,
      commit: local.commit,
      getters: local.getters,
      state: local.state,
      rootGetters: store.getters,
      rootState: store.state
    }, payload);
    if (!isPromise(res)) {
      res = Promise.resolve(res);
    }
    if (store._devtoolHook) {
      return res.catch(function (err) {
        store._devtoolHook.emit('vuex:error', err);
        throw err
      })
    } else {
      return res
    }
  });
}

function registerGetter (store, type, rawGetter, local) {
  if (store._wrappedGetters[type]) {
    if ((true)) {
      console.error(("[vuex] duplicate getter key: " + type));
    }
    return
  }
  store._wrappedGetters[type] = function wrappedGetter (store) {
    return rawGetter(
      local.state, // local state
      local.getters, // local getters
      store.state, // root state
      store.getters // root getters
    )
  };
}

function enableStrictMode (store) {
  vue.watch(function () { return store._state.data; }, function () {
    if ((true)) {
      assert(store._committing, "do not mutate vuex store state outside mutation handlers.");
    }
  }, { deep: true, flush: 'sync' });
}

function getNestedState (state, path) {
  return path.reduce(function (state, key) { return state[key]; }, state)
}

function unifyObjectStyle (type, payload, options) {
  if (isObject(type) && type.type) {
    options = payload;
    payload = type;
    type = type.type;
  }

  if ((true)) {
    assert(typeof type === 'string', ("expects string as the type, but found " + (typeof type) + "."));
  }

  return { type: type, payload: payload, options: options }
}

var LABEL_VUEX_BINDINGS = 'vuex bindings';
var MUTATIONS_LAYER_ID = 'vuex:mutations';
var ACTIONS_LAYER_ID = 'vuex:actions';
var INSPECTOR_ID = 'vuex';

var actionId = 0;

function addDevtools (app, store) {
  devtoolsApi.setupDevtoolsPlugin(
    {
      id: 'org.vuejs.vuex',
      app: app,
      label: 'Vuex',
      homepage: 'https://next.vuex.vuejs.org/',
      logo: 'https://vuejs.org/images/icons/favicon-96x96.png',
      packageName: 'vuex',
      componentStateTypes: [LABEL_VUEX_BINDINGS]
    },
    function (api) {
      api.addTimelineLayer({
        id: MUTATIONS_LAYER_ID,
        label: 'Vuex Mutations',
        color: COLOR_LIME_500
      });

      api.addTimelineLayer({
        id: ACTIONS_LAYER_ID,
        label: 'Vuex Actions',
        color: COLOR_LIME_500
      });

      api.addInspector({
        id: INSPECTOR_ID,
        label: 'Vuex',
        icon: 'storage',
        treeFilterPlaceholder: 'Filter stores...'
      });

      api.on.getInspectorTree(function (payload) {
        if (payload.app === app && payload.inspectorId === INSPECTOR_ID) {
          if (payload.filter) {
            var nodes = [];
            flattenStoreForInspectorTree(nodes, store._modules.root, payload.filter, '');
            payload.rootNodes = nodes;
          } else {
            payload.rootNodes = [
              formatStoreForInspectorTree(store._modules.root, '')
            ];
          }
        }
      });

      api.on.getInspectorState(function (payload) {
        if (payload.app === app && payload.inspectorId === INSPECTOR_ID) {
          var modulePath = payload.nodeId;
          makeLocalGetters(store, modulePath);
          payload.state = formatStoreForInspectorState(
            getStoreModule(store._modules, modulePath),
            modulePath === 'root' ? store.getters : store._makeLocalGettersCache,
            modulePath
          );
        }
      });

      api.on.editInspectorState(function (payload) {
        if (payload.app === app && payload.inspectorId === INSPECTOR_ID) {
          var modulePath = payload.nodeId;
          var path = payload.path;
          if (modulePath !== 'root') {
            path = modulePath.split('/').filter(Boolean).concat( path);
          }
          store._withCommit(function () {
            payload.set(store._state.data, path, payload.state.value);
          });
        }
      });

      store.subscribe(function (mutation, state) {
        var data = {};

        if (mutation.payload) {
          data.payload = mutation.payload;
        }

        data.state = state;

        api.notifyComponentUpdate();
        api.sendInspectorTree(INSPECTOR_ID);
        api.sendInspectorState(INSPECTOR_ID);

        api.addTimelineEvent({
          layerId: MUTATIONS_LAYER_ID,
          event: {
            time: Date.now(),
            title: mutation.type,
            data: data
          }
        });
      });

      store.subscribeAction({
        before: function (action, state) {
          var data = {};
          if (action.payload) {
            data.payload = action.payload;
          }
          action._id = actionId++;
          action._time = Date.now();
          data.state = state;

          api.addTimelineEvent({
            layerId: ACTIONS_LAYER_ID,
            event: {
              time: action._time,
              title: action.type,
              groupId: action._id,
              subtitle: 'start',
              data: data
            }
          });
        },
        after: function (action, state) {
          var data = {};
          var duration = Date.now() - action._time;
          data.duration = {
            _custom: {
              type: 'duration',
              display: (duration + "ms"),
              tooltip: 'Action duration',
              value: duration
            }
          };
          if (action.payload) {
            data.payload = action.payload;
          }
          data.state = state;

          api.addTimelineEvent({
            layerId: ACTIONS_LAYER_ID,
            event: {
              time: Date.now(),
              title: action.type,
              groupId: action._id,
              subtitle: 'end',
              data: data
            }
          });
        }
      });
    }
  );
}

// extracted from tailwind palette
var COLOR_LIME_500 = 0x84cc16;
var COLOR_DARK = 0x666666;
var COLOR_WHITE = 0xffffff;

var TAG_NAMESPACED = {
  label: 'namespaced',
  textColor: COLOR_WHITE,
  backgroundColor: COLOR_DARK
};

/**
 * @param {string} path
 */
function extractNameFromPath (path) {
  return path && path !== 'root' ? path.split('/').slice(-2, -1)[0] : 'Root'
}

/**
 * @param {*} module
 * @return {import('@vue/devtools-api').CustomInspectorNode}
 */
function formatStoreForInspectorTree (module, path) {
  return {
    id: path || 'root',
    // all modules end with a `/`, we want the last segment only
    // cart/ -> cart
    // nested/cart/ -> cart
    label: extractNameFromPath(path),
    tags: module.namespaced ? [TAG_NAMESPACED] : [],
    children: Object.keys(module._children).map(function (moduleName) { return formatStoreForInspectorTree(
        module._children[moduleName],
        path + moduleName + '/'
      ); }
    )
  }
}

/**
 * @param {import('@vue/devtools-api').CustomInspectorNode[]} result
 * @param {*} module
 * @param {string} filter
 * @param {string} path
 */
function flattenStoreForInspectorTree (result, module, filter, path) {
  if (path.includes(filter)) {
    result.push({
      id: path || 'root',
      label: path.endsWith('/') ? path.slice(0, path.length - 1) : path || 'Root',
      tags: module.namespaced ? [TAG_NAMESPACED] : []
    });
  }
  Object.keys(module._children).forEach(function (moduleName) {
    flattenStoreForInspectorTree(result, module._children[moduleName], filter, path + moduleName + '/');
  });
}

/**
 * @param {*} module
 * @return {import('@vue/devtools-api').CustomInspectorState}
 */
function formatStoreForInspectorState (module, getters, path) {
  getters = path === 'root' ? getters : getters[path];
  var gettersKeys = Object.keys(getters);
  var storeState = {
    state: Object.keys(module.state).map(function (key) { return ({
      key: key,
      editable: true,
      value: module.state[key]
    }); })
  };

  if (gettersKeys.length) {
    var tree = transformPathsToObjectTree(getters);
    storeState.getters = Object.keys(tree).map(function (key) { return ({
      key: key.endsWith('/') ? extractNameFromPath(key) : key,
      editable: false,
      value: canThrow(function () { return tree[key]; })
    }); });
  }

  return storeState
}

function transformPathsToObjectTree (getters) {
  var result = {};
  Object.keys(getters).forEach(function (key) {
    var path = key.split('/');
    if (path.length > 1) {
      var target = result;
      var leafKey = path.pop();
      path.forEach(function (p) {
        if (!target[p]) {
          target[p] = {
            _custom: {
              value: {},
              display: p,
              tooltip: 'Module',
              abstract: true
            }
          };
        }
        target = target[p]._custom.value;
      });
      target[leafKey] = canThrow(function () { return getters[key]; });
    } else {
      result[key] = canThrow(function () { return getters[key]; });
    }
  });
  return result
}

function getStoreModule (moduleMap, path) {
  var names = path.split('/').filter(function (n) { return n; });
  return names.reduce(
    function (module, moduleName, i) {
      var child = module[moduleName];
      if (!child) {
        throw new Error(("Missing module \"" + moduleName + "\" for path \"" + path + "\"."))
      }
      return i === names.length - 1 ? child : child._children
    },
    path === 'root' ? moduleMap : moduleMap.root._children
  )
}

function canThrow (cb) {
  try {
    return cb()
  } catch (e) {
    return e
  }
}

// Base data struct for store's module, package with some attribute and method
var Module = function Module (rawModule, runtime) {
  this.runtime = runtime;
  // Store some children item
  this._children = Object.create(null);
  // Store the origin module object which passed by programmer
  this._rawModule = rawModule;
  var rawState = rawModule.state;

  // Store the origin module's state
  this.state = (typeof rawState === 'function' ? rawState() : rawState) || {};
};

var prototypeAccessors$1 = { namespaced: { configurable: true } };

prototypeAccessors$1.namespaced.get = function () {
  return !!this._rawModule.namespaced
};

Module.prototype.addChild = function addChild (key, module) {
  this._children[key] = module;
};

Module.prototype.removeChild = function removeChild (key) {
  delete this._children[key];
};

Module.prototype.getChild = function getChild (key) {
  return this._children[key]
};

Module.prototype.hasChild = function hasChild (key) {
  return key in this._children
};

Module.prototype.update = function update (rawModule) {
  this._rawModule.namespaced = rawModule.namespaced;
  if (rawModule.actions) {
    this._rawModule.actions = rawModule.actions;
  }
  if (rawModule.mutations) {
    this._rawModule.mutations = rawModule.mutations;
  }
  if (rawModule.getters) {
    this._rawModule.getters = rawModule.getters;
  }
};

Module.prototype.forEachChild = function forEachChild (fn) {
  forEachValue(this._children, fn);
};

Module.prototype.forEachGetter = function forEachGetter (fn) {
  if (this._rawModule.getters) {
    forEachValue(this._rawModule.getters, fn);
  }
};

Module.prototype.forEachAction = function forEachAction (fn) {
  if (this._rawModule.actions) {
    forEachValue(this._rawModule.actions, fn);
  }
};

Module.prototype.forEachMutation = function forEachMutation (fn) {
  if (this._rawModule.mutations) {
    forEachValue(this._rawModule.mutations, fn);
  }
};

Object.defineProperties( Module.prototype, prototypeAccessors$1 );

var ModuleCollection = function ModuleCollection (rawRootModule) {
  // register root module (Vuex.Store options)
  this.register([], rawRootModule, false);
};

ModuleCollection.prototype.get = function get (path) {
  return path.reduce(function (module, key) {
    return module.getChild(key)
  }, this.root)
};

ModuleCollection.prototype.getNamespace = function getNamespace (path) {
  var module = this.root;
  return path.reduce(function (namespace, key) {
    module = module.getChild(key);
    return namespace + (module.namespaced ? key + '/' : '')
  }, '')
};

ModuleCollection.prototype.update = function update$1 (rawRootModule) {
  update([], this.root, rawRootModule);
};

ModuleCollection.prototype.register = function register (path, rawModule, runtime) {
    var this$1$1 = this;
    if ( runtime === void 0 ) runtime = true;

  if ((true)) {
    assertRawModule(path, rawModule);
  }

  var newModule = new Module(rawModule, runtime);
  if (path.length === 0) {
    this.root = newModule;
  } else {
    var parent = this.get(path.slice(0, -1));
    parent.addChild(path[path.length - 1], newModule);
  }

  // register nested modules
  if (rawModule.modules) {
    forEachValue(rawModule.modules, function (rawChildModule, key) {
      this$1$1.register(path.concat(key), rawChildModule, runtime);
    });
  }
};

ModuleCollection.prototype.unregister = function unregister (path) {
  var parent = this.get(path.slice(0, -1));
  var key = path[path.length - 1];
  var child = parent.getChild(key);

  if (!child) {
    if ((true)) {
      console.warn(
        "[vuex] trying to unregister module '" + key + "', which is " +
        "not registered"
      );
    }
    return
  }

  if (!child.runtime) {
    return
  }

  parent.removeChild(key);
};

ModuleCollection.prototype.isRegistered = function isRegistered (path) {
  var parent = this.get(path.slice(0, -1));
  var key = path[path.length - 1];

  if (parent) {
    return parent.hasChild(key)
  }

  return false
};

function update (path, targetModule, newModule) {
  if ((true)) {
    assertRawModule(path, newModule);
  }

  // update target module
  targetModule.update(newModule);

  // update nested modules
  if (newModule.modules) {
    for (var key in newModule.modules) {
      if (!targetModule.getChild(key)) {
        if ((true)) {
          console.warn(
            "[vuex] trying to add a new module '" + key + "' on hot reloading, " +
            'manual reload is needed'
          );
        }
        return
      }
      update(
        path.concat(key),
        targetModule.getChild(key),
        newModule.modules[key]
      );
    }
  }
}

var functionAssert = {
  assert: function (value) { return typeof value === 'function'; },
  expected: 'function'
};

var objectAssert = {
  assert: function (value) { return typeof value === 'function' ||
    (typeof value === 'object' && typeof value.handler === 'function'); },
  expected: 'function or object with "handler" function'
};

var assertTypes = {
  getters: functionAssert,
  mutations: functionAssert,
  actions: objectAssert
};

function assertRawModule (path, rawModule) {
  Object.keys(assertTypes).forEach(function (key) {
    if (!rawModule[key]) { return }

    var assertOptions = assertTypes[key];

    forEachValue(rawModule[key], function (value, type) {
      assert(
        assertOptions.assert(value),
        makeAssertionMessage(path, key, type, value, assertOptions.expected)
      );
    });
  });
}

function makeAssertionMessage (path, key, type, value, expected) {
  var buf = key + " should be " + expected + " but \"" + key + "." + type + "\"";
  if (path.length > 0) {
    buf += " in module \"" + (path.join('.')) + "\"";
  }
  buf += " is " + (JSON.stringify(value)) + ".";
  return buf
}

function createStore (options) {
  return new Store(options)
}

var Store = function Store (options) {
  var this$1$1 = this;
  if ( options === void 0 ) options = {};

  if ((true)) {
    assert(typeof Promise !== 'undefined', "vuex requires a Promise polyfill in this browser.");
    assert(this instanceof Store, "store must be called with the new operator.");
  }

  var plugins = options.plugins; if ( plugins === void 0 ) plugins = [];
  var strict = options.strict; if ( strict === void 0 ) strict = false;
  var devtools = options.devtools;

  // store internal state
  this._committing = false;
  this._actions = Object.create(null);
  this._actionSubscribers = [];
  this._mutations = Object.create(null);
  this._wrappedGetters = Object.create(null);
  this._modules = new ModuleCollection(options);
  this._modulesNamespaceMap = Object.create(null);
  this._subscribers = [];
  this._makeLocalGettersCache = Object.create(null);
  this._devtools = devtools;

  // bind commit and dispatch to self
  var store = this;
  var ref = this;
  var dispatch = ref.dispatch;
  var commit = ref.commit;
  this.dispatch = function boundDispatch (type, payload) {
    return dispatch.call(store, type, payload)
  };
  this.commit = function boundCommit (type, payload, options) {
    return commit.call(store, type, payload, options)
  };

  // strict mode
  this.strict = strict;

  var state = this._modules.root.state;

  // init root module.
  // this also recursively registers all sub-modules
  // and collects all module getters inside this._wrappedGetters
  installModule(this, state, [], this._modules.root);

  // initialize the store state, which is responsible for the reactivity
  // (also registers _wrappedGetters as computed properties)
  resetStoreState(this, state);

  // apply plugins
  plugins.forEach(function (plugin) { return plugin(this$1$1); });
};

var prototypeAccessors = { state: { configurable: true } };

Store.prototype.install = function install (app, injectKey) {
  app.provide(injectKey || storeKey, this);
  app.config.globalProperties.$store = this;

  var useDevtools = this._devtools !== undefined
    ? this._devtools
    : ( true) || 0;

  if (useDevtools) {
    addDevtools(app, this);
  }
};

prototypeAccessors.state.get = function () {
  return this._state.data
};

prototypeAccessors.state.set = function (v) {
  if ((true)) {
    assert(false, "use store.replaceState() to explicit replace store state.");
  }
};

Store.prototype.commit = function commit (_type, _payload, _options) {
    var this$1$1 = this;

  // check object-style commit
  var ref = unifyObjectStyle(_type, _payload, _options);
    var type = ref.type;
    var payload = ref.payload;
    var options = ref.options;

  var mutation = { type: type, payload: payload };
  var entry = this._mutations[type];
  if (!entry) {
    if ((true)) {
      console.error(("[vuex] unknown mutation type: " + type));
    }
    return
  }
  this._withCommit(function () {
    entry.forEach(function commitIterator (handler) {
      handler(payload);
    });
  });

  this._subscribers
    .slice() // shallow copy to prevent iterator invalidation if subscriber synchronously calls unsubscribe
    .forEach(function (sub) { return sub(mutation, this$1$1.state); });

  if (
    ( true) &&
    options && options.silent
  ) {
    console.warn(
      "[vuex] mutation type: " + type + ". Silent option has been removed. " +
      'Use the filter functionality in the vue-devtools'
    );
  }
};

Store.prototype.dispatch = function dispatch (_type, _payload) {
    var this$1$1 = this;

  // check object-style dispatch
  var ref = unifyObjectStyle(_type, _payload);
    var type = ref.type;
    var payload = ref.payload;

  var action = { type: type, payload: payload };
  var entry = this._actions[type];
  if (!entry) {
    if ((true)) {
      console.error(("[vuex] unknown action type: " + type));
    }
    return
  }

  try {
    this._actionSubscribers
      .slice() // shallow copy to prevent iterator invalidation if subscriber synchronously calls unsubscribe
      .filter(function (sub) { return sub.before; })
      .forEach(function (sub) { return sub.before(action, this$1$1.state); });
  } catch (e) {
    if ((true)) {
      console.warn("[vuex] error in before action subscribers: ");
      console.error(e);
    }
  }

  var result = entry.length > 1
    ? Promise.all(entry.map(function (handler) { return handler(payload); }))
    : entry[0](payload);

  return new Promise(function (resolve, reject) {
    result.then(function (res) {
      try {
        this$1$1._actionSubscribers
          .filter(function (sub) { return sub.after; })
          .forEach(function (sub) { return sub.after(action, this$1$1.state); });
      } catch (e) {
        if ((true)) {
          console.warn("[vuex] error in after action subscribers: ");
          console.error(e);
        }
      }
      resolve(res);
    }, function (error) {
      try {
        this$1$1._actionSubscribers
          .filter(function (sub) { return sub.error; })
          .forEach(function (sub) { return sub.error(action, this$1$1.state, error); });
      } catch (e) {
        if ((true)) {
          console.warn("[vuex] error in error action subscribers: ");
          console.error(e);
        }
      }
      reject(error);
    });
  })
};

Store.prototype.subscribe = function subscribe (fn, options) {
  return genericSubscribe(fn, this._subscribers, options)
};

Store.prototype.subscribeAction = function subscribeAction (fn, options) {
  var subs = typeof fn === 'function' ? { before: fn } : fn;
  return genericSubscribe(subs, this._actionSubscribers, options)
};

Store.prototype.watch = function watch$1 (getter, cb, options) {
    var this$1$1 = this;

  if ((true)) {
    assert(typeof getter === 'function', "store.watch only accepts a function.");
  }
  return vue.watch(function () { return getter(this$1$1.state, this$1$1.getters); }, cb, Object.assign({}, options))
};

Store.prototype.replaceState = function replaceState (state) {
    var this$1$1 = this;

  this._withCommit(function () {
    this$1$1._state.data = state;
  });
};

Store.prototype.registerModule = function registerModule (path, rawModule, options) {
    if ( options === void 0 ) options = {};

  if (typeof path === 'string') { path = [path]; }

  if ((true)) {
    assert(Array.isArray(path), "module path must be a string or an Array.");
    assert(path.length > 0, 'cannot register the root module by using registerModule.');
  }

  this._modules.register(path, rawModule);
  installModule(this, this.state, path, this._modules.get(path), options.preserveState);
  // reset store to update getters...
  resetStoreState(this, this.state);
};

Store.prototype.unregisterModule = function unregisterModule (path) {
    var this$1$1 = this;

  if (typeof path === 'string') { path = [path]; }

  if ((true)) {
    assert(Array.isArray(path), "module path must be a string or an Array.");
  }

  this._modules.unregister(path);
  this._withCommit(function () {
    var parentState = getNestedState(this$1$1.state, path.slice(0, -1));
    delete parentState[path[path.length - 1]];
  });
  resetStore(this);
};

Store.prototype.hasModule = function hasModule (path) {
  if (typeof path === 'string') { path = [path]; }

  if ((true)) {
    assert(Array.isArray(path), "module path must be a string or an Array.");
  }

  return this._modules.isRegistered(path)
};

Store.prototype.hotUpdate = function hotUpdate (newOptions) {
  this._modules.update(newOptions);
  resetStore(this, true);
};

Store.prototype._withCommit = function _withCommit (fn) {
  var committing = this._committing;
  this._committing = true;
  fn();
  this._committing = committing;
};

Object.defineProperties( Store.prototype, prototypeAccessors );

/**
 * Reduce the code which written in Vue.js for getting the state.
 * @param {String} [namespace] - Module's namespace
 * @param {Object|Array} states # Object's item can be a function which accept state and getters for param, you can do something for state and getters in it.
 * @param {Object}
 */
var mapState = normalizeNamespace(function (namespace, states) {
  var res = {};
  if (( true) && !isValidMap(states)) {
    console.error('[vuex] mapState: mapper parameter must be either an Array or an Object');
  }
  normalizeMap(states).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedState () {
      var state = this.$store.state;
      var getters = this.$store.getters;
      if (namespace) {
        var module = getModuleByNamespace(this.$store, 'mapState', namespace);
        if (!module) {
          return
        }
        state = module.context.state;
        getters = module.context.getters;
      }
      return typeof val === 'function'
        ? val.call(this, state, getters)
        : state[val]
    };
    // mark vuex getter for devtools
    res[key].vuex = true;
  });
  return res
});

/**
 * Reduce the code which written in Vue.js for committing the mutation
 * @param {String} [namespace] - Module's namespace
 * @param {Object|Array} mutations # Object's item can be a function which accept `commit` function as the first param, it can accept another params. You can commit mutation and do any other things in this function. specially, You need to pass anthor params from the mapped function.
 * @return {Object}
 */
var mapMutations = normalizeNamespace(function (namespace, mutations) {
  var res = {};
  if (( true) && !isValidMap(mutations)) {
    console.error('[vuex] mapMutations: mapper parameter must be either an Array or an Object');
  }
  normalizeMap(mutations).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedMutation () {
      var args = [], len = arguments.length;
      while ( len-- ) args[ len ] = arguments[ len ];

      // Get the commit method from store
      var commit = this.$store.commit;
      if (namespace) {
        var module = getModuleByNamespace(this.$store, 'mapMutations', namespace);
        if (!module) {
          return
        }
        commit = module.context.commit;
      }
      return typeof val === 'function'
        ? val.apply(this, [commit].concat(args))
        : commit.apply(this.$store, [val].concat(args))
    };
  });
  return res
});

/**
 * Reduce the code which written in Vue.js for getting the getters
 * @param {String} [namespace] - Module's namespace
 * @param {Object|Array} getters
 * @return {Object}
 */
var mapGetters = normalizeNamespace(function (namespace, getters) {
  var res = {};
  if (( true) && !isValidMap(getters)) {
    console.error('[vuex] mapGetters: mapper parameter must be either an Array or an Object');
  }
  normalizeMap(getters).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    // The namespace has been mutated by normalizeNamespace
    val = namespace + val;
    res[key] = function mappedGetter () {
      if (namespace && !getModuleByNamespace(this.$store, 'mapGetters', namespace)) {
        return
      }
      if (( true) && !(val in this.$store.getters)) {
        console.error(("[vuex] unknown getter: " + val));
        return
      }
      return this.$store.getters[val]
    };
    // mark vuex getter for devtools
    res[key].vuex = true;
  });
  return res
});

/**
 * Reduce the code which written in Vue.js for dispatch the action
 * @param {String} [namespace] - Module's namespace
 * @param {Object|Array} actions # Object's item can be a function which accept `dispatch` function as the first param, it can accept anthor params. You can dispatch action and do any other things in this function. specially, You need to pass anthor params from the mapped function.
 * @return {Object}
 */
var mapActions = normalizeNamespace(function (namespace, actions) {
  var res = {};
  if (( true) && !isValidMap(actions)) {
    console.error('[vuex] mapActions: mapper parameter must be either an Array or an Object');
  }
  normalizeMap(actions).forEach(function (ref) {
    var key = ref.key;
    var val = ref.val;

    res[key] = function mappedAction () {
      var args = [], len = arguments.length;
      while ( len-- ) args[ len ] = arguments[ len ];

      // get dispatch function from store
      var dispatch = this.$store.dispatch;
      if (namespace) {
        var module = getModuleByNamespace(this.$store, 'mapActions', namespace);
        if (!module) {
          return
        }
        dispatch = module.context.dispatch;
      }
      return typeof val === 'function'
        ? val.apply(this, [dispatch].concat(args))
        : dispatch.apply(this.$store, [val].concat(args))
    };
  });
  return res
});

/**
 * Rebinding namespace param for mapXXX function in special scoped, and return them by simple object
 * @param {String} namespace
 * @return {Object}
 */
var createNamespacedHelpers = function (namespace) { return ({
  mapState: mapState.bind(null, namespace),
  mapGetters: mapGetters.bind(null, namespace),
  mapMutations: mapMutations.bind(null, namespace),
  mapActions: mapActions.bind(null, namespace)
}); };

/**
 * Normalize the map
 * normalizeMap([1, 2, 3]) => [ { key: 1, val: 1 }, { key: 2, val: 2 }, { key: 3, val: 3 } ]
 * normalizeMap({a: 1, b: 2, c: 3}) => [ { key: 'a', val: 1 }, { key: 'b', val: 2 }, { key: 'c', val: 3 } ]
 * @param {Array|Object} map
 * @return {Object}
 */
function normalizeMap (map) {
  if (!isValidMap(map)) {
    return []
  }
  return Array.isArray(map)
    ? map.map(function (key) { return ({ key: key, val: key }); })
    : Object.keys(map).map(function (key) { return ({ key: key, val: map[key] }); })
}

/**
 * Validate whether given map is valid or not
 * @param {*} map
 * @return {Boolean}
 */
function isValidMap (map) {
  return Array.isArray(map) || isObject(map)
}

/**
 * Return a function expect two param contains namespace and map. it will normalize the namespace and then the param's function will handle the new namespace and the map.
 * @param {Function} fn
 * @return {Function}
 */
function normalizeNamespace (fn) {
  return function (namespace, map) {
    if (typeof namespace !== 'string') {
      map = namespace;
      namespace = '';
    } else if (namespace.charAt(namespace.length - 1) !== '/') {
      namespace += '/';
    }
    return fn(namespace, map)
  }
}

/**
 * Search a special module from store by namespace. if module not exist, print error message.
 * @param {Object} store
 * @param {String} helper
 * @param {String} namespace
 * @return {Object}
 */
function getModuleByNamespace (store, helper, namespace) {
  var module = store._modulesNamespaceMap[namespace];
  if (( true) && !module) {
    console.error(("[vuex] module namespace not found in " + helper + "(): " + namespace));
  }
  return module
}

// Credits: borrowed code from fcomb/redux-logger

function createLogger (ref) {
  if ( ref === void 0 ) ref = {};
  var collapsed = ref.collapsed; if ( collapsed === void 0 ) collapsed = true;
  var filter = ref.filter; if ( filter === void 0 ) filter = function (mutation, stateBefore, stateAfter) { return true; };
  var transformer = ref.transformer; if ( transformer === void 0 ) transformer = function (state) { return state; };
  var mutationTransformer = ref.mutationTransformer; if ( mutationTransformer === void 0 ) mutationTransformer = function (mut) { return mut; };
  var actionFilter = ref.actionFilter; if ( actionFilter === void 0 ) actionFilter = function (action, state) { return true; };
  var actionTransformer = ref.actionTransformer; if ( actionTransformer === void 0 ) actionTransformer = function (act) { return act; };
  var logMutations = ref.logMutations; if ( logMutations === void 0 ) logMutations = true;
  var logActions = ref.logActions; if ( logActions === void 0 ) logActions = true;
  var logger = ref.logger; if ( logger === void 0 ) logger = console;

  return function (store) {
    var prevState = deepCopy(store.state);

    if (typeof logger === 'undefined') {
      return
    }

    if (logMutations) {
      store.subscribe(function (mutation, state) {
        var nextState = deepCopy(state);

        if (filter(mutation, prevState, nextState)) {
          var formattedTime = getFormattedTime();
          var formattedMutation = mutationTransformer(mutation);
          var message = "mutation " + (mutation.type) + formattedTime;

          startMessage(logger, message, collapsed);
          logger.log('%c prev state', 'color: #9E9E9E; font-weight: bold', transformer(prevState));
          logger.log('%c mutation', 'color: #03A9F4; font-weight: bold', formattedMutation);
          logger.log('%c next state', 'color: #4CAF50; font-weight: bold', transformer(nextState));
          endMessage(logger);
        }

        prevState = nextState;
      });
    }

    if (logActions) {
      store.subscribeAction(function (action, state) {
        if (actionFilter(action, state)) {
          var formattedTime = getFormattedTime();
          var formattedAction = actionTransformer(action);
          var message = "action " + (action.type) + formattedTime;

          startMessage(logger, message, collapsed);
          logger.log('%c action', 'color: #03A9F4; font-weight: bold', formattedAction);
          endMessage(logger);
        }
      });
    }
  }
}

function startMessage (logger, message, collapsed) {
  var startMessage = collapsed
    ? logger.groupCollapsed
    : logger.group;

  // render
  try {
    startMessage.call(logger, message);
  } catch (e) {
    logger.log(message);
  }
}

function endMessage (logger) {
  try {
    logger.groupEnd();
  } catch (e) {
    logger.log('—— log end ——');
  }
}

function getFormattedTime () {
  var time = new Date();
  return (" @ " + (pad(time.getHours(), 2)) + ":" + (pad(time.getMinutes(), 2)) + ":" + (pad(time.getSeconds(), 2)) + "." + (pad(time.getMilliseconds(), 3)))
}

function repeat (str, times) {
  return (new Array(times + 1)).join(str)
}

function pad (num, maxLength) {
  return repeat('0', maxLength - num.toString().length) + num
}

var index_cjs = {
  version: '4.0.2',
  Store: Store,
  storeKey: storeKey,
  createStore: createStore,
  useStore: useStore,
  mapState: mapState,
  mapMutations: mapMutations,
  mapGetters: mapGetters,
  mapActions: mapActions,
  createNamespacedHelpers: createNamespacedHelpers,
  createLogger: createLogger
};

module.exports = index_cjs;


/***/ })

}]);