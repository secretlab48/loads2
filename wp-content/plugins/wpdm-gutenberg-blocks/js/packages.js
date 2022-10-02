/* npx babel --watch ./src --out-dir ../wpdm-gutenberg-blocks/js --presets react-app/prod  */

var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    TextareaControl = _wp$components.TextareaControl,
    SelectControl = _wp$components.SelectControl,
    FormToggle = _wp$components.FormToggle,
    ServerSideRender = _wp$components.ServerSideRender,
    Modal = _wp$components.Modal,
    Button = _wp$components.Button,
    PanelBody = _wp$components.PanelBody;
var registerBlockType = wp.blocks.registerBlockType;
var withState = wp.compose.withState;
var __ = wp.i18n.__;


registerBlockType('download-manager/packages', {
    title: 'Packages',

    description: 'Query Download Manager Packages',

    keywords: [__('download manager digital ecommerce store product sell'), __('file manager'), __('product category categories')],

    icon: packages,

    category: 'wpdm-blocks',

    attributes: {
        search: {
            type: 'string',
            default: ""
        },
        categories: {
            type: 'string',
            default: ""
        },
        include_children: {
            type: 'boolean',
            default: false
        },
        operator: {
            type: 'string',
            default: "IN"
        },
        xcats: {
            type: 'string',
            default: ""
        },
        tag: {
            type: 'string',
            default: ""
        },
        tag__not_in: {
            type: 'string',
            default: ""
        },
        author: {
            type: 'string',
            default: ""
        },
        author__not_in: {
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
            setAttributes({ categories: categories });
        }

        return [React.createElement(
            InspectorControls,
            null,
            React.createElement(
                'div',
                { className: 'w3eden' },
                React.createElement(
                    PanelBody,
                    null,
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Search Keyword:",
                            value: attributes.search,
                            onChange: function onChange(keyword) {
                                return setAttributes({ search: keyword });
                            }
                        })
                    ),
                    React.createElement(CategorySelector, {
                        label: "Include Categories:",
                        value: attributes.categories,
                        id: "categories",
                        onChange: onSelectCategory
                    }),
                    React.createElement(
                        'div',
                        { className: "form-group" },
                        React.createElement(FormToggle, {
                            id: "ever",
                            checked: attributes.include_children,
                            onChange: function onChange(_include_children) {
                                setAttributes({ include_children: _include_children.target.checked });
                            }
                        }),
                        React.createElement(
                            'label',
                            { htmlFor: "ever", style: { paddingLeft: "5px" } },
                            ' Include Children'
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Category Match:",
                            value: attributes.operator,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: 'Match Exactly', value: 'AND' }, { label: 'Match Any', value: 'IN' }],
                            onChange: function onChange(operator) {
                                return setAttributes({ operator: operator });
                            }
                        })
                    ),
                    React.createElement(CategorySelector, {
                        label: "Exclude Categories:",
                        value: attributes.xcats,
                        id: "xcats",
                        onChange: function onChange(xcats) {
                            return setAttributes({ xcats: xcats });
                        }
                    }),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Tags:",
                            placeholder: "Tags separated by comma",
                            value: attributes.tag,
                            onChange: function onChange(tag) {
                                return setAttributes({ tag: tag });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Exclude Packages With Tags:",
                            placeholder: "Tags separated by comma",
                            value: attributes.tag__not_in,
                            onChange: function onChange(tag__not_in) {
                                return setAttributes({ tag__not_in: tag__not_in });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Author:",
                            placeholder: "Author IDs separated by comma",
                            value: attributes.author,
                            onChange: function onChange(author) {
                                return setAttributes({ author: author });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(TextControl, {
                            label: "Exclude Package From Authors:",
                            placeholder: "Author IDs separated by comma",
                            value: attributes.author__not_in,
                            onChange: function onChange(author__not_in) {
                                return setAttributes({ author__not_in: author__not_in });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Toolbar:",
                            value: attributes.toolbar,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: 'Show Toolbar', value: 1 }, { label: "Hide Toolbar", value: 0 }],
                            onChange: function onChange(toolbar) {
                                return setAttributes({ toolbar: toolbar });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Order By:",
                            value: attributes.order_by,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: 'Publish Date', value: 'date' }, { label: 'Update Date', value: 'updated' }, { label: "Downloads", value: 'download_count' }, { label: "Views", value: 'view_count' }, { label: "Price", value: 'base_price' }],
                            onChange: function onChange(order_by) {
                                return setAttributes({ order_by: order_by });
                            }
                        })
                    ),
                    React.createElement(
                        'div',
                        { className: 'form-group' },
                        React.createElement(SelectControl, {
                            label: "Order:",
                            value: attributes.order,
                            'class': "form-control wpdm-custom-select",
                            options: [{ label: 'Desc', value: 'desc' }, { label: 'Asc', value: 'asc' }],
                            onChange: function onChange(order) {
                                return setAttributes({ order: order });
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
            block: "download-manager/packages",
            attributes: attributes
        })];
    },
    save: function save() {
        return null;
    }
});