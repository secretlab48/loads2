/* npx babel --watch src --out-dir ./js --presets react-app/prod  */

var _wp$editor = wp.editor,
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
    Toolbar = _wp$components.Toolbar;
var registerBlockType = wp.blocks.registerBlockType;
var Fragment = wp.element.Fragment;
var __ = wp.i18n.__;


registerBlockType('download-manager/call2action', {
    title: 'Call To Action',

    description: 'Call To Action UI',

    keywords: [__('bootstrap jumbotron component'), __('call-to-action ui'), __('call2action')],

    icon: btnC2A,

    category: 'wpdm-blocks',

    attributes: {
        actionType: {
            type: 'string',
            default: 'button'
        },
        title: {
            type: 'array',
            source: 'children',
            selector: '.title'
        },
        alignment: {
            type: 'string',
            default: 'center'
        },
        titleFontSize: {
            type: 'string',
            default: '20'
        },
        textFontSize: {
            type: 'string',
            default: '13'
        },
        buttonText: {
            type: 'array',
            source: 'children',
            selector: 'a',
            default: 'Call To Action'
        },
        buttonStyle: {
            type: 'string',
            default: 'btn btn-primary btn-lg'
        },
        buttonSize: {
            type: 'string',
            default: 'btn-lg'
        },
        link: {
            type: 'string',
            source: 'attribute',
            selector: 'a',
            attribute: 'href'
        },
        content: {
            type: 'array',
            source: 'children',
            selector: '.content'
        },
        buttonTextColor: {
            type: 'string',
            default: '#ffffff'
        },
        buttonBG: {
            type: 'string',
            default: '#333333'
        },
        ctaBG: {
            type: 'string',
            default: '#E9ECEF'
        },
        ctaBGx: {
            type: 'string',
            default: '#E9ECEF'
        },

        ctaBGAlpha: {
            type: 'string',
            default: '50'
        },

        bgCS1: {
            type: 'string',
            default: '0'
        },

        bgCS2: {
            type: 'string',
            default: '100'
        },

        gradAngle: {
            type: 'string',
            default: '45'
        },

        ctaBGImage: {
            type: 'string',
            default: null
        },

        ctaBGSize: {
            type: 'string',
            default: 'bg-cover'
        },

        ctaBGRepeat: {
            type: 'string',
            default: 'bg-no-repeat'
        },

        ctaBGImageID: {
            type: 'string',
            default: null
        },

        titleColor: {
            type: 'string',
            default: '#333333'
        },

        textColor: {
            type: 'string',
            default: '#333333'
        },
        className: {
            type: 'string',
            default: ''
        }
    },

    edit: function edit(_ref) {
        var attributes = _ref.attributes,
            className = _ref.className,
            setAttributes = _ref.setAttributes;
        var title = attributes.title,
            content = attributes.content;


        var onChangeContent = function onChangeContent(newContent) {
            setAttributes({ content: newContent });
        };

        var onChangeTitle = function onChangeTitle(newTitle) {
            setAttributes({ title: newTitle });
        };

        var onChangeAlignment = function onChangeAlignment(newAlignment) {
            setAttributes({ alignment: newAlignment });
        };

        var onChangeButton = function onChangeButton(buttonText) {
            setAttributes({ buttonText: buttonText });
        };

        var onSelectImage = function onSelectImage(img) {
            setAttributes({
                ctaBGImage: img.url
            });
        };

        var onRemoveImage = function onRemoveImage() {
            setAttributes({
                ctaBGImage: null
                //imgAlt: null,
            });
        };

        var fontSizes = [{
            name: __('Small'),
            slug: 'small',
            size: 12
        }, {
            name: __('Medium'),
            slug: 'small',
            size: 16
        }, {
            name: __('Big'),
            slug: 'small',
            size: 24
        }, {
            name: __('Extra Big'),
            slug: 'xbig',
            size: 32
        }];

        /* Default colors */
        var defaultColors = Util.defaultColor();

        var fallbackFontSize = 16;
        var colorPaletteControl = '';

        var tfz = attributes.titleFontSize + 'px';
        var xfz = attributes.textFontSize + 'px';

        var rgba1 = Util.hexToRgba(attributes.ctaBG, attributes.ctaBGAlpha);
        var rgba2 = Util.hexToRgba(attributes.ctaBGx, attributes.ctaBGAlpha);
        var cs1 = attributes.bgCS1 + "%";
        var cs2 = attributes.bgCS2 + "%";
        var overlay = "linear-gradient( " + attributes.gradAngle + "deg, " + rgba1 + " " + cs1 + ", " + rgba2 + " " + cs2 + "),";

        /* onchange functions */
        var onChangeButonTextColor = function onChangeButonTextColor(value) {
            return setAttributes({ buttonTextColor: value });
        };

        var actionTypeEditHTML = React.createElement(
            'a',
            { href: attributes.link, className: attributes.buttonStyle,
                style: { background: attributes.buttonBG, color: attributes.buttonTextColor } },
            React.createElement(RichText, {
                tagName: "span",
                placeholder: __('Call To Action'),
                onChange: onChangeButton,
                value: attributes.buttonText
            })
        );
        var actionTypeOutputHTML = React.createElement(
            'a',
            { href: attributes.link, className: attributes.buttonStyle, style: { background: attributes.buttonBG, color: attributes.buttonTextColor } },
            React.createElement(RichText.Content, {
                placeholder: __('Call To Action'),
                value: attributes.buttonText
            })
        );
        if (attributes.actionType === 'search') {
            actionTypeEditHTML = React.createElement(
                'form',
                { className: "text-center", method: "GET", action: attributes.link },
                React.createElement('input', { name: "s", style: { maxWidth: '100%', width: '500px', margin: '0px auto' }, type: "text", className: "form-control input-lg", placeholder: "Search..." })
            );

            actionTypeOutputHTML = React.createElement(
                'form',
                { className: "text-center", method: "GET", action: attributes.link },
                React.createElement('input', { name: "s", style: { maxWidth: '100%', width: '500px', margin: '0px auto' }, type: "text", className: "form-control input-lg", placeholder: attributes.buttonText })
            );
        }

        return [React.createElement(
            InspectorControls,
            null,
            React.createElement(
                PanelBody,
                null,
                React.createElement(
                    'div',
                    { className: 'w3eden' },
                    React.createElement(TextControl, {
                        label: 'Action URL',
                        help: 'Where to go when someone clicks the button',
                        value: attributes.link,
                        onChange: function onChange(value) {
                            return setAttributes({ link: value });
                        }
                    }),
                    React.createElement(RadioControl, {
                        label: 'Action type',
                        help: 'The type of the current user',
                        selected: attributes.actionType,
                        options: [{ label: 'Button', value: 'button' }, { label: 'Search', value: 'search' }],
                        onChange: function onChange(actionType) {
                            return setAttributes({ actionType: actionType });
                        }
                    }),
                    React.createElement(
                        'label',
                        null,
                        'Text Alignment'
                    ),
                    React.createElement('br', null),
                    React.createElement(AlignmentToolbar, {
                        value: attributes.alignment,
                        onChange: onChangeAlignment
                    }),
                    React.createElement(
                        PanelBody,
                        { title: __('Text Options') },
                        React.createElement(
                            'label',
                            null,
                            'Title Font Size'
                        ),
                        React.createElement('br', null),
                        React.createElement(FontSizePicker, {
                            fontSizes: fontSizes,
                            value: attributes.titleFontSize,
                            fallbackFontSize: fallbackFontSize,
                            onChange: function onChange(fontSize) {
                                return setAttributes({ titleFontSize: fontSize });
                            }
                        }),
                        React.createElement(
                            'label',
                            null,
                            'Text Font Size'
                        ),
                        React.createElement('br', null),
                        React.createElement(FontSizePicker, {
                            fontSizes: fontSizes,
                            value: attributes.textFontSize,
                            fallbackFontSize: fallbackFontSize,
                            onChange: function onChange(fontSize) {
                                return setAttributes({ textFontSize: fontSize });
                            }
                        })
                    ),
                    React.createElement(
                        PanelBody,
                        { title: __('Background Options'), initialOpen: false },
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
                                    disableAlpha: false,
                                    label: __('Background Color'),
                                    value: attributes.ctaBG,
                                    onChange: function onChange(value) {
                                        return setAttributes({ ctaBG: value });
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
                                    disableAlpha: false,
                                    label: __('Background Color'),
                                    value: attributes.ctaBGx,
                                    onChange: function onChange(value) {
                                        return setAttributes({ ctaBGx: value });
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
                                    value: attributes.ctaBGImage,
                                    render: function render(_ref2) {
                                        var open = _ref2.open;
                                        return React.createElement(
                                            'div',
                                            null,
                                            React.createElement(
                                                IconButton,
                                                {
                                                    className: 'ab-cta-inspector-media',
                                                    label: __('Edit image'),
                                                    icon: 'format-image',
                                                    onClick: open
                                                },
                                                __('Select Image')
                                            ),
                                            attributes.ctaBGImage && !!attributes.ctaBGImage.length && React.createElement(
                                                IconButton,
                                                {
                                                    className: 'ab-cta-inspector-media',
                                                    label: __('Remove Image'),
                                                    icon: 'dismiss',
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
                                value: attributes.ctaBGAlpha,
                                onChange: function onChange(value) {
                                    return setAttributes({ ctaBGAlpha: value });
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
                        attributes.ctaBGImage && !!attributes.ctaBGImage.length && React.createElement(
                            'div',
                            null,
                            React.createElement(
                                'label',
                                null,
                                'Background Size:'
                            ),
                            React.createElement('br', null),
                            React.createElement(SelectControl, {
                                value: attributes.ctaBGSize,
                                onChange: function onChange(value) {
                                    return setAttributes({ ctaBGSize: value });
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
                                value: attributes.ctaBGRepeat,
                                onChange: function onChange(value) {
                                    return setAttributes({ ctaBGRepeat: value });
                                },
                                options: [{ label: 'No Repeat', value: 'bg-no-repeat' }, { label: 'Repeat', value: 'bg-repeat' }, { label: 'Repeat X', value: 'bg-repeat-x' }, { label: 'Repeat Y', value: 'bg-repeat-y' }]
                            })
                        )
                    ),
                    React.createElement(PanelColorSettings, {
                        title: __('Button Text Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.buttonTextColor,
                            onChange: onChangeButonTextColor,
                            label: __('Button Text Color'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Button Background Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.buttonBG,
                            onChange: function onChange(buttonBG) {
                                return setAttributes({ buttonBG: buttonBG });
                            },
                            label: __('Button Background Color'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Title Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.titleColor,
                            onChange: function onChange(titleColor) {
                                return setAttributes({ titleColor: titleColor });
                            },
                            label: __('Title Color'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Text Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.textColor,
                            onChange: function onChange(textColor) {
                                return setAttributes({ textColor: textColor });
                            },
                            label: __('Text Color'),
                            colors: defaultColors
                        }]
                    })
                )
            )
        ), React.createElement(
            'div',
            { className: "w3eden" },
            React.createElement(
                'div',
                { className: "jumbotron jumbotron-fluid " + attributes.ctaBGRepeat + " " + attributes.ctaBGSize, style: { background: overlay + " " + "url(" + attributes.ctaBGImage + ")" } },
                React.createElement(
                    'div',
                    { style: { textAlign: attributes.alignment } },
                    React.createElement(RichText, {
                        tagName: "h1",
                        className: "title",
                        style: { color: attributes.titleColor, fontSize: tfz },
                        placeholder: __('Title'),
                        onChange: onChangeTitle,
                        value: title
                    }),
                    React.createElement(RichText, {
                        tagName: "div",
                        className: "content",
                        placeholder: __('Content'),
                        onChange: onChangeContent,
                        style: { color: attributes.textColor, fontSize: xfz },
                        value: content
                    }),
                    actionTypeEditHTML
                )
            )
        )];
    },
    save: function save(_ref3) {
        var attributes = _ref3.attributes,
            className = _ref3.className;
        var title = attributes.title,
            content = attributes.content;


        var actionTypeOutputHTML = React.createElement(
            'a',
            { href: attributes.link, className: attributes.buttonStyle, style: { background: attributes.buttonBG, color: attributes.buttonTextColor } },
            React.createElement(RichText.Content, {
                placeholder: __('Call To Action'),
                value: attributes.buttonText
            })
        );
        if (attributes.actionType === 'search') {

            actionTypeOutputHTML = React.createElement(
                'form',
                { className: "text-center", method: "GET", action: attributes.link },
                React.createElement('input', { name: "s", style: { maxWidth: '100%', width: '500px', margin: '0px auto' }, type: "text", className: "form-control input-lg", placeholder: "Search..." })
            );
        }

        var tfz = attributes.titleFontSize + 'px';
        var xfz = attributes.textFontSize + 'px';

        var rgba1 = Util.hexToRgba(attributes.ctaBG, attributes.ctaBGAlpha);
        var rgba2 = Util.hexToRgba(attributes.ctaBGx, attributes.ctaBGAlpha);
        var cs1 = attributes.bgCS1 + "%";
        var cs2 = attributes.bgCS2 + "%";
        var overlay = "linear-gradient( " + attributes.gradAngle + "deg, " + rgba1 + " " + cs1 + ", " + rgba2 + " " + cs2 + "),";

        return React.createElement(
            'div',
            { className: "w3eden" },
            React.createElement(
                'div',
                { className: "jumbotron jumbotron-fluid " + attributes.ctaBGRepeat + " " + attributes.ctaBGSize, style: { background: overlay + " " + "url(" + attributes.ctaBGImage + ")" } },
                React.createElement(
                    'div',
                    { style: { textAlign: attributes.alignment } },
                    React.createElement(RichText.Content, {
                        tagName: "h1",
                        className: "title",
                        style: { color: attributes.titleColor, fontSize: tfz },
                        value: title
                    }),
                    React.createElement(RichText.Content, {
                        tagName: "div",
                        className: "content",
                        style: { color: attributes.textColor, fontSize: xfz },
                        value: content
                    }),
                    actionTypeOutputHTML
                )
            )
        );
    }
});