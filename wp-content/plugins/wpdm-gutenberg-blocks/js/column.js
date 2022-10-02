var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

/* npx babel --watch ./src --out-dir ../wpdm-gutenberg-blocks/js --presets react-app/prod  */

var _wp$editor = wp.editor,
    InnerBlocks = _wp$editor.InnerBlocks,
    InspectorControls = _wp$editor.InspectorControls,
    BlockControls = _wp$editor.BlockControls,
    ColorPalette = _wp$editor.ColorPalette,
    RichText = _wp$editor.RichText,
    AlignmentToolbar = _wp$editor.AlignmentToolbar,
    MediaUpload = _wp$editor.MediaUpload,
    PanelColorSettings = _wp$editor.PanelColorSettings,
    Inserter = _wp$editor.Inserter;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    ServerSideRender = _wp$components.ServerSideRender,
    Modal = _wp$components.Modal,
    Button = _wp$components.Button,
    PanelBody = _wp$components.PanelBody,
    PanelRow = _wp$components.PanelRow,
    RangeControl = _wp$components.RangeControl,
    ToggleControl = _wp$components.ToggleControl,
    Panel = _wp$components.Panel,
    TreeSelect = _wp$components.TreeSelect,
    RadioControl = _wp$components.RadioControl,
    FontSizePicker = _wp$components.FontSizePicker,
    withFallbackStyles = _wp$components.withFallbackStyles,
    IconButton = _wp$components.IconButton,
    Dashicon = _wp$components.Dashicon,
    Toolbar = _wp$components.Toolbar,
    ResizableBox = _wp$components.ResizableBox;
var registerBlockType = wp.blocks.registerBlockType;
var Fragment = wp.element.Fragment;
var _wp$i18n = wp.i18n,
    __ = _wp$i18n.__,
    _x = _wp$i18n._x;

var ColumnEdit = function (_Component) {
    _inherits(ColumnEdit, _Component);

    function ColumnEdit(props) {
        _classCallCheck(this, ColumnEdit);

        var _this = _possibleConstructorReturn(this, (ColumnEdit.__proto__ || Object.getPrototypeOf(ColumnEdit)).call(this, props));

        console.log(props);
        _this.state = {
            width: props.attributes.width,
            clientId: props.clientId,
            selectedWidth: 0,
            nextWidth: 0,
            selectedBlockWidth: 0,
            nextBlockWidth: 0,
            maxWidth: 999999999,
            resizing: false
        };
        return _this;
    }

    _createClass(ColumnEdit, [{
        key: 'render',
        value: function render() {
            var _props = this.props,
                clientId = _props.clientId,
                attributes = _props.attributes,
                className = _props.className,
                isSelected = _props.isSelected,
                setAttributes = _props.setAttributes,
                backgroundColor = _props.backgroundColor,
                textColor = _props.textColor;
            var width = attributes.width;


            var parentId = wp.data.select('core/block-editor').getBlockRootClientId(clientId);
            var columnBlocks = wp.data.select('core/block-editor').getBlock(clientId);
            var nextBlockClientId = wp.data.select('core/block-editor').getNextBlockClientId(clientId);
            var nextBlockClient = wp.data.select('core/block-editor').getBlock(nextBlockClientId);

            var colID = "#block-" + clientId;
            $(colID).css('width', width + '%');

            return React.createElement(
                Fragment,
                null,
                React.createElement(
                    InspectorControls,
                    null,
                    React.createElement(
                        PanelBody,
                        null,
                        React.createElement(
                            'label',
                            null,
                            'Width:'
                        ),
                        React.createElement('br', null),
                        React.createElement(RangeControl, {
                            value: width,
                            onChange: function onChange(value) {
                                setAttributes({ width: value });
                                $(colID).css('width', value + '%');
                            },
                            min: 20,
                            max: 100,
                            step: 5
                        })
                    )
                ),
                React.createElement(InnerBlocks, {
                    renderAppender: function renderAppender() {
                        return React.createElement(
                            'button',
                            null,
                            'Add'
                        );
                    }
                })
            );
        }
    }, {
        key: 'componentDidMount',
        value: function componentDidMount() {
            console.log("After:");
            console.log(this.state.width);

            var _state = this.state,
                clientId = _state.clientId,
                width = _state.width;


            var parentId = wp.data.select('core/block-editor').getBlockRootClientId(clientId);
            var columnBlocks = wp.data.select('core/block-editor').getBlock(clientId);
            var nextBlockClientId = wp.data.select('core/block-editor').getNextBlockClientId(clientId);
            var nextBlockClient = wp.data.select('core/block-editor').getBlock(nextBlockClientId);

            var colID = "#block-" + clientId;
            $(colID).css('width', width + '%');
        }
    }]);

    return ColumnEdit;
}(Component);

registerBlockType('download-manager/column', {

    title: _x('Column', 'block name'),

    description: __('Add a structured wrapper for column blocks, then add content blocks you’d like to the columns.'),

    keywords: [_x('rows', 'block keyword'), _x('columns', 'block keyword'), _x('layouts', 'block keyword')],
    icon: section,

    category: 'wpdm-blocks',

    attributes: {
        className: {
            type: 'string',
            default: ''
        },
        width: {
            type: 'number',
            default: 50
        }
    },
    supports: {
        inserter: false
    },

    edit: function edit(props) {
        return React.createElement(ColumnEdit, props);
    },
    save: function save(props) {
        var width = props.attributes.width;


        return React.createElement(
            'div',
            { 'data-sdwidth': '100%', style: { width: width + '%', display: 'inline-block' } },
            React.createElement(InnerBlocks.Content, null)
        );
    }
});