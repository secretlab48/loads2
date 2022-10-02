var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    TextareaControl = _wp$components.TextareaControl,
    SelectControl = _wp$components.SelectControl,
    ServerSideRender = _wp$components.ServerSideRender,
    Modal = _wp$components.Modal,
    Button = _wp$components.Button,
    PanelBody = _wp$components.PanelBody;
var registerBlockType = wp.blocks.registerBlockType;
var withState = wp.compose.withState;
var __ = wp.i18n.__;


registerBlockType('download-manager/category-blocks', {
    title: 'Category Cards',

    description: 'Download Manager Category Cards',

    keywords: [__('download manager digital ecommerce store product sell'), __('file manager'), __('product category categories')],

    icon: theCat,

    category: 'wpdm-blocks',

    attributes: {
        cats: {
            type: 'string',
            default: ""
        },
        cols: {
            type: 'string',
            default: "3"
        },
        button_color: {
            type: 'string',
            default: "rgb(0, 115, 255)"
        },
        hover_color: {
            type: 'string',
            default: "rgb(0, 115, 255)"
        },
        template: {
            type: 'string',
            default: ''
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


        function onChangeTemplate(newTemplate) {
            setAttributes({ template: newTemplate });
        }

        function onSelectCategory(categories) {
            setAttributes({ cats: categories });
        }

        /* Default colors */
        var defaultColors = Util.defaultColor();
        console.log(attributes);
        return [React.createElement(
            InspectorControls,
            null,
            React.createElement(
                'div',
                { className: 'w3eden' },
                React.createElement(
                    PanelBody,
                    null,
                    React.createElement(CategorySelector, {
                        label: "Categories:",
                        value: attributes.cats,
                        onChange: onSelectCategory
                    }),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(
                            'div',
                            { className: 'form-group' },
                            React.createElement(SelectControl, {
                                label: "Columns:",
                                value: attributes.cols,
                                'class': "form-control wpdm-custom-select",
                                options: [{ label: "4 columns", value: 4 }, { label: "3 columns", value: 3 }, { label: "2 columns", value: 2 }, { label: '1 column', value: 1 }],
                                onChange: function onChange(cols) {
                                    return setAttributes({ cols: cols });
                                }
                            })
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(
                            'div',
                            { className: 'form-group' },
                            React.createElement(SelectControl, {
                                label: "Template:",
                                value: attributes.template,
                                'class': "form-control wpdm-custom-select",
                                options: [{ label: "Default", value: 'default' }],
                                onChange: function onChange(template) {
                                    return setAttributes({ template: template });
                                }
                            })
                        )
                    ),
                    React.createElement(PanelColorSettings, {
                        title: __('Button Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.button_color,
                            onChange: function onChange(button_color) {
                                return setAttributes({ button_color: button_color });
                            },
                            label: __('Border Color'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Hover Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.hover_color,
                            onChange: function onChange(hover_color) {
                                return setAttributes({ hover_color: hover_color });
                            },
                            label: __('Hover Color'),
                            colors: defaultColors
                        }]
                    })
                )
            )
        ), React.createElement(ServerSideRender, {
            block: "download-manager/category-blocks",
            attributes: attributes
        })];
    },
    save: function save() {
        return null;
    }
});