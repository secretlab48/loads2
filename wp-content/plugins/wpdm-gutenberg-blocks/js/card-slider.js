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


registerBlockType('download-manager/card-slider', {
    title: 'Card Slider',

    description: 'Download Manager Package Slider',

    keywords: [__('download manager digital ecommerce store product sell'), __('file manager image slider'), __('product slider')],

    icon: slider,

    category: 'wpdm-blocks',

    attributes: {
        cat: {
            type: 'string',
            default: ""
        },
        items_per_page: {
            type: 'number',
            default: 4
        },
        order_by: {
            type: 'string',
            default: ""
        },
        order: {
            type: 'string',
            default: ""
        },
        color: {
            type: 'string',
            default: ""
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
            setAttributes({ cat: categories });
        }

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
                    React.createElement(WPDMCategoryDropdown, {
                        label: "Category:",
                        value: attributes.cat,
                        onChange: onSelectCategory
                    }),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "No. of items:",
                            type: "number",
                            value: attributes.items_per_page,
                            onChange: function onChange(items_per_page) {
                                return setAttributes({ items_per_page: items_per_page });
                            }
                        })
                    ),
                    React.createElement(PanelColorSettings, {
                        title: __('Color Scheme'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.color,
                            onChange: function onChange(color) {
                                return setAttributes({ color: color });
                            },
                            label: __('Color Scheme'),
                            colors: Util.defaultColor()
                        }]
                    })
                )
            )
        ), React.createElement(ServerSideRender, {
            block: "download-manager/card-slider",
            attributes: attributes
        })];
    },
    save: function save() {
        return null;
    }
});