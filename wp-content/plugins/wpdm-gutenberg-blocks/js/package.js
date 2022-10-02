/* import { LinkTemplates } from './libs/link-templates.js'; */
/* npx babel --watch src --out-dir ./js --presets react-app/prod  */

var registerBlockType = wp.blocks.registerBlockType;
var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    ServerSideRender = _wp$components.ServerSideRender,
    Modal = _wp$components.Modal,
    Button = _wp$components.Button,
    PanelBody = _wp$components.PanelBody;
var __ = wp.i18n.__;


registerBlockType('download-manager/package', {
    title: 'Package',

    description: 'Download Manager Package',

    keywords: [__('download manager digital ecommerce store product sell'), __('file manager'), __('package link')],

    icon: downloadIcon,

    category: 'wpdm-blocks',

    attributes: {
        packageID: {
            type: 'string',
            default: 0
        },
        template: {
            type: 'string',
            default: 'link-template-panel'
        }
    },

    edit: function edit(_ref) {
        var attributes = _ref.attributes,
            className = _ref.className,
            setAttributes = _ref.setAttributes;


        function onChangeTemplate(newTemplate) {
            setAttributes({ template: newTemplate });
        }

        function onChangeID(event) {
            if (event.target.value > 0) setAttributes({ packageID: event.target.value });else if (event.target.id > 0) setAttributes({ packageID: event.target.id });
        }

        function onSelectCategories(cat) {
            console.log(cat);
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
                    React.createElement(PackageSelector, {
                        label: "Package ID:",
                        value: attributes.packageID,
                        onChange: onChangeID
                    }),
                    React.createElement(LinkTemplates, {
                        label: "Link Template:",
                        value: attributes.template,
                        onChange: onChangeTemplate
                    })
                )
            )
        ), React.createElement(ServerSideRender, {
            block: "download-manager/package",
            attributes: attributes
        })];
    },
    save: function save() {
        return null;
    }
});