var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var WPDMCategoryDropdown = function (_React$Component) {
    _inherits(WPDMCategoryDropdown, _React$Component);

    function WPDMCategoryDropdown(props) {
        _classCallCheck(this, WPDMCategoryDropdown);

        var _this = _possibleConstructorReturn(this, (WPDMCategoryDropdown.__proto__ || Object.getPrototypeOf(WPDMCategoryDropdown)).call(this, props));

        _this.state = { value: props.value, term: '', categories: [{ value: 0, label: 'Loading Categories...' }], selected: props.value };
        _this.change = _this.change.bind(_this);
        return _this;
    }

    _createClass(WPDMCategoryDropdown, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            var _this2 = this;

            wp.apiFetch({ path: "/wpdm/v1/categories" }).then(function (categories) {
                _this2.setState({
                    categories: categories
                });
            });
        }
    }, {
        key: 'change',
        value: function change(event) {
            this.setState({ term: event.target.value });
        }
    }, {
        key: 'render',
        value: function render() {
            return React.createElement(SelectControl, {
                id: "wpdm-thecategory",
                label: "Select Category:",
                value: this.state.value,
                'class': "form-control wpdm-custom-select",
                options: this.state.categories,
                onChange: this.props.onChange
            });
        }
    }]);

    return WPDMCategoryDropdown;
}(React.Component);