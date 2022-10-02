var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var cscount = 0;

var CategoryList = function (_React$Component) {
    _inherits(CategoryList, _React$Component);

    function CategoryList(props) {
        _classCallCheck(this, CategoryList);

        var _this = _possibleConstructorReturn(this, (CategoryList.__proto__ || Object.getPrototypeOf(CategoryList)).call(this, props));

        _this.state = { selected: props.selected.split(','), categories: [] };
        return _this;
    }

    _createClass(CategoryList, [{
        key: 'render',
        value: function render() {
            var _this2 = this;

            return React.createElement(
                'div',
                { className: "row" },
                this.props.items.map(function (item) {
                    var checked = _this2.props.selected.indexOf(item.value) >= 0 ? 'checked' : '';
                    return React.createElement(
                        'label',
                        { className: 'col-md-4', style: { fontWeight: "400", fontSize: '8pt' } },
                        React.createElement('input', { checked: checked, className: 'xcats', style: { margin: "0" }, onClick: _this2.props.onClick, type: "checkbox", value: item.value }),
                        ' ',
                        item.label
                    );
                })
            );
        }
    }]);

    return CategoryList;
}(React.Component);

var CategorySelector = function (_React$Component2) {
    _inherits(CategorySelector, _React$Component2);

    function CategorySelector(props) {
        _classCallCheck(this, CategorySelector);

        var _this3 = _possibleConstructorReturn(this, (CategorySelector.__proto__ || Object.getPrototypeOf(CategorySelector)).call(this, props));

        _this3.state = { value: props.value, term: '', categories: [{ id: 0, title: 'Loading Categories...' }], selected: props.value.split(",") };
        _this3.change = _this3.change.bind(_this3);
        _this3.getCategoryID = _this3.getCategoryID.bind(_this3);
        return _this3;
    }

    _createClass(CategorySelector, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            var _this4 = this;

            var tax = this.props.tax ? this.props.tax : 'wpdmcategory';
            fetch(wpdmConfig.siteURL + "/wp-json/wpdm/v1/categories?tax=" + tax).then(function (response) {
                return response.json();
            }).then(function (data) {
                _this4.setState({
                    categories: data
                });
            });
        }
    }, {
        key: 'change',
        value: function change(event) {
            this.setState({ term: event.target.value });
        }
    }, {
        key: 'getCategoryID',
        value: function getCategoryID(event) {

            var index = this.state.selected.indexOf(event.target.value);
            if (event.target.checked) {
                if (index < 0) this.state.selected[this.state.selected.length] = event.target.value;
            } else {
                if (index >= 0) this.state.selected.splice(index, 1);
            }

            var cats = this.state.selected.join();
            this.setState({ value: cats });
            this.props.value = cats;
            this.props.onChange(cats);
        }
    }, {
        key: 'render',
        value: function render() {
            var blockStyle = {
                margin: "0",
                padding: "4px",
                background: "#ffffff",
                borderRadius: "3px",
                border: "1px solid #dddddd"
            };
            cscount++;
            return React.createElement(
                'div',
                { className: 'form-group' },
                React.createElement(
                    'label',
                    null,
                    this.props.label
                ),
                React.createElement(
                    'div',
                    { className: 'media', style: blockStyle },
                    React.createElement(
                        'div',
                        { className: 'pull-right' },
                        React.createElement(
                            'button',
                            { className: 'btn btn-primary btn-sm', 'data-target': "#packageSelectorModal" + cscount, 'data-toggle': 'modal' },
                            React.createElement('i', { className: 'fas fa-search' })
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: 'media-body' },
                        React.createElement('input', { type: 'text', value: this.props.value, readOnly: "readonly", className: 'form-control input-sm', style: { height: "28px", background: "#ffffff", border: "0px" } })
                    )
                ),
                React.createElement(
                    'div',
                    { className: 'modal fade', id: "packageSelectorModal" + cscount, tabIndex: '-1', role: 'dialog', 'aria-labelledby': 'packageSelectorModalLabel' },
                    React.createElement(
                        'div',
                        { className: 'modal-dialog modal-vertical-centered', role: 'document' },
                        React.createElement(
                            'div',
                            { className: 'modal-content' },
                            React.createElement(
                                'div',
                                { className: 'modal-header' },
                                React.createElement(
                                    'button',
                                    { type: 'button', className: 'close', 'data-dismiss': 'modal', 'aria-label': 'Close' },
                                    React.createElement(
                                        'span',
                                        { 'aria-hidden': 'true' },
                                        '\xD7'
                                    )
                                ),
                                React.createElement(
                                    'h4',
                                    { className: 'modal-title', id: 'packageSelectorModalLabel' },
                                    'Select Category'
                                )
                            ),
                            React.createElement(
                                'div',
                                { className: 'modal-body' },
                                React.createElement(
                                    'div',
                                    { id: 'categorylist' },
                                    React.createElement(CategoryList, {
                                        onClick: this.getCategoryID,
                                        items: this.state.categories,
                                        selected: this.props.value
                                    })
                                )
                            )
                        )
                    )
                )
            );
        }
    }]);

    return CategorySelector;
}(React.Component);