var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var PluginSidebar = wp.editPost.PluginSidebar;
var registerPlugin = wp.plugins.registerPlugin;
var _wp$components = wp.components,
    Button = _wp$components.Button,
    Modal = _wp$components.Modal;
var withState = wp.compose.withState;
var Component = wp.element.Component;

var WPDM_GB_Sidebar = function (_Component) {
    _inherits(WPDM_GB_Sidebar, _Component);

    function WPDM_GB_Sidebar(props) {
        _classCallCheck(this, WPDM_GB_Sidebar);

        var _this = _possibleConstructorReturn(this, (WPDM_GB_Sidebar.__proto__ || Object.getPrototypeOf(WPDM_GB_Sidebar)).call(this, props));

        _this.state = { layouts: [], btnDisabled: false };
        return _this;
    }

    _createClass(WPDM_GB_Sidebar, [{
        key: 'componentDidMount',
        value: function componentDidMount() {
            var _this2 = this;

            fetch(wpdmConfig.siteURL + "/wp-json/wpdm/v1/layouts").then(function (response) {
                return response.json();
            }).then(function (data) {
                _this2.setState({
                    layouts: data
                });
            });
        }
    }, {
        key: 'insertLayout',
        value: function insertLayout(id, panel) {
            var _this3 = this;

            jQuery(panel).addClass('blockui');
            var content = 'ok';
            var el = wp.element.createElement;
            var name = 'core/rawhtml';
            this.setState({
                btnDisabled: true
            });
            fetch(wpdmConfig.siteURL + "/wp-json/wpdm/v1/getlayout?layout=" + id).then(function (response) {
                return response.json();
            }).then(function (data) {
                var insertedBlock = wp.blocks.rawHandler({ HTML: data.content });
                wp.data.dispatch('core/block-editor').insertBlocks(insertedBlock);
                _this3.setState({
                    btnDisabled: false
                });
                jQuery(panel).removeClass('blockui');
            });
        }
    }, {
        key: 'render',
        value: function render() {
            var _this4 = this;

            return React.createElement(
                PluginSidebar,
                {
                    name: 'wpdmgb-sidebar',
                    title: __('Attire Layouts'),
                    icon: "welcome-widgets-menus"
                },
                React.createElement(
                    'div',
                    { className: "w3eden", style: { padding: '10px' } },
                    this.state.layouts.map(function (layout, id) {
                        return React.createElement(
                            'div',
                            { className: "panel panel-default", id: "planel-" + id },
                            React.createElement(
                                'div',
                                { className: "panel-body-p-0" },
                                React.createElement('img', { src: layout.preview, alt: layout.title })
                            ),
                            React.createElement(
                                'div',
                                { className: "panel-footer text-center" },
                                React.createElement(
                                    'button',
                                    { disabled: _this4.state.btnDisabled, onClick: function onClick() {
                                            return _this4.insertLayout(layout.path, "#planel-" + id);
                                        }, className: "button btn btn-block btn-primary btn-insert-layout" },
                                    'Insert Layout'
                                )
                            )
                        );
                    })
                )
            );
        }
    }]);

    return WPDM_GB_Sidebar;
}(Component);

registerPlugin('wpdmgb-sidebar', {
    render: function render() {
        return React.createElement(WPDM_GB_Sidebar, null);
    }
});