"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["patients"],{

/***/ "./assets/card/card.jsx":
/*!******************************!*\
  !*** ./assets/card/card.jsx ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_icons_fa__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react-icons/fa */ "./node_modules/react-icons/fa/index.mjs");
/* harmony import */ var _spinner_spinner__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../spinner/spinner */ "./assets/spinner/spinner.jsx");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var jquery_loading__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! jquery-loading */ "./node_modules/jquery-loading/dist/jquery.loading.js");
/* harmony import */ var jquery_loading__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(jquery_loading__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }






var Card = /*#__PURE__*/function (_Component) {
  function Card() {
    var _this;
    _classCallCheck(this, Card);
    _this = _callSuper(this, Card);
    _this.state = {
      loading: true
    };
    return _this;
  }
  _inherits(Card, _Component);
  return _createClass(Card, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.image = this.choseimage();
      this.title = this.choseTitle();
      this.textcolor = this.choseColor();
      //this.nrd=afficherNrd();
      //=afficherNrd;
      this.setState({
        loading: false,
        image: this.image,
        title: this.title,
        patient: this.props.patient
      });
    }
  }, {
    key: "choseimage",
    value: function choseimage() {
      //console.log(this.props.cardType);
      if (this.props.patient.havemammo) return '../images/Mammographie.jpeg';
      if (this.props.patient.haveradio) return '../images/Radiographie.jpg';
      if (this.props.patient.havescanner) return '../images/scanner.jpeg';
      return '../images/scanner.jpeg';
      // removed by dead control flow
{}
    }
  }, {
    key: "choseTitle",
    value: function choseTitle() {
      if (this.props.patient.havemammo) return 'Mammographie';
      if (this.props.patient.haveradio) return 'Radiographie';
      if (this.props.patient.havescanner) return 'Scanner';
      return 'Scanner';
    }
  }, {
    key: "choseColor",
    value: function choseColor() {
      if (this.props.patient.sex == "Homme") return 'text-blue';
      return 'text-pink';
    }
  }, {
    key: "CalculAge",
    value: function CalculAge(dateNaissance) {
      var today = new Date();
      var age = today.getFullYear() - dateNaissance.getFullYear();
      var m = today.getMonth() - dateNaissance.getMonth();
      if (m < 0 || m === 0 && today.getDate() < dateNaissance.getDate()) {
        age = age - 1;
      }
      //console.log(dateNaissance.toString());
      //console.log(age);
      return age; // que l'on place dans le input d'id Age
    }
  }, {
    key: "spin",
    value: function spin() {
      // console.log('spin');
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
        className: "row g-0",
        children: " Spinner()"
      });
    }
  }, {
    key: "formatDate",
    value: function formatDate(date) {
      var day = String(date.getDate()).padStart(2, '0');
      var month = String(date.getMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
      var year = date.getFullYear();
      return "".concat(day, "/").concat(month, "/").concat(year);
    }
  }, {
    key: "getinfopatient",
    value: function getinfopatient() {
      /*$('#maincontent').loading({
        stoppable: true,
            message: 'Chargement...',
            theme: 'dark'
          });*/
      /*$('#maincontent').loading({
        theme: 'light',
        hideAnimation: function() {
          $(this).remove(); // Force la suppression
        }
      });*/
      //console.log(this);  
      this.urljsonpatients = window.location.protocol + "//" + window.location.host;
      jquery__WEBPACK_IMPORTED_MODULE_2___default()('#maincontent').load(this.urljsonpatients + '/patient/infopatient/' + this.props.patient.id);
      jquery__WEBPACK_IMPORTED_MODULE_2___default()('#tabledetailcontent').load(this.urljsonpatients + '/patient/tdpatient/' + this.props.patient.id);
    }
  }, {
    key: "afficherNrd",
    value: function afficherNrd() {
      if (this.props.patient.nrdhavealerte == "1") return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("p", {
        className: "card-text text-danger",
        children: ["NRD ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("i", {
          "class": "bi bi-exclamation-triangle"
        })]
      });else return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("p", {
        className: "card-text"
      });
    }
  }, {
    key: "loadedcard",
    value: function loadedcard() {
      var _this2 = this;
      // console.log('loadedcard');
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
        className: "row g-0",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
          className: "col-md-5",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
            className: "row",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "col-md-12 text-uppercase",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h4", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("center", {
                  children: this.state.title
                })
              })
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
            className: "row",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "col-md-12",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("img", {
                src: this.state.image,
                className: "img-fluid rounded-start",
                alt: "..."
              })
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "col-md-12",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
                className: "row",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                  className: "col-md-12",
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("center", {
                    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("p", {
                      className: "card-text",
                      children: "Nombre d'expositions"
                    })
                  })
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                  className: "col-md-12",
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("center", {
                    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h1", {
                      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("p", {
                        className: "card-text",
                        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("strong", {
                          className: this.state.patient.sumhavealerte == "1" ? "text-danger" : "",
                          children: this.state.patient.nbdoses
                        })
                      })
                    })
                  })
                })]
              })
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "col-md-12",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("center", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("h4", {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("strong", {
                    children: this.props.patient.nrdhavealerte == "1" ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("p", {
                      className: "card-text text-danger",
                      children: ["NRD", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)(react_icons_fa__WEBPACK_IMPORTED_MODULE_5__.FaExclamation, {
                        className: "mt-n1 mr-1"
                      })]
                    }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("p", {
                      className: "card-text"
                    })
                  })
                })
              })
            })]
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
          className: "col-md-7",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("div", {
            className: "card-body",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("h5", {
              className: "card-title text-end " + this.textcolor,
              children: [this.state.patient.sex == "Homme" ? "Monsieur " : "Madame ", this.state.patient.nom, " ", this.state.patient.prenom]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "row",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                className: "col-md-12",
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("ul", {
                  className: "list-group list-group-flush",
                  children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("li", {
                    className: "list-group-item pb-1 pt-1",
                    children: ["N\xB0 dossier : ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("strong", {
                      className: this.textcolor,
                      children: this.state.patient.numipp
                    })]
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("li", {
                    className: "list-group-item pb-1 pt-1",
                    children: ["N\xE9 le ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("strong", {
                      className: this.textcolor,
                      children: [this.state.patient.datedenaissancestring, " "]
                    })]
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("li", {
                    className: "list-group-item pb-1 pt-1",
                    children: ["Date dernier examen : ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("strong", {
                      className: this.textcolor,
                      children: [this.state.patient.datelastexam != null ? this.formatDate(new Date(this.state.patient.datelastexam.timestamp * 1000)) : 'Inconnu', " "]
                    })]
                  }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("li", {
                    className: "list-group-item pb-5",
                    children: ["Age :  ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsxs)("strong", {
                      className: this.textcolor,
                      children: [this.CalculAge(new Date(this.state.patient.datenaissance.timestamp * 1000)), " ans "]
                    })]
                  })]
                })
              })
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
              className: "row",
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
                className: "col-md-12",
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("center", {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("button", {
                    type: "button",
                    onClick: function onClick() {
                      return _this2.getinfopatient();
                    },
                    className: "btn btn-secondary btn-lg btn-block",
                    children: "Informations patient"
                  }, this.state.patient.id)
                })
              })
            })]
          })
        })]
      });
    }
  }, {
    key: "createcard",
    value: function createcard() {
      return this.state.loading ? this.spin() : this.loadedcard();
    }
  }, {
    key: "render",
    value: function render() {
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_4__.jsx)("div", {
        className: "card mb-3",
        children: this.createcard()
      });
    }
  }]);
}(react__WEBPACK_IMPORTED_MODULE_0__.Component);
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Card);

/***/ }),

/***/ "./assets/filter/ProtocolSelector.jsx":
/*!********************************************!*\
  !*** ./assets/filter/ProtocolSelector.jsx ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var multiselect_react_dropdown__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! multiselect-react-dropdown */ "./node_modules/multiselect-react-dropdown/dist/index.js");
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom/client */ "./node_modules/react-dom/client.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { if (r) i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n;else { var o = function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); }; o("next", 0), o("throw", 1), o("return", 2); } }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }




var ProtocolSelector = /*#__PURE__*/function (_Component) {
  function ProtocolSelector(props) {
    var _this;
    _classCallCheck(this, ProtocolSelector);
    _this = _callSuper(this, ProtocolSelector, [props]);

    // Définition de l'état initial
    _this.state = {
      options: [],
      // Liste de tous les protocoles disponibles pour le Multiselect
      selectedProtocols: [],
      // Liste des protocoles sélectionnés par l'utilisateur
      loading: true,
      // Indicateur de chargement
      error: null // Stockage des erreurs éventuelles
    };

    // Lier les méthodes de gestion d'événements à l'instance de la classe
    _this.onSelect = _this.onSelect.bind(_this);
    _this.onRemove = _this.onRemove.bind(_this);
    _this.API_URL = "/" + jsonprotocolespathname;
    return _this;
  }

  /**
   * Cycle de vie : Exécuté après le montage initial du composant dans le DOM.
   * C'est l'endroit idéal pour les appels API.
   */
  _inherits(ProtocolSelector, _Component);
  return _createClass(ProtocolSelector, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.fetchProtocols();
    }

    // Méthode asynchrone pour la récupération des données
  }, {
    key: "fetchProtocols",
    value: function () {
      var _fetchProtocols = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
        var response, data, protocolList, formattedOptions, _t;
        return _regenerator().w(function (_context) {
          while (1) switch (_context.n) {
            case 0:
              _context.p = 0;
              _context.n = 1;
              return fetch(this.API_URL);
            case 1:
              response = _context.v;
              if (response.ok) {
                _context.n = 2;
                break;
              }
              throw new Error("Erreur HTTP: ".concat(response.status));
            case 2:
              _context.n = 3;
              return response.json();
            case 3:
              data = _context.v;
              protocolList = data || [];
              console.log(protocolList);
              // Formatage des données en objets { name: "...", id: "..." }
              formattedOptions = protocolList.filter(function (protocol) {
                return protocol && protocol.name.trim() !== '' && !protocol.name.startsWith("b'");
              }).map(function (protocol) {
                return {
                  name: protocol.name.trim(),
                  id: protocol.name.trim()
                };
              }); // Mise à jour de l'état avec les données récupérées
              this.setState({
                options: formattedOptions,
                loading: false
              });
              _context.n = 5;
              break;
            case 4:
              _context.p = 4;
              _t = _context.v;
              console.error("Erreur lors de la récupération des protocoles :", _t);
              // Mise à jour de l'état en cas d'erreur
              this.setState({
                error: "Impossible de charger les protocoles.",
                loading: false
              });
            case 5:
              return _context.a(2);
          }
        }, _callee, this, [[0, 4]]);
      }));
      function fetchProtocols() {
        return _fetchProtocols.apply(this, arguments);
      }
      return fetchProtocols;
    }() // Gestionnaire d'événement pour la sélection
  }, {
    key: "onSelect",
    value: function onSelect(selectedList, selectedItem) {
      this.setState({
        selectedProtocols: selectedList
      });
      console.log('Protocoles sélectionnés:', selectedList);
    }

    //<!-- h3 Sélection des Protocoles (Mode Classe) h3 -->
    //{selectedProtocols.length > 0 && (
    //    <!-- p
    //        Vous avez sélectionné : {selectedProtocols.map(p => p.name).join(', ')}
    //    p -->
    //)}

    // Gestionnaire d'événement pour la désélection
  }, {
    key: "onRemove",
    value: function onRemove(selectedList, removedItem) {
      this.setState({
        selectedProtocols: selectedList
      });
      console.log('Protocole retiré. Liste actuelle:', selectedList);
    }

    /**
     * Cycle de vie : Rendu du composant
     */
  }, {
    key: "render",
    value: function render() {
      var _this$state = this.state,
        options = _this$state.options,
        selectedProtocols = _this$state.selectedProtocols,
        loading = _this$state.loading,
        error = _this$state.error;
      if (loading) {
        return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
          children: "Chargement des protocoles..."
        });
      }
      if (error) {
        return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsxs)("div", {
          style: {
            color: 'red'
          },
          children: ["Erreur : ", error]
        });
      }
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)("div", {
        className: "protocol-selector-container",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(multiselect_react_dropdown__WEBPACK_IMPORTED_MODULE_1__.Multiselect, {
          options: options,
          selectedValues: selectedProtocols,
          onSelect: this.onSelect,
          onRemove: this.onRemove,
          displayValue: "name",
          placeholder: "S\xE9lectionnez un ou plusieurs protocoles",
          showCheckbox: true
        })
      });
    }
  }]);
}(react__WEBPACK_IMPORTED_MODULE_0__.Component);
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (ProtocolSelector);

/***/ }),

/***/ "./assets/filter/filter.jsx":
/*!**********************************!*\
  !*** ./assets/filter/filter.jsx ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _nav_pagination__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../nav/pagination */ "./assets/nav/pagination.jsx");
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-dom/client */ "./node_modules/react-dom/client.js");
/* harmony import */ var react_paginate__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-paginate */ "./node_modules/react-paginate/dist/react-paginate.js");
/* harmony import */ var react_paginate__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_paginate__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _ProtocolSelector__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./ProtocolSelector */ "./assets/filter/ProtocolSelector.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }







function Filter() {
  var _useState = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState2 = _slicedToArray(_useState, 2),
    isEnfantsChecked = _useState2[0],
    setIsEnfantsChecked = _useState2[1];
  var _useState3 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState4 = _slicedToArray(_useState3, 2),
    isScannerChecked = _useState4[0],
    setIsScannerChecked = _useState4[1];
  var _useState5 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState6 = _slicedToArray(_useState5, 2),
    isRadioChecked = _useState6[0],
    setIsRadioChecked = _useState6[1];
  var _useState7 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState8 = _slicedToArray(_useState7, 2),
    isNrdChecked = _useState8[0],
    setIsNrdChecked = _useState8[1];
  var _useState9 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState0 = _slicedToArray(_useState9, 2),
    isMammoChecked = _useState0[0],
    setIsMammoChecked = _useState0[1];
  var _useState1 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(true),
    _useState10 = _slicedToArray(_useState1, 2),
    isTousChecked = _useState10[0],
    setIsTousChecked = _useState10[1];
  var _useState11 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState12 = _slicedToArray(_useState11, 2),
    isPediatrieChecked = _useState12[0],
    setIsPediatrieChecked = _useState12[1];
  var _useState13 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState14 = _slicedToArray(_useState13, 2),
    isHommeChecked = _useState14[0],
    setIsHommeChecked = _useState14[1];
  var _useState15 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false),
    _useState16 = _slicedToArray(_useState15, 2),
    isFemmeChecked = _useState16[0],
    setIsFemmeChecked = _useState16[1];
  var nav = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(0);
  var renderTrigger = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(0);
  var _useState17 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(0),
    _useState18 = _slicedToArray(_useState17, 2),
    itemOffset = _useState18[0],
    setItemOffset = _useState18[1];
  var _useState19 = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(2),
    _useState20 = _slicedToArray(_useState19, 2),
    pageCount = _useState20[0],
    setPageCount = _useState20[1];
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    rendernav();
  }, [isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked, isPediatrieChecked, isHommeChecked, isFemmeChecked]);
  if (!nav.current) {
    var navElement = document.getElementById('nav');
    if (navElement) {
      nav.current = (0,react_dom_client__WEBPACK_IMPORTED_MODULE_2__.createRoot)(navElement);
    } else {
      console.error('Element DOM #nav non trouvé');
      return;
    }
  }
  var rendernav = function rendernav() {
    renderTrigger.current++;
    if (nav.current) {
      nav.current.render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_nav_pagination__WEBPACK_IMPORTED_MODULE_1__["default"], {
        itemsperPage: 15,
        istousChecked: isTousChecked,
        ismammoChecked: isMammoChecked,
        isscannerChecked: isScannerChecked,
        isradioChecked: isRadioChecked,
        isnrdChecked: isNrdChecked,
        isenfantsChecked: isEnfantsChecked,
        isPediatrieChecked: isPediatrieChecked,
        isHommeChecked: isHommeChecked,
        isFemmeChecked: isFemmeChecked
      }, renderTrigger.current));
    }
  };

  /*const [renderCount, setRenderCount] = useState(0);
    const rendernav = useCallback((newProps) => {
    if (nav.current) {
      nav.current.render(
        <NavComponent
          {...newProps}
          key={`nav-${renderCount}`} // Clé unique par rendu
        />
      );
      setRenderCount(c => c + 1); // Force le re-rendu
    }
  }, [renderCount]);
  */
  // Utilisation :
  //rendernav({ filters: updatedFilters });

  //    const updateNav = () => {
  //        if (nav.current) {
  //            nav.current.render(
  //                <PaginatedItems itemsPerPage={15} isTousChecked={isTousChecked} isMammoChecked={isMammoChecked} isScannerChecked={isScannerChecked} isRadioChecked={isRadioChecked} isNrdChecked={isNrdChecked} isEnfantsChecked={isEnfantsChecked} />
  //              );
  //        }
  //      };

  var manageechebox = function manageechebox(e, name) {
    //console.log(name);
    if (name != 'handleTousChange') {
      if (e.target.checked) {
        setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
        _istousChecked = e.target.checked;
        //          console.log(isTousChecked);
        //         console.log((isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked || isMammoChecked));
        //          console.log(isMammoChecked);
      } else {
        // console.log(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked ||  e.target.checked));
        if (name == 'handleEnfantsChange') {
          setIsTousChecked(!(isScannerChecked || isRadioChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
          _isenfantsChecked = e.target.checked;
        }
        if (name == 'handleMammoChange') {
          setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isNrdChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
          _ismammoChecked = e.target.checked;
        }
        if (name == 'handleScannerChange') {
          setIsTousChecked(!(isEnfantsChecked || isRadioChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
          _isscannerChecked = e.target.checked;
        }
        if (name == 'handleRadioChange') {
          setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isNrdChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
          _isradioChecked = e.target.checked;
        }
        if (name == 'handleNrdoChange') {
          setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isFemmeChecked || e.target.checked));
          _isnrdChecked = e.target.checked;
        }
        if (name == 'handlePediatrieChange') {
          setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isHommeChecked || isFemmeChecked || isNrdChecked || e.target.checked));
          _ispediatrieChecked = e.target.checked;
        }
        if (name == 'handleHommeChange') {
          setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isPediatrieChecked || isFemmeChecked || isNrdChecked || e.target.checked));
          _ishommeChecked = e.target.checked;
        }
        if (name == 'handleFemmeChange') {
          setIsTousChecked(!(isEnfantsChecked || isScannerChecked || isRadioChecked || isMammoChecked || isPediatrieChecked || isHommeChecked || isNrdChecked || e.target.checked));
          _isfemmeChecked = e.target.checked;
        }
      }
    } else {
      if (e.target.checked) {
        setIsEnfantsChecked(false);
        setIsMammoChecked(false);
        setIsScannerChecked(false);
        setIsRadioChecked(false);
        setIsNrdChecked(false);
        setIsPediatrieChecked(false);
        setIsHommeChecked(false);
        setIsFemmeChecked(false);
      } else setIsTousChecked(true);
    }
  };
  var handleTousChange = function handleTousChange(e) {
    setIsTousChecked(e.target.checked);
    manageechebox(e, 'handleTousChange');
    rendernav(isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked, isMammoChecked, isPediatrieChecked, isHommeChecked, isFemmeChecked);
    // console.log('setIsTousChecked');
  };

  // Invoke when user click to request another page.
  var handlePageClick = function handlePageClick(event) {
    var newOffset = event.selected * itemsPerPage % items.length;
    //console.log(
    //  `User requested page number ${event.selected}, which is offset ${newOffset}`
    //);
    setItemOffset(newOffset);
  };
  var handleEnfantsChange = function handleEnfantsChange(e) {
    setIsEnfantsChecked(e.target.checked);
    manageechebox(e, 'handleEnfantsChange');
    rendernav(e.target.checked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked, isPediatrieChecked, isHommeChecked, isFemmeChecked);
    //  console.log('setIsEnfantsChecked');
  };
  var handleMammoChange = function handleMammoChange(e) {
    setIsMammoChecked(e.target.checked);
    manageechebox(e, 'handleMammoChange');
    //  console.log('setIsMammoChecked');
    rendernav(isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, e.target.checked, isPediatrieChecked, isHommeChecked, isFemmeChecked);
  };
  var handleScannerChange = function handleScannerChange(e) {
    setIsScannerChecked(e.target.checked);
    manageechebox(e, 'handleScannerChange');
    //  console.log('setIsScannerChecked');
    rendernav(isEnfantsChecked, e.target.checked, isRadioChecked, isNrdChecked, isMammoChecked, isPediatrieChecked, isHommeChecked, isFemmeChecked);
  };
  var handleRadioChange = function handleRadioChange(e) {
    setIsRadioChecked(e.target.checked);
    manageechebox(e, 'handleRadioChange');
    //  console.log('setIsRadioChecked');
    rendernav(isEnfantsChecked, isScannerChecked, e.target.checked, isNrdChecked, isMammoChecked, isPediatrieChecked, isHommeChecked, isFemmeChecked);
  };
  var handleNrdoChange = function handleNrdoChange(e) {
    setIsNrdChecked(e.target.checked);
    manageechebox(e, 'handleNrdoChange');
    //  console.log('setIsNrdChecked');
    rendernav(isEnfantsChecked, isScannerChecked, isRadioChecked, e.target.checked, isMammoChecked, isPediatrieChecked, isHommeChecked, isFemmeChecked);
  };
  var handlePediatrieChange = function handlePediatrieChange(e) {
    setIsPediatrieChecked(e.target.checked);
    manageechebox(e, 'handlePediatrieChange');
    //  console.log('setIsNrdChecked');
    rendernav(isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked, e.target.checked, isHommeChecked, isFemmeChecked);
  };
  var handleHommeChange = function handleHommeChange(e) {
    setIsHommeChecked(e.target.checked);
    if (e.target.checked) setIsFemmeChecked(!e.target.checked);
    manageechebox(e, 'handleHommeChange');
    //  console.log('setIsNrdChecked');
    rendernav(isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked, isPediatrieChecked, e.target.checked, !e.target.checked);
  };
  var handleFemmeChange = function handleFemmeChange(e) {
    setIsFemmeChecked(e.target.checked);
    if (e.target.checked) setIsHommeChecked(!e.target.checked);
    manageechebox(e, 'handleFemmeChange');
    //  console.log('setIsNrdChecked');
    rendernav(isEnfantsChecked, isScannerChecked, isRadioChecked, isNrdChecked, isMammoChecked, isPediatrieChecked, !e.target.checked, e.target.checked);
  };
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
    className: "row",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
      className: "col-md-4",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "tous",
          checked: isTousChecked,
          onChange: handleTousChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "tous",
          children: "Tous"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "mamo",
          checked: isMammoChecked,
          onChange: handleMammoChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "mamo",
          children: "Mammographie"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "scanner",
          checked: isScannerChecked,
          onChange: handleScannerChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "scanner",
          children: "Scanner"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "radio",
          checked: isRadioChecked,
          onChange: handleRadioChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "radio",
          children: "Radiographie"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "nrd",
          checked: isNrdChecked,
          onChange: handleNrdoChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "nrd",
          children: "Nrd"
        })]
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
      className: "col-md-4",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "enfants",
          checked: isPediatrieChecked,
          onChange: handlePediatrieChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "enfants",
          children: "P\xE9diatrie"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "Homme",
          checked: isHommeChecked,
          onChange: handleHommeChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "Homme",
          children: "Homme"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "form-check form-switch",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("input", {
          className: "form-check-input",
          type: "checkbox",
          role: "switch",
          id: "Femme",
          checked: isFemmeChecked,
          onChange: handleFemmeChange
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("label", {
          className: "form-check-label",
          htmlFor: "Femme",
          children: "Femme"
        })]
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
      className: "col-md-4",
      children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
        className: "form-check form-switch",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_ProtocolSelector__WEBPACK_IMPORTED_MODULE_4__["default"], {})
      })
    })]
  });
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Filter);

/***/ }),

/***/ "./assets/nav/pagination.jsx":
/*!***********************************!*\
  !*** ./assets/nav/pagination.jsx ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _card_card__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../card/card */ "./assets/card/card.jsx");
/* harmony import */ var _spinner_spinner__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../spinner/spinner */ "./assets/spinner/spinner.jsx");
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react-dom/client */ "./node_modules/react-dom/client.js");
/* harmony import */ var react_paginate__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! react-paginate */ "./node_modules/react-paginate/dist/react-paginate.js");
/* harmony import */ var react_paginate__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(react_paginate__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }





//const spinRef = useRef(null);
//const [current, setCurrent] = useState(this);
var current = null;


var getelements = function getelements(pos) {
  // console.log('element at : '+pos+' auther lement==>'+current.limit);
  current.load();
};
var handlePageClick = function handlePageClick(event) {
  current.offset = event.selected * current.limit; //) % current.totalNotFiltered;
  //currentpage=event.selected;
  //console.log(event);
  //current.setoffset(offset);
  getelements(event.selected);
  // console.log(
  //   `User requested page number ${event.selected}, which is offset ${current.offset}, ${current.limit}, ${current.totalNotFiltered}`
  // );
  //console.log('event======>');
  //console.log(event);
};
var handleOnClick = function handleOnClick(event) {
  //console.log("---------------------handleOnClick---------------------");

  current.currentpage = event.nextSelectedPage;
  ///if(event.isPrevious)
  //  event.nextSelectedPage=current.currentpage-1
  //if(event.isNext)
  //  event.nextSelectedPage=current.currentpage+1
  //console.log(current);
  //console.log(event);
};
var PaginatedItems = /*#__PURE__*/function (_Component) {
  function PaginatedItems() {
    var _this;
    _classCallCheck(this, PaginatedItems);
    _this = _callSuper(this, PaginatedItems);
    _this.pageCount = 1;
    _this.totalNotFiltered = 0;
    _this.total = 0;
    _this.offset = 0;
    _this.nextSelectedPage = 1;
    _this.currentpage = 0;
    _this.state = {
      loading: true,
      itemsperPage: _this.itemsperPage
    };
    //console.log(this.state );
    _this.spinRef = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createRef();
    _this.patients = null;

    //const [current, setCurrent] = useState(this);
    return _this;
  }
  _inherits(PaginatedItems, _Component);
  return _createClass(PaginatedItems, [{
    key: "setoffset",
    value: function setoffset(offset) {
      this.offset = offset;
      this.setState({
        loading: false
      });
    }
  }, {
    key: "componentDidMount",
    value: function componentDidMount() {
      current = this;
      this.limit = this.props.itemsperPage;
      //his.offset=1;
      this.setparameter();
      //if (!nav.current) {
      var spinElement = document.getElementById('patients');
      if (spinElement) {
        this.patients = (0,react_dom_client__WEBPACK_IMPORTED_MODULE_3__.createRoot)(spinElement);
        //this.renderSpin();
        //}
      }
      this.load();
    }
  }, {
    key: "calcNbItems",
    value: function calcNbItems() {
      //console.log(this.props.itemsperPage);
      // Simulate fetching items from another resources.
      // (This could be items from props; or items loaded in a local state
      // from an API endpoint with useEffect and useState)
      this.endOffset = this.offset + this.limit;
      //console.log(`Loading items from ${this.offset } to ${this.endOffset}`);
      //const currentItems = items.slice(itemOffset, endOffset);
      this.pageCount = Math.ceil(this.totalNotFiltered / this.limit);
    }
  }, {
    key: "setparameter",
    value: function setparameter() {
      this.filter = "";
      if (this.props.istousChecked) this.filter = "";
      if (this.props.ismammoChecked) this.filter = this.filter + "&havemammo=1";
      if (this.props.isscannerChecked) this.filter = this.filter + "&havescanner=1";
      if (this.props.isradioChecked) this.filter = this.filter + "&haveradio=1";
      if (this.props.isnrdChecked) this.filter = this.filter + "&nrdhavealerte=1";
      if (this.props.isPediatrieChecked) this.filter = this.filter + "&ispediatrie=1";
      if (this.props.isHommeChecked) this.filter = this.filter + "&ishomme=1";
      if (this.props.isFemmeChecked) this.filter = this.filter + "&isfemme=1";
      //console.log('this.filter: '+this.filter);
    }
  }, {
    key: "renderpatients",
    value: function renderpatients(rows) {
      this.rows = rows;
      //const patients = createRoot(document.getElementById('patients')); 
      //console.log(this.pageCount);
      this.patients.render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsxs)("div", {
        className: "row",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: "col-md-12 pagination justify-content-end",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)((react_paginate__WEBPACK_IMPORTED_MODULE_4___default()), {
            breakLabel: "...",
            forcePage: this.currentpage,
            nextLabel: "next >",
            onPageChange: handlePageClick,
            onClick: handleOnClick,
            pageRangeDisplayed: 3,
            pageCount: this.pageCount,
            previousLabel: "< previous",
            renderOnZeroPageCount: null,
            disableInitialCallback: true,
            pageClassName: "page-item",
            pageLinkClassName: "page-link",
            previousClassName: "page-item",
            previousLinkClassName: "page-link",
            nextClassName: "page-item",
            nextLinkClassName: "page-link",
            breakClassName: "page-item",
            breakLinkClassName: "page-link",
            containerClassName: "pagination",
            activeClassName: "active"
          }, "".concat(this.offset))
        }), this.loadpatients()]
      }));
    }
  }, {
    key: "renderspin",
    value: function renderspin() {
      if (this.patients) {
        this.patients.render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: "row",
          children: this.spin()
        }));
      }
    }
  }, {
    key: "load",
    value: function load() {
      var _this2 = this;
      this.setparameter();
      this.urljsonpatients = window.location.protocol + "//" + window.location.host + "/" + jsonpatientspathname;
      this.urljsonpatients = this.urljsonpatients + '?limit=' + this.limit + '&offset=' + this.offset + this.filter;
      //console.log(this.urljsonpatients);
      this.renderspin();
      fetch(this.urljsonpatients).then(function (response) {
        return response.json();
      }).then(function (result) {
        return _this2.traiterretourpatiens(result);
      });
    }
  }, {
    key: "traiterretourpatiens",
    value: function traiterretourpatiens(result) {
      //console.log(result);

      this.setState({
        loading: false,
        listepatients: result.rows
      });
      //console.log(result);
      this.totalNotFiltered = result.totalNotFiltered;
      this.total = result.total;
      //console.log(this.state.listepatients);
      this.calcNbItems();
      this.renderpatients(result.rows);
    }
  }, {
    key: "spin",
    value: function spin() {
      //console.log('spinpatients');
      return (0,_spinner_spinner__WEBPACK_IMPORTED_MODULE_2__["default"])();
    }
    //loadnav(){
    //   return <div className="col-md-12" id='navigation'>Navigation</div>
    //}
  }, {
    key: "lstpatients",
    value: function lstpatients() {
      var listpatients = this.rows.map(function (patient) {
        var _patient$id;
        return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: "col-md-4",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)(_card_card__WEBPACK_IMPORTED_MODULE_1__["default"], {
            patient: patient
          }, (_patient$id = patient.id) !== null && _patient$id !== void 0 ? _patient$id : "patient-".concat(index))
        }, "dv-".concat(patient.id));
      });
      return listpatients;
    }
  }, {
    key: "loadpatients",
    value: function loadpatients() {
      //console.log('loadpatients');
      //console.log(this.rows);

      //console.log(listpatients);
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
        className: "col-md-12",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
          className: "row",
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
            className: "col-md-12",
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
              className: "row",
              id: "listepatients",
              children: this.lstpatients()
            })
          })
        })
      });
    }
  }, {
    key: "createPatients",
    value: function createPatients() {
      return this.state.loading ? this.spin() : this.loadpatients();
    }
  }, {
    key: "render",
    value: function render() {
      return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_5__.jsx)("div", {
        className: "row"
      });
    }
  }]);
}(react__WEBPACK_IMPORTED_MODULE_0__.Component);
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (PaginatedItems);

/***/ }),

/***/ "./assets/patients.js":
/*!****************************!*\
  !*** ./assets/patients.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom/client */ "./node_modules/react-dom/client.js");
/* harmony import */ var _filter_filter__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./filter/filter */ "./assets/filter/filter.jsx");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");


//import AllPatients from './patient/patients';


//console.log(parameters);
//const param=searchParams.get("limit")
//console.log(param);

var filter = (0,react_dom_client__WEBPACK_IMPORTED_MODULE_1__.createRoot)(document.getElementById('filter'));
//const patients = createRoot(document.getElementById('patients'));

filter.render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_filter_filter__WEBPACK_IMPORTED_MODULE_2__["default"], {
  parameters: parameters
}));

/***/ }),

/***/ "./assets/spinner/spinner.jsx":
/*!************************************!*\
  !*** ./assets/spinner/spinner.jsx ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react_icons_fa__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react-icons/fa */ "./node_modules/react-icons/fa/index.mjs");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "./node_modules/react/index.js");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "./node_modules/react/jsx-runtime.js");



function spinner() {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("div", {
    className: "col-md-12",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("center", {
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(react_icons_fa__WEBPACK_IMPORTED_MODULE_2__.FaSpinner, {
        icon: "spinner",
        className: "spinner"
      }), " Chargement... "]
    })
  });
}
;
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (spinner);

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_jquery-loading_dist_jquery_loading_js-node_modules_multiselect-react-dro-51560c"], () => (__webpack_exec__("./assets/patients.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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O0lBQzVEO0VBQUM7SUFBQW5ULEdBQUE7SUFBQUMsS0FBQSxFQUVBLFNBQUE2RCxNQUFNQSxDQUFBLEVBQUc7TUFDQyxvQkFDRzFFLHNEQUFBO1FBQUtzQyxTQUFTLEVBQUM7TUFBSyxDQUVmLENBQUM7SUFHbEI7RUFBQztBQUFBLEVBeE15QjVDLDRDQUFTO0FBME10QyxpRUFBZWlNLGNBQWM7Ozs7Ozs7Ozs7Ozs7Ozs7QUNuUEg7QUFDb0I7QUFDOUM7QUFDcUM7O0FBRXJDO0FBQ0E7QUFDQTtBQUFBO0FBRUEsSUFBTWpCLE1BQU0sR0FBR3pCLDREQUFVLENBQUNnRyxRQUFRLENBQUNDLGNBQWMsQ0FBQyxRQUFRLENBQUMsQ0FBQztBQUM1RDs7QUFFQXhFLE1BQU0sQ0FBQ2hHLE1BQU0sY0FFTjFFLHNEQUFBLENBQUM4TCxzREFBTTtFQUFDNEksVUFBVSxFQUFFQTtBQUFXLENBQUMsQ0FDdkMsQ0FBQzs7Ozs7Ozs7Ozs7Ozs7Ozs7O0FDZjBDO0FBQ0o7QUFBQTtBQUN2QyxTQUFTRSxPQUFPQSxDQUFBLEVBQUc7RUFDZixvQkFDSTVVLHNEQUFBO0lBQUtzQyxTQUFTLEVBQUMsV0FBVztJQUFBQyxRQUFBLGVBQ3RCckMsdURBQUE7TUFBQXFDLFFBQUEsZ0JBQVF2QyxzREFBQSxDQUFDMlUscURBQVM7UUFBQ0UsSUFBSSxFQUFDLFNBQVM7UUFBQ3ZTLFNBQVMsRUFBQztNQUFTLENBQUUsQ0FBQyxtQkFBZTtJQUFBLENBQVE7RUFBQyxDQUM5RSxDQUFDO0FBRWY7QUFBQztBQUNELGlFQUFlc1MsT0FBTyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9jYXJkL2NhcmQuanN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9maWx0ZXIvUHJvdG9jb2xTZWxlY3Rvci5qc3giLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2ZpbHRlci9maWx0ZXIuanN4Iiwid2VicGFjazovLy8uL2Fzc2V0cy9uYXYvcGFnaW5hdGlvbi5qc3giLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3BhdGllbnRzLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9zcGlubmVyL3NwaW5uZXIuanN4Il0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBSZWFjdCwge0NvbXBvbmVudCxjcmVhdGVDb250ZXh0fSBmcm9tICdyZWFjdCc7XHJcbmltcG9ydCB7IEZhRXhjbGFtYXRpb24gIH0gZnJvbSBcInJlYWN0LWljb25zL2ZhXCI7XHJcbmltcG9ydCBTcGlubmVyIGZyb20gJy4uL3NwaW5uZXIvc3Bpbm5lcidcclxuaW1wb3J0ICQgZnJvbSAnanF1ZXJ5JztcclxuaW1wb3J0ICdqcXVlcnktbG9hZGluZyc7IFxyXG5cclxuY2xhc3MgQ2FyZCBleHRlbmRzIENvbXBvbmVudCB7XHJcbiAgY29uc3RydWN0b3IoKSB7XHJcbiAgICBzdXBlcigpO1xyXG4gICAgdGhpcy5zdGF0ZSA9IHsgbG9hZGluZzogdHJ1ZX07XHJcbiAgfVxyXG5cclxuICBjb21wb25lbnREaWRNb3VudCgpIHtcclxuICAgIHRoaXMuaW1hZ2UgPSB0aGlzLmNob3NlaW1hZ2UoKTtcclxuICAgIHRoaXMudGl0bGUgPSB0aGlzLmNob3NlVGl0bGUoKTtcclxuICAgIHRoaXMudGV4dGNvbG9yPXRoaXMuY2hvc2VDb2xvcigpO1xyXG4gICAgLy90aGlzLm5yZD1hZmZpY2hlck5yZCgpO1xyXG4gICAgLy89YWZmaWNoZXJOcmQ7XHJcbiAgICB0aGlzLnNldFN0YXRlKHsgbG9hZGluZzogZmFsc2UsaW1hZ2U6dGhpcy5pbWFnZSx0aXRsZTp0aGlzLnRpdGxlLHBhdGllbnQ6dGhpcy5wcm9wcy5wYXRpZW50fSlcclxuICB9XHJcblxyXG4gIGNob3NlaW1hZ2UoKSB7XHJcbiAgICAvL2NvbnNvbGUubG9nKHRoaXMucHJvcHMuY2FyZFR5cGUpO1xyXG4gICAgaWYodGhpcy5wcm9wcy5wYXRpZW50LmhhdmVtYW1tbylcclxuICAgICAgcmV0dXJuICcuLi9pbWFnZXMvTWFtbW9ncmFwaGllLmpwZWcnO1xyXG4gICAgaWYodGhpcy5wcm9wcy5wYXRpZW50LmhhdmVyYWRpbylcclxuICAgICAgcmV0dXJuICcuLi9pbWFnZXMvUmFkaW9ncmFwaGllLmpwZyc7XHJcbiAgICBpZih0aGlzLnByb3BzLnBhdGllbnQuaGF2ZXNjYW5uZXIpXHJcbiAgICAgIHJldHVybiAnLi4vaW1hZ2VzL3NjYW5uZXIuanBlZyc7XHJcbiAgICByZXR1cm4gJy4uL2ltYWdlcy9zY2FubmVyLmpwZWcnOztcclxuXHJcbiAgfVxyXG4gIGNob3NlVGl0bGUoKSB7XHJcbiAgICBpZih0aGlzLnByb3BzLnBhdGllbnQuaGF2ZW1hbW1vKVxyXG4gICAgICByZXR1cm4gJ01hbW1vZ3JhcGhpZSc7XHJcbiAgICBpZih0aGlzLnByb3BzLnBhdGllbnQuaGF2ZXJhZGlvKVxyXG4gICAgICByZXR1cm4gJ1JhZGlvZ3JhcGhpZSc7XHJcbiAgICBpZih0aGlzLnByb3BzLnBhdGllbnQuaGF2ZXNjYW5uZXIpXHJcbiAgICAgIHJldHVybiAnU2Nhbm5lcic7XHJcbiAgICByZXR1cm4gJ1NjYW5uZXInO1xyXG4gIH1cclxuXHJcbiAgY2hvc2VDb2xvcigpIHtcclxuICAgIGlmKHRoaXMucHJvcHMucGF0aWVudC5zZXg9PVwiSG9tbWVcIilcclxuICAgICAgcmV0dXJuICd0ZXh0LWJsdWUnO1xyXG4gICAgcmV0dXJuICd0ZXh0LXBpbmsnIDtcclxuICB9XHJcblxyXG4gICBDYWxjdWxBZ2UoZGF0ZU5haXNzYW5jZSkgeyBcclxuICAgIHZhciB0b2RheSA9IG5ldyBEYXRlKCk7IFxyXG4gICAgdmFyIGFnZSA9IHRvZGF5LmdldEZ1bGxZZWFyKCkgLSBkYXRlTmFpc3NhbmNlLmdldEZ1bGxZZWFyKCk7XHJcbiAgICB2YXIgbSA9IHRvZGF5LmdldE1vbnRoKCkgLSBkYXRlTmFpc3NhbmNlLmdldE1vbnRoKCk7XHJcbiAgICBpZiAobSA8IDAgfHwgKG0gPT09IDAgJiYgdG9kYXkuZ2V0RGF0ZSgpIDwgZGF0ZU5haXNzYW5jZS5nZXREYXRlKCkpKSB7XHJcbiAgICAgICAgYWdlID0gYWdlIC0gMTtcclxuICAgIH1cclxuICAgIC8vY29uc29sZS5sb2coZGF0ZU5haXNzYW5jZS50b1N0cmluZygpKTtcclxuICAvL2NvbnNvbGUubG9nKGFnZSk7XHJcbiAgICByZXR1cm4gIGFnZTsgLy8gcXVlIGwnb24gcGxhY2UgZGFucyBsZSBpbnB1dCBkJ2lkIEFnZVxyXG59XHJcblxyXG4gIHNwaW4oKXtcclxuICAgLy8gY29uc29sZS5sb2coJ3NwaW4nKTtcclxuICAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cInJvdyBnLTBcIj4gU3Bpbm5lcigpPC9kaXY+O1xyXG5cclxuICB9XHJcblxyXG4gICBmb3JtYXREYXRlKGRhdGUpIHtcclxuICAgIGNvbnN0IGRheSA9IFN0cmluZyhkYXRlLmdldERhdGUoKSkucGFkU3RhcnQoMiwgJzAnKTtcclxuICAgIGNvbnN0IG1vbnRoID0gU3RyaW5nKGRhdGUuZ2V0TW9udGgoKSArIDEpLnBhZFN0YXJ0KDIsICcwJyk7IC8vIExlcyBtb2lzIGNvbW1lbmNlbnQgw6AgMFxyXG4gICAgY29uc3QgeWVhciA9IGRhdGUuZ2V0RnVsbFllYXIoKTtcclxuICAgIHJldHVybiBgJHtkYXl9LyR7bW9udGh9LyR7eWVhcn1gO1xyXG4gIH1cclxuXHJcbiAgZ2V0aW5mb3BhdGllbnQoKXtcclxuXHJcbiAgICAvKiQoJyNtYWluY29udGVudCcpLmxvYWRpbmcoe1xyXG4gICAgICBzdG9wcGFibGU6IHRydWUsXHJcbiAgICAgICAgICBtZXNzYWdlOiAnQ2hhcmdlbWVudC4uLicsXHJcbiAgICAgICAgICB0aGVtZTogJ2RhcmsnXHJcbiAgICAgICAgfSk7Ki9cclxuICAgIC8qJCgnI21haW5jb250ZW50JykubG9hZGluZyh7XHJcbiAgICAgIHRoZW1lOiAnbGlnaHQnLFxyXG4gICAgICBoaWRlQW5pbWF0aW9uOiBmdW5jdGlvbigpIHtcclxuICAgICAgICAkKHRoaXMpLnJlbW92ZSgpOyAvLyBGb3JjZSBsYSBzdXBwcmVzc2lvblxyXG4gICAgICB9XHJcbiAgICB9KTsqL1xyXG4gICAgLy9jb25zb2xlLmxvZyh0aGlzKTsgIFxyXG4gICAgdGhpcy51cmxqc29ucGF0aWVudHM9IHdpbmRvdy5sb2NhdGlvbi5wcm90b2NvbCArIFwiLy9cIiArIHdpbmRvdy5sb2NhdGlvbi5ob3N0O1xyXG5cclxuICAgICQoJyNtYWluY29udGVudCcpLmxvYWQodGhpcy51cmxqc29ucGF0aWVudHMrJy9wYXRpZW50L2luZm9wYXRpZW50LycrdGhpcy5wcm9wcy5wYXRpZW50LmlkKTtcclxuICAgICQoJyN0YWJsZWRldGFpbGNvbnRlbnQnKS5sb2FkKHRoaXMudXJsanNvbnBhdGllbnRzKycvcGF0aWVudC90ZHBhdGllbnQvJyt0aGlzLnByb3BzLnBhdGllbnQuaWQpO1xyXG4gICAgXHJcbiAgICB9XHJcbmFmZmljaGVyTnJkKCl7XHJcbiAgaWYodGhpcy5wcm9wcy5wYXRpZW50Lm5yZGhhdmVhbGVydGU9PVwiMVwiKVxyXG4gICAgcmV0dXJuIDxwIGNsYXNzTmFtZT1cImNhcmQtdGV4dCB0ZXh0LWRhbmdlclwiPk5SRCA8aSBjbGFzcz0nYmkgYmktZXhjbGFtYXRpb24tdHJpYW5nbGUnPjwvaT48L3A+XHJcbiAgZWxzZVxyXG4gICAgcmV0dXJuIDxwIGNsYXNzTmFtZT1cImNhcmQtdGV4dFwiPjwvcD5cclxufVxyXG4gIGxvYWRlZGNhcmQoKXtcclxuICAgLy8gY29uc29sZS5sb2coJ2xvYWRlZGNhcmQnKTtcclxuICAgICAgcmV0dXJuIChcclxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJyb3cgZy0wXCI+ICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJjb2wtbWQtNVwiPlxyXG4gICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwicm93XCI+XHJcbiAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJjb2wtbWQtMTIgdGV4dC11cHBlcmNhc2VcIj48aDQ+PGNlbnRlcj57dGhpcy5zdGF0ZS50aXRsZX08L2NlbnRlcj48L2g0PjwvZGl2PlxyXG4gICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cInJvd1wiPlxyXG4gICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29sLW1kLTEyXCI+PGltZyBzcmM9e3RoaXMuc3RhdGUuaW1hZ2V9IGNsYXNzTmFtZT1cImltZy1mbHVpZCByb3VuZGVkLXN0YXJ0XCIgYWx0PVwiLi4uXCIvPjwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29sLW1kLTEyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJyb3dcIj5cclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29sLW1kLTEyXCI+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8Y2VudGVyPjxwIGNsYXNzTmFtZT1cImNhcmQtdGV4dFwiPk5vbWJyZSBkJ2V4cG9zaXRpb25zPC9wPjwvY2VudGVyPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC0xMlwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPGNlbnRlcj48aDE+PHAgY2xhc3NOYW1lPVwiY2FyZC10ZXh0XCI+PHN0cm9uZyAgY2xhc3NOYW1lPXsodGhpcy5zdGF0ZS5wYXRpZW50LnN1bWhhdmVhbGVydGU9PVwiMVwiKT9cInRleHQtZGFuZ2VyXCI6XCJcIn0+e3RoaXMuc3RhdGUucGF0aWVudC5uYmRvc2VzfTwvc3Ryb25nPjwvcD48L2gxPjwvY2VudGVyPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC0xMlwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgPGNlbnRlcj48aDQ+PHN0cm9uZz57KHRoaXMucHJvcHMucGF0aWVudC5ucmRoYXZlYWxlcnRlPT1cIjFcIik/PHAgY2xhc3NOYW1lPVwiY2FyZC10ZXh0IHRleHQtZGFuZ2VyXCI+TlJEPEZhRXhjbGFtYXRpb24gY2xhc3NOYW1lPVwibXQtbjEgbXItMVwiIC8+PC9wPjo8cCBjbGFzc05hbWU9XCJjYXJkLXRleHRcIj48L3A+fVxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8L3N0cm9uZz48L2g0PjwvY2VudGVyPlxyXG4gICAgICAgICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC03XCI+XHJcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNhcmQtYm9keVwiPlxyXG4gICAgICAgICAgICAgICAgICA8aDUgY2xhc3NOYW1lPSB7XCJjYXJkLXRpdGxlIHRleHQtZW5kIFwiICsgdGhpcy50ZXh0Y29sb3J9PnsodGhpcy5zdGF0ZS5wYXRpZW50LnNleD09XCJIb21tZVwiKT9cIk1vbnNpZXVyIFwiOlwiTWFkYW1lIFwifXt0aGlzLnN0YXRlLnBhdGllbnQubm9tfSB7dGhpcy5zdGF0ZS5wYXRpZW50LnByZW5vbX08L2g1PlxyXG4gICAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJyb3dcIj5cclxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC0xMlwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgPHVsIGNsYXNzTmFtZT1cImxpc3QtZ3JvdXAgbGlzdC1ncm91cC1mbHVzaFwiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8bGkgY2xhc3NOYW1lPVwibGlzdC1ncm91cC1pdGVtIHBiLTEgcHQtMVwiPk7CsCBkb3NzaWVyIDogPHN0cm9uZyBjbGFzc05hbWU9eyB0aGlzLnRleHRjb2xvcn0+e3RoaXMuc3RhdGUucGF0aWVudC5udW1pcHB9PC9zdHJvbmc+PC9saT5cclxuICAgICAgICAgICAgICAgICAgICAgICAgPGxpIGNsYXNzTmFtZT1cImxpc3QtZ3JvdXAtaXRlbSBwYi0xIHB0LTFcIj5Ow6kgbGUgPHN0cm9uZyBjbGFzc05hbWU9eyB0aGlzLnRleHRjb2xvcn0+e3RoaXMuc3RhdGUucGF0aWVudC5kYXRlZGVuYWlzc2FuY2VzdHJpbmd9IDwvc3Ryb25nPjwvbGk+XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIDxsaSBjbGFzc05hbWU9XCJsaXN0LWdyb3VwLWl0ZW0gcGItMSBwdC0xXCI+RGF0ZSBkZXJuaWVyIGV4YW1lbiA6IDxzdHJvbmcgY2xhc3NOYW1lPXsgdGhpcy50ZXh0Y29sb3J9PnsgKHRoaXMuc3RhdGUucGF0aWVudC5kYXRlbGFzdGV4YW0gIT1udWxsKT90aGlzLmZvcm1hdERhdGUobmV3IERhdGUodGhpcy5zdGF0ZS5wYXRpZW50LmRhdGVsYXN0ZXhhbS50aW1lc3RhbXAgKiAxMDAwICkpOiAnSW5jb25udScgfSA8L3N0cm9uZz48L2xpPlxyXG4gICAgICAgICAgICAgICAgICAgICAgICA8bGkgY2xhc3NOYW1lPVwibGlzdC1ncm91cC1pdGVtIHBiLTVcIj5BZ2UgOiAgPHN0cm9uZyBjbGFzc05hbWU9eyB0aGlzLnRleHRjb2xvcn0+e3RoaXMuQ2FsY3VsQWdlKG5ldyBEYXRlKHRoaXMuc3RhdGUucGF0aWVudC5kYXRlbmFpc3NhbmNlLnRpbWVzdGFtcCAqIDEwMDAgKSl9IGFucyA8L3N0cm9uZz48L2xpPlxyXG5cclxuXHJcbiAgICAgICAgICAgICAgICAgICAgICA8L3VsPlxyXG5cclxuICAgICAgICAgICAgICAgICAgICA8L2Rpdj5cclxuXHJcblxyXG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG5cclxuICAgICAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cInJvd1wiPlxyXG4gICAgICAgICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJjb2wtbWQtMTJcIj5cclxuICAgICAgICAgICAgICAgICAgICAgIDxjZW50ZXI+PGJ1dHRvbiBrZXk9e3RoaXMuc3RhdGUucGF0aWVudC5pZH0gdHlwZT1cImJ1dHRvblwiIG9uQ2xpY2s9eygpID0+dGhpcy5nZXRpbmZvcGF0aWVudCgpfSBjbGFzc05hbWU9XCJidG4gYnRuLXNlY29uZGFyeSBidG4tbGcgYnRuLWJsb2NrXCI+SW5mb3JtYXRpb25zIHBhdGllbnQ8L2J1dHRvbj48L2NlbnRlcj5cclxuICAgICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgKTtcclxuICB9XHJcbiAgY3JlYXRlY2FyZCgpe1xyXG4gICAgcmV0dXJuIHRoaXMuc3RhdGUubG9hZGluZz8gdGhpcy5zcGluKCk6dGhpcy5sb2FkZWRjYXJkKCk7XHJcbiAgfVxyXG4gICAgcmVuZGVyKCkge1xyXG4gICAgICByZXR1cm4gKFxyXG4gICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY2FyZCBtYi0zXCIgPlxyXG4gICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIHRoaXMuY3JlYXRlY2FyZCgpXHJcbiAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICk7XHJcbiAgICB9XHJcbiAgfVxyXG4gIFxyXG5leHBvcnQgZGVmYXVsdCBDYXJkOyIsImltcG9ydCBSZWFjdCwgeyBDb21wb25lbnQgfSBmcm9tICdyZWFjdCc7XHJcbmltcG9ydCB7IE11bHRpc2VsZWN0IH0gZnJvbSAnbXVsdGlzZWxlY3QtcmVhY3QtZHJvcGRvd24nO1xyXG5pbXBvcnQgeyBjcmVhdGVSb290IH0gZnJvbSAncmVhY3QtZG9tL2NsaWVudCc7XHJcbmNsYXNzIFByb3RvY29sU2VsZWN0b3IgZXh0ZW5kcyBDb21wb25lbnQge1xyXG4gICAgY29uc3RydWN0b3IocHJvcHMpIHtcclxuICAgICAgICBzdXBlcihwcm9wcyk7XHJcblxyXG4gICAgICAgIC8vIETDqWZpbml0aW9uIGRlIGwnw6l0YXQgaW5pdGlhbFxyXG4gICAgICAgIHRoaXMuc3RhdGUgPSB7XHJcbiAgICAgICAgICAgIG9wdGlvbnM6IFtdLCAvLyBMaXN0ZSBkZSB0b3VzIGxlcyBwcm90b2NvbGVzIGRpc3BvbmlibGVzIHBvdXIgbGUgTXVsdGlzZWxlY3RcclxuICAgICAgICAgICAgc2VsZWN0ZWRQcm90b2NvbHM6IFtdLCAvLyBMaXN0ZSBkZXMgcHJvdG9jb2xlcyBzw6lsZWN0aW9ubsOpcyBwYXIgbCd1dGlsaXNhdGV1clxyXG4gICAgICAgICAgICBsb2FkaW5nOiB0cnVlLCAvLyBJbmRpY2F0ZXVyIGRlIGNoYXJnZW1lbnRcclxuICAgICAgICAgICAgZXJyb3I6IG51bGwgLy8gU3RvY2thZ2UgZGVzIGVycmV1cnMgw6l2ZW50dWVsbGVzXHJcbiAgICAgICAgfTtcclxuXHJcbiAgICAgICAgLy8gTGllciBsZXMgbcOpdGhvZGVzIGRlIGdlc3Rpb24gZCfDqXbDqW5lbWVudHMgw6AgbCdpbnN0YW5jZSBkZSBsYSBjbGFzc2VcclxuICAgICAgICB0aGlzLm9uU2VsZWN0ID0gdGhpcy5vblNlbGVjdC5iaW5kKHRoaXMpO1xyXG4gICAgICAgIHRoaXMub25SZW1vdmUgPSB0aGlzLm9uUmVtb3ZlLmJpbmQodGhpcyk7XHJcbiAgICAgICAgXHJcbiAgICAgICAgdGhpcy5BUElfVVJMID0gXCIvXCIgKyBqc29ucHJvdG9jb2xlc3BhdGhuYW1lO1xyXG4gICAgfVxyXG5cclxuICAgIC8qKlxyXG4gICAgICogQ3ljbGUgZGUgdmllIDogRXjDqWN1dMOpIGFwcsOocyBsZSBtb250YWdlIGluaXRpYWwgZHUgY29tcG9zYW50IGRhbnMgbGUgRE9NLlxyXG4gICAgICogQydlc3QgbCdlbmRyb2l0IGlkw6lhbCBwb3VyIGxlcyBhcHBlbHMgQVBJLlxyXG4gICAgICovXHJcbiAgICBjb21wb25lbnREaWRNb3VudCgpIHtcclxuICAgICAgICB0aGlzLmZldGNoUHJvdG9jb2xzKCk7XHJcbiAgICB9XHJcblxyXG4gICAgLy8gTcOpdGhvZGUgYXN5bmNocm9uZSBwb3VyIGxhIHLDqWN1cMOpcmF0aW9uIGRlcyBkb25uw6llc1xyXG4gICAgYXN5bmMgZmV0Y2hQcm90b2NvbHMoKSB7XHJcbiAgICAgICAgdHJ5IHtcclxuICAgICAgICAgICAgY29uc3QgcmVzcG9uc2UgPSBhd2FpdCBmZXRjaCh0aGlzLkFQSV9VUkwpO1xyXG4gICAgICAgICAgICBpZiAoIXJlc3BvbnNlLm9rKSB7XHJcbiAgICAgICAgICAgICAgICB0aHJvdyBuZXcgRXJyb3IoYEVycmV1ciBIVFRQOiAke3Jlc3BvbnNlLnN0YXR1c31gKTtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBjb25zdCBkYXRhID0gYXdhaXQgcmVzcG9uc2UuanNvbigpO1xyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgY29uc3QgcHJvdG9jb2xMaXN0ID0gZGF0YSB8fCBbXTsgXHJcbiAgICAgICAgICAgIGNvbnNvbGUubG9nKHByb3RvY29sTGlzdCk7XHJcbiAgICAgICAgICAgIC8vIEZvcm1hdGFnZSBkZXMgZG9ubsOpZXMgZW4gb2JqZXRzIHsgbmFtZTogXCIuLi5cIiwgaWQ6IFwiLi4uXCIgfVxyXG4gICAgICAgICAgICBjb25zdCBmb3JtYXR0ZWRPcHRpb25zID0gcHJvdG9jb2xMaXN0XHJcbiAgICAgICAgICAgICAgICAuZmlsdGVyKHByb3RvY29sID0+IHByb3RvY29sICYmIHByb3RvY29sLm5hbWUudHJpbSgpICE9PSAnJyAmJiAhcHJvdG9jb2wubmFtZS5zdGFydHNXaXRoKFwiYidcIikpIFxyXG4gICAgICAgICAgICAgICAgLm1hcChwcm90b2NvbCA9PiAoeyBcclxuICAgICAgICAgICAgICAgICAgICBuYW1lOiBwcm90b2NvbC5uYW1lLnRyaW0oKSwgXHJcbiAgICAgICAgICAgICAgICAgICAgaWQ6IHByb3RvY29sLm5hbWUudHJpbSgpIFxyXG4gICAgICAgICAgICAgICAgfSkpO1xyXG5cclxuICAgICAgICAgICAgLy8gTWlzZSDDoCBqb3VyIGRlIGwnw6l0YXQgYXZlYyBsZXMgZG9ubsOpZXMgcsOpY3Vww6lyw6llc1xyXG4gICAgICAgICAgICB0aGlzLnNldFN0YXRlKHsgXHJcbiAgICAgICAgICAgICAgICBvcHRpb25zOiBmb3JtYXR0ZWRPcHRpb25zLCBcclxuICAgICAgICAgICAgICAgIGxvYWRpbmc6IGZhbHNlIFxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgXHJcbiAgICAgICAgfSBjYXRjaCAoZXJyb3IpIHtcclxuICAgICAgICAgICAgY29uc29sZS5lcnJvcihcIkVycmV1ciBsb3JzIGRlIGxhIHLDqWN1cMOpcmF0aW9uIGRlcyBwcm90b2NvbGVzIDpcIiwgZXJyb3IpO1xyXG4gICAgICAgICAgICAvLyBNaXNlIMOgIGpvdXIgZGUgbCfDqXRhdCBlbiBjYXMgZCdlcnJldXJcclxuICAgICAgICAgICAgdGhpcy5zZXRTdGF0ZSh7IFxyXG4gICAgICAgICAgICAgICAgZXJyb3I6IFwiSW1wb3NzaWJsZSBkZSBjaGFyZ2VyIGxlcyBwcm90b2NvbGVzLlwiLCBcclxuICAgICAgICAgICAgICAgIGxvYWRpbmc6IGZhbHNlIFxyXG4gICAgICAgICAgICB9KTtcclxuICAgICAgICB9XHJcbiAgICB9XHJcblxyXG4gICAgLy8gR2VzdGlvbm5haXJlIGQnw6l2w6luZW1lbnQgcG91ciBsYSBzw6lsZWN0aW9uXHJcbiAgICBvblNlbGVjdChzZWxlY3RlZExpc3QsIHNlbGVjdGVkSXRlbSkge1xyXG4gICAgICAgIHRoaXMuc2V0U3RhdGUoeyBzZWxlY3RlZFByb3RvY29sczogc2VsZWN0ZWRMaXN0IH0pO1xyXG4gICAgICAgIGNvbnNvbGUubG9nKCdQcm90b2NvbGVzIHPDqWxlY3Rpb25uw6lzOicsIHNlbGVjdGVkTGlzdCk7XHJcbiAgICB9XHJcblxyXG4gICAgLy88IS0tIGgzIFPDqWxlY3Rpb24gZGVzIFByb3RvY29sZXMgKE1vZGUgQ2xhc3NlKSBoMyAtLT5cclxuICAgIC8ve3NlbGVjdGVkUHJvdG9jb2xzLmxlbmd0aCA+IDAgJiYgKFxyXG4gICAgLy8gICAgPCEtLSBwXHJcbiAgICAvLyAgICAgICAgVm91cyBhdmV6IHPDqWxlY3Rpb25uw6kgOiB7c2VsZWN0ZWRQcm90b2NvbHMubWFwKHAgPT4gcC5uYW1lKS5qb2luKCcsICcpfVxyXG4gICAgLy8gICAgcCAtLT5cclxuICAgIC8vKX1cclxuICAgIFxyXG4gICAgLy8gR2VzdGlvbm5haXJlIGQnw6l2w6luZW1lbnQgcG91ciBsYSBkw6lzw6lsZWN0aW9uXHJcbiAgICBvblJlbW92ZShzZWxlY3RlZExpc3QsIHJlbW92ZWRJdGVtKSB7XHJcbiAgICAgICAgdGhpcy5zZXRTdGF0ZSh7IHNlbGVjdGVkUHJvdG9jb2xzOiBzZWxlY3RlZExpc3QgfSk7XHJcbiAgICAgICAgY29uc29sZS5sb2coJ1Byb3RvY29sZSByZXRpcsOpLiBMaXN0ZSBhY3R1ZWxsZTonLCBzZWxlY3RlZExpc3QpO1xyXG4gICAgfVxyXG5cclxuICAgIC8qKlxyXG4gICAgICogQ3ljbGUgZGUgdmllIDogUmVuZHUgZHUgY29tcG9zYW50XHJcbiAgICAgKi9cclxuICAgIHJlbmRlcigpIHtcclxuICAgICAgICBjb25zdCB7IG9wdGlvbnMsIHNlbGVjdGVkUHJvdG9jb2xzLCBsb2FkaW5nLCBlcnJvciB9ID0gdGhpcy5zdGF0ZTtcclxuICAgICAgICBcclxuICAgICAgICBpZiAobG9hZGluZykge1xyXG4gICAgICAgICAgICByZXR1cm4gPGRpdj5DaGFyZ2VtZW50IGRlcyBwcm90b2NvbGVzLi4uPC9kaXY+O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgaWYgKGVycm9yKSB7XHJcbiAgICAgICAgICAgIHJldHVybiA8ZGl2IHN0eWxlPXt7IGNvbG9yOiAncmVkJyB9fT5FcnJldXIgOiB7ZXJyb3J9PC9kaXY+O1xyXG4gICAgICAgIH1cclxuXHJcbiAgICAgICAgcmV0dXJuIChcclxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJwcm90b2NvbC1zZWxlY3Rvci1jb250YWluZXJcIj5cclxuICAgICAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgPE11bHRpc2VsZWN0XHJcbiAgICAgICAgICAgICAgICAgICAgb3B0aW9ucz17b3B0aW9uc30gXHJcbiAgICAgICAgICAgICAgICAgICAgc2VsZWN0ZWRWYWx1ZXM9e3NlbGVjdGVkUHJvdG9jb2xzfSBcclxuICAgICAgICAgICAgICAgICAgICBvblNlbGVjdD17dGhpcy5vblNlbGVjdH0gXHJcbiAgICAgICAgICAgICAgICAgICAgb25SZW1vdmU9e3RoaXMub25SZW1vdmV9IFxyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXlWYWx1ZT1cIm5hbWVcIiBcclxuICAgICAgICAgICAgICAgICAgICBwbGFjZWhvbGRlcj1cIlPDqWxlY3Rpb25uZXogdW4gb3UgcGx1c2lldXJzIHByb3RvY29sZXNcIlxyXG4gICAgICAgICAgICAgICAgICAgIHNob3dDaGVja2JveD17dHJ1ZX1cclxuICAgICAgICAgICAgICAgIC8+XHJcblxyXG4gICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICApO1xyXG4gICAgfVxyXG59XHJcblxyXG5leHBvcnQgZGVmYXVsdCBQcm90b2NvbFNlbGVjdG9yOyIsImltcG9ydCBSZWFjdCwge0NvbXBvbmVudCwgdXNlU3RhdGUsIHVzZUVmZmVjdCB9IGZyb20gJ3JlYWN0JztcclxuaW1wb3J0IFBhZ2luYXRlZEl0ZW1zIGZyb20gJy4uL25hdi9wYWdpbmF0aW9uJztcclxuaW1wb3J0IHsgY3JlYXRlUm9vdCB9IGZyb20gJ3JlYWN0LWRvbS9jbGllbnQnO1xyXG5pbXBvcnQgeyB1c2VSZWYgfSBmcm9tICdyZWFjdCc7XHJcbmltcG9ydCBSZWFjdFBhZ2luYXRlIGZyb20gJ3JlYWN0LXBhZ2luYXRlJztcclxuaW1wb3J0IFByb3RvY29sU2VsZWN0b3IgZnJvbSAnLi9Qcm90b2NvbFNlbGVjdG9yJztcclxuXHJcbmZ1bmN0aW9uIEZpbHRlcigpe1xyXG5cclxuICAgIGNvbnN0IFtpc0VuZmFudHNDaGVja2VkLHNldElzRW5mYW50c0NoZWNrZWRdID0gdXNlU3RhdGUoZmFsc2UpO1xyXG4gICAgY29uc3QgW2lzU2Nhbm5lckNoZWNrZWQgLHNldElzU2Nhbm5lckNoZWNrZWRdID0gdXNlU3RhdGUoZmFsc2UpO1xyXG4gICAgY29uc3QgW2lzUmFkaW9DaGVja2VkLHNldElzUmFkaW9DaGVja2VkXSA9IHVzZVN0YXRlKGZhbHNlKTtcclxuICAgIGNvbnN0IFtpc05yZENoZWNrZWQsc2V0SXNOcmRDaGVja2VkXSA9IHVzZVN0YXRlKGZhbHNlKTtcclxuICAgIGNvbnN0IFtpc01hbW1vQ2hlY2tlZCxzZXRJc01hbW1vQ2hlY2tlZF0gPSB1c2VTdGF0ZShmYWxzZSk7XHJcbiAgICBjb25zdCBbaXNUb3VzQ2hlY2tlZCxzZXRJc1RvdXNDaGVja2VkXSA9IHVzZVN0YXRlKHRydWUpO1xyXG4gICAgY29uc3QgW2lzUGVkaWF0cmllQ2hlY2tlZCxzZXRJc1BlZGlhdHJpZUNoZWNrZWRdID0gdXNlU3RhdGUoZmFsc2UpO1xyXG4gICAgY29uc3QgW2lzSG9tbWVDaGVja2VkLHNldElzSG9tbWVDaGVja2VkXSA9IHVzZVN0YXRlKGZhbHNlKTtcclxuICAgIGNvbnN0IFtpc0ZlbW1lQ2hlY2tlZCxzZXRJc0ZlbW1lQ2hlY2tlZF0gPSB1c2VTdGF0ZShmYWxzZSk7XHJcbiAgICBjb25zdCBuYXYgPSB1c2VSZWYoMCk7XHJcbiAgICBjb25zdCByZW5kZXJUcmlnZ2VyID0gdXNlUmVmKDApO1xyXG4gICAgY29uc3QgW2l0ZW1PZmZzZXQsIHNldEl0ZW1PZmZzZXRdID0gdXNlU3RhdGUoMCk7XHJcbiAgICBjb25zdCBbcGFnZUNvdW50LCBzZXRQYWdlQ291bnRdID0gdXNlU3RhdGUoMik7XHJcbiAgIFxyXG4gICAgdXNlRWZmZWN0KCgpID0+IHtcclxuICAgICAgcmVuZGVybmF2KCk7XHJcbiAgICB9LCBbaXNFbmZhbnRzQ2hlY2tlZCwgaXNTY2FubmVyQ2hlY2tlZCwgaXNSYWRpb0NoZWNrZWQsIGlzTnJkQ2hlY2tlZCwgaXNNYW1tb0NoZWNrZWQsaXNQZWRpYXRyaWVDaGVja2VkLGlzSG9tbWVDaGVja2VkLGlzRmVtbWVDaGVja2VkXSk7XHJcblxyXG4gICAgaWYgKCFuYXYuY3VycmVudCkge1xyXG4gICAgICAgIGNvbnN0IG5hdkVsZW1lbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbmF2Jyk7XHJcbiAgICAgICBpZiAobmF2RWxlbWVudCkge1xyXG4gICAgICAgICAgbmF2LmN1cnJlbnQgPSBjcmVhdGVSb290KG5hdkVsZW1lbnQpO1xyXG5cclxuIFxyXG4gICAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgICBjb25zb2xlLmVycm9yKCdFbGVtZW50IERPTSAjbmF2IG5vbiB0cm91dsOpJyk7XHJcbiAgICAgICAgICByZXR1cm47XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcblxyXG4gICAgY29uc3QgcmVuZGVybmF2ID0gKCkgPT4ge1xyXG4gICAgcmVuZGVyVHJpZ2dlci5jdXJyZW50Kys7XHJcbiAgICBpZiAobmF2LmN1cnJlbnQpIHtcclxuICAgICAgICBuYXYuY3VycmVudC5yZW5kZXIoXHJcbiAgICAgICAgICAgIDxQYWdpbmF0ZWRJdGVtcyAga2V5PXtyZW5kZXJUcmlnZ2VyLmN1cnJlbnR9IFxyXG4gICAgICAgICAgICBpdGVtc3BlclBhZ2U9ezE1fSBcclxuICAgICAgICAgICAgaXN0b3VzQ2hlY2tlZD17aXNUb3VzQ2hlY2tlZH0gXHJcbiAgICAgICAgICAgIGlzbWFtbW9DaGVja2VkPXtpc01hbW1vQ2hlY2tlZH0gXHJcbiAgICAgICAgICAgIGlzc2Nhbm5lckNoZWNrZWQ9e2lzU2Nhbm5lckNoZWNrZWR9IFxyXG4gICAgICAgICAgICBpc3JhZGlvQ2hlY2tlZD17aXNSYWRpb0NoZWNrZWR9XHJcbiAgICAgICAgICAgIGlzbnJkQ2hlY2tlZD17aXNOcmRDaGVja2VkfSBcclxuICAgICAgICAgICAgaXNlbmZhbnRzQ2hlY2tlZD17aXNFbmZhbnRzQ2hlY2tlZH0gICAgICAgICAgXHJcbiAgICAgICAgICAgIGlzUGVkaWF0cmllQ2hlY2tlZD17aXNQZWRpYXRyaWVDaGVja2VkfVxyXG4gICAgICAgICAgICBpc0hvbW1lQ2hlY2tlZD17aXNIb21tZUNoZWNrZWR9IFxyXG4gICAgICAgICAgICBpc0ZlbW1lQ2hlY2tlZD17aXNGZW1tZUNoZWNrZWR9IFxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgLz5cclxuICAgICAgICApO1xyXG4gICAgfVxyXG4gICAgfTtcclxuXHJcblxyXG4gICAgLypjb25zdCBbcmVuZGVyQ291bnQsIHNldFJlbmRlckNvdW50XSA9IHVzZVN0YXRlKDApO1xyXG5cclxuICAgIGNvbnN0IHJlbmRlcm5hdiA9IHVzZUNhbGxiYWNrKChuZXdQcm9wcykgPT4ge1xyXG4gICAgICBpZiAobmF2LmN1cnJlbnQpIHtcclxuICAgICAgICBuYXYuY3VycmVudC5yZW5kZXIoXHJcbiAgICAgICAgICA8TmF2Q29tcG9uZW50XHJcbiAgICAgICAgICAgIHsuLi5uZXdQcm9wc31cclxuICAgICAgICAgICAga2V5PXtgbmF2LSR7cmVuZGVyQ291bnR9YH0gLy8gQ2zDqSB1bmlxdWUgcGFyIHJlbmR1XHJcbiAgICAgICAgICAvPlxyXG4gICAgICAgICk7XHJcbiAgICAgICAgc2V0UmVuZGVyQ291bnQoYyA9PiBjICsgMSk7IC8vIEZvcmNlIGxlIHJlLXJlbmR1XHJcbiAgICAgIH1cclxuICAgIH0sIFtyZW5kZXJDb3VudF0pO1xyXG4gICAgKi9cclxuICAgIC8vIFV0aWxpc2F0aW9uIDpcclxuICAgIC8vcmVuZGVybmF2KHsgZmlsdGVyczogdXBkYXRlZEZpbHRlcnMgfSk7XHJcblxyXG4vLyAgICBjb25zdCB1cGRhdGVOYXYgPSAoKSA9PiB7XHJcbi8vICAgICAgICBpZiAobmF2LmN1cnJlbnQpIHtcclxuLy8gICAgICAgICAgICBuYXYuY3VycmVudC5yZW5kZXIoXHJcbi8vICAgICAgICAgICAgICAgIDxQYWdpbmF0ZWRJdGVtcyBpdGVtc1BlclBhZ2U9ezE1fSBpc1RvdXNDaGVja2VkPXtpc1RvdXNDaGVja2VkfSBpc01hbW1vQ2hlY2tlZD17aXNNYW1tb0NoZWNrZWR9IGlzU2Nhbm5lckNoZWNrZWQ9e2lzU2Nhbm5lckNoZWNrZWR9IGlzUmFkaW9DaGVja2VkPXtpc1JhZGlvQ2hlY2tlZH0gaXNOcmRDaGVja2VkPXtpc05yZENoZWNrZWR9IGlzRW5mYW50c0NoZWNrZWQ9e2lzRW5mYW50c0NoZWNrZWR9IC8+XHJcbi8vICAgICAgICAgICAgICApO1xyXG4vLyAgICAgICAgfVxyXG4vLyAgICAgIH07XHJcblxyXG4gICAgY29uc3QgbWFuYWdlZWNoZWJveCA9IChlLG5hbWUpID0+e1xyXG4gICAgICAgIC8vY29uc29sZS5sb2cobmFtZSk7XHJcbiAgICAgICAgaWYgKG5hbWUhPSdoYW5kbGVUb3VzQ2hhbmdlJyl7XHJcblxyXG4gICAgICAgICAgICBpZihlLnRhcmdldC5jaGVja2VkKVxyXG4gICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgIHNldElzVG91c0NoZWNrZWQoIShpc0VuZmFudHNDaGVja2VkIHx8IGlzU2Nhbm5lckNoZWNrZWQgfHwgaXNSYWRpb0NoZWNrZWQgfHwgaXNOcmRDaGVja2VkIHx8IGlzTWFtbW9DaGVja2VkIHx8IGlzUGVkaWF0cmllQ2hlY2tlZCB8fCBpc0hvbW1lQ2hlY2tlZCB8fCBpc0ZlbW1lQ2hlY2tlZCB8fCBlLnRhcmdldC5jaGVja2VkKSk7XHJcbiAgICAgICAgICAgICAgICAgICAgX2lzdG91c0NoZWNrZWQ9IGUudGFyZ2V0LmNoZWNrZWQ7XHJcbiAgICAgICAgICAvLyAgICAgICAgICBjb25zb2xlLmxvZyhpc1RvdXNDaGVja2VkKTtcclxuICAgICAgICAgICAvLyAgICAgICAgIGNvbnNvbGUubG9nKChpc0VuZmFudHNDaGVja2VkIHx8IGlzU2Nhbm5lckNoZWNrZWQgfHwgaXNSYWRpb0NoZWNrZWQgfHwgaXNOcmRDaGVja2VkIHx8IGlzTWFtbW9DaGVja2VkKSk7XHJcbiAgICAgICAgICAvLyAgICAgICAgICBjb25zb2xlLmxvZyhpc01hbW1vQ2hlY2tlZCk7XHJcbiAgICAgICAgICAgICAgICB9ZWxzZVxyXG4gICAgICAgICAgICAgICAge1xyXG5cclxuICAgICAgICAgICAgICAgICAgIC8vIGNvbnNvbGUubG9nKCEoaXNFbmZhbnRzQ2hlY2tlZCB8fCBpc1NjYW5uZXJDaGVja2VkIHx8IGlzUmFkaW9DaGVja2VkIHx8IGlzTnJkQ2hlY2tlZCB8fCAgZS50YXJnZXQuY2hlY2tlZCkpO1xyXG4gICAgICAgICAgICAgICAgICAgIGlmIChuYW1lPT0naGFuZGxlRW5mYW50c0NoYW5nZScpXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHtzZXRJc1RvdXNDaGVja2VkKCEoaXNTY2FubmVyQ2hlY2tlZCB8fCBpc1JhZGlvQ2hlY2tlZCB8fCBpc05yZENoZWNrZWQgfHwgaXNNYW1tb0NoZWNrZWQgfHwgaXNQZWRpYXRyaWVDaGVja2VkIHx8IGlzSG9tbWVDaGVja2VkIHx8IGlzRmVtbWVDaGVja2VkIHx8IGUudGFyZ2V0LmNoZWNrZWQpKTtfaXNlbmZhbnRzQ2hlY2tlZD0gZS50YXJnZXQuY2hlY2tlZDt9XHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKG5hbWU9PSdoYW5kbGVNYW1tb0NoYW5nZScpXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHtzZXRJc1RvdXNDaGVja2VkKCEoaXNFbmZhbnRzQ2hlY2tlZCB8fCBpc1NjYW5uZXJDaGVja2VkIHx8IGlzUmFkaW9DaGVja2VkIHx8IGlzTnJkQ2hlY2tlZCB8fCBpc1BlZGlhdHJpZUNoZWNrZWQgfHwgaXNIb21tZUNoZWNrZWQgfHwgaXNGZW1tZUNoZWNrZWQgfHwgIGUudGFyZ2V0LmNoZWNrZWQpKTtfaXNtYW1tb0NoZWNrZWQ9IGUudGFyZ2V0LmNoZWNrZWQ7fVxyXG4gICAgICAgICAgICAgICAgICAgIGlmIChuYW1lPT0naGFuZGxlU2Nhbm5lckNoYW5nZScpXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHtzZXRJc1RvdXNDaGVja2VkKCEoaXNFbmZhbnRzQ2hlY2tlZCB8fCBpc1JhZGlvQ2hlY2tlZCB8fCBpc05yZENoZWNrZWQgfHwgaXNNYW1tb0NoZWNrZWQgfHwgaXNQZWRpYXRyaWVDaGVja2VkIHx8IGlzSG9tbWVDaGVja2VkIHx8IGlzRmVtbWVDaGVja2VkIHx8IGUudGFyZ2V0LmNoZWNrZWQpKTtfaXNzY2FubmVyQ2hlY2tlZD0gZS50YXJnZXQuY2hlY2tlZDt9XHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKG5hbWU9PSdoYW5kbGVSYWRpb0NoYW5nZScpXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHtzZXRJc1RvdXNDaGVja2VkKCEoaXNFbmZhbnRzQ2hlY2tlZCB8fCBpc1NjYW5uZXJDaGVja2VkIHx8ICBpc05yZENoZWNrZWQgfHwgaXNNYW1tb0NoZWNrZWQgfHwgaXNQZWRpYXRyaWVDaGVja2VkIHx8IGlzSG9tbWVDaGVja2VkIHx8IGlzRmVtbWVDaGVja2VkIHx8IGUudGFyZ2V0LmNoZWNrZWQpKTtfaXNyYWRpb0NoZWNrZWQ9IGUudGFyZ2V0LmNoZWNrZWQ7fVxyXG4gICAgICAgICAgICAgICAgICAgIGlmIChuYW1lPT0naGFuZGxlTnJkb0NoYW5nZScpXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHtzZXRJc1RvdXNDaGVja2VkKCEoaXNFbmZhbnRzQ2hlY2tlZCB8fCBpc1NjYW5uZXJDaGVja2VkIHx8IGlzUmFkaW9DaGVja2VkIHx8IGlzTWFtbW9DaGVja2VkIHx8IGlzUGVkaWF0cmllQ2hlY2tlZCB8fCBpc0hvbW1lQ2hlY2tlZCB8fCBpc0ZlbW1lQ2hlY2tlZCB8fCBlLnRhcmdldC5jaGVja2VkKSk7X2lzbnJkQ2hlY2tlZD0gZS50YXJnZXQuY2hlY2tlZDt9XHJcbiAgICAgICAgICAgICAgICAgICAgaWYgKG5hbWU9PSdoYW5kbGVQZWRpYXRyaWVDaGFuZ2UnKVxyXG4gICAgICAgICAgICAgICAgICAgICAge3NldElzVG91c0NoZWNrZWQoIShpc0VuZmFudHNDaGVja2VkIHx8IGlzU2Nhbm5lckNoZWNrZWQgfHwgaXNSYWRpb0NoZWNrZWQgfHwgaXNNYW1tb0NoZWNrZWQgfHwgaXNIb21tZUNoZWNrZWQgfHwgaXNGZW1tZUNoZWNrZWR8fCBpc05yZENoZWNrZWQgfHwgZS50YXJnZXQuY2hlY2tlZCkpO19pc3BlZGlhdHJpZUNoZWNrZWQ9IGUudGFyZ2V0LmNoZWNrZWQ7fVxyXG4gICAgICAgICAgICAgICAgICAgIGlmIChuYW1lPT0naGFuZGxlSG9tbWVDaGFuZ2UnKVxyXG4gICAgICAgICAgICAgICAgICAgICAge3NldElzVG91c0NoZWNrZWQoIShpc0VuZmFudHNDaGVja2VkIHx8IGlzU2Nhbm5lckNoZWNrZWQgfHwgaXNSYWRpb0NoZWNrZWQgfHwgaXNNYW1tb0NoZWNrZWQgfHwgaXNQZWRpYXRyaWVDaGVja2VkIHx8IGlzRmVtbWVDaGVja2VkIHx8IGlzTnJkQ2hlY2tlZCB8fGUudGFyZ2V0LmNoZWNrZWQpKTtfaXNob21tZUNoZWNrZWQ9IGUudGFyZ2V0LmNoZWNrZWQ7fVxyXG4gICAgICAgICAgICAgICAgICAgIGlmIChuYW1lPT0naGFuZGxlRmVtbWVDaGFuZ2UnKVxyXG4gICAgICAgICAgICAgICAgICAgICAge3NldElzVG91c0NoZWNrZWQoIShpc0VuZmFudHNDaGVja2VkIHx8IGlzU2Nhbm5lckNoZWNrZWQgfHwgaXNSYWRpb0NoZWNrZWQgfHwgaXNNYW1tb0NoZWNrZWQgfHwgaXNQZWRpYXRyaWVDaGVja2VkIHx8IGlzSG9tbWVDaGVja2VkIHx8IGlzTnJkQ2hlY2tlZCB8fGUudGFyZ2V0LmNoZWNrZWQpKTtfaXNmZW1tZUNoZWNrZWQ9IGUudGFyZ2V0LmNoZWNrZWQ7fVxyXG5cclxuXHJcblxyXG4gICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgfWVsc2UgXHJcbiAgICAgICAge1xyXG4gICAgICAgICAgICBpZihlLnRhcmdldC5jaGVja2VkKVxyXG4gICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICAgIHNldElzRW5mYW50c0NoZWNrZWQoZmFsc2UpO1xyXG4gICAgICAgICAgICAgICAgICAgIHNldElzTWFtbW9DaGVja2VkKGZhbHNlKTtcclxuICAgICAgICAgICAgICAgICAgICBzZXRJc1NjYW5uZXJDaGVja2VkKGZhbHNlKTtcclxuICAgICAgICAgICAgICAgICAgICBzZXRJc1JhZGlvQ2hlY2tlZChmYWxzZSk7XHJcbiAgICAgICAgICAgICAgICAgICAgc2V0SXNOcmRDaGVja2VkKGZhbHNlKTtcclxuICAgICAgICAgICAgICAgICAgICBzZXRJc1BlZGlhdHJpZUNoZWNrZWQoZmFsc2UpO1xyXG4gICAgICAgICAgICAgICAgICAgIHNldElzSG9tbWVDaGVja2VkKGZhbHNlKTtcclxuICAgICAgICAgICAgICAgICAgICBzZXRJc0ZlbW1lQ2hlY2tlZChmYWxzZSk7XHJcbiAgICAgICAgICAgICAgICB9ZWxzZVxyXG4gICAgICAgICAgICAgICAgc2V0SXNUb3VzQ2hlY2tlZCh0cnVlKTtcclxuXHJcbiAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgIH1cclxuICAgIGNvbnN0IGhhbmRsZVRvdXNDaGFuZ2UgPSAoZSkgPT4ge1xyXG4gICAgICAgIFxyXG4gICAgICAgIHNldElzVG91c0NoZWNrZWQoZS50YXJnZXQuY2hlY2tlZCk7XHJcbiAgICAgICAgbWFuYWdlZWNoZWJveChlLCdoYW5kbGVUb3VzQ2hhbmdlJyk7XHJcbiAgICAgICAgcmVuZGVybmF2KGlzRW5mYW50c0NoZWNrZWQgLGlzU2Nhbm5lckNoZWNrZWQsIGlzUmFkaW9DaGVja2VkLGlzTnJkQ2hlY2tlZCAsaXNNYW1tb0NoZWNrZWQsIGlzTWFtbW9DaGVja2VkICxpc1BlZGlhdHJpZUNoZWNrZWQsaXNIb21tZUNoZWNrZWQsaXNGZW1tZUNoZWNrZWQpO1xyXG4gICAgICAgLy8gY29uc29sZS5sb2coJ3NldElzVG91c0NoZWNrZWQnKTtcclxuXHJcbiAgICAgIH07XHJcblxyXG4gICAgICAgIC8vIEludm9rZSB3aGVuIHVzZXIgY2xpY2sgdG8gcmVxdWVzdCBhbm90aGVyIHBhZ2UuXHJcbiAgY29uc3QgaGFuZGxlUGFnZUNsaWNrID0gKGV2ZW50KSA9PiB7XHJcbiAgICBjb25zdCBuZXdPZmZzZXQgPSAoZXZlbnQuc2VsZWN0ZWQgKiBpdGVtc1BlclBhZ2UpICUgaXRlbXMubGVuZ3RoO1xyXG4gICAgLy9jb25zb2xlLmxvZyhcclxuICAgIC8vICBgVXNlciByZXF1ZXN0ZWQgcGFnZSBudW1iZXIgJHtldmVudC5zZWxlY3RlZH0sIHdoaWNoIGlzIG9mZnNldCAke25ld09mZnNldH1gXHJcbiAgICAvLyk7XHJcbiAgICBzZXRJdGVtT2Zmc2V0KG5ld09mZnNldCk7XHJcbiAgfTtcclxuXHJcbiAgICBjb25zdCBoYW5kbGVFbmZhbnRzQ2hhbmdlID0gKGUpID0+IHtcclxuICAgICAgICBzZXRJc0VuZmFudHNDaGVja2VkKGUudGFyZ2V0LmNoZWNrZWQpO1xyXG4gICAgICAgIG1hbmFnZWVjaGVib3goZSwnaGFuZGxlRW5mYW50c0NoYW5nZScpO1xyXG4gICAgICAgIHJlbmRlcm5hdihlLnRhcmdldC5jaGVja2VkICxpc1NjYW5uZXJDaGVja2VkLCBpc1JhZGlvQ2hlY2tlZCxpc05yZENoZWNrZWQgLGlzTWFtbW9DaGVja2VkLGlzUGVkaWF0cmllQ2hlY2tlZCxpc0hvbW1lQ2hlY2tlZCxpc0ZlbW1lQ2hlY2tlZCk7XHJcbiAgICAgIC8vICBjb25zb2xlLmxvZygnc2V0SXNFbmZhbnRzQ2hlY2tlZCcpO1xyXG4gICAgICB9O1xyXG4gICAgICBjb25zdCBoYW5kbGVNYW1tb0NoYW5nZSA9IChlKSA9PiB7XHJcbiAgICAgICAgc2V0SXNNYW1tb0NoZWNrZWQoZS50YXJnZXQuY2hlY2tlZCk7XHJcbiAgICAgICAgbWFuYWdlZWNoZWJveChlLCdoYW5kbGVNYW1tb0NoYW5nZScpO1xyXG4gICAgICAvLyAgY29uc29sZS5sb2coJ3NldElzTWFtbW9DaGVja2VkJyk7XHJcbiAgICAgICAgcmVuZGVybmF2KGlzRW5mYW50c0NoZWNrZWQgLGlzU2Nhbm5lckNoZWNrZWQsIGlzUmFkaW9DaGVja2VkLGlzTnJkQ2hlY2tlZCwgZS50YXJnZXQuY2hlY2tlZCxpc1BlZGlhdHJpZUNoZWNrZWQsaXNIb21tZUNoZWNrZWQsaXNGZW1tZUNoZWNrZWQpO1xyXG4gICAgICB9O1xyXG4gICAgICBjb25zdCBoYW5kbGVTY2FubmVyQ2hhbmdlID0gKGUpID0+IHtcclxuICAgICAgICBzZXRJc1NjYW5uZXJDaGVja2VkKGUudGFyZ2V0LmNoZWNrZWQpO1xyXG4gICAgICAgIG1hbmFnZWVjaGVib3goZSwnaGFuZGxlU2Nhbm5lckNoYW5nZScpO1xyXG4gICAgICAvLyAgY29uc29sZS5sb2coJ3NldElzU2Nhbm5lckNoZWNrZWQnKTtcclxuICAgICAgICByZW5kZXJuYXYoaXNFbmZhbnRzQ2hlY2tlZCAsZS50YXJnZXQuY2hlY2tlZCwgaXNSYWRpb0NoZWNrZWQsaXNOcmRDaGVja2VkICxpc01hbW1vQ2hlY2tlZCxpc1BlZGlhdHJpZUNoZWNrZWQsaXNIb21tZUNoZWNrZWQsaXNGZW1tZUNoZWNrZWQpO1xyXG4gICAgICB9O1xyXG4gICAgICBjb25zdCBoYW5kbGVSYWRpb0NoYW5nZSA9IChlKSA9PiB7XHJcbiAgICAgICAgc2V0SXNSYWRpb0NoZWNrZWQoZS50YXJnZXQuY2hlY2tlZCk7XHJcbiAgICAgICAgbWFuYWdlZWNoZWJveChlLCdoYW5kbGVSYWRpb0NoYW5nZScpO1xyXG4gICAgICAvLyAgY29uc29sZS5sb2coJ3NldElzUmFkaW9DaGVja2VkJyk7XHJcbiAgICAgICAgcmVuZGVybmF2KGlzRW5mYW50c0NoZWNrZWQgLGlzU2Nhbm5lckNoZWNrZWQsIGUudGFyZ2V0LmNoZWNrZWQsaXNOcmRDaGVja2VkLGlzTWFtbW9DaGVja2VkLGlzUGVkaWF0cmllQ2hlY2tlZCxpc0hvbW1lQ2hlY2tlZCxpc0ZlbW1lQ2hlY2tlZCk7XHJcbiAgICAgIH07XHJcbiAgICAgIGNvbnN0IGhhbmRsZU5yZG9DaGFuZ2UgPSAoZSkgPT4ge1xyXG4gICAgICAgIHNldElzTnJkQ2hlY2tlZChlLnRhcmdldC5jaGVja2VkKTtcclxuICAgICAgICBtYW5hZ2VlY2hlYm94KGUsJ2hhbmRsZU5yZG9DaGFuZ2UnKTtcclxuICAgICAgLy8gIGNvbnNvbGUubG9nKCdzZXRJc05yZENoZWNrZWQnKTtcclxuICAgICAgICByZW5kZXJuYXYoaXNFbmZhbnRzQ2hlY2tlZCAsaXNTY2FubmVyQ2hlY2tlZCwgaXNSYWRpb0NoZWNrZWQsZS50YXJnZXQuY2hlY2tlZCAsaXNNYW1tb0NoZWNrZWQsaXNQZWRpYXRyaWVDaGVja2VkLGlzSG9tbWVDaGVja2VkLGlzRmVtbWVDaGVja2VkKTtcclxuICAgICAgfTtcclxuXHJcblxyXG4gICAgICBjb25zdCBoYW5kbGVQZWRpYXRyaWVDaGFuZ2UgPSAoZSkgPT4ge1xyXG4gICAgICAgIHNldElzUGVkaWF0cmllQ2hlY2tlZChlLnRhcmdldC5jaGVja2VkKTtcclxuICAgICAgICBtYW5hZ2VlY2hlYm94KGUsJ2hhbmRsZVBlZGlhdHJpZUNoYW5nZScpO1xyXG4gICAgICAvLyAgY29uc29sZS5sb2coJ3NldElzTnJkQ2hlY2tlZCcpO1xyXG4gICAgICAgIHJlbmRlcm5hdihpc0VuZmFudHNDaGVja2VkICxpc1NjYW5uZXJDaGVja2VkLCBpc1JhZGlvQ2hlY2tlZCxpc05yZENoZWNrZWQsaXNNYW1tb0NoZWNrZWQsZS50YXJnZXQuY2hlY2tlZCAsaXNIb21tZUNoZWNrZWQsaXNGZW1tZUNoZWNrZWQpO1xyXG4gICAgICB9O1xyXG5cclxuICAgICAgY29uc3QgaGFuZGxlSG9tbWVDaGFuZ2UgPSAoZSkgPT4ge1xyXG4gICAgICAgIHNldElzSG9tbWVDaGVja2VkKGUudGFyZ2V0LmNoZWNrZWQpO1xyXG4gICAgICAgIGlmKGUudGFyZ2V0LmNoZWNrZWQpXHJcbiAgICAgICAgICBzZXRJc0ZlbW1lQ2hlY2tlZCghZS50YXJnZXQuY2hlY2tlZCk7XHJcbiAgICAgICAgbWFuYWdlZWNoZWJveChlLCdoYW5kbGVIb21tZUNoYW5nZScpO1xyXG4gICAgICAvLyAgY29uc29sZS5sb2coJ3NldElzTnJkQ2hlY2tlZCcpO1xyXG4gICAgICAgIHJlbmRlcm5hdihpc0VuZmFudHNDaGVja2VkICxpc1NjYW5uZXJDaGVja2VkLCBpc1JhZGlvQ2hlY2tlZCxpc05yZENoZWNrZWQsaXNNYW1tb0NoZWNrZWQsaXNQZWRpYXRyaWVDaGVja2VkLGUudGFyZ2V0LmNoZWNrZWQgLCFlLnRhcmdldC5jaGVja2VkKTtcclxuICAgICAgfTtcclxuXHJcblxyXG4gICAgICBjb25zdCBoYW5kbGVGZW1tZUNoYW5nZSA9IChlKSA9PiB7XHJcbiAgICAgICAgc2V0SXNGZW1tZUNoZWNrZWQoZS50YXJnZXQuY2hlY2tlZCk7XHJcbiAgICAgICAgaWYoZS50YXJnZXQuY2hlY2tlZClcclxuICAgICAgICAgc2V0SXNIb21tZUNoZWNrZWQoIWUudGFyZ2V0LmNoZWNrZWQpO1xyXG4gICAgICAgIG1hbmFnZWVjaGVib3goZSwnaGFuZGxlRmVtbWVDaGFuZ2UnKTtcclxuICAgICAgLy8gIGNvbnNvbGUubG9nKCdzZXRJc05yZENoZWNrZWQnKTtcclxuICAgICAgICByZW5kZXJuYXYoaXNFbmZhbnRzQ2hlY2tlZCAsaXNTY2FubmVyQ2hlY2tlZCwgaXNSYWRpb0NoZWNrZWQsaXNOcmRDaGVja2VkICxpc01hbW1vQ2hlY2tlZCxpc1BlZGlhdHJpZUNoZWNrZWQsIWUudGFyZ2V0LmNoZWNrZWQsZS50YXJnZXQuY2hlY2tlZCApO1xyXG4gICAgICB9O1xyXG5cclxuICAgICAgcmV0dXJuIChcclxuICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9J3Jvdyc+XHJcblxyXG4gICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPSdjb2wtbWQtNCc+XHJcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImZvcm0tY2hlY2sgZm9ybS1zd2l0Y2hcIj5cclxuICAgICAgICAgICAgICAgIDxpbnB1dCBjbGFzc05hbWU9XCJmb3JtLWNoZWNrLWlucHV0XCIgdHlwZT1cImNoZWNrYm94XCIgcm9sZT1cInN3aXRjaFwiIGlkPVwidG91c1wiIGNoZWNrZWQ9e2lzVG91c0NoZWNrZWR9IG9uQ2hhbmdlPXtoYW5kbGVUb3VzQ2hhbmdlfS8+XHJcbiAgICAgICAgICAgICAgICA8bGFiZWwgY2xhc3NOYW1lPVwiZm9ybS1jaGVjay1sYWJlbFwiIGh0bWxGb3I9XCJ0b3VzXCI+VG91czwvbGFiZWw+XHJcbiAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiZm9ybS1jaGVjayBmb3JtLXN3aXRjaFwiPlxyXG4gICAgICAgICAgICAgICAgPGlucHV0IGNsYXNzTmFtZT1cImZvcm0tY2hlY2staW5wdXRcIiB0eXBlPVwiY2hlY2tib3hcIiByb2xlPVwic3dpdGNoXCIgaWQ9XCJtYW1vXCIgY2hlY2tlZD17aXNNYW1tb0NoZWNrZWR9IG9uQ2hhbmdlPXtoYW5kbGVNYW1tb0NoYW5nZX0vPlxyXG4gICAgICAgICAgICAgICAgPGxhYmVsIGNsYXNzTmFtZT1cImZvcm0tY2hlY2stbGFiZWxcIiBodG1sRm9yPVwibWFtb1wiPk1hbW1vZ3JhcGhpZTwvbGFiZWw+XHJcbiAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiZm9ybS1jaGVjayBmb3JtLXN3aXRjaFwiPlxyXG4gICAgICAgICAgICAgICAgPGlucHV0IGNsYXNzTmFtZT1cImZvcm0tY2hlY2staW5wdXRcIiB0eXBlPVwiY2hlY2tib3hcIiByb2xlPVwic3dpdGNoXCIgaWQ9XCJzY2FubmVyXCIgY2hlY2tlZD17aXNTY2FubmVyQ2hlY2tlZH0gb25DaGFuZ2U9e2hhbmRsZVNjYW5uZXJDaGFuZ2V9Lz5cclxuICAgICAgICAgICAgICAgIDxsYWJlbCBjbGFzc05hbWU9XCJmb3JtLWNoZWNrLWxhYmVsXCIgaHRtbEZvcj1cInNjYW5uZXJcIj5TY2FubmVyPC9sYWJlbD5cclxuICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJmb3JtLWNoZWNrIGZvcm0tc3dpdGNoXCI+XHJcbiAgICAgICAgICAgICAgICA8aW5wdXQgY2xhc3NOYW1lPVwiZm9ybS1jaGVjay1pbnB1dFwiIHR5cGU9XCJjaGVja2JveFwiIHJvbGU9XCJzd2l0Y2hcIiBpZD1cInJhZGlvXCIgY2hlY2tlZD17aXNSYWRpb0NoZWNrZWR9IG9uQ2hhbmdlPXtoYW5kbGVSYWRpb0NoYW5nZX0vPlxyXG4gICAgICAgICAgICAgICAgPGxhYmVsIGNsYXNzTmFtZT1cImZvcm0tY2hlY2stbGFiZWxcIiBodG1sRm9yPVwicmFkaW9cIj5SYWRpb2dyYXBoaWU8L2xhYmVsPlxyXG4gICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImZvcm0tY2hlY2sgZm9ybS1zd2l0Y2hcIj5cclxuICAgICAgICAgICAgICAgIDxpbnB1dCBjbGFzc05hbWU9XCJmb3JtLWNoZWNrLWlucHV0XCIgdHlwZT1cImNoZWNrYm94XCIgcm9sZT1cInN3aXRjaFwiIGlkPVwibnJkXCIgY2hlY2tlZD17aXNOcmRDaGVja2VkfSBvbkNoYW5nZT17aGFuZGxlTnJkb0NoYW5nZX0vPlxyXG4gICAgICAgICAgICAgICAgPGxhYmVsIGNsYXNzTmFtZT1cImZvcm0tY2hlY2stbGFiZWxcIiBodG1sRm9yPVwibnJkXCI+TnJkPC9sYWJlbD5cclxuICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT0nY29sLW1kLTQnPlxyXG4gICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJmb3JtLWNoZWNrIGZvcm0tc3dpdGNoXCI+XHJcbiAgICAgICAgICAgICAgICA8aW5wdXQgY2xhc3NOYW1lPVwiZm9ybS1jaGVjay1pbnB1dFwiIHR5cGU9XCJjaGVja2JveFwiIHJvbGU9XCJzd2l0Y2hcIiBpZD1cImVuZmFudHNcIiBjaGVja2VkPXtpc1BlZGlhdHJpZUNoZWNrZWR9IG9uQ2hhbmdlPXtoYW5kbGVQZWRpYXRyaWVDaGFuZ2V9Lz5cclxuICAgICAgICAgICAgICAgIDxsYWJlbCBjbGFzc05hbWU9XCJmb3JtLWNoZWNrLWxhYmVsXCIgaHRtbEZvcj1cImVuZmFudHNcIj5Qw6lkaWF0cmllPC9sYWJlbD5cclxuICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJmb3JtLWNoZWNrIGZvcm0tc3dpdGNoXCI+XHJcbiAgICAgICAgICAgICAgICAgIDxpbnB1dCBjbGFzc05hbWU9XCJmb3JtLWNoZWNrLWlucHV0XCIgdHlwZT1cImNoZWNrYm94XCIgcm9sZT1cInN3aXRjaFwiIGlkPVwiSG9tbWVcIiBjaGVja2VkPXtpc0hvbW1lQ2hlY2tlZH0gb25DaGFuZ2U9e2hhbmRsZUhvbW1lQ2hhbmdlfS8+XHJcbiAgICAgICAgICAgICAgICAgIDxsYWJlbCBjbGFzc05hbWU9XCJmb3JtLWNoZWNrLWxhYmVsXCIgaHRtbEZvcj1cIkhvbW1lXCI+SG9tbWU8L2xhYmVsPlxyXG4gICAgICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImZvcm0tY2hlY2sgZm9ybS1zd2l0Y2hcIj5cclxuICAgICAgICAgICAgICAgICAgPGlucHV0IGNsYXNzTmFtZT1cImZvcm0tY2hlY2staW5wdXRcIiB0eXBlPVwiY2hlY2tib3hcIiByb2xlPVwic3dpdGNoXCIgaWQ9XCJGZW1tZVwiIGNoZWNrZWQ9e2lzRmVtbWVDaGVja2VkfSBvbkNoYW5nZT17aGFuZGxlRmVtbWVDaGFuZ2V9Lz5cclxuICAgICAgICAgICAgICAgICAgPGxhYmVsIGNsYXNzTmFtZT1cImZvcm0tY2hlY2stbGFiZWxcIiBodG1sRm9yPVwiRmVtbWVcIj5GZW1tZTwvbGFiZWw+XHJcbiAgICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT0nY29sLW1kLTQnPlxyXG4gICAgICAgICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiZm9ybS1jaGVjayBmb3JtLXN3aXRjaFwiID5cclxuICAgICAgICAgICAgICAgICAgPFByb3RvY29sU2VsZWN0b3IgLz5cclxuICAgICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICA8L2Rpdj5cclxuICAgICAgICAgICk7XHJcbiAgXHJcbn1cclxuICBcclxuZXhwb3J0IGRlZmF1bHQgRmlsdGVyOyIsImltcG9ydCBSZWFjdCwge0NvbXBvbmVudCx1c2VTdGF0ZX0gZnJvbSAncmVhY3QnO1xyXG5pbXBvcnQgQ2FyZCBmcm9tICcuLi9jYXJkL2NhcmQnO1xyXG5pbXBvcnQgU3Bpbm5lciBmcm9tICcuLi9zcGlubmVyL3NwaW5uZXInXHJcbmltcG9ydCB7IGNyZWF0ZVJvb3QgfSBmcm9tICdyZWFjdC1kb20vY2xpZW50JztcclxuaW1wb3J0IHsgdXNlUmVmIH0gZnJvbSAncmVhY3QnO1xyXG4vL2NvbnN0IHNwaW5SZWYgPSB1c2VSZWYobnVsbCk7XHJcbi8vY29uc3QgW2N1cnJlbnQsIHNldEN1cnJlbnRdID0gdXNlU3RhdGUodGhpcyk7XHJcbnZhciBjdXJyZW50PW51bGw7XHJcbmltcG9ydCBSZWFjdFBhZ2luYXRlIGZyb20gJ3JlYWN0LXBhZ2luYXRlJztcclxuXHJcblxyXG5jb25zdCBnZXRlbGVtZW50cyA9IChwb3MpPT57XHJcbiAvLyBjb25zb2xlLmxvZygnZWxlbWVudCBhdCA6ICcrcG9zKycgYXV0aGVyIGxlbWVudD09PicrY3VycmVudC5saW1pdCk7XHJcbiAgY3VycmVudC5sb2FkKCk7XHJcbiAgfVxyXG5cclxuIGNvbnN0IGhhbmRsZVBhZ2VDbGljayA9IChldmVudCk9PntcclxuICBjdXJyZW50Lm9mZnNldD1ldmVudC5zZWxlY3RlZCAqIGN1cnJlbnQubGltaXQ7Ly8pICUgY3VycmVudC50b3RhbE5vdEZpbHRlcmVkO1xyXG4gIC8vY3VycmVudHBhZ2U9ZXZlbnQuc2VsZWN0ZWQ7XHJcbiAgICAvL2NvbnNvbGUubG9nKGV2ZW50KTtcclxuICAgIC8vY3VycmVudC5zZXRvZmZzZXQob2Zmc2V0KTtcclxuICAgIGdldGVsZW1lbnRzKGV2ZW50LnNlbGVjdGVkKTtcclxuICAgLy8gY29uc29sZS5sb2coXHJcbiAgIC8vICAgYFVzZXIgcmVxdWVzdGVkIHBhZ2UgbnVtYmVyICR7ZXZlbnQuc2VsZWN0ZWR9LCB3aGljaCBpcyBvZmZzZXQgJHtjdXJyZW50Lm9mZnNldH0sICR7Y3VycmVudC5saW1pdH0sICR7Y3VycmVudC50b3RhbE5vdEZpbHRlcmVkfWBcclxuICAgLy8gKTtcclxuICAgIC8vY29uc29sZS5sb2coJ2V2ZW50PT09PT09PicpO1xyXG4gICAgLy9jb25zb2xlLmxvZyhldmVudCk7XHJcbiAgICBcclxuICB9O1xyXG5cclxuICBjb25zdCBoYW5kbGVPbkNsaWNrID0oZXZlbnQpPT57XHJcbiAgICAvL2NvbnNvbGUubG9nKFwiLS0tLS0tLS0tLS0tLS0tLS0tLS0taGFuZGxlT25DbGljay0tLS0tLS0tLS0tLS0tLS0tLS0tLVwiKTtcclxuXHJcbiAgICBjdXJyZW50LmN1cnJlbnRwYWdlPSBldmVudC5uZXh0U2VsZWN0ZWRQYWdlO1xyXG4gICAgLy8vaWYoZXZlbnQuaXNQcmV2aW91cylcclxuICAgIC8vICBldmVudC5uZXh0U2VsZWN0ZWRQYWdlPWN1cnJlbnQuY3VycmVudHBhZ2UtMVxyXG4gICAgLy9pZihldmVudC5pc05leHQpXHJcbiAgICAvLyAgZXZlbnQubmV4dFNlbGVjdGVkUGFnZT1jdXJyZW50LmN1cnJlbnRwYWdlKzFcclxuICAgIC8vY29uc29sZS5sb2coY3VycmVudCk7XHJcbiAgICAvL2NvbnNvbGUubG9nKGV2ZW50KTtcclxuICB9XHJcbmNsYXNzIFBhZ2luYXRlZEl0ZW1zIGV4dGVuZHMgQ29tcG9uZW50IHtcclxuICBjb25zdHJ1Y3RvcigpIHtcclxuICAgIHN1cGVyKCk7XHJcbiAgICB0aGlzLnBhZ2VDb3VudD0xO1xyXG4gICAgdGhpcy50b3RhbE5vdEZpbHRlcmVkPTA7XHJcbiAgICB0aGlzLnRvdGFsPTA7XHJcbiAgICB0aGlzLm9mZnNldD0wO1xyXG4gICAgdGhpcy5uZXh0U2VsZWN0ZWRQYWdlPTE7XHJcbiAgICB0aGlzLmN1cnJlbnRwYWdlPTA7XHJcbiAgICB0aGlzLnN0YXRlID0geyBsb2FkaW5nOiB0cnVlLGl0ZW1zcGVyUGFnZTp0aGlzLml0ZW1zcGVyUGFnZX07XHJcbiAgICAvL2NvbnNvbGUubG9nKHRoaXMuc3RhdGUgKTtcclxuICAgIHRoaXMuc3BpblJlZiA9IFJlYWN0LmNyZWF0ZVJlZigpO1xyXG4gICAgdGhpcy5wYXRpZW50cyA9bnVsbDtcclxuICAgIFxyXG4gICAgLy9jb25zdCBbY3VycmVudCwgc2V0Q3VycmVudF0gPSB1c2VTdGF0ZSh0aGlzKTtcclxuICB9XHJcbiAgc2V0b2Zmc2V0KG9mZnNldCl7XHJcbiAgICB0aGlzLm9mZnNldD1vZmZzZXQ7XHJcbiAgICB0aGlzLnNldFN0YXRlKHsgbG9hZGluZzogZmFsc2V9KTtcclxuICB9XHJcbiAgY29tcG9uZW50RGlkTW91bnQoKSB7XHJcbiAgIGN1cnJlbnQ9dGhpcztcclxuICAgdGhpcy5saW1pdD10aGlzLnByb3BzLml0ZW1zcGVyUGFnZTtcclxuICAgLy9oaXMub2Zmc2V0PTE7XHJcbiAgIHRoaXMuc2V0cGFyYW1ldGVyKClcclxuICAgLy9pZiAoIW5hdi5jdXJyZW50KSB7XHJcbiAgIGNvbnN0IHNwaW5FbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3BhdGllbnRzJyk7XHJcbiAgIGlmIChzcGluRWxlbWVudCkge1xyXG4gICAgdGhpcy5wYXRpZW50cz0gY3JlYXRlUm9vdChzcGluRWxlbWVudCk7XHJcbiAgICAgLy90aGlzLnJlbmRlclNwaW4oKTtcclxuICAgLy99XHJcbiAgIH1cclxuXHJcbiAgIHRoaXMubG9hZCgpO1xyXG4gICBcclxufVxyXG5cclxuXHJcbmNhbGNOYkl0ZW1zKCkge1xyXG4gIC8vY29uc29sZS5sb2codGhpcy5wcm9wcy5pdGVtc3BlclBhZ2UpO1xyXG4gIC8vIFNpbXVsYXRlIGZldGNoaW5nIGl0ZW1zIGZyb20gYW5vdGhlciByZXNvdXJjZXMuXHJcbiAgLy8gKFRoaXMgY291bGQgYmUgaXRlbXMgZnJvbSBwcm9wczsgb3IgaXRlbXMgbG9hZGVkIGluIGEgbG9jYWwgc3RhdGVcclxuICAvLyBmcm9tIGFuIEFQSSBlbmRwb2ludCB3aXRoIHVzZUVmZmVjdCBhbmQgdXNlU3RhdGUpXHJcbiAgdGhpcy5lbmRPZmZzZXQgPSB0aGlzLm9mZnNldCArIHRoaXMubGltaXQ7XHJcbiAgLy9jb25zb2xlLmxvZyhgTG9hZGluZyBpdGVtcyBmcm9tICR7dGhpcy5vZmZzZXQgfSB0byAke3RoaXMuZW5kT2Zmc2V0fWApO1xyXG4gIC8vY29uc3QgY3VycmVudEl0ZW1zID0gaXRlbXMuc2xpY2UoaXRlbU9mZnNldCwgZW5kT2Zmc2V0KTtcclxuICB0aGlzLnBhZ2VDb3VudCA9IE1hdGguY2VpbCh0aGlzLnRvdGFsTm90RmlsdGVyZWQgLyB0aGlzLmxpbWl0KTtcclxuXHJcbn1cclxuXHJcbnNldHBhcmFtZXRlcigpe1xyXG4gIHRoaXMuZmlsdGVyPVwiXCI7XHJcbiAgXHJcbiAgXHJcbiAgaWYodGhpcy5wcm9wcy5pc3RvdXNDaGVja2VkKVxyXG4gICAgdGhpcy5maWx0ZXI9XCJcIjtcclxuICBpZih0aGlzLnByb3BzLmlzbWFtbW9DaGVja2VkKVxyXG4gICB0aGlzLmZpbHRlcj10aGlzLmZpbHRlcitcIiZoYXZlbWFtbW89MVwiO1xyXG4gIGlmKHRoaXMucHJvcHMuaXNzY2FubmVyQ2hlY2tlZClcclxuICAgIHRoaXMuZmlsdGVyPXRoaXMuZmlsdGVyK1wiJmhhdmVzY2FubmVyPTFcIjtcclxuICBpZih0aGlzLnByb3BzLmlzcmFkaW9DaGVja2VkKVxyXG4gICAgdGhpcy5maWx0ZXI9dGhpcy5maWx0ZXIrXCImaGF2ZXJhZGlvPTFcIjtcclxuICBpZih0aGlzLnByb3BzLmlzbnJkQ2hlY2tlZClcclxuICAgIHRoaXMuZmlsdGVyPXRoaXMuZmlsdGVyK1wiJm5yZGhhdmVhbGVydGU9MVwiO1xyXG4gIGlmKHRoaXMucHJvcHMuaXNQZWRpYXRyaWVDaGVja2VkKVxyXG4gICAgdGhpcy5maWx0ZXI9dGhpcy5maWx0ZXIrXCImaXNwZWRpYXRyaWU9MVwiO1xyXG4gIGlmKHRoaXMucHJvcHMuaXNIb21tZUNoZWNrZWQpXHJcbiAgICB0aGlzLmZpbHRlcj10aGlzLmZpbHRlcitcIiZpc2hvbW1lPTFcIjtcclxuICBpZih0aGlzLnByb3BzLmlzRmVtbWVDaGVja2VkKVxyXG4gICAgdGhpcy5maWx0ZXI9dGhpcy5maWx0ZXIrXCImaXNmZW1tZT0xXCI7XHJcbiAgLy9jb25zb2xlLmxvZygndGhpcy5maWx0ZXI6ICcrdGhpcy5maWx0ZXIpO1xyXG59XHJcblxyXG5cclxucmVuZGVycGF0aWVudHMocm93cyl7XHJcbiAgdGhpcy5yb3dzPXJvd3M7XHJcbiAgLy9jb25zdCBwYXRpZW50cyA9IGNyZWF0ZVJvb3QoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3BhdGllbnRzJykpOyBcclxuICAvL2NvbnNvbGUubG9nKHRoaXMucGFnZUNvdW50KTtcclxuICB0aGlzLnBhdGllbnRzLnJlbmRlcihcclxuXHJcbiAgICBcclxuICAgIDxkaXYgY2xhc3NOYW1lPVwicm93XCI+XHJcbiAgICAgICAgPGRpdiBjbGFzc05hbWU9J2NvbC1tZC0xMiBwYWdpbmF0aW9uIGp1c3RpZnktY29udGVudC1lbmQnPlxyXG4gICAgICAgICAgPFJlYWN0UGFnaW5hdGVcclxuICAgICAgICAgICAgYnJlYWtMYWJlbD1cIi4uLlwiXHJcbiAgICAgICAgICAgIGZvcmNlUGFnZT17dGhpcy5jdXJyZW50cGFnZX1cclxuICAgICAgICAgICAgbmV4dExhYmVsPVwibmV4dCA+XCJcclxuICAgICAgICAgICAgb25QYWdlQ2hhbmdlPXtoYW5kbGVQYWdlQ2xpY2t9XHJcbiAgICAgICAgICAgIG9uQ2xpY2s9e2hhbmRsZU9uQ2xpY2t9XHJcbiAgICAgICAgICAgIHBhZ2VSYW5nZURpc3BsYXllZD17M31cclxuICAgICAgICAgICAgcGFnZUNvdW50PXt0aGlzLnBhZ2VDb3VudH1cclxuICAgICAgICAgICAgcHJldmlvdXNMYWJlbD1cIjwgcHJldmlvdXNcIlxyXG4gICAgICAgICAgICByZW5kZXJPblplcm9QYWdlQ291bnQ9e251bGx9XHJcbiAgICAgICAgICAgIGtleT17YCR7dGhpcy5vZmZzZXR9YH1cclxuICAgICAgICAgICAgZGlzYWJsZUluaXRpYWxDYWxsYmFjaz17dHJ1ZX1cclxuICAgICAgICAgICAgcGFnZUNsYXNzTmFtZT1cInBhZ2UtaXRlbVwiXHJcbiAgICAgICAgICAgIHBhZ2VMaW5rQ2xhc3NOYW1lPVwicGFnZS1saW5rXCJcclxuICAgICAgICAgICAgcHJldmlvdXNDbGFzc05hbWU9XCJwYWdlLWl0ZW1cIlxyXG4gICAgICAgICAgICBwcmV2aW91c0xpbmtDbGFzc05hbWU9XCJwYWdlLWxpbmtcIlxyXG4gICAgICAgICAgICBuZXh0Q2xhc3NOYW1lPVwicGFnZS1pdGVtXCJcclxuICAgICAgICAgICAgbmV4dExpbmtDbGFzc05hbWU9XCJwYWdlLWxpbmtcIlxyXG4gICAgICAgICAgICBicmVha0NsYXNzTmFtZT1cInBhZ2UtaXRlbVwiXHJcbiAgICAgICAgICAgIGJyZWFrTGlua0NsYXNzTmFtZT1cInBhZ2UtbGlua1wiXHJcbiAgICAgICAgICAgIGNvbnRhaW5lckNsYXNzTmFtZT1cInBhZ2luYXRpb25cIlxyXG4gICAgICAgICAgICBhY3RpdmVDbGFzc05hbWU9XCJhY3RpdmVcIlxyXG4gICAgICAgICAgLz5cclxuICAgICAgICA8L2Rpdj5cclxuICAgICAgICB7XHJcbiAgICAgICAgICB0aGlzLmxvYWRwYXRpZW50cygpXHJcbiAgICAgICAgfVxyXG4gICAgPC9kaXY+XHJcbiAgICApO1xyXG59XHJcblxyXG5cclxucmVuZGVyc3Bpbigpe1xyXG4gIGlmICh0aGlzLnBhdGllbnRzKSBcclxuICB7dGhpcy5wYXRpZW50cy5yZW5kZXIoXHJcbiAgICA8ZGl2IGNsYXNzTmFtZT1cInJvd1wiPlxyXG4gICAge1xyXG4gICAgICAgdGhpcy5zcGluKClcclxuICAgICB9XHJcbiAgICA8L2Rpdj5cclxuICAgICk7XHJcbiAgfVxyXG59XHJcblxyXG5cclxubG9hZCgpe1xyXG4gICB0aGlzLnNldHBhcmFtZXRlcigpO1xyXG4gICB0aGlzLnVybGpzb25wYXRpZW50cz0gd2luZG93LmxvY2F0aW9uLnByb3RvY29sICsgXCIvL1wiICsgd2luZG93LmxvY2F0aW9uLmhvc3QgK1wiL1wiK2pzb25wYXRpZW50c3BhdGhuYW1lO1xyXG4gICB0aGlzLnVybGpzb25wYXRpZW50cz0gdGhpcy51cmxqc29ucGF0aWVudHMrJz9saW1pdD0nK3RoaXMubGltaXQrJyZvZmZzZXQ9JysodGhpcy5vZmZzZXQpK3RoaXMuZmlsdGVyO1xyXG4gICAvL2NvbnNvbGUubG9nKHRoaXMudXJsanNvbnBhdGllbnRzKTtcclxuICAgdGhpcy5yZW5kZXJzcGluKCk7XHJcbiAgIGZldGNoKHRoaXMudXJsanNvbnBhdGllbnRzKVxyXG4gICAudGhlbihyZXNwb25zZSA9PnJlc3BvbnNlLmpzb24oKSlcclxuICAgLnRoZW4gKHJlc3VsdCA9PnRoaXMudHJhaXRlcnJldG91cnBhdGllbnMocmVzdWx0KSlcclxufVxyXG5cclxudHJhaXRlcnJldG91cnBhdGllbnMocmVzdWx0KXtcclxuICAgLy9jb25zb2xlLmxvZyhyZXN1bHQpO1xyXG5cclxuICAgdGhpcy5zZXRTdGF0ZSh7IGxvYWRpbmc6IGZhbHNlLGxpc3RlcGF0aWVudHM6cmVzdWx0LnJvd3N9KTtcclxuICAgLy9jb25zb2xlLmxvZyhyZXN1bHQpO1xyXG4gICB0aGlzLnRvdGFsTm90RmlsdGVyZWQ9cmVzdWx0LnRvdGFsTm90RmlsdGVyZWQ7XHJcbiAgIHRoaXMudG90YWw9cmVzdWx0LnRvdGFsO1xyXG4gICAvL2NvbnNvbGUubG9nKHRoaXMuc3RhdGUubGlzdGVwYXRpZW50cyk7XHJcbiAgIHRoaXMuY2FsY05iSXRlbXMoKTtcclxuICAgdGhpcy5yZW5kZXJwYXRpZW50cyhyZXN1bHQucm93cyk7XHJcbn1cclxuXHJcbnNwaW4oKXtcclxuICAgLy9jb25zb2xlLmxvZygnc3BpbnBhdGllbnRzJyk7XHJcbiAgIHJldHVybiBTcGlubmVyKCk7XHJcbiB9XHJcbi8vbG9hZG5hdigpe1xyXG4vLyAgIHJldHVybiA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC0xMlwiIGlkPSduYXZpZ2F0aW9uJz5OYXZpZ2F0aW9uPC9kaXY+XHJcbi8vfVxyXG5cclxubHN0cGF0aWVudHMoKXtcclxuICAgICAgY29uc3QgbGlzdHBhdGllbnRzPXRoaXMucm93cy5tYXAoIHBhdGllbnQgPT57XHJcbiAgICAgICAgcmV0dXJuICA8ZGl2IGtleT17YGR2LSR7cGF0aWVudC5pZH1gfSAgY2xhc3NOYW1lPVwiY29sLW1kLTRcIj5cclxuICAgICAgICAgIDxDYXJkIGtleT17cGF0aWVudC5pZCA/PyBgcGF0aWVudC0ke2luZGV4fWB9IHBhdGllbnQ9e3BhdGllbnR9Lz4gICAgICAgICAgXHJcbiAgICAgICAgPC9kaXY+XHJcbiAgICB9KVxyXG5yZXR1cm4gbGlzdHBhdGllbnRzO1xyXG59XHJcblxyXG5cclxuIGxvYWRwYXRpZW50cygpe1xyXG4gICAvL2NvbnNvbGUubG9nKCdsb2FkcGF0aWVudHMnKTtcclxuICAgLy9jb25zb2xlLmxvZyh0aGlzLnJvd3MpO1xyXG5cclxuXHJcbiAgIC8vY29uc29sZS5sb2cobGlzdHBhdGllbnRzKTtcclxuICAgcmV0dXJuIChcclxuICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC0xMlwiPlxyXG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwicm93XCI+XHJcbiAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cImNvbC1tZC0xMlwiPlxyXG4gICAgICAgICAgICA8ZGl2IGNsYXNzTmFtZT1cInJvd1wiIGlkPSdsaXN0ZXBhdGllbnRzJz5cclxuICAgICAgICAgICAgICAgIHt0aGlzLmxzdHBhdGllbnRzKCl9XHJcbiAgICAgICAgICAgIDwvZGl2PlxyXG4gICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICA8L2Rpdj5cclxuICAgICAgPC9kaXY+XHJcbiAgICk7XHJcblxyXG4gfVxyXG5cclxuIGNyZWF0ZVBhdGllbnRzKCl7XHJcbiAgIHJldHVybiB0aGlzLnN0YXRlLmxvYWRpbmc/IHRoaXMuc3BpbigpOnRoaXMubG9hZHBhdGllbnRzKCk7XHJcbiB9XHJcblxyXG4gIHJlbmRlcigpIHtcclxuICAgICAgICAgICAgcmV0dXJuIChcclxuICAgICAgICAgICAgICAgPGRpdiBjbGFzc05hbWU9XCJyb3dcIj5cclxuXHJcbiAgICAgICAgICAgICAgIDwvZGl2PlxyXG5cclxuICAgICAgICAgICAgKVxyXG4gICB9XHJcbn1cclxuZXhwb3J0IGRlZmF1bHQgUGFnaW5hdGVkSXRlbXM7IiwiaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcclxuaW1wb3J0IHsgY3JlYXRlUm9vdCB9IGZyb20gJ3JlYWN0LWRvbS9jbGllbnQnO1xyXG4vL2ltcG9ydCBBbGxQYXRpZW50cyBmcm9tICcuL3BhdGllbnQvcGF0aWVudHMnO1xyXG5pbXBvcnQgRmlsdGVyIGZyb20gJy4vZmlsdGVyL2ZpbHRlcic7XHJcblxyXG4vL2NvbnNvbGUubG9nKHBhcmFtZXRlcnMpO1xyXG4vL2NvbnN0IHBhcmFtPXNlYXJjaFBhcmFtcy5nZXQoXCJsaW1pdFwiKVxyXG4vL2NvbnNvbGUubG9nKHBhcmFtKTtcclxuXHJcbmNvbnN0IGZpbHRlciA9IGNyZWF0ZVJvb3QoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2ZpbHRlcicpKTtcclxuLy9jb25zdCBwYXRpZW50cyA9IGNyZWF0ZVJvb3QoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3BhdGllbnRzJykpO1xyXG5cclxuZmlsdGVyLnJlbmRlcihcclxuICAgICBcclxuICAgICAgIDxGaWx0ZXIgcGFyYW1ldGVycz17cGFyYW1ldGVyc30vPlxyXG4pOyIsImltcG9ydCB7IEZhU3Bpbm5lciB9IGZyb20gJ3JlYWN0LWljb25zL2ZhJztcclxuaW1wb3J0IFJlYWN0LCB7Q29tcG9uZW50fSBmcm9tICdyZWFjdCc7XHJcbmZ1bmN0aW9uIHNwaW5uZXIoKSB7XHJcbiAgICByZXR1cm4gKFxyXG4gICAgICAgIDxkaXYgY2xhc3NOYW1lPVwiY29sLW1kLTEyXCI+XHJcbiAgICAgICAgICAgIDxjZW50ZXI+PEZhU3Bpbm5lciBpY29uPVwic3Bpbm5lclwiIGNsYXNzTmFtZT1cInNwaW5uZXJcIiAvPiBDaGFyZ2VtZW50Li4uIDwvY2VudGVyPlxyXG4gICAgICAgICA8L2Rpdj5cclxuICAgICApO1xyXG59O1xyXG5leHBvcnQgZGVmYXVsdCBzcGlubmVyOyJdLCJuYW1lcyI6WyJSZWFjdCIsIkNvbXBvbmVudCIsImNyZWF0ZUNvbnRleHQiLCJGYUV4Y2xhbWF0aW9uIiwiU3Bpbm5lciIsIiQiLCJqc3giLCJfanN4IiwianN4cyIsIl9qc3hzIiwiQ2FyZCIsIl9Db21wb25lbnQiLCJfdGhpcyIsIl9jbGFzc0NhbGxDaGVjayIsIl9jYWxsU3VwZXIiLCJzdGF0ZSIsImxvYWRpbmciLCJfaW5oZXJpdHMiLCJfY3JlYXRlQ2xhc3MiLCJrZXkiLCJ2YWx1ZSIsImNvbXBvbmVudERpZE1vdW50IiwiaW1hZ2UiLCJjaG9zZWltYWdlIiwidGl0bGUiLCJjaG9zZVRpdGxlIiwidGV4dGNvbG9yIiwiY2hvc2VDb2xvciIsInNldFN0YXRlIiwicGF0aWVudCIsInByb3BzIiwiaGF2ZW1hbW1vIiwiaGF2ZXJhZGlvIiwiaGF2ZXNjYW5uZXIiLCJzZXgiLCJDYWxjdWxBZ2UiLCJkYXRlTmFpc3NhbmNlIiwidG9kYXkiLCJEYXRlIiwiYWdlIiwiZ2V0RnVsbFllYXIiLCJtIiwiZ2V0TW9udGgiLCJnZXREYXRlIiwic3BpbiIsImNsYXNzTmFtZSIsImNoaWxkcmVuIiwiZm9ybWF0RGF0ZSIsImRhdGUiLCJkYXkiLCJTdHJpbmciLCJwYWRTdGFydCIsIm1vbnRoIiwieWVhciIsImNvbmNhdCIsImdldGluZm9wYXRpZW50IiwidXJsanNvbnBhdGllbnRzIiwid2luZG93IiwibG9jYXRpb24iLCJwcm90b2NvbCIsImhvc3QiLCJsb2FkIiwiaWQiLCJhZmZpY2hlck5yZCIsIm5yZGhhdmVhbGVydGUiLCJsb2FkZWRjYXJkIiwiX3RoaXMyIiwic3JjIiwiYWx0Iiwic3VtaGF2ZWFsZXJ0ZSIsIm5iZG9zZXMiLCJub20iLCJwcmVub20iLCJudW1pcHAiLCJkYXRlZGVuYWlzc2FuY2VzdHJpbmciLCJkYXRlbGFzdGV4YW0iLCJ0aW1lc3RhbXAiLCJkYXRlbmFpc3NhbmNlIiwidHlwZSIsIm9uQ2xpY2siLCJjcmVhdGVjYXJkIiwicmVuZGVyIiwiZSIsInQiLCJyIiwiU3ltYm9sIiwibiIsIml0ZXJhdG9yIiwibyIsInRvU3RyaW5nVGFnIiwiaSIsImMiLCJwcm90b3R5cGUiLCJHZW5lcmF0b3IiLCJ1IiwiT2JqZWN0IiwiY3JlYXRlIiwiX3JlZ2VuZXJhdG9yRGVmaW5lMiIsImYiLCJwIiwieSIsIkciLCJ2IiwiYSIsImQiLCJiaW5kIiwibGVuZ3RoIiwibCIsIlR5cGVFcnJvciIsImNhbGwiLCJkb25lIiwiR2VuZXJhdG9yRnVuY3Rpb24iLCJHZW5lcmF0b3JGdW5jdGlvblByb3RvdHlwZSIsImdldFByb3RvdHlwZU9mIiwic2V0UHJvdG90eXBlT2YiLCJfX3Byb3RvX18iLCJkaXNwbGF5TmFtZSIsIl9yZWdlbmVyYXRvciIsInciLCJkZWZpbmVQcm9wZXJ0eSIsIl9yZWdlbmVyYXRvckRlZmluZSIsImVudW1lcmFibGUiLCJjb25maWd1cmFibGUiLCJ3cml0YWJsZSIsIl9pbnZva2UiLCJhc3luY0dlbmVyYXRvclN0ZXAiLCJQcm9taXNlIiwicmVzb2x2ZSIsInRoZW4iLCJfYXN5bmNUb0dlbmVyYXRvciIsImFyZ3VtZW50cyIsImFwcGx5IiwiX25leHQiLCJfdGhyb3ciLCJfZGVmaW5lUHJvcGVydGllcyIsIl90b1Byb3BlcnR5S2V5IiwiX3RvUHJpbWl0aXZlIiwiX3R5cGVvZiIsInRvUHJpbWl0aXZlIiwiTnVtYmVyIiwiX2dldFByb3RvdHlwZU9mIiwiX3Bvc3NpYmxlQ29uc3RydWN0b3JSZXR1cm4iLCJfaXNOYXRpdmVSZWZsZWN0Q29uc3RydWN0IiwiUmVmbGVjdCIsImNvbnN0cnVjdCIsImNvbnN0cnVjdG9yIiwiX2Fzc2VydFRoaXNJbml0aWFsaXplZCIsIlJlZmVyZW5jZUVycm9yIiwiQm9vbGVhbiIsInZhbHVlT2YiLCJfc2V0UHJvdG90eXBlT2YiLCJNdWx0aXNlbGVjdCIsImNyZWF0ZVJvb3QiLCJQcm90b2NvbFNlbGVjdG9yIiwib3B0aW9ucyIsInNlbGVjdGVkUHJvdG9jb2xzIiwiZXJyb3IiLCJvblNlbGVjdCIsIm9uUmVtb3ZlIiwiQVBJX1VSTCIsImpzb25wcm90b2NvbGVzcGF0aG5hbWUiLCJmZXRjaFByb3RvY29scyIsIl9mZXRjaFByb3RvY29scyIsIl9jYWxsZWUiLCJyZXNwb25zZSIsImRhdGEiLCJwcm90b2NvbExpc3QiLCJmb3JtYXR0ZWRPcHRpb25zIiwiX3QiLCJfY29udGV4dCIsImZldGNoIiwib2siLCJFcnJvciIsInN0YXR1cyIsImpzb24iLCJjb25zb2xlIiwibG9nIiwiZmlsdGVyIiwibmFtZSIsInRyaW0iLCJzdGFydHNXaXRoIiwibWFwIiwic2VsZWN0ZWRMaXN0Iiwic2VsZWN0ZWRJdGVtIiwicmVtb3ZlZEl0ZW0iLCJfdGhpcyRzdGF0ZSIsInN0eWxlIiwiY29sb3IiLCJzZWxlY3RlZFZhbHVlcyIsImRpc3BsYXlWYWx1ZSIsInBsYWNlaG9sZGVyIiwic2hvd0NoZWNrYm94IiwidXNlU3RhdGUiLCJ1c2VFZmZlY3QiLCJQYWdpbmF0ZWRJdGVtcyIsInVzZVJlZiIsIlJlYWN0UGFnaW5hdGUiLCJGaWx0ZXIiLCJfdXNlU3RhdGUiLCJfdXNlU3RhdGUyIiwiX3NsaWNlZFRvQXJyYXkiLCJpc0VuZmFudHNDaGVja2VkIiwic2V0SXNFbmZhbnRzQ2hlY2tlZCIsIl91c2VTdGF0ZTMiLCJfdXNlU3RhdGU0IiwiaXNTY2FubmVyQ2hlY2tlZCIsInNldElzU2Nhbm5lckNoZWNrZWQiLCJfdXNlU3RhdGU1IiwiX3VzZVN0YXRlNiIsImlzUmFkaW9DaGVja2VkIiwic2V0SXNSYWRpb0NoZWNrZWQiLCJfdXNlU3RhdGU3IiwiX3VzZVN0YXRlOCIsImlzTnJkQ2hlY2tlZCIsInNldElzTnJkQ2hlY2tlZCIsIl91c2VTdGF0ZTkiLCJfdXNlU3RhdGUwIiwiaXNNYW1tb0NoZWNrZWQiLCJzZXRJc01hbW1vQ2hlY2tlZCIsIl91c2VTdGF0ZTEiLCJfdXNlU3RhdGUxMCIsImlzVG91c0NoZWNrZWQiLCJzZXRJc1RvdXNDaGVja2VkIiwiX3VzZVN0YXRlMTEiLCJfdXNlU3RhdGUxMiIsImlzUGVkaWF0cmllQ2hlY2tlZCIsInNldElzUGVkaWF0cmllQ2hlY2tlZCIsIl91c2VTdGF0ZTEzIiwiX3VzZVN0YXRlMTQiLCJpc0hvbW1lQ2hlY2tlZCIsInNldElzSG9tbWVDaGVja2VkIiwiX3VzZVN0YXRlMTUiLCJfdXNlU3RhdGUxNiIsImlzRmVtbWVDaGVja2VkIiwic2V0SXNGZW1tZUNoZWNrZWQiLCJuYXYiLCJyZW5kZXJUcmlnZ2VyIiwiX3VzZVN0YXRlMTciLCJfdXNlU3RhdGUxOCIsIml0ZW1PZmZzZXQiLCJzZXRJdGVtT2Zmc2V0IiwiX3VzZVN0YXRlMTkiLCJfdXNlU3RhdGUyMCIsInBhZ2VDb3VudCIsInNldFBhZ2VDb3VudCIsInJlbmRlcm5hdiIsImN1cnJlbnQiLCJuYXZFbGVtZW50IiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsIml0ZW1zcGVyUGFnZSIsImlzdG91c0NoZWNrZWQiLCJpc21hbW1vQ2hlY2tlZCIsImlzc2Nhbm5lckNoZWNrZWQiLCJpc3JhZGlvQ2hlY2tlZCIsImlzbnJkQ2hlY2tlZCIsImlzZW5mYW50c0NoZWNrZWQiLCJtYW5hZ2VlY2hlYm94IiwidGFyZ2V0IiwiY2hlY2tlZCIsIl9pc3RvdXNDaGVja2VkIiwiX2lzZW5mYW50c0NoZWNrZWQiLCJfaXNtYW1tb0NoZWNrZWQiLCJfaXNzY2FubmVyQ2hlY2tlZCIsIl9pc3JhZGlvQ2hlY2tlZCIsIl9pc25yZENoZWNrZWQiLCJfaXNwZWRpYXRyaWVDaGVja2VkIiwiX2lzaG9tbWVDaGVja2VkIiwiX2lzZmVtbWVDaGVja2VkIiwiaGFuZGxlVG91c0NoYW5nZSIsImhhbmRsZVBhZ2VDbGljayIsImV2ZW50IiwibmV3T2Zmc2V0Iiwic2VsZWN0ZWQiLCJpdGVtc1BlclBhZ2UiLCJpdGVtcyIsImhhbmRsZUVuZmFudHNDaGFuZ2UiLCJoYW5kbGVNYW1tb0NoYW5nZSIsImhhbmRsZVNjYW5uZXJDaGFuZ2UiLCJoYW5kbGVSYWRpb0NoYW5nZSIsImhhbmRsZU5yZG9DaGFuZ2UiLCJoYW5kbGVQZWRpYXRyaWVDaGFuZ2UiLCJoYW5kbGVIb21tZUNoYW5nZSIsImhhbmRsZUZlbW1lQ2hhbmdlIiwicm9sZSIsIm9uQ2hhbmdlIiwiaHRtbEZvciIsImdldGVsZW1lbnRzIiwicG9zIiwib2Zmc2V0IiwibGltaXQiLCJoYW5kbGVPbkNsaWNrIiwiY3VycmVudHBhZ2UiLCJuZXh0U2VsZWN0ZWRQYWdlIiwidG90YWxOb3RGaWx0ZXJlZCIsInRvdGFsIiwic3BpblJlZiIsImNyZWF0ZVJlZiIsInBhdGllbnRzIiwic2V0b2Zmc2V0Iiwic2V0cGFyYW1ldGVyIiwic3BpbkVsZW1lbnQiLCJjYWxjTmJJdGVtcyIsImVuZE9mZnNldCIsIk1hdGgiLCJjZWlsIiwicmVuZGVycGF0aWVudHMiLCJyb3dzIiwiYnJlYWtMYWJlbCIsImZvcmNlUGFnZSIsIm5leHRMYWJlbCIsIm9uUGFnZUNoYW5nZSIsInBhZ2VSYW5nZURpc3BsYXllZCIsInByZXZpb3VzTGFiZWwiLCJyZW5kZXJPblplcm9QYWdlQ291bnQiLCJkaXNhYmxlSW5pdGlhbENhbGxiYWNrIiwicGFnZUNsYXNzTmFtZSIsInBhZ2VMaW5rQ2xhc3NOYW1lIiwicHJldmlvdXNDbGFzc05hbWUiLCJwcmV2aW91c0xpbmtDbGFzc05hbWUiLCJuZXh0Q2xhc3NOYW1lIiwibmV4dExpbmtDbGFzc05hbWUiLCJicmVha0NsYXNzTmFtZSIsImJyZWFrTGlua0NsYXNzTmFtZSIsImNvbnRhaW5lckNsYXNzTmFtZSIsImFjdGl2ZUNsYXNzTmFtZSIsImxvYWRwYXRpZW50cyIsInJlbmRlcnNwaW4iLCJqc29ucGF0aWVudHNwYXRobmFtZSIsInJlc3VsdCIsInRyYWl0ZXJyZXRvdXJwYXRpZW5zIiwibGlzdGVwYXRpZW50cyIsImxzdHBhdGllbnRzIiwibGlzdHBhdGllbnRzIiwiX3BhdGllbnQkaWQiLCJpbmRleCIsImNyZWF0ZVBhdGllbnRzIiwicGFyYW1ldGVycyIsIkZhU3Bpbm5lciIsInNwaW5uZXIiLCJpY29uIl0sInNvdXJjZVJvb3QiOiIifQ==