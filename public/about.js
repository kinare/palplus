(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["about"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminCard.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/admin/AdminCard.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var buefy_src_components_field_Field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! buefy/src/components/field/Field */ "./node_modules/buefy/src/components/field/Field.vue");
/* harmony import */ var buefy_src_components_input_Input__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! buefy/src/components/input/Input */ "./node_modules/buefy/src/components/input/Input.vue");
/* harmony import */ var buefy_src_components_button_Button__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! buefy/src/components/button/Button */ "./node_modules/buefy/src/components/button/Button.vue");
/* harmony import */ var buefy_src_components_datepicker_Datepicker__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! buefy/src/components/datepicker/Datepicker */ "./node_modules/buefy/src/components/datepicker/Datepicker.vue");
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
  name: "AdminCard",
  components: {
    BDatepicker: buefy_src_components_datepicker_Datepicker__WEBPACK_IMPORTED_MODULE_3__["default"],
    BButton: buefy_src_components_button_Button__WEBPACK_IMPORTED_MODULE_2__["default"],
    BInput: buefy_src_components_input_Input__WEBPACK_IMPORTED_MODULE_1__["default"],
    BField: buefy_src_components_field_Field__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      admin: {
        access_type: '',
        name: '',
        email: '',
        phone: '',
        status: '',
        wef: '',
        wet: ''
      }
    };
  },
  methods: {
    saveAdmin: function saveAdmin() {
      this.$store.dispatch('Admin/invite', this.admin);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminList.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/admin/AdminList.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var buefy_src_components_table_Table__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! buefy/src/components/table/Table */ "./node_modules/buefy/src/components/table/Table.vue");
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
  name: "AdminList",
  components: {
    BTable: buefy_src_components_table_Table__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      data: [{
        'name': 'michael kamau',
        'email': 'michaelkinare@gmail.com',
        'phone': '0708338855',
        'status': 'active',
        'role': 'editor',
        'wef': '10/2/2019',
        'wet': '10/2/2020',
        'id': '1'
      }, {
        'name': 'michael kamau',
        'email': 'michaelkinare@gmail.com',
        'phone': '0708338855',
        'status': 'inactive',
        'role': 'editor',
        'wef': '10/2/2019',
        'wet': '10/2/2020',
        'id': '2'
      }]
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/currency/List.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/currency/List.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var buefy_src_components_table_Table__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! buefy/src/components/table/Table */ "./node_modules/buefy/src/components/table/Table.vue");
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
  name: "List",
  components: {
    BTable: buefy_src_components_table_Table__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      data: [{
        'name': 'Kenya Shillings',
        'short_code': 'KES',
        'country': 'Kenya',
        'rate': '102.09'
      }, {
        'name': 'US Dollars',
        'short_code': 'USD',
        'country': 'USA',
        'rate': '1'
      }, {
        'name': 'Uganda Shillings',
        'short_code': 'UGX',
        'country': 'Uganda',
        'rate': '3709.09'
      }],
      columns: [{
        field: 'name',
        label: 'Currency',
        searchable: true
      }, {
        field: 'short_code',
        label: 'Short Description',
        searchable: true
      }, {
        field: 'country',
        label: 'Country',
        searchable: true
      }, {
        field: 'rate',
        label: 'Today\'s Rate vs USD',
        searchable: true
      }]
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/group/GroupList.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/group/GroupList.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "GroupList",
  data: function data() {
    return {
      data: [{
        'name': 'Huruma Youth Group',
        'country': 'Kenya',
        'currency': 'KES',
        'type': 'Investment',
        'wef': '28-OCT-2019',
        'access_level': 'private',
        'status': 'active',
        'created_by_name': 'John Doe',
        'created_by_phone': '+254708338855',
        'id': '1'
      }]
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/member/MemberList.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/member/MemberList.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "MemberList",
  data: function data() {
    return {
      data: [{
        'name': 'Michael Kinare',
        'country': 'Kenya',
        'phone': '+2540708338855',
        'email': 'michaelkinare@gmail.com',
        'wef': '28-OCT-2019',
        'status': 'active',
        'id': '1'
      }]
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Menu.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/stats/Menu.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Menu"
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Stats.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/stats/Stats.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Stats"
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/wallet/List.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/wallet/List.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "List"
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/admin/AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "Card has-background-white" }, [
    _vm._m(0),
    _vm._v(" "),
    _c("div", { staticClass: "card-content" }, [
      _c("div", { staticClass: "content has-text-left" }, [
        _c("div", { staticClass: "columns is-multiline" }, [
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "Access type" } },
                [
                  _c(
                    "b-select",
                    {
                      attrs: {
                        expanded: "",
                        placeholder: "Select Access type"
                      },
                      model: {
                        value: _vm.admin.access_type,
                        callback: function($$v) {
                          _vm.$set(_vm.admin, "access_type", $$v)
                        },
                        expression: "admin.access_type"
                      }
                    },
                    [
                      _c("option", [_vm._v("Editor")]),
                      _vm._v(" "),
                      _c("option", [_vm._v("Viewer")])
                    ]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "Full Names" } },
                [
                  _c("b-input", {
                    attrs: { type: "text", placeholder: "Names" },
                    model: {
                      value: _vm.admin.name,
                      callback: function($$v) {
                        _vm.$set(_vm.admin, "name", $$v)
                      },
                      expression: "admin.name"
                    }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "Phone" } },
                [
                  _c("b-input", {
                    attrs: { type: "text", placeholder: "Phone" },
                    model: {
                      value: _vm.admin.phone,
                      callback: function($$v) {
                        _vm.$set(_vm.admin, "phone", $$v)
                      },
                      expression: "admin.phone"
                    }
                  })
                ],
                1
              )
            ],
            1
          )
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "columns is-multiline" }, [
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "Email" } },
                [
                  _c("b-input", {
                    attrs: { type: "email", placeholder: "email" },
                    model: {
                      value: _vm.admin.email,
                      callback: function($$v) {
                        _vm.$set(_vm.admin, "email", $$v)
                      },
                      expression: "admin.email"
                    }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "Status" } },
                [
                  _c(
                    "b-select",
                    {
                      attrs: { expanded: "", placeholder: "Select status" },
                      model: {
                        value: _vm.admin.status,
                        callback: function($$v) {
                          _vm.$set(_vm.admin, "status", $$v)
                        },
                        expression: "admin.status"
                      }
                    },
                    [
                      _c("option", [_vm._v("Active")]),
                      _vm._v(" "),
                      _c("option", [_vm._v("Inactive")])
                    ]
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "WEF date" } },
                [
                  _c("b-datepicker", {
                    attrs: {
                      "show-week-number": true,
                      placeholder: "Click to select...",
                      icon: "calendar-today"
                    },
                    model: {
                      value: _vm.admin.wef,
                      callback: function($$v) {
                        _vm.$set(_vm.admin, "wef", $$v)
                      },
                      expression: "admin.wef"
                    }
                  })
                ],
                1
              )
            ],
            1
          )
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "columns is-multiline" }, [
          _c(
            "div",
            { staticClass: "column" },
            [
              _c(
                "b-field",
                { attrs: { label: "WET date" } },
                [
                  _c("b-datepicker", {
                    attrs: {
                      "show-week-number": true,
                      placeholder: "Click to select...",
                      icon: "calendar-today"
                    },
                    model: {
                      value: _vm.admin.wet,
                      callback: function($$v) {
                        _vm.$set(_vm.admin, "wet", $$v)
                      },
                      expression: "admin.wet"
                    }
                  })
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c("div", { staticClass: "column" }),
          _vm._v(" "),
          _c("div", { staticClass: "column" })
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "columns is-multiline" }, [
          _c("div", { staticClass: "column" }, [
            _c(
              "div",
              { staticClass: "buttons" },
              [
                _c(
                  "b-button",
                  {
                    attrs: { type: "is-primary", expanded: "" },
                    on: {
                      click: function($event) {
                        return _vm.saveAdmin()
                      }
                    }
                  },
                  [_vm._v("Submit")]
                )
              ],
              1
            )
          ])
        ])
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("header", { staticClass: "card-header" }, [
      _c("p", { staticClass: "card-header-title" }, [_vm._v("Admin Card")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminList.vue?vue&type=template&id=1a35be7e&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/admin/AdminList.vue?vue&type=template&id=1a35be7e&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "Card has-background-white" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "card-content" },
      [
        _c("b-table", {
          attrs: { data: _vm.data, striped: true, hoverable: true },
          scopedSlots: _vm._u([
            {
              key: "default",
              fn: function(props) {
                return [
                  _c(
                    "b-table-column",
                    {
                      attrs: { field: "name", label: "Name", searchable: true }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.name) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "email",
                        label: "Email",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.email) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "phone",
                        label: "Phone",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.phone) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "status",
                        label: "Status",
                        searchable: true
                      }
                    },
                    [
                      _c(
                        "span",
                        {
                          staticClass: "tag",
                          class:
                            props.row.status === "active"
                              ? "is-success"
                              : "is-grey"
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(props.row.status) +
                              "\n                    "
                          )
                        ]
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: { field: "role", label: "Role", searchable: true }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.role) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "wef", label: "WEF", searchable: true } },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.wef) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "wet", label: "WET", searchable: true } },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.wet) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "id", label: "Options" } },
                    [
                      _c(
                        "b-dropdown",
                        { attrs: { "aria-role": "list" } },
                        [
                          _c(
                            "button",
                            {
                              staticClass: "button",
                              attrs: { slot: "trigger" },
                              slot: "trigger"
                            },
                            [
                              _c("span", [_vm._v("Options")]),
                              _vm._v("  \n                            "),
                              _c("font-awesome-icon", {
                                attrs: { icon: "caret-down" }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Edit")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [
                              _vm._v(
                                _vm._s(
                                  props.row.status === "active"
                                    ? "Deactivate"
                                    : "Activate"
                                )
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Delete")]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ]
              }
            }
          ])
        })
      ],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("header", { staticClass: "card-header" }, [
      _c("p", { staticClass: "card-header-title" }, [_vm._v("Admins")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/currency/List.vue?vue&type=template&id=5c2c878d&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/currency/List.vue?vue&type=template&id=5c2c878d&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "Card has-background-white" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "card-content" },
      [
        _c("b-table", {
          attrs: {
            data: _vm.data,
            columns: _vm.columns,
            striped: true,
            hoverable: true
          }
        })
      ],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("header", { staticClass: "card-header" }, [
      _c("p", { staticClass: "card-header-title" }, [_vm._v("Currencies")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/group/GroupList.vue?vue&type=template&id=5c9c20de&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/group/GroupList.vue?vue&type=template&id=5c9c20de&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "Card has-background-white" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "card-content is-size-7" },
      [
        _c("b-table", {
          attrs: {
            data: _vm.data,
            striped: true,
            narrowed: true,
            hoverable: true
          },
          scopedSlots: _vm._u([
            {
              key: "default",
              fn: function(props) {
                return [
                  _c(
                    "b-table-column",
                    {
                      attrs: { field: "name", label: "Name", searchable: true }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.name) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "country",
                        label: "Country",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.country) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "currency",
                        label: "Currency",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.currency) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: { field: "type", label: "Type", searchable: true }
                    },
                    [
                      _c(
                        "span",
                        {
                          staticClass: "tag",
                          class:
                            props.row.status === "active"
                              ? "is-success"
                              : "is-grey"
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(props.row.type) +
                              "\n                    "
                          )
                        ]
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "wef", label: "WEF", searchable: true } },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.wef) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "access_level",
                        label: "Access Level",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.access_level) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "created_by_name",
                        label: "Created By",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.created_by_name) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "created_by_phone",
                        label: "Phone",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.created_by_phone) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "id", label: "Options" } },
                    [
                      _c(
                        "b-dropdown",
                        { attrs: { "aria-role": "list" } },
                        [
                          _c(
                            "button",
                            {
                              staticClass: "button",
                              attrs: { slot: "trigger" },
                              slot: "trigger"
                            },
                            [
                              _c("span", [_vm._v("Options")]),
                              _vm._v("  \n                            "),
                              _c("font-awesome-icon", {
                                attrs: { icon: "caret-down" }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Details")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Deposits")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Withdrawals")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Chats")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Pending Payments")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Members")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Admins")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Loan")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Loan Approvers")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Withdawal Approvers")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Membership Settings")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Loan Settings")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Events")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Meetings")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Projects")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Projects")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Suspend")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [
                              _vm._v(
                                _vm._s(
                                  props.row.status === "active"
                                    ? "Deactivate"
                                    : "Activate"
                                )
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Delete")]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ]
              }
            }
          ])
        })
      ],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("header", { staticClass: "card-header" }, [
      _c("p", { staticClass: "card-header-title" }, [_vm._v("Groups")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/member/MemberList.vue?vue&type=template&id=3743bb9e&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/member/MemberList.vue?vue&type=template&id=3743bb9e&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "Card has-background-white" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "card-content is-size-7" },
      [
        _c("b-table", {
          attrs: {
            data: _vm.data,
            striped: true,
            narrowed: true,
            hoverable: true
          },
          scopedSlots: _vm._u([
            {
              key: "default",
              fn: function(props) {
                return [
                  _c(
                    "b-table-column",
                    {
                      attrs: { field: "name", label: "Name", searchable: true }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.name) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "country",
                        label: "Country",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.country) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "phone",
                        label: "Phone",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.phone) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "email",
                        label: "Email",
                        searchable: true
                      }
                    },
                    [
                      _vm._v(
                        "\n                        " +
                          _vm._s(props.row.email) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    {
                      attrs: {
                        field: "status",
                        label: "Status",
                        searchable: true
                      }
                    },
                    [
                      _c(
                        "span",
                        {
                          staticClass: "tag",
                          class:
                            props.row.status === "active"
                              ? "is-success"
                              : "is-grey"
                        },
                        [
                          _vm._v(
                            "\n                        " +
                              _vm._s(props.row.status) +
                              "\n                    "
                          )
                        ]
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "wef", label: "WEF", searchable: true } },
                    [
                      _vm._v(
                        "\n                    " +
                          _vm._s(props.row.wef) +
                          "\n                "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "b-table-column",
                    { attrs: { field: "id", label: "Options" } },
                    [
                      _c(
                        "b-dropdown",
                        { attrs: { "aria-role": "list" } },
                        [
                          _c(
                            "button",
                            {
                              staticClass: "button",
                              attrs: { slot: "trigger" },
                              slot: "trigger"
                            },
                            [
                              _c("span", [_vm._v("Options")]),
                              _vm._v("  \n                            "),
                              _c("font-awesome-icon", {
                                attrs: { icon: "caret-down" }
                              })
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Details")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Deposits")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("View Withdrawals")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Pending Payments")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("My Groups")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("My Wallets")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Next Of Kin")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("My Loans")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("My Events")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("My Projects")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Suspend")]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [
                              _vm._v(
                                _vm._s(
                                  props.row.status === "active"
                                    ? "Deactivate"
                                    : "Activate"
                                )
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c(
                            "b-dropdown-item",
                            { attrs: { "aria-role": "listitem" } },
                            [_vm._v("Delete")]
                          )
                        ],
                        1
                      )
                    ],
                    1
                  )
                ]
              }
            }
          ])
        })
      ],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("header", { staticClass: "card-header" }, [
      _c("p", { staticClass: "card-header-title" }, [_vm._v("Groups")])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Menu.vue?vue&type=template&id=232003ae&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/stats/Menu.vue?vue&type=template&id=232003ae&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************/
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
    "button",
    { staticClass: "button is-small", attrs: { type: "button" } },
    [_vm._v("\n    March 8, 2017 - April 6, 2017\n")]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Stats.vue?vue&type=template&id=22f27360&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/stats/Stats.vue?vue&type=template&id=22f27360&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************/
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
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("section", { staticClass: "info-tiles" }, [
      _c("div", { staticClass: "tile is-ancestor has-text-centered" }, [
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("439k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Groups")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("59k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Users")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("3.4M")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Palplus wallet")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("50k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Loans")])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/wallet/List.vue?vue&type=template&id=0d0472e5&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/wallet/List.vue?vue&type=template&id=0d0472e5&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************/
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
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("section", { staticClass: "info-tiles" }, [
      _c("div", { staticClass: "tile is-ancestor has-text-centered" }, [
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("$4,000.00")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Total Balance")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("59k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [
              _vm._v("Total Number of Groups")
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("3.4M")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [
              _vm._v("Total Group Withdrawals")
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "tile is-ancestor has-text-centered" }, [
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("50k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Total Deposits")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("50k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [
              _vm._v("Total Number of Members")
            ])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("50k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [
              _vm._v("Today's Total Deposits")
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "tile is-ancestor has-text-centered" }, [
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("50k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [_vm._v("Total Withdrawals")])
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "tile is-parent" }, [
          _c("article", { staticClass: "tile is-child box" }, [
            _c("p", { staticClass: "title" }, [_vm._v("50k")]),
            _vm._v(" "),
            _c("p", { staticClass: "subtitle" }, [
              _vm._v("Total Active Members")
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/admin/AdminCard.vue":
/*!************************************************!*\
  !*** ./resources/js/views/admin/AdminCard.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdminCard_vue_vue_type_template_id_6cfa0020_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true& */ "./resources/js/views/admin/AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true&");
/* harmony import */ var _AdminCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdminCard.vue?vue&type=script&lang=js& */ "./resources/js/views/admin/AdminCard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdminCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdminCard_vue_vue_type_template_id_6cfa0020_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdminCard_vue_vue_type_template_id_6cfa0020_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "6cfa0020",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/admin/AdminCard.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/admin/AdminCard.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/views/admin/AdminCard.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminCard.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminCard.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminCard_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/admin/AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/views/admin/AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminCard_vue_vue_type_template_id_6cfa0020_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminCard.vue?vue&type=template&id=6cfa0020&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminCard_vue_vue_type_template_id_6cfa0020_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminCard_vue_vue_type_template_id_6cfa0020_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/admin/AdminList.vue":
/*!************************************************!*\
  !*** ./resources/js/views/admin/AdminList.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _AdminList_vue_vue_type_template_id_1a35be7e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./AdminList.vue?vue&type=template&id=1a35be7e&scoped=true& */ "./resources/js/views/admin/AdminList.vue?vue&type=template&id=1a35be7e&scoped=true&");
/* harmony import */ var _AdminList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./AdminList.vue?vue&type=script&lang=js& */ "./resources/js/views/admin/AdminList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _AdminList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _AdminList_vue_vue_type_template_id_1a35be7e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _AdminList_vue_vue_type_template_id_1a35be7e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "1a35be7e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/admin/AdminList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/admin/AdminList.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/views/admin/AdminList.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/admin/AdminList.vue?vue&type=template&id=1a35be7e&scoped=true&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/views/admin/AdminList.vue?vue&type=template&id=1a35be7e&scoped=true& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminList_vue_vue_type_template_id_1a35be7e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./AdminList.vue?vue&type=template&id=1a35be7e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/admin/AdminList.vue?vue&type=template&id=1a35be7e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminList_vue_vue_type_template_id_1a35be7e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_AdminList_vue_vue_type_template_id_1a35be7e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/currency/List.vue":
/*!**********************************************!*\
  !*** ./resources/js/views/currency/List.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _List_vue_vue_type_template_id_5c2c878d_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./List.vue?vue&type=template&id=5c2c878d&scoped=true& */ "./resources/js/views/currency/List.vue?vue&type=template&id=5c2c878d&scoped=true&");
/* harmony import */ var _List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./List.vue?vue&type=script&lang=js& */ "./resources/js/views/currency/List.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _List_vue_vue_type_template_id_5c2c878d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _List_vue_vue_type_template_id_5c2c878d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5c2c878d",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/currency/List.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/currency/List.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/views/currency/List.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./List.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/currency/List.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/currency/List.vue?vue&type=template&id=5c2c878d&scoped=true&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/views/currency/List.vue?vue&type=template&id=5c2c878d&scoped=true& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_5c2c878d_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./List.vue?vue&type=template&id=5c2c878d&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/currency/List.vue?vue&type=template&id=5c2c878d&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_5c2c878d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_5c2c878d_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/group/GroupList.vue":
/*!************************************************!*\
  !*** ./resources/js/views/group/GroupList.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _GroupList_vue_vue_type_template_id_5c9c20de_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./GroupList.vue?vue&type=template&id=5c9c20de&scoped=true& */ "./resources/js/views/group/GroupList.vue?vue&type=template&id=5c9c20de&scoped=true&");
/* harmony import */ var _GroupList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./GroupList.vue?vue&type=script&lang=js& */ "./resources/js/views/group/GroupList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _GroupList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _GroupList_vue_vue_type_template_id_5c9c20de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _GroupList_vue_vue_type_template_id_5c9c20de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "5c9c20de",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/group/GroupList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/group/GroupList.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/views/group/GroupList.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GroupList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./GroupList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/group/GroupList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_GroupList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/group/GroupList.vue?vue&type=template&id=5c9c20de&scoped=true&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/views/group/GroupList.vue?vue&type=template&id=5c9c20de&scoped=true& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GroupList_vue_vue_type_template_id_5c9c20de_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./GroupList.vue?vue&type=template&id=5c9c20de&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/group/GroupList.vue?vue&type=template&id=5c9c20de&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GroupList_vue_vue_type_template_id_5c9c20de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_GroupList_vue_vue_type_template_id_5c9c20de_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/member/MemberList.vue":
/*!**************************************************!*\
  !*** ./resources/js/views/member/MemberList.vue ***!
  \**************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MemberList_vue_vue_type_template_id_3743bb9e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MemberList.vue?vue&type=template&id=3743bb9e&scoped=true& */ "./resources/js/views/member/MemberList.vue?vue&type=template&id=3743bb9e&scoped=true&");
/* harmony import */ var _MemberList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MemberList.vue?vue&type=script&lang=js& */ "./resources/js/views/member/MemberList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MemberList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MemberList_vue_vue_type_template_id_3743bb9e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MemberList_vue_vue_type_template_id_3743bb9e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "3743bb9e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/member/MemberList.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/member/MemberList.vue?vue&type=script&lang=js&":
/*!***************************************************************************!*\
  !*** ./resources/js/views/member/MemberList.vue?vue&type=script&lang=js& ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MemberList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./MemberList.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/member/MemberList.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MemberList_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/member/MemberList.vue?vue&type=template&id=3743bb9e&scoped=true&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/views/member/MemberList.vue?vue&type=template&id=3743bb9e&scoped=true& ***!
  \*********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MemberList_vue_vue_type_template_id_3743bb9e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./MemberList.vue?vue&type=template&id=3743bb9e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/member/MemberList.vue?vue&type=template&id=3743bb9e&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MemberList_vue_vue_type_template_id_3743bb9e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MemberList_vue_vue_type_template_id_3743bb9e_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/stats/Menu.vue":
/*!*******************************************!*\
  !*** ./resources/js/views/stats/Menu.vue ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Menu_vue_vue_type_template_id_232003ae_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Menu.vue?vue&type=template&id=232003ae&scoped=true& */ "./resources/js/views/stats/Menu.vue?vue&type=template&id=232003ae&scoped=true&");
/* harmony import */ var _Menu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Menu.vue?vue&type=script&lang=js& */ "./resources/js/views/stats/Menu.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Menu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Menu_vue_vue_type_template_id_232003ae_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Menu_vue_vue_type_template_id_232003ae_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "232003ae",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/stats/Menu.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/stats/Menu.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/views/stats/Menu.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Menu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Menu.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Menu.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Menu_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/stats/Menu.vue?vue&type=template&id=232003ae&scoped=true&":
/*!**************************************************************************************!*\
  !*** ./resources/js/views/stats/Menu.vue?vue&type=template&id=232003ae&scoped=true& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Menu_vue_vue_type_template_id_232003ae_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Menu.vue?vue&type=template&id=232003ae&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Menu.vue?vue&type=template&id=232003ae&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Menu_vue_vue_type_template_id_232003ae_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Menu_vue_vue_type_template_id_232003ae_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/stats/Stats.vue":
/*!********************************************!*\
  !*** ./resources/js/views/stats/Stats.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Stats_vue_vue_type_template_id_22f27360_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Stats.vue?vue&type=template&id=22f27360&scoped=true& */ "./resources/js/views/stats/Stats.vue?vue&type=template&id=22f27360&scoped=true&");
/* harmony import */ var _Stats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Stats.vue?vue&type=script&lang=js& */ "./resources/js/views/stats/Stats.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Stats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Stats_vue_vue_type_template_id_22f27360_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Stats_vue_vue_type_template_id_22f27360_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "22f27360",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/stats/Stats.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/stats/Stats.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/js/views/stats/Stats.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Stats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Stats.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Stats.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Stats_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/stats/Stats.vue?vue&type=template&id=22f27360&scoped=true&":
/*!***************************************************************************************!*\
  !*** ./resources/js/views/stats/Stats.vue?vue&type=template&id=22f27360&scoped=true& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stats_vue_vue_type_template_id_22f27360_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Stats.vue?vue&type=template&id=22f27360&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/stats/Stats.vue?vue&type=template&id=22f27360&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stats_vue_vue_type_template_id_22f27360_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stats_vue_vue_type_template_id_22f27360_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/views/wallet/List.vue":
/*!********************************************!*\
  !*** ./resources/js/views/wallet/List.vue ***!
  \********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _List_vue_vue_type_template_id_0d0472e5_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./List.vue?vue&type=template&id=0d0472e5&scoped=true& */ "./resources/js/views/wallet/List.vue?vue&type=template&id=0d0472e5&scoped=true&");
/* harmony import */ var _List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./List.vue?vue&type=script&lang=js& */ "./resources/js/views/wallet/List.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _List_vue_vue_type_template_id_0d0472e5_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _List_vue_vue_type_template_id_0d0472e5_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0d0472e5",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/wallet/List.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/wallet/List.vue?vue&type=script&lang=js&":
/*!*********************************************************************!*\
  !*** ./resources/js/views/wallet/List.vue?vue&type=script&lang=js& ***!
  \*********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./List.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/wallet/List.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/wallet/List.vue?vue&type=template&id=0d0472e5&scoped=true&":
/*!***************************************************************************************!*\
  !*** ./resources/js/views/wallet/List.vue?vue&type=template&id=0d0472e5&scoped=true& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_0d0472e5_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./List.vue?vue&type=template&id=0d0472e5&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/wallet/List.vue?vue&type=template&id=0d0472e5&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_0d0472e5_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_List_vue_vue_type_template_id_0d0472e5_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);