(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["LikeButton"],{

/***/ "./public/assets/LikeButton.js":
/*!*************************************!*\
  !*** ./public/assets/LikeButton.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { return function () { var Super = _getPrototypeOf(Derived), result; if (_isNativeReflectConstruct()) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Date.prototype.toString.call(Reflect.construct(Date, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var LikeButton = /*#__PURE__*/function (_React$Component) {
  "use strict";

  _inherits(LikeButton, _React$Component);

  var _super = _createSuper(LikeButton);

  function LikeButton() {
    _classCallCheck(this, LikeButton);

    return _super.apply(this, arguments);
  }

  _createClass(LikeButton, [{
    key: "render",
    value: function render() {
      return /*#__PURE__*/React.createElement("button", {
        className: "btn btn-success"
      }, " Click "); //return React.createElement("button", {className:"btn"}, "click")
    }
  }]);

  return LikeButton;
}(React.Component);

var elem = document.getElementById("test");
ReactDOM.render(React.createElement(LikeButton), elem); // document.querySelectorAll("div#test").forEach(function(div){
//    ReactDOM.render(React.createElement(LikeButton), div) 
// })

/***/ })

},[["./public/assets/LikeButton.js","runtime"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9wdWJsaWMvYXNzZXRzL0xpa2VCdXR0b24uanMiXSwibmFtZXMiOlsiTGlrZUJ1dHRvbiIsIlJlYWN0IiwiQ29tcG9uZW50IiwiZWxlbSIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJSZWFjdERPTSIsInJlbmRlciIsImNyZWF0ZUVsZW1lbnQiXSwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7SUFBTUEsVTs7Ozs7Ozs7Ozs7Ozs7OzZCQUVNO0FBQ1IsMEJBQU87QUFBUSxpQkFBUyxFQUFDO0FBQWxCLG1CQUFQLENBRFEsQ0FFTDtBQUNGOzs7O0VBTG9CQyxLQUFLLENBQUNDLFM7O0FBUy9CLElBQU1DLElBQUksR0FBR0MsUUFBUSxDQUFDQyxjQUFULENBQXdCLE1BQXhCLENBQWI7QUFDQUMsUUFBUSxDQUFDQyxNQUFULENBQWdCTixLQUFLLENBQUNPLGFBQU4sQ0FBb0JSLFVBQXBCLENBQWhCLEVBQWlERyxJQUFqRCxFLENBQ0E7QUFDQTtBQUNBLEsiLCJmaWxlIjoiTGlrZUJ1dHRvbi5qcyIsInNvdXJjZXNDb250ZW50IjpbImNsYXNzIExpa2VCdXR0b24gZXh0ZW5kcyBSZWFjdC5Db21wb25lbnR7XHJcblxyXG4gICAgcmVuZGVyKCl7XHJcbiAgICByZXR1cm4gPGJ1dHRvbiBjbGFzc05hbWU9XCJidG4gYnRuLXN1Y2Nlc3NcIj4gQ2xpY2sgPC9idXR0b24+XHJcbiAgICAgICAvL3JldHVybiBSZWFjdC5jcmVhdGVFbGVtZW50KFwiYnV0dG9uXCIsIHtjbGFzc05hbWU6XCJidG5cIn0sIFwiY2xpY2tcIilcclxuICAgIH1cclxufVxyXG5cclxuXHJcbmNvbnN0IGVsZW0gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInRlc3RcIilcclxuUmVhY3RET00ucmVuZGVyKFJlYWN0LmNyZWF0ZUVsZW1lbnQoTGlrZUJ1dHRvbiksIGVsZW0pXHJcbi8vIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoXCJkaXYjdGVzdFwiKS5mb3JFYWNoKGZ1bmN0aW9uKGRpdil7XHJcbi8vICAgIFJlYWN0RE9NLnJlbmRlcihSZWFjdC5jcmVhdGVFbGVtZW50KExpa2VCdXR0b24pLCBkaXYpIFxyXG4vLyB9KSJdLCJzb3VyY2VSb290IjoiIn0=