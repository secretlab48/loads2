var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var PackageList = function (_React$Component) {
    _inherits(PackageList, _React$Component);

    function PackageList(props) {
        _classCallCheck(this, PackageList);

        var _this = _possibleConstructorReturn(this, (PackageList.__proto__ || Object.getPrototypeOf(PackageList)).call(this, props));

        _this.state = { packages: [{ title: 'Search Packages...', id: '' }] };
        return _this;
    }

    _createClass(PackageList, [{
        key: 'render',
        value: function render() {
            var _this2 = this;

            return React.createElement(
                'ul',
                { className: "list-group" },
                this.props.items.map(function (item) {
                    return React.createElement(
                        'li',
                        { style: { cursor: 'pointer' }, className: 'list-group-item', id: item.id, onClick: _this2.props.onSelect, 'data-dismiss': 'modal' },
                        item.title
                    );
                })
            );
        }
    }]);

    return PackageList;
}(React.Component);

var PackageSelector = function (_React$Component2) {
    _inherits(PackageSelector, _React$Component2);

    function PackageSelector(props) {
        _classCallCheck(this, PackageSelector);

        var _this3 = _possibleConstructorReturn(this, (PackageSelector.__proto__ || Object.getPrototypeOf(PackageSelector)).call(this, props));

        _this3.state = { value: props.value, term: '', searchResult: [{ id: 0, title: 'Search Package...' }] };
        _this3.change = _this3.change.bind(_this3);
        _this3.search = _this3.search.bind(_this3);
        _this3.getPackageID = _this3.getPackageID.bind(_this3);
        return _this3;
    }

    _createClass(PackageSelector, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            this.search();
        }
    }, {
        key: 'change',
        value: function change(event) {
            this.setState({ term: event.target.value });
        }
    }, {
        key: 'search',
        value: function search() {
            var _this4 = this;

            fetch(wpdmConfig.siteURL + "/wp-json/wpdm/v1/search-package?s=" + this.state.term).then(function (response) {
                return response.json();
            }).then(function (data) {
                _this4.setState({
                    searchResult: data
                });
            });
        }
    }, {
        key: 'getPackageID',
        value: function getPackageID(event) {
            this.props.onChange(event);
            this.setState({ value: event.target.id });
            //this.setAttributes({value: event.target.id});
            this.props.value = event.target.id;
            //console.log(event.target.id);
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
                            { className: 'btn btn-primary btn-sm', 'data-target': '#packageSelectorModal', 'data-toggle': 'modal' },
                            React.createElement('i', { className: 'fas fa-search' })
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: 'media-body' },
                        React.createElement('input', { type: 'text', value: this.props.value, onChange: this.props.onChange, readOnly: "readonly", className: 'form-control input-sm', style: { height: "28px", background: "#ffffff", border: "0px" } })
                    )
                ),
                React.createElement(
                    'div',
                    { className: 'modal fade', id: 'packageSelectorModal', tabIndex: '-1', role: 'dialog', 'aria-labelledby': 'packageSelectorModalLabel' },
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
                                    'Search Package'
                                )
                            ),
                            React.createElement(
                                'div',
                                { className: 'modal-body' },
                                React.createElement(
                                    'div',
                                    { className: 'input-group' },
                                    React.createElement('input', { placeholder: 'Search Product...', onChange: this.change, className: 'form-control', id: 'srcp', type: 'text' }),
                                    React.createElement(
                                        'div',
                                        { className: 'input-group-btn' },
                                        React.createElement(
                                            'button',
                                            { type: 'button', onClick: this.search, className: 'btn btn-default', id: 'srcpnow' },
                                            'Search'
                                        )
                                    )
                                ),
                                React.createElement('br', null),
                                React.createElement(
                                    'div',
                                    { id: 'productlist' },
                                    React.createElement(PackageList, {
                                        onSelect: this.getPackageID,
                                        items: this.state.searchResult
                                    })
                                )
                            )
                        )
                    )
                )
            );
        }
    }]);

    return PackageSelector;
}(React.Component);