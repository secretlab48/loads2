/* npx babel --watch ./src --out-dir ../wpdm-gutenberg-blocks/js --presets react-app/prod  */

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


registerBlockType('download-manager/category', {
    title: 'Categories',

    description: 'Download Manager Category',

    keywords: [__('download manager digital ecommerce store product sell'), __('file manager'), __('product category categories')],

    icon: catIcon,

    category: 'wpdm-blocks',

    attributes: {
        cats: {
            type: 'string',
            default: ""
        },
        title: {
            type: 'string',
            default: ""
        },
        desc: {
            type: 'string',
            default: ""
        },
        items_per_page: {
            type: 'string',
            default: "10"
        },
        toolbar: {
            type: 'string',
            default: '1'
        },
        paging: {
            type: 'string',
            default: "1"
        },
        cols: {
            type: 'string',
            default: "1"
        },
        order_by: {
            type: 'string',
            default: ""
        },
        order: {
            type: 'string',
            default: ""
        },
        template: {
            type: 'string',
            default: 'link-template-panel'
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
            console.log(categories);
            setAttributes({ cats: categories });
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
                    React.createElement(CategorySelector, {
                        label: "Categories:",
                        value: attributes.cats,
                        onChange: onSelectCategory
                    }),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Toolbar:",
                            value: attributes.toolbar,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: 'Extended Toolbar', value: 1 }, { label: 'Compact Toolbar', value: 'skinny' }, { label: "Hide Toolbar", value: 0 }],
                            onChange: function onChange(toolbar) {
                                return setAttributes({ toolbar: toolbar });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Title:",
                            value: attributes.title,
                            onChange: function onChange(text) {
                                return setAttributes({ title: text });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextareaControl, {
                            label: "Description:",
                            value: attributes.desc,
                            onChange: function onChange(text) {
                                return setAttributes({ desc: text });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Items Par Page:",
                            type: "number",
                            value: attributes.items_per_page,
                            onChange: function onChange(items_per_page) {
                                return setAttributes({ items_per_page: items_per_page });
                            }
                        })
                    ),
                    React.createElement(LinkTemplates, {
                        label: "Link Template:",
                        value: attributes.template,
                        onChange: onChangeTemplate
                    }),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Pagination:",
                            value: attributes.paging,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: 'Show', value: 1 }, { label: "Hide", value: 0 }],
                            onChange: function onChange(paging) {
                                return setAttributes({ paging: paging });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Columns:",
                            value: attributes.cols,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: '1 Column', value: 1 }, { label: "2 Columns", value: 2 }, { label: "3 Columns", value: 3 }, { label: "4 Columns", value: 4 }],
                            onChange: function onChange(cols) {
                                return setAttributes({ cols: cols });
                            }
                        })
                    )
                )
            )
        ), React.createElement(ServerSideRender, {
            block: "download-manager/category",
            attributes: attributes
        })];
    },
    save: function save() {
        return null;
    }
});