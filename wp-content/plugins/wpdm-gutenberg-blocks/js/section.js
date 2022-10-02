/* npx babel --watch ./src --out-dir ../wpdm-gutenberg-blocks/js --presets react-app/prod  */

var _wp$editor = wp.editor,
    InnerBlocks = _wp$editor.InnerBlocks,
    InspectorControls = _wp$editor.InspectorControls,
    BlockControls = _wp$editor.BlockControls,
    ColorPalette = _wp$editor.ColorPalette,
    RichText = _wp$editor.RichText,
    AlignmentToolbar = _wp$editor.AlignmentToolbar,
    MediaUpload = _wp$editor.MediaUpload,
    PanelColorSettings = _wp$editor.PanelColorSettings;
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
var __ = wp.i18n.__;


registerBlockType('download-manager/section', {

    title: 'Section',

    description: 'HTML Section',

    keywords: [__('bootstrap jumbotron component'), __('call-to-action ui'), __('call2action')],

    icon: section,

    category: 'wpdm-blocks',

    attributes: {
        wideContent: {
            type: 'boolean',
            default: false
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

    edit: function edit(_ref) {
        var attributes = _ref.attributes,
            setAttributes = _ref.setAttributes,
            className = _ref.className;


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

        if (attributes.sectionBGImage === null) attributes.sectionBGImage = "";

        var background = overlay + " " + "url(" + attributes.sectionBGImage + ")";

        var container = attributes.wideContent ? 'container-fluid' : 'container';

        return [React.createElement(
            InspectorControls,
            null,
            React.createElement(
                'div',
                { className: 'w3eden' },
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
                        'label',
                        { htmlFor: "ever", style: { paddingLeft: "5px" } },
                        ' Full-width Content'
                    )
                ),
                React.createElement(
                    PanelBody,
                    { title: __('Background Options'), initialOpen: true },
                    React.createElement(
                        'div',
                        { className: "panel panel-default" },
                        React.createElement(
                            'div',
                            { className: "panel-heading" },
                            __('Background Color Left')
                        ),
                        React.createElement(
                            'div',
                            { className: "panel-body" },
                            React.createElement(ColorPalette, {
                                colors: defaultColors,
                                disableAlpha: false,
                                label: __('Background Color'),
                                value: attributes.sectionBG ? attributes.sectionBG : 'transparent',
                                onChange: function onChange(value) {
                                    return setAttributes({ sectionBG: value });
                                }
                            })
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: "panel panel-default" },
                        React.createElement(
                            'div',
                            { className: "panel-heading" },
                            __('Background Color Right')
                        ),
                        React.createElement(
                            'div',
                            { className: "panel-body" },
                            React.createElement(ColorPalette, {
                                colors: defaultColors,
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
                        'div',
                        { className: "panel panel-default" },
                        React.createElement(
                            'div',
                            { className: "panel-heading" },
                            __('Select a background image:')
                        ),
                        React.createElement(
                            'div',
                            { className: "panel-body" },
                            React.createElement(MediaUpload, {
                                onSelect: onSelectImage,
                                type: 'image',
                                value: attributes.sectionBGImage,
                                render: function render(_ref2) {
                                    var open = _ref2.open;
                                    return React.createElement(
                                        'div',
                                        null,
                                        React.createElement(
                                            IconButton,
                                            {
                                                className: 'ab-section-inspector-media',
                                                label: __('Edit image'),
                                                icon: 'format-image',
                                                onClick: open
                                            },
                                            __('Select Image')
                                        ),
                                        attributes.sectionBGImage && !!attributes.sectionBGImage.length && React.createElement(
                                            'div',
                                            null,
                                            React.createElement('img', { src: attributes.sectionBGImage }),
                                            React.createElement(
                                                IconButton,
                                                {
                                                    className: 'ab-section-inspector-media',
                                                    label: __('Remove Image'),
                                                    icon: 'dismiss',
                                                    onClick: onRemoveImage
                                                },
                                                __('Remove')
                                            )
                                        )
                                    );
                                }
                            })
                        )
                    ),
                    React.createElement(
                        'div',
                        null,
                        React.createElement(
                            'label',
                            null,
                            'Gradient Angle:'
                        ),
                        React.createElement('br', null),
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
                            'label',
                            null,
                            'Opacity:'
                        ),
                        React.createElement('br', null),
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
                            'label',
                            null,
                            'Color #1 Start:'
                        ),
                        React.createElement('br', null),
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
                            'label',
                            null,
                            'Color #2 Start:'
                        ),
                        React.createElement('br', null),
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
                        'div',
                        null,
                        React.createElement(
                            'label',
                            null,
                            'Background Size:'
                        ),
                        React.createElement('br', null),
                        React.createElement(SelectControl, {
                            'class': 'form-control wpdm-custom-select',
                            value: attributes.sectionBGSize,
                            onChange: function onChange(value) {
                                return setAttributes({ sectionBGSize: value });
                            },
                            options: [{ label: 'Auto', value: 'bg-auto' }, { label: 'Cover', value: 'bg-cover' }, { label: 'Contain', value: 'bg-contain' }, { label: '100%', value: 'bg-100' }]
                        }),
                        React.createElement(
                            'label',
                            null,
                            'Background Repeat:'
                        ),
                        React.createElement('br', null),
                        React.createElement(SelectControl, {
                            'class': 'form-control wpdm-custom-select',
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
            'section',
            { className: "w3eden " + attributes.sectionBGRepeat + " " + attributes.sectionBGSize, style: { background: background } },
            React.createElement(
                'div',
                { className: container },
                React.createElement(InnerBlocks, {
                    renderAppender: function renderAppender() {
                        return React.createElement(InnerBlocks.ButtonBlockAppender, null);
                    }
                })
            )
        )];
    },
    save: function save(_ref3) {
        var attributes = _ref3.attributes,
            className = _ref3.className;


        var rgba1 = Util.hexToRgba(attributes.sectionBG, attributes.sectionBGAlpha);
        var rgba2 = Util.hexToRgba(attributes.sectionBGx, attributes.sectionBGAlpha);
        var cs1 = attributes.bgCS1 + "%";
        var cs2 = attributes.bgCS2 + "%";
        var overlay = "linear-gradient( " + attributes.gradAngle + "deg, " + rgba1 + " " + cs1 + ", " + rgba2 + " " + cs2 + "),";

        if (attributes.sectionBGImage === null) attributes.sectionBGImage = "";

        var background = overlay + " " + "url(" + attributes.sectionBGImage + ")";

        var container = attributes.wideContent ? 'container-fluid' : 'container';

        return React.createElement(
            'section',
            { className: "w3eden " + attributes.sectionBGRepeat + " " + attributes.sectionBGSize, style: { background: background } },
            React.createElement(
                'div',
                { className: container },
                React.createElement(InnerBlocks.Content, null)
            )
        );
    }
});