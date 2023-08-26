"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["permission-rights"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=script&lang=js":
/*!******************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=script&lang=js ***!
  \******************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'DataTable',
  props: {
    'perPageItems': {
      type: Array,
      required: false,
      "default": function _default() {
        return [10, 20, 50];
      }
    },
    'dataTable': {
      type: Array
    },
    'dataFields': {
      type: Array,
      required: false
    },
    'tableHeaderClass': {
      type: String,
      required: false
    },
    'tableClass': {
      type: String,
      required: false
    },
    'searchable': {
      type: String,
      required: false,
      "default": ''
    },
    'showActionsPanel': {
      type: Boolean,
      required: false,
      "default": function _default() {
        return true;
      }
    },
    'showPaginationPanel': {
      type: Boolean,
      required: false,
      "default": function _default() {
        return true;
      }
    },
    'externalPagination': {
      type: Object,
      required: false
      // default: () => {}
    },

    'searchableFields': {
      type: Array,
      required: false
    },
    'sortByDefaultField': {
      type: String,
      required: false,
      "default": ''
    }
    // 'sortableFields': {
    //     type: Object,
    //     required: false,
    // }
  },
  data: function data() {
    return {
      currentPage: 1,
      perPage: this.perPageItems[0],
      searchData: '',
      sortedBy: {},
      fieldsType: {},
      sortedByLength: 0,
      dataShouldBeSorted: false
    };
  },
  emits: ['pageChanged', 'perPageChanged'],
  methods: {
    changePerPage: function changePerPage(value) {
      var _this$externalPaginat;
      if ((_this$externalPaginat = this.externalPagination) !== null && _this$externalPaginat !== void 0 && _this$externalPaginat.per_page) {
        // let url = `${this.pagination.path}/?per_page=${value}`;
        this.$emit('perPageChanged', value);
      } else {
        // this.perPage = value === "all" ? value :  parseInt(value);
        this.perPage = parseInt(value);
        this.currentPage = 1;
      }
    },
    nextPage: function nextPage() {
      this.currentPage++;
    },
    prevPage: function prevPage() {
      this.currentPage--;
    },
    changePage: function changePage(page) {
      var _this$externalPaginat2;
      if ((_this$externalPaginat2 = this.externalPagination) !== null && _this$externalPaginat2 !== void 0 && _this$externalPaginat2.current_page) {
        this.$emit('pageChanged', page);
      }
      this.currentPage = page;
    },
    sortDataByField: function sortDataByField(e) {
      var field = e.target.dataset.sortField;
      var sort = e.target.dataset.sortOrder;

      // Click on sortable field
      if (!e.ctrlKey) {
        this.sortedBy = {};
        var fields = document.querySelectorAll('[data-sort-order]');
        fields.forEach(function (f) {
          f.removeAttribute('data-sort-order');
          f.removeAttribute('data-sort-position');
          f.classList.remove('ascending', 'descending');
        });
      }
      if (sort == 'descending') {
        e.target.classList.remove('descending');
        e.target.removeAttribute('data-sort-order');
        e.target.removeAttribute('data-sort-position');
        delete this.sortedBy[field];
        var _fields = document.querySelectorAll('[data-sort-position]');
        _fields.forEach(function (f) {
          var position = f.dataset.sortPosition;
          f.dataset.sortPosition = position > 1 ? position - 1 : 1;
        });
      } else {
        if (sort == undefined) {
          sort = 'ascending';
        } else {
          e.target.classList.remove('ascending');
          sort = 'descending';
        }
        e.target.dataset.sortOrder = sort;
        e.target.classList.add(sort);
        this.sortedBy[field] = sort;
      }
      if (Object.keys(this.sortedBy).indexOf(field) >= 0) {
        e.target.dataset.sortPosition = Object.keys(this.sortedBy).indexOf(field) + 1;
      }
    },
    sortDataHandler: function sortDataHandler(sortedBy, sortableFields) {
      return function (a, b) {
        var compareResult = [];
        Object.keys(sortedBy).forEach(function (field) {
          var sortOrder = sortedBy[field];
          var dataType = sortableFields[field];
          if (sortOrder.toLowerCase() == 'ascending') {
            if (dataType == 'string') {
              compareResult.push(a[field].localeCompare(b[field]));
            } else if (dataType == 'number') {
              compareResult.push(a[field] - b[field]);
            }
          } else if (sortOrder.toLowerCase() == 'descending') {
            if (dataType == 'string') {
              compareResult.push(b[field].localeCompare(a[field]));
            } else if (dataType == 'number') {
              compareResult.push(b[field] - a[field]);
            }
          } else {
            return;
          }
        });
        return compareResult.reduce(function (res, next) {
          return res || next;
        });
      };
    } // sortOrderNumber(field) {
    //     let index = Object.keys(this.sortedBy).indexOf(field);
    //     return index < 0 ? '' : index+1;
    // }
  },
  computed: {
    pagesCount: function pagesCount() {
      var _this$externalPaginat3;
      if ((_this$externalPaginat3 = this.externalPagination) !== null && _this$externalPaginat3 !== void 0 && _this$externalPaginat3.last_page) {
        return this.externalPagination.last_page;
      } else {
        return this.searchData == '' ? Math.ceil(this.dataTable.length / this.perPage) : Math.ceil(this.paginatedData.length / this.perPage);
      }
    },
    paginatedData: function paginatedData() {
      var _this$externalPaginat4,
        _this = this;
      var dataSet;
      if ((_this$externalPaginat4 = this.externalPagination) !== null && _this$externalPaginat4 !== void 0 && _this$externalPaginat4.total) {
        if (this.searchData !== '') {
          dataSet = this.dataTable.filter(function (r) {
            return _this.$parent.searchData(r, _this.searchData);
          });
        } else {
          dataSet = this.dataTable;
        }
      } else {
        var start = (this.currentPage - 1) * this.perPage,
          end = start + this.perPage;
        if (this.searchData !== '') {
          dataSet = this.dataTable.filter(function (r) {
            return _this.$parent.searchData(r, _this.searchData);
          }).slice(start, end);
        } else {
          dataSet = this.dataTable.slice(start, end);
        }
      }
      if (this.sortedByLength > 0) {
        dataSet.sort(this.sortDataHandler(this.sortedBy, this.fieldsType));
      } else {
        if (this.sortByDefaultField !== '' && this.dataShouldBeSorted == true) {
          // console.log(`Sort dataset by fallbackSortField`);
          dataSet.sort(function (a, b) {
            return a[_this.sortByDefaultField] - b[_this.sortByDefaultField];
          });
          this.dataShouldBeSorted = false;
        }
      }
      return dataSet;
    },
    shownFrom: function shownFrom() {
      var _this$externalPaginat5;
      if ((_this$externalPaginat5 = this.externalPagination) !== null && _this$externalPaginat5 !== void 0 && _this$externalPaginat5.from) {
        return this.externalPagination.from;
      } else {
        return (this.currentPage - 1) * this.perPage + 1;
      }
    },
    shownTo: function shownTo() {
      var _this$externalPaginat6;
      if ((_this$externalPaginat6 = this.externalPagination) !== null && _this$externalPaginat6 !== void 0 && _this$externalPaginat6.to) {
        return this.externalPagination.to;
      } else {
        var show = this.shownFrom + this.perPage;
        return show < this.dataTable.length ? show : this.dataTable.length;
      }
    },
    shownTotal: function shownTotal() {
      var _this$externalPaginat7;
      if ((_this$externalPaginat7 = this.externalPagination) !== null && _this$externalPaginat7 !== void 0 && _this$externalPaginat7.total) {
        return this.externalPagination.total;
      } else {
        return this.dataTable.length;
      }
    },
    isLastPage: function isLastPage() {
      return this.currentPage == this.pagesCount;
    },
    isFirstPage: function isFirstPage() {
      return this.currentPage == 1;
    }
  },
  mounted: function mounted() {
    var _this2 = this;
    // if (this.dataFields.length > 0) {
    var fields = document.querySelectorAll('[data-sort-field]');
    if (fields) {
      fields.forEach(function (field) {
        field.addEventListener('click', _this2.sortDataByField);
        if (field.dataset.fieldType) {
          _this2.fieldsType[field.dataset.sortField] = field.dataset.fieldType;
        } else {
          _this2.fieldsType[field.dataset.sortField] = 'string';
        }
      });
    }
    // }
  },

  watch: {
    sortedBy: {
      handler: function handler(newVal, oldVal) {
        this.sortedByLength = Object.keys(this.sortedBy).length;
      },
      deep: true,
      immidiate: true
    },
    sortedByLength: function sortedByLength(newVal, oldVal) {
      // console.log(`newVal: ${newVal}, oldVal: ${oldVal}`);
      if (oldVal == 1 && newVal == 0) {
        this.dataShouldBeSorted = true;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=script&lang=js":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=script&lang=js ***!
  \************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_ui_DataTable_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/ui/DataTable.vue */ "./resources/js/components/ui/DataTable.vue");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: 'PermissionRightsMain',
  components: {
    DataTable: _components_ui_DataTable_vue__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      ownerId: 0,
      rightsFor: 'role',
      owners: [],
      permissions: [],
      _permissions: [],
      inEditMode: false
    };
  },
  methods: {
    fetchRoles: function fetchRoles() {
      var _this = this;
      axios.get("/api/v1/roles").then(function (res) {
        _this.owners = res.data.data;
      });
    },
    fetchUsers: function fetchUsers() {
      var _this2 = this;
      axios.get("/api/v1/users").then(function (res) {
        _this2.owners = res.data.data;
      });
    },
    fetchOwnerPermissions: function fetchOwnerPermissions() {
      var _this3 = this;
      axios.get("/api/v1/granted-permissions?type=".concat(this.rightsFor, "&owner=").concat(this.ownerId)).then(function (res) {
        _this3.permissions = res.data.data;
      });
    },
    toggleAction: function toggleAction(action) {
      var _action = action.charAt(0).toUpperCase() + action.slice(1);
      this["all".concat(_action, "Granted")] ? this.permissions.forEach(function (p) {
        return p[action] = false;
      }) : this.permissions.forEach(function (p) {
        return p[action] = true;
      });
    },
    toggleRight: function toggleRight(right) {
      var permission = this.permissions.find(function (p) {
        return p.id == right.id;
      });
      if (right.create && right.read && right.update && right["delete"]) {
        permission.create = false;
        permission.read = false;
        permission.update = false;
        permission["delete"] = false;
      } else {
        permission.create = true;
        permission.read = true;
        permission.update = true;
        permission["delete"] = true;
      }
    },
    editPermissionRights: function editPermissionRights() {
      this.inEditMode = true;
      this._permissions = JSON.parse(JSON.stringify(this.permissions));
    },
    cancelEditingPermissionRights: function cancelEditingPermissionRights() {
      this.inEditMode = false;
      this.permissions = JSON.parse(JSON.stringify(this._permissions));
    },
    grantPermission: function grantPermission() {
      var _this4 = this;
      var data = {};

      // if (this.rightsFor == 'role') {
      //     data.owner_type = 'App\\Models\\Role';
      // } else if (this.rightsFor == 'user') {
      //     data.owner_type = 'App\\Models\\User';
      // } else {
      //     return;
      // }
      data.owner_type = this.rightsFor;
      if (this.ownerId != 0) {
        data.owner = this.ownerId;
      } else {
        return;
      }
      data.rights = this.permissions.map(function (p) {
        var right = 0;
        if (p.create) right += 8;
        if (p.read) right += 4;
        if (p.update) right += 2;
        if (p["delete"]) right += 1;
        return "".concat(p.id, ":").concat(right);
      }).join(',');
      // console.log(data);
      axios.post("/api/v1/grant-permissions", data).then(function (res) {
        if (res.status == 200) {
          _this4.$toast(res.data.message);
          _this4.fetchOwnerPermissions();
          _this4.inEditMode = false;
        }
      });
    }
  },
  computed: {
    chooseOwner: function chooseOwner() {
      if (this.rightsFor == 'role') {
        return 'оберіть роль';
      }
      if (this.rightsFor == 'user') {
        return 'оберіть користувача';
      }
    },
    allReadGranted: function allReadGranted() {
      return !this.permissions.some(function (p) {
        return !p.read;
      });
    },
    allCreateGranted: function allCreateGranted() {
      return !this.permissions.some(function (p) {
        return !p.create;
      });
    },
    allUpdateGranted: function allUpdateGranted() {
      return !this.permissions.some(function (p) {
        return !p.update;
      });
    },
    allDeleteGranted: function allDeleteGranted() {
      return !this.permissions.some(function (p) {
        return !p["delete"];
      });
    },
    readyForGrantPermission: function readyForGrantPermission() {
      return JSON.stringify(this.permissions) != JSON.stringify(this._permissions);
    }
  },
  watch: {
    rightsFor: function rightsFor(newVal) {
      if (newVal == 'role') {
        this.ownerId = 0;
        this.fetchRoles();
      } else if (newVal == 'user') {
        this.ownerId = 0;
        this.fetchUsers();
      }
    },
    ownerId: function ownerId(newVal) {
      if (newVal !== 0) {
        this.fetchOwnerPermissions();
      }
    }
  },
  created: function created() {
    this.fetchRoles();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=template&id=54e633b4&scoped=true":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=template&id=54e633b4&scoped=true ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-54e633b4"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  "class": "data-table--wrapper"
};
var _hoisted_2 = {
  key: 0,
  "class": "data-table_ d-flex justify-content-between pb-2"
};
var _hoisted_3 = {
  "class": "per-page__wrapper"
};
var _hoisted_4 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, "Відображати", -1 /* HOISTED */);
});
var _hoisted_5 = ["disabled"];
var _hoisted_6 = ["value"];
var _hoisted_7 = {
  "class": "search__wrapper"
};
var _hoisted_8 = {
  autocomplete: "off"
};
var _hoisted_9 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
    "for": "search"
  }, "Поіск", -1 /* HOISTED */);
});
var _hoisted_10 = {
  "class": "table__wrapper"
};
var _hoisted_11 = {
  "class": "table-responsive"
};
var _hoisted_12 = {
  key: 0
};
var _hoisted_13 = ["data-sort-field", "data-field-type"];
var _hoisted_14 = {
  key: 1,
  "class": "data-table__pagination--wrapper d-flex justify-content-between align-items-center py-2"
};
var _hoisted_15 = {
  "class": "pagination mb-0"
};
var _hoisted_16 = ["innerHTML", "onClick"];
var _hoisted_17 = ["onClick"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _$props$externalPagin;
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [$props.showActionsPanel ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [_hoisted_4, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    name: "per_Page",
    id: "per_page",
    "class": "per-page",
    disabled: $options.paginatedData.length == 0,
    onChange: _cache[0] || (_cache[0] = function ($event) {
      return $options.changePerPage($event.target.value);
    })
  }, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.perPageItems, function (value, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      key: index,
      value: value
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(value), 9 /* TEXT, PROPS */, _hoisted_6);
  }), 128 /* KEYED_FRAGMENT */))], 40 /* PROPS, HYDRATE_EVENTS */, _hoisted_5)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", _hoisted_8, [_hoisted_9, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <input  type=\"search\"\n                            id=\"search\"\n                            class=\"search\"\n                            readonly\n                            autocomplete=\"off\"\n                            @input=\"$emit('searchInput', $event.target.value)\"> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "search",
    id: "search",
    "class": "search",
    autocomplete: "off",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.searchData = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.searchData]])])])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("table", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["table table-striped", $props.tableClass])
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("thead", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)($props.tableHeaderClass)
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot)(_ctx.$slots, "header", {}, function () {
    return [$props.dataFields.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", _hoisted_12, [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.dataFields, function (field) {
      return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("th", {
        key: field.name,
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(field["class"]),
        "data-sort-field": field.sortable ? field.name : '',
        "data-field-type": field.dataType
      }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(field.caption), 11 /* TEXT, CLASS, PROPS */, _hoisted_13);
    }), 128 /* KEYED_FRAGMENT */))])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)];
  }, true)], 2 /* CLASS */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tbody", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot)(_ctx.$slots, "default", {
    paginatedData: $options.paginatedData
  }, undefined, true)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tfoot", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.renderSlot)(_ctx.$slots, "footer", {}, undefined, true)])], 2 /* CLASS */)])]), $options.paginatedData.length > 0 && $props.showPaginationPanel ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_14, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, "Відображено з " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.shownFrom) + " по " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.shownTo) + " із " + (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.shownTotal), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("ul", _hoisted_15, [(_$props$externalPagin = $props.externalPagination) !== null && _$props$externalPagin !== void 0 && _$props$externalPagin.links ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    key: 0
  }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($props.externalPagination.links, function (link, index) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", {
      "class": "page-item",
      key: index
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["page-link", [link.active ? 'active' : '', link.url ? '' : 'disabled']]),
      innerHTML: link.label,
      onClick: function onClick($event) {
        return $options.changePage(link.url);
      }
    }, null, 10 /* CLASS, PROPS */, _hoisted_16)]);
  }), 128 /* KEYED_FRAGMENT */)) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, {
    key: 1
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["page-item", {
      'disabled': $options.isFirstPage
    }])
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    "class": "page-link",
    onClick: _cache[2] || (_cache[2] = function () {
      return $options.prevPage && $options.prevPage.apply($options, arguments);
    })
  }, " Previous ")], 2 /* CLASS */), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($options.pagesCount, function (page) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("li", {
      "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["page-item", [$data.currentPage == page ? 'active' : '']]),
      key: page
    }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
      "class": "page-link",
      onClick: function onClick($event) {
        return $options.changePage(page);
      }
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(page), 9 /* TEXT, PROPS */, _hoisted_17)], 2 /* CLASS */);
  }), 128 /* KEYED_FRAGMENT */)), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("li", {
    "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)(["page-item", {
      'disabled': $options.isLastPage
    }])
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    "class": "page-link",
    onClick: _cache[3] || (_cache[3] = function () {
      return $options.nextPage && $options.nextPage.apply($options, arguments);
    })
  }, " Next ")], 2 /* CLASS */)], 64 /* STABLE_FRAGMENT */))])])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)]);
}

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=template&id=961392e8&scoped=true":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=template&id=961392e8&scoped=true ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _withScopeId = function _withScopeId(n) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.pushScopeId)("data-v-961392e8"), n = n(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.popScopeId)(), n;
};
var _hoisted_1 = {
  "class": "row"
};
var _hoisted_2 = {
  "class": "col-md-12"
};
var _hoisted_3 = {
  "class": "card"
};
var _hoisted_4 = {
  "class": "card-body"
};
var _hoisted_5 = {
  "class": "row mb-3"
};
var _hoisted_6 = {
  "class": "d-flex justify-content-between"
};
var _hoisted_7 = {
  "class": "d-flex align-items-center"
};
var _hoisted_8 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "me-2"
  }, "Керування правами дозволу для", -1 /* HOISTED */);
});
var _hoisted_9 = {
  "class": "ms-3"
};
var _hoisted_10 = {
  value: "0",
  disabled: ""
};
var _hoisted_11 = ["value"];
var _hoisted_12 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-pencil-off-outline me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_13 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-pencil-outline me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_14 = ["disabled"];
var _hoisted_15 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-content-save-outline me-1"
  }, null, -1 /* HOISTED */);
});
var _hoisted_16 = {
  "class": "border-top pt-3"
};
var _hoisted_17 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [/*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    rowspan: "2",
    "class": "align-middle"
  }, "Назва"), /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", {
    colspan: "4",
    "class": "text-center"
  }, "Дозвіл")], -1 /* HOISTED */);
});
var _hoisted_18 = {
  "class": "crud-title"
};
var _hoisted_19 = ["title"];
var _hoisted_20 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-check-all"
  }, null, -1 /* HOISTED */);
});
var _hoisted_21 = [_hoisted_20];
var _hoisted_22 = {
  "class": "crud-title"
};
var _hoisted_23 = ["title"];
var _hoisted_24 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-check-all"
  }, null, -1 /* HOISTED */);
});
var _hoisted_25 = [_hoisted_24];
var _hoisted_26 = {
  "class": "crud-title"
};
var _hoisted_27 = ["title"];
var _hoisted_28 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-check-all"
  }, null, -1 /* HOISTED */);
});
var _hoisted_29 = [_hoisted_28];
var _hoisted_30 = {
  "class": "crud-title"
};
var _hoisted_31 = ["title"];
var _hoisted_32 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-check-all"
  }, null, -1 /* HOISTED */);
});
var _hoisted_33 = [_hoisted_32];
var _hoisted_34 = ["onClick", "title"];
var _hoisted_35 = /*#__PURE__*/_withScopeId(function () {
  return /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
    "class": "mdi mdi-check-all"
  }, null, -1 /* HOISTED */);
});
var _hoisted_36 = [_hoisted_35];
var _hoisted_37 = {
  "class": "text-center"
};
var _hoisted_38 = ["onUpdate:modelValue", "disabled"];
var _hoisted_39 = {
  "class": "text-center"
};
var _hoisted_40 = ["onUpdate:modelValue", "disabled"];
var _hoisted_41 = {
  "class": "text-center"
};
var _hoisted_42 = ["onUpdate:modelValue", "disabled"];
var _hoisted_43 = {
  "class": "text-center"
};
var _hoisted_44 = ["onUpdate:modelValue", "disabled"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_breadcrumbs = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("breadcrumbs");
  var _component_DataTable = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("DataTable");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_breadcrumbs), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div class=\"card\">\n        <div class=\"card-body\"> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <div class=\"col-md-3\">\n                    <div class=\"card\">\n                        <div class=\"card-body\">\n                            <div class=\"row mb-2\">\n                                <div class=\"d-flex justify-content-between\">\n                                    <button class=\"btn btn-sm btn-outline-secondary btn-transparent\"\n                                            :class=\"{'active': rightsFor == 'role'}\"\n                                            @click=\"rightsFor = 'role'\">\n                                        <span class=\"mdi mdi-shield-account-variant-outline me-1\"></span>\n                                        Ролі\n                                    </button>\n                                    <button class=\"btn btn-sm btn-outline-secondary  btn-transparent\"\n                                            :class=\"{'active': rightsFor == 'user'}\"\n                                            @click=\"rightsFor = 'user'\">\n                                        <span class=\"mdi mdi-account-supervisor-outline me-1\"></span>\n                                        Користувачі\n                                    </button>\n                                </div>\n                            </div>\n                            <div class=\"row mb-3\">\n                                <div>\n                                    <select class='form-control'\n                                            id=\"role\"\n                                            v-model=\"ownerId\">\n                                        <option value=\"0\" disabled>{{chooseOwner}}</option>\n                                        <option :value=\"owner.id\" v-for=\"owner in owners\" :key=\"owner.id\">\n                                            {{owner.name}}\n                                        </option>\n                                    </select>\n                                </div>\n                            </div>\n                            <div class=\"row\">\n                                <div class=\"d-flex justify-content-end\">\n                                    <button class=\"btn btn-sm btn-outline-secondary\"\n                                            :disabled=\"ownerId == 0\" title=\"Отримати перелік дозволів\"\n                                            @click=\"fetchOwnerPermissions\">\n                                        <span class=\"mdi mdi-account-key-outline\"></span>\n                                        Дозволи\n                                    </button>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n                </div> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_5, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_7, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-primary btn-transparent1\"\n                                                :class=\"{'active': rightsFor == 'role'}\"\n                                                @click=\"rightsFor = 'role'\">\n                                            <span class=\"mdi mdi-shield-account-variant-outline me-1\"></span>\n                                            ролей\n                                        </button>\n                                        <span class=\"mx-2\">\n                                            /\n                                        </span>\n                                        <button class=\"btn btn-sm btn-outline-primary btn-transparent1\"\n                                                :class=\"{'active': rightsFor == 'user'}\"\n                                                @click=\"rightsFor = 'user'\">\n                                            <span class=\"mdi mdi-account-supervisor-outline me-1\"></span>\n                                            користувачів\n                                        </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-select",
    style: {
      "padding": "0.175rem 2.5rem 0.175rem 1rem",
      "width": "250px"
    },
    id: "role",
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.ownerId = $event;
    })
  }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", _hoisted_10, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($options.chooseOwner), 1 /* TEXT */), ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.owners, function (owner) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: owner.id,
      key: owner.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(owner.name), 9 /* TEXT, PROPS */, _hoisted_11);
  }), 128 /* KEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.ownerId]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-primary ms-2\"\n                                                :disabled=\"ownerId == 0\" title=\"Отримати перелік дозволів\"\n                                                @click=\"fetchOwnerPermissions\">\n                                            <span class=\"mdi mdi-account-key-outline me-1\"></span>\n                                            Дозволи\n                                        </button> ")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", null, [$data.inEditMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 0,
    "class": "btn btn-sm btn-outline-danger",
    title: "Відмінити редагування прав",
    onClick: _cache[1] || (_cache[1] = function () {
      return $options.cancelEditingPermissionRights && $options.cancelEditingPermissionRights.apply($options, arguments);
    })
  }, [_hoisted_12, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Відмінити ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), !$data.inEditMode && $data.permissions.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 1,
    "class": "btn btn-sm btn-outline-primary btn-transparent",
    title: "Редагування прав дозволу",
    onClick: _cache[2] || (_cache[2] = function () {
      return $options.editPermissionRights && $options.editPermissionRights.apply($options, arguments);
    })
  }, [_hoisted_13, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Редагувати ")])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true), $data.inEditMode ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("button", {
    key: 2,
    "class": "btn btn-sm btn-outline-success ms-2",
    title: "Встановити права дозволи",
    disabled: !$options.readyForGrantPermission,
    onClick: _cache[3] || (_cache[3] = function () {
      return $options.grantPermission && $options.grantPermission.apply($options, arguments);
    })
  }, [_hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" Встановити ")], 8 /* PROPS */, _hoisted_14)) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_16, [$data.permissions.length > 0 ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createBlock)(_component_DataTable, {
    key: 0,
    dataTable: $data.permissions,
    tableClass: "table-sm table-bordered"
  }, {
    header: (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function () {
      return [_hoisted_17, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("tr", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", _hoisted_18, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" читання "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-secondary btn-transparent\"\n                                                        :class=\"{'active' : allReadGranted}\"\n                                                        :disabled=\"!inEditMode\"\n                                                        :title=\"allReadGranted ? 'Відмінити всі' : 'Обрати всі'\"\n                                                        @click=\"toggleAction('read')\">\n                                                    <span class=\"mdi mdi-check-all\"></span>\n                                                </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        onClick: _cache[4] || (_cache[4] = function ($event) {
          return $options.toggleAction('read');
        }),
        title: $options.allReadGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл',
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
          'toggle-rights__disabled': !$data.inEditMode,
          'toggle-rights__all': $options.allReadGranted
        })
      }, _hoisted_21, 10 /* CLASS, PROPS */, _hoisted_19)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", _hoisted_22, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" створення "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-secondary btn-transparent\"\n                                                        :class=\"{'active' : allCreateGranted}\"\n                                                        :disabled=\"!inEditMode\"\n                                                        :title=\"allCreateGranted ? 'Відмінити всі' : 'Обрати всі'\"\n                                                        @click=\"toggleAction('create')\">\n                                                    <span class=\"mdi mdi-check-all\"></span>\n                                                </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        onClick: _cache[5] || (_cache[5] = function ($event) {
          return $options.toggleAction('create');
        }),
        title: $options.allCreateGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл',
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
          'toggle-rights__disabled': !$data.inEditMode,
          'toggle-rights__all': $options.allCreateGranted
        })
      }, _hoisted_25, 10 /* CLASS, PROPS */, _hoisted_23)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", _hoisted_26, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" редагування "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-secondary btn-transparent\"\n                                                        :class=\"{'active' : allUpdateGranted}\"\n                                                        :disabled=\"!inEditMode\"\n                                                        :title=\"allUpdateGranted ? 'Відмінити всі' : 'Обрати всі'\"\n                                                        @click=\"toggleAction('update')\">\n                                                    <span class=\"mdi mdi-check-all\"></span>\n                                                </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        onClick: _cache[6] || (_cache[6] = function ($event) {
          return $options.toggleAction('update');
        }),
        title: $options.allUpdateGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл',
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
          'toggle-rights__disabled': !$data.inEditMode,
          'toggle-rights__all': $options.allUpdateGranted
        })
      }, _hoisted_29, 10 /* CLASS, PROPS */, _hoisted_27)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("th", _hoisted_30, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createTextVNode)(" видалення "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-secondary btn-transparent\"\n                                                        :class=\"{'active' : allDeleteGranted}\"\n                                                        :disabled=\"!inEditMode\"\n                                                        :title=\"allDeleteGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл'\"\n                                                    >\n                                                    <span class=\"mdi mdi-check-all\"></span>\n                                                </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
        onClick: _cache[7] || (_cache[7] = function ($event) {
          return $options.toggleAction('delete');
        }),
        title: $options.allDeleteGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл',
        "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
          'toggle-rights__disabled': !$data.inEditMode,
          'toggle-rights__all': $options.allDeleteGranted
        })
      }, _hoisted_33, 10 /* CLASS, PROPS */, _hoisted_31)])])];
    }),
    "default": (0,vue__WEBPACK_IMPORTED_MODULE_0__.withCtx)(function (slotProps) {
      return [((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)(slotProps.paginatedData, function (record) {
        return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("tr", {
          key: record.id
        }, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", null, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(record.name), 1 /* TEXT */), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" <button class=\"btn btn-sm btn-outline-secondary btn-transparent\"\n                                                        :class=\"{'active': (record.create && record.read && record.update && record.delete)}\"\n                                                        :disabled=\"!inEditMode\"\n                                                        :title=\"(record.create && record.read && record.update && record.delete) ? 'Скасувати всі дозволи' : 'Надати всі дозволи'\"\n                                                        @click=\"toggleRight(record)\">\n                                                    <span class=\"mdi mdi-check-all\"></span>\n                                                </button> "), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
          onClick: function onClick($event) {
            return $options.toggleRight(record);
          },
          title: record.create && record.read && record.update && record["delete"] ? 'Скасувати всі дозволи' : 'Надати всі дозволи',
          "class": (0,vue__WEBPACK_IMPORTED_MODULE_0__.normalizeClass)({
            'toggle-rights__disabled': !$data.inEditMode,
            'toggle-rights__all': record.create && record.read && record.update && record["delete"]
          })
        }, _hoisted_36, 10 /* CLASS, PROPS */, _hoisted_34)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_37, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          type: "checkbox",
          name: "",
          id: "",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return record.read = $event;
          },
          value: "4",
          disabled: !$data.inEditMode
        }, null, 8 /* PROPS */, _hoisted_38), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, record.read]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          type: "checkbox",
          name: "",
          id: "",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return record.create = $event;
          },
          value: "8",
          disabled: !$data.inEditMode
        }, null, 8 /* PROPS */, _hoisted_40), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, record.create]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          type: "checkbox",
          name: "",
          id: "",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return record.update = $event;
          },
          value: "2",
          disabled: !$data.inEditMode
        }, null, 8 /* PROPS */, _hoisted_42), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, record.update]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("td", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
          type: "checkbox",
          name: "",
          id: "",
          "onUpdate:modelValue": function onUpdateModelValue($event) {
            return record["delete"] = $event;
          },
          value: "1",
          disabled: !$data.inEditMode
        }, null, 8 /* PROPS */, _hoisted_44), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, record["delete"]]])])]);
      }), 128 /* KEYED_FRAGMENT */))];
    }),

    _: 1 /* STABLE */
  }, 8 /* PROPS */, ["dataTable"])) : (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("v-if", true)])])])])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)(" </div>\n    </div> ")], 64 /* STABLE_FRAGMENT */);
}

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
___CSS_LOADER_EXPORT___.push([module.id, ".per-page[data-v-54e633b4], .search[data-v-54e633b4] {\n  font-size: 0.9rem;\n  font-weight: 400;\n  line-height: 1.6;\n  color: #495057;\n  border-radius: 0.25rem;\n  border: 1px solid #ced4da;\n}\n.per-page[data-v-54e633b4] {\n  padding: 0.3rem 1.5rem 0.3rem 0.5rem;\n  vertical-align: middle;\n  background: #fff url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e\") right 0.75rem center/8px 10px no-repeat;\n  -webkit-appearance: none;\n  -moz-appearance: none;\n  appearance: none;\n}\n.search__wrapper label[data-v-54e633b4] {\n  margin-right: 0.5rem;\n}\n.search__wrapper .search[data-v-54e633b4] {\n  display: inline-block;\n  width: 200px;\n  height: calc(1.6em + 0.75rem + 0px);\n  padding: 0.375rem 0.75rem;\n  background-color: #fff;\n  background-clip: padding-box;\n  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;\n}\n.per-page[data-v-54e633b4]:focus, .search[data-v-54e633b4]:focus {\n  border-color: #7db8fb;\n  outline: 0;\n  box-shadow: 0 0 0 0.2rem rgba(7, 117, 242, 0.25);\n}\n.per-page__wrapper span[data-v-54e633b4] {\n  margin-right: 0.5rem;\n}\ntbody tr[data-v-54e633b4]:last-of-type {\n  border-bottom: 2px solid #343a40;\n}\n.sort-field-number[data-v-54e633b4] {\n  font-size: 0.6rem;\n  display: inline-block;\n  position: absolute;\n  right: 1.5rem;\n  top: calc(50% - 0.5rem);\n  line-height: 1rem;\n  background: #f8f9fa;\n  color: black;\n  width: 1rem;\n  text-align: center;\n  border-radius: 999px;\n  border-color: black;\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true ***!
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
___CSS_LOADER_EXPORT___.push([module.id, ".crud-title[data-v-961392e8] {\n  position: relative;\n  width: 175px;\n  text-align: center;\n  vertical-align: middle;\n  height: 40px;\n}\n.crud-title a[data-v-961392e8] {\n  position: absolute;\n  right: 8px;\n  top: 6px;\n}\ntable tbody tr[data-v-961392e8] {\n  vertical-align: middle;\n}\ntable tbody tr td[data-v-961392e8]:first-of-type {\n  padding-left: 0.5rem;\n  padding-right: 0.5rem;\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n}\na[data-v-961392e8]:not([href]):not(.toggle-rights__disabled, .toggle-rights__all) {\n  color: grey;\n}\na[data-v-961392e8]:not([href]):not(.toggle-rights__disabled, .toggle-rights__all):hover {\n  color: #0076f9;\n  font-weight: bold;\n  transform: scale(1.1);\n}\n.toggle-rights__disabled[data-v-961392e8] {\n  color: grey;\n  cursor: not-allowed;\n  opacity: 0.5;\n  text-decoration: none;\n  pointer-events: none;\n}\n.toggle-rights__disabled.toggle-rights__all[data-v-961392e8] {\n  color: grey;\n}\n.toggle-rights__all[data-v-961392e8] {\n  font-weight: bold;\n  color: #0076f9;\n  transform: scale(1.5);\n}", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_style_index_0_id_54e633b4_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_style_index_0_id_54e633b4_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_style_index_0_id_54e633b4_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true":
/*!************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true ***!
  \************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_style_index_0_id_961392e8_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_style_index_0_id_961392e8_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_style_index_0_id_961392e8_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/components/ui/DataTable.vue":
/*!**************************************************!*\
  !*** ./resources/js/components/ui/DataTable.vue ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _DataTable_vue_vue_type_template_id_54e633b4_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./DataTable.vue?vue&type=template&id=54e633b4&scoped=true */ "./resources/js/components/ui/DataTable.vue?vue&type=template&id=54e633b4&scoped=true");
/* harmony import */ var _DataTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./DataTable.vue?vue&type=script&lang=js */ "./resources/js/components/ui/DataTable.vue?vue&type=script&lang=js");
/* harmony import */ var _DataTable_vue_vue_type_style_index_0_id_54e633b4_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true */ "./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_DataTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_DataTable_vue_vue_type_template_id_54e633b4_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-54e633b4"],['__file',"resources/js/components/ui/DataTable.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/modules/PermissionRights/Main.vue":
/*!********************************************************!*\
  !*** ./resources/js/modules/PermissionRights/Main.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Main_vue_vue_type_template_id_961392e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Main.vue?vue&type=template&id=961392e8&scoped=true */ "./resources/js/modules/PermissionRights/Main.vue?vue&type=template&id=961392e8&scoped=true");
/* harmony import */ var _Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Main.vue?vue&type=script&lang=js */ "./resources/js/modules/PermissionRights/Main.vue?vue&type=script&lang=js");
/* harmony import */ var _Main_vue_vue_type_style_index_0_id_961392e8_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true */ "./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true");
/* harmony import */ var _mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;


const __exports__ = /*#__PURE__*/(0,_mnt_Work_Projects_Laravel_secretary_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_3__["default"])(_Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_Main_vue_vue_type_template_id_961392e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render],['__scopeId',"data-v-961392e8"],['__file',"resources/js/modules/PermissionRights/Main.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/ui/DataTable.vue?vue&type=script&lang=js":
/*!**************************************************************************!*\
  !*** ./resources/js/components/ui/DataTable.vue?vue&type=script&lang=js ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DataTable.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/modules/PermissionRights/Main.vue?vue&type=script&lang=js":
/*!********************************************************************************!*\
  !*** ./resources/js/modules/PermissionRights/Main.vue?vue&type=script&lang=js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Main.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/ui/DataTable.vue?vue&type=template&id=54e633b4&scoped=true":
/*!********************************************************************************************!*\
  !*** ./resources/js/components/ui/DataTable.vue?vue&type=template&id=54e633b4&scoped=true ***!
  \********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_template_id_54e633b4_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_template_id_54e633b4_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DataTable.vue?vue&type=template&id=54e633b4&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=template&id=54e633b4&scoped=true");


/***/ }),

/***/ "./resources/js/modules/PermissionRights/Main.vue?vue&type=template&id=961392e8&scoped=true":
/*!**************************************************************************************************!*\
  !*** ./resources/js/modules/PermissionRights/Main.vue?vue&type=template&id=961392e8&scoped=true ***!
  \**************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_template_id_961392e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_template_id_961392e8_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Main.vue?vue&type=template&id=961392e8&scoped=true */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=template&id=961392e8&scoped=true");


/***/ }),

/***/ "./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_DataTable_vue_vue_type_style_index_0_id_54e633b4_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/ui/DataTable.vue?vue&type=style&index=0&id=54e633b4&lang=scss&scoped=true");


/***/ }),

/***/ "./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true":
/*!*****************************************************************************************************************!*\
  !*** ./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true ***!
  \*****************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_12_use_1_node_modules_vue_loader_dist_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_12_use_2_node_modules_sass_loader_dist_cjs_js_clonedRuleSet_12_use_3_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_Main_vue_vue_type_style_index_0_id_961392e8_lang_scss_scoped_true__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!../../../../node_modules/vue-loader/dist/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!../../../../node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-12.use[1]!./node_modules/vue-loader/dist/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-12.use[2]!./node_modules/sass-loader/dist/cjs.js??clonedRuleSet-12.use[3]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/modules/PermissionRights/Main.vue?vue&type=style&index=0&id=961392e8&lang=scss&scoped=true");


/***/ })

}]);