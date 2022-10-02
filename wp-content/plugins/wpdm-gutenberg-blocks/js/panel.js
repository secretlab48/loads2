//import LinkTemplates from './link-templates.js';
/* npx babel --watch src --out-dir ./js --presets react-app/prod  */

var _wp$editor = wp.editor,
    InspectorControls = _wp$editor.InspectorControls,
    ColorPalette = _wp$editor.ColorPalette,
    RichText = _wp$editor.RichText;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    ServerSideRender = _wp$components.ServerSideRender,
    Modal = _wp$components.Modal,
    Button = _wp$components.Button,
    PanelBody = _wp$components.PanelBody,
    PanelRow = _wp$components.PanelRow,
    PanelColor = _wp$components.PanelColor,
    RangeControl = _wp$components.RangeControl,
    ToggleControl = _wp$components.ToggleControl,
    TabPanel = _wp$components.TabPanel,
    TreeSelect = _wp$components.TreeSelect;
var registerBlockType = wp.blocks.registerBlockType;
var __ = wp.i18n.__;


registerBlockType('download-manager/panel', {
    title: 'Panel',

    description: 'Panel UI',

    keywords: [__('bootstrap panel component'), __('card ui'), __('collaspe uikit')],

    icon: panelIcon,

    category: 'wpdm-blocks',

    attributes: {
        title: {
            type: 'array',
            source: 'children',
            selector: '.title'
        },
        panel_id: {
            type: 'string'
        },
        content: {
            type: 'array',
            source: 'children',
            selector: '.content'
        },
        collapsible: {
            type: 'boolean',
            default: false
        },
        borderColor: {
            type: 'string',
            default: '#dddddd'
        },
        headerBG: {
            type: 'string',
            default: '#eeeeee'
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
            content = attributes.content,
            collapsible = attributes.collapsible;


        function onChangeContent(newContent) {
            setAttributes({ content: newContent });
        }

        function onChangeTitle(newTitle) {
            setAttributes({ title: newTitle });
        }

        function onSelectCategories(cat) {
            console.log(cat);
        }

        var collapse = attributes.collapsible ? 'collaspe' : '';
        var panel_id = "#" + attributes.panel_id;

        /* Default colors */
        var defaultColors = Util.defaultColor();

        return [React.createElement(
            InspectorControls,
            null,
            React.createElement(
                PanelBody,
                null,
                React.createElement(
                    'div',
                    { className: 'w3eden' },
                    React.createElement(ToggleControl, {
                        label: 'Collapsible',
                        help: 'Is panel collapsible?',
                        checked: attributes.collapsible,
                        onChange: function onChange(value) {
                            return setAttributes({ collapsible: value });
                        }
                    }),
                    React.createElement(TextControl, {
                        label: 'Panel ID',
                        help: 'Unique ID for Panel',
                        value: attributes.panel_id,
                        onChange: function onChange(value) {
                            return setAttributes({ panel_id: value });
                        }
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Border Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.borderColor,
                            onChange: function onChange(borderColor) {
                                return setAttributes({ borderColor: borderColor });
                            },
                            label: __('Border Color'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Header Background'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.headerBG,
                            onChange: function onChange(headerBG) {
                                return setAttributes({ headerBG: headerBG });
                            },
                            label: __('Header Background'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Header Text Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.titleColor,
                            onChange: function onChange(titleColor) {
                                return setAttributes({ titleColor: titleColor });
                            },
                            label: __('Header Text Color'),
                            colors: defaultColors
                        }]
                    }),
                    React.createElement(PanelColorSettings, {
                        title: __('Body Text Color'),
                        initialOpen: false,
                        colorSettings: [{
                            value: attributes.textColor,
                            onChange: function onChange(textColor) {
                                return setAttributes({ textColor: textColor });
                            },
                            label: __('Body Text Color'),
                            colors: defaultColors
                        }]
                    })
                )
            )
        ), attributes.collapsible ? React.createElement(
            'div',
            { className: "w3eden" },
            React.createElement(
                'div',
                { className: "card card-default panel panel-default", style: { borderColor: attributes.borderColor } },
                React.createElement(
                    'div',
                    { className: "card-header panel-heading collapsed", 'data-toggle': 'collapse', href: panel_id, style: { background: attributes.headerBG, borderColor: attributes.borderColor } },
                    React.createElement(RichText, {
                        tagName: "div",
                        className: "title",
                        style: { color: attributes.titleColor },
                        placeholder: __('Title'),
                        onChange: onChangeTitle,
                        value: title
                    })
                ),
                React.createElement(
                    'div',
                    { className: "card-body panel-body collapse", id: attributes.panel_id },
                    React.createElement(RichText, {
                        tagName: "div",
                        className: "content",
                        placeholder: __('Content'),
                        onChange: onChangeContent,
                        style: { color: attributes.textColor },
                        value: content
                    })
                )
            )
        ) : React.createElement(
            'div',
            { className: "w3eden" },
            React.createElement(
                'div',
                { className: 'card card-default panel panel-default', style: { borderColor: attributes.borderColor } },
                React.createElement(
                    'div',
                    { className: "card-header panel-heading", style: { background: attributes.headerBG, borderColor: attributes.borderColor } },
                    React.createElement(RichText, {
                        tagName: "div",
                        className: "title",
                        style: { color: attributes.titleColor },
                        placeholder: __('Title'),
                        onChange: onChangeTitle,
                        value: title
                    })
                ),
                React.createElement(
                    'div',
                    { className: "card-body panel-body", id: attributes.panel_id },
                    React.createElement(RichText, {
                        tagName: "div",
                        className: "content",
                        placeholder: __('Content'),
                        onChange: onChangeContent,
                        style: { color: attributes.textColor },
                        value: content
                    })
                )
            )
        )];
    },
    save: function save(_ref2) {
        var attributes = _ref2.attributes,
            className = _ref2.className;
        var title = attributes.title,
            content = attributes.content;


        var panel_id = "#" + attributes.panel_id;

        return attributes.collapsible ? React.createElement(
            'div',
            { className: "w3eden" },
            React.createElement(
                'div',
                { className: "card card-default panel panel-default", style: { borderColor: attributes.borderColor } },
                React.createElement(
                    'div',
                    { className: "card-header panel-heading collapsed", 'data-toggle': 'collapse', href: panel_id, style: { background: attributes.headerBG, borderColor: attributes.borderColor } },
                    React.createElement(RichText.Content, {
                        tagName: "div",
                        className: "title",
                        style: { color: attributes.titleColor },
                        value: title
                    })
                ),
                React.createElement(
                    'div',
                    { className: "card-body panel-body collapse", id: attributes.panel_id },
                    React.createElement(RichText.Content, {
                        tagName: "div",
                        className: "content",
                        style: { color: attributes.textColor },
                        value: content
                    })
                )
            )
        ) : React.createElement(
            'div',
            { className: "w3eden" },
            React.createElement(
                'div',
                { className: "card card-default panel panel-default", style: { borderColor: attributes.borderColor } },
                React.createElement(
                    'div',
                    { className: "card-header panel-heading", style: { background: attributes.headerBG, borderColor: attributes.borderColor } },
                    React.createElement(RichText.Content, {
                        tagName: "div",
                        className: "title",
                        style: { color: attributes.titleColor },
                        value: title
                    })
                ),
                React.createElement(
                    'div',
                    { className: "card-body panel-body", id: 'collapseExample' },
                    React.createElement(RichText.Content, {
                        tagName: "div",
                        className: "content",
                        style: { color: attributes.textColor },
                        value: content
                    })
                )
            )
        );
    }
});