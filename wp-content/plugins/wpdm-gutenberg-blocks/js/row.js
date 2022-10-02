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

var RowEdit = function (_Component) {
    _inherits(RowEdit, _Component);

    function RowEdit(props) {
        _classCallCheck(this, RowEdit);

        var _this = _possibleConstructorReturn(this, (RowEdit.__proto__ || Object.getPrototypeOf(RowEdit)).call(this, props));

        _this.state = {
            columns: props.attributes.columns,
            clientId: props.clientId
        };
        return _this;
    }

    _createClass(RowEdit, [{
        key: "render",
        value: function render() {
            var _props = this.props,
                clientId = _props.clientId,
                attributes = _props.attributes,
                className = _props.className,
                isSelected = _props.isSelected,
                setAttributes = _props.setAttributes,
                backgroundColor = _props.backgroundColor,
                textColor = _props.textColor;
            var columns = attributes.columns;


            var onSelectImage = function onSelectImage(img) {
                setAttributes({
                    sectionBGImage: img.url
                });
            };

            var onRemoveImage = function onRemoveImage() {
                setAttributes({
                    sectionBGImage: null
                    //imgAlt: null,
                });
            };

            /* Default colors */
            var defaultColors = Util.defaultColor();

            var rgba1 = Util.hexToRgba(attributes.sectionBG, attributes.sectionBGAlpha);
            var rgba2 = Util.hexToRgba(attributes.sectionBGx, attributes.sectionBGAlpha);
            var cs1 = attributes.bgCS1 + "%";
            var cs2 = attributes.bgCS2 + "%";
            var overlay = "linear-gradient( " + attributes.gradAngle + "deg, " + rgba1 + " " + cs1 + ", " + rgba2 + " " + cs2 + "),";
            var background = overlay + " " + "url(" + attributes.sectionBGImage + ")";

            var container = attributes.wideContent ? 'container-fluid' : 'container';

            var TEMPLATE = Array.from({ length: columns }, function (_, i) {
                return ['download-manager/column', { placeholder: 'Enter content...' }];
            });
            console.log(TEMPLATE);

            var ALLOWED_BLOCKS = ['download-manager/column'];

            return [React.createElement(
                InspectorControls,
                null,
                React.createElement(
                    "div",
                    { className: "w3eden" },
                    React.createElement(
                        PanelBody,
                        { initialOpen: true },
                        React.createElement(FormToggle, {
                            id: "ever",
                            checked: attributes.wideContent,
                            onChange: function onChange(_wideContent) {
                                setAttributes({ wideContent: _wideContent.target.checked });
                            }
                        }),
                        React.createElement(
                            "label",
                            { htmlFor: "ever", style: { paddingLeft: "5px" } },
                            " Full-width Content"
                        )
                    ),
                    React.createElement(
                        PanelBody,
                        { title: __('Columns'), initialOpen: true },
                        React.createElement(
                            PanelBody,
                            null,
                            React.createElement(RangeControl, {
                                value: attributes.columns,
                                onChange: function onChange(value) {
                                    setAttributes({ columns: value });
                                },
                                min: 1,
                                max: 6,
                                step: 1
                            })
                        )
                    ),
                    React.createElement(
                        PanelBody,
                        { title: __('Background Options'), initialOpen: true },
                        React.createElement(
                            "div",
                            { className: "panel panel-default" },
                            React.createElement(
                                "div",
                                { className: "panel-heading" },
                                __('Background Color Left')
                            ),
                            React.createElement(
                                "div",
                                { className: "panel-body" },
                                React.createElement(ColorPalette, {
                                    disableAlpha: false,
                                    label: __('Background Color'),
                                    value: attributes.sectionBG,
                                    onChange: function onChange(value) {
                                        return setAttributes({ sectionBG: value });
                                    }
                                })
                            )
                        ),
                        React.createElement(
                            "div",
                            { className: "panel panel-default" },
                            React.createElement(
                                "div",
                                { className: "panel-heading" },
                                __('Background Color Right')
                            ),
                            React.createElement(
                                "div",
                                { className: "panel-body" },
                                React.createElement(ColorPalette, {
                                    disableAlpha: false,
                                    label: __('Background Color'),
                                    value: attributes.sectionBGx,
                                    onChange: function onChange(value) {
                                        return setAttributes({ sectionBGx: value });
                                    }
                                })
                            )
                        ),
                        React.createElement(
                            "div",
                            { className: "panel panel-default" },
                            React.createElement(
                                "div",
                                { className: "panel-heading" },
                                __('Select a background image:')
                            ),
                            React.createElement(
                                "div",
                                { className: "panel-body" },
                                React.createElement(MediaUpload, {
                                    onSelect: onSelectImage,
                                    type: "image",
                                    value: attributes.sectionBGImage,
                                    render: function render(_ref) {
                                        var open = _ref.open;
                                        return React.createElement(
                                            "div",
                                            null,
                                            React.createElement(
                                                IconButton,
                                                {
                                                    className: "ab-section-inspector-media",
                                                    label: __('Edit image'),
                                                    icon: "format-image",
                                                    onClick: open
                                                },
                                                __('Select Image')
                                            ),
                                            attributes.sectionBGImage && !!attributes.sectionBGImage.length && React.createElement(
                                                IconButton,
                                                {
                                                    className: "ab-section-inspector-media",
                                                    label: __('Remove Image'),
                                                    icon: "dismiss",
                                                    onClick: onRemoveImage
                                                },
                                                __('Remove')
                                            )
                                        );
                                    }
                                })
                            )
                        ),
                        React.createElement(
                            "div",
                            null,
                            React.createElement(
                                "label",
                                null,
                                "Gradient Angle:"
                            ),
                            React.createElement("br", null),
                            React.createElement(RangeControl, {
                                value: attributes.gradAngle,
                                onChange: function onChange(value) {
                                    return setAttributes({ gradAngle: value });
                                },
                                min: -270,
                                max: 360,
                                step: 1
                            }),
                            React.createElement(
                                "label",
                                null,
                                "Opacity:"
                            ),
                            React.createElement("br", null),
                            React.createElement(RangeControl, {
                                value: attributes.sectionBGAlpha,
                                onChange: function onChange(value) {
                                    return setAttributes({ sectionBGAlpha: value });
                                },
                                min: 0,
                                max: 100,
                                step: 1
                            }),
                            React.createElement(
                                "label",
                                null,
                                "Color #1 Start:"
                            ),
                            React.createElement("br", null),
                            React.createElement(RangeControl, {
                                value: attributes.bgCS1,
                                onChange: function onChange(value) {
                                    return setAttributes({ bgCS1: value });
                                },
                                min: 0,
                                max: 100,
                                step: 1
                            }),
                            React.createElement(
                                "label",
                                null,
                                "Color #2 Start:"
                            ),
                            React.createElement("br", null),
                            React.createElement(RangeControl, {
                                value: attributes.bgCS2,
                                onChange: function onChange(value) {
                                    return setAttributes({ bgCS2: value });
                                },
                                min: 0,
                                max: 100,
                                step: 1
                            })
                        ),
                        attributes.sectionBGImage && !!attributes.sectionBGImage.length && React.createElement(
                            "div",
                            null,
                            React.createElement(
                                "label",
                                null,
                                "Background Size:"
                            ),
                            React.createElement("br", null),
                            React.createElement(SelectControl, {
                                "class": "form-control wpdm-custom-select",
                                value: attributes.sectionBGSize,
                                onChange: function onChange(value) {
                                    return setAttributes({ sectionBGSize: value });
                                },
                                options: [{ label: 'Auto', value: 'bg-auto' }, { label: 'Cover', value: 'bg-cover' }, { label: 'Contain', value: 'bg-contain' }, { label: '100%', value: 'bg-100' }]
                            }),
                            React.createElement(
                                "label",
                                null,
                                "Background Repeat:"
                            ),
                            React.createElement("br", null),
                            React.createElement(SelectControl, {
                                "class": "form-control wpdm-custom-select",
                                value: attributes.sectionBGRepeat,
                                onChange: function onChange(value) {
                                    return setAttributes({ sectionBGRepeat: value });
                                },
                                options: [{ label: 'No Repeat', value: 'bg-no-repeat' }, { label: 'Repeat', value: 'bg-repeat' }, { label: 'Repeat X', value: 'bg-repeat-x' }, { label: 'Repeat Y', value: 'bg-repeat-y' }]
                            })
                        )
                    )
                )
            ), React.createElement(
                "section",
                { className: "w3eden __wpdm_row_block " + attributes.sectionBGRepeat + " " + attributes.sectionBGSize, style: { background: background } },
                React.createElement(
                    "div",
                    { className: container },
                    React.createElement(InnerBlocks, { template: TEMPLATE,
                        allowedBlocks: ALLOWED_BLOCKS,
                        renderAppender: function renderAppender() {
                            return React.createElement(InnerBlocks.ButtonBlockAppender, null);
                        }
                    })
                )
            )];
        }
    }, {
        key: "componentDidMount",
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

    return RowEdit;
}(Component);

registerBlockType('download-manager/row', {

    title: _x('Row', 'block name'),

    description: __('Add a structured wrapper for column blocks, then add content blocks you’d like to the columns.'),

    keywords: [_x('rows', 'block keyword'), _x('columns', 'block keyword'), _x('layouts', 'block keyword')],
    supports: {
        align: ['wide', 'full'],
        anchor: true,
        stackedOnMobile: true
    },

    icon: section,

    category: 'wpdm-blocks',

    attributes: {
        wideContent: {
            type: 'boolean',
            default: false
        },
        columns: {
            type: 'number',
            default: 2
        },
        sectionBG: {
            type: 'string',
            default: '#E9ECEF'
        },
        sectionBGx: {
            type: 'string',
            default: '#E9ECEF'
        },

        sectionBGAlpha: {
            type: 'number',
            default: 95
        },

        bgCS1: {
            type: 'number',
            default: 0
        },

        bgCS2: {
            type: 'number',
            default: 100
        },

        gradAngle: {
            type: 'number',
            default: 45
        },

        sectionBGImage: {
            type: 'string',
            default: null
        },

        sectionBGSize: {
            type: 'string',
            default: 'bg-cover'
        },

        sectionBGRepeat: {
            type: 'string',
            default: 'bg-no-repeat'
        },

        sectionBGImageID: {
            type: 'string',
            default: null
        },
        className: {
            type: 'string',
            default: ''
        }
    },

    edit: function edit(props) {

        return React.createElement(RowEdit, props);
    },
    save: function save(_ref2) {
        var attributes = _ref2.attributes,
            className = _ref2.className;


        var rgba1 = Util.hexToRgba(attributes.sectionBG, attributes.sectionBGAlpha);
        var rgba2 = Util.hexToRgba(attributes.sectionBGx, attributes.sectionBGAlpha);
        var cs1 = attributes.bgCS1 + "%";
        var cs2 = attributes.bgCS2 + "%";
        var overlay = "linear-gradient( " + attributes.gradAngle + "deg, " + rgba1 + " " + cs1 + ", " + rgba2 + " " + cs2 + "),";
        var background = overlay + " " + "url(" + attributes.sectionBGImage + ")";

        var container = attributes.wideContent ? 'container-fluid' : 'container';

        return React.createElement(
            "section",
            { className: "w3eden " + attributes.sectionBGRepeat + " " + attributes.sectionBGSize, style: { background: background } },
            React.createElement(
                "div",
                { className: container },
                React.createElement(
                    "div",
                    { className: "row" },
                    React.createElement(InnerBlocks.Content, null)
                )
            )
        );
    }
});