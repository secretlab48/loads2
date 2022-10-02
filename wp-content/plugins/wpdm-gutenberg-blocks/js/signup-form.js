/* import { LinkTemplates } from './libs/link-templates.js'; */
/* npx babel --watch src --out-dir ./js --presets react-app/prod  */

var registerBlockType = wp.blocks.registerBlockType;
var InspectorControls = wp.editor.InspectorControls;
var _wp$components = wp.components,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    FormToggle = _wp$components.FormToggle,
    ServerSideRender = _wp$components.ServerSideRender,
    Modal = _wp$components.Modal,
    Button = _wp$components.Button,
    PanelBody = _wp$components.PanelBody;
var __ = wp.i18n.__;


registerBlockType('download-manager/signup-form', {
    title: 'Signup Form',

    description: 'Download Manager Sigup Form',

    keywords: [__('download manager signup form digital ecommerce store product sell'), __('file manager'), __('signup register form')],

    icon: signup,

    category: 'wpdm-blocks',

    attributes: {
        role: {
            type: 'string',
            default: 'subscriber'
        },
        logo: {
            type: 'string',
            default: ''
        },
        verifyemail: {
            type: 'boolean',
            default: false
        },
        autologin: {
            type: 'boolean',
            default: false
        },
        note_before: {
            type: 'string',
            default: ''
        },
        note_after: {
            type: 'string',
            default: ''
        },
        social_only: {
            type: 'boolean',
            default: false
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

        function onChangeID(event) {
            if (event.target.value > 0) setAttributes({ packageID: event.target.value });else if (event.target.id > 0) setAttributes({ packageID: event.target.id });
        }

        var captchaToggle = function captchaToggle(ncaptcha) {
            setAttributes({ captcha: ncaptcha.target.checked });
        };

        return [React.createElement(
            InspectorControls,
            null,
            React.createElement(
                'div',
                { className: 'w3eden' },
                React.createElement(
                    PanelBody,
                    null,
                    React.createElement(SelectControl, {
                        label: 'Role:',
                        help: 'Assign signed up user to the selected role',
                        'class': "form-control wpdm-custom-select",
                        value: attributes.role,
                        options: __wpdm_roles,
                        onChange: function onChange(role) {
                            setAttributes({ role: role });
                        }
                    }),
                    React.createElement(
                        'div',
                        { className: "form-group" },
                        React.createElement(FormToggle, {
                            id: "ever",
                            checked: attributes.verifyemail,
                            onChange: function onChange(_verifyemail) {
                                setAttributes({ verifyemail: _verifyemail.target.checked });
                            }
                        }),
                        React.createElement(
                            'label',
                            { 'for': "ever", style: { paddingLeft: "5px" } },
                            ' Verify Email'
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: "form-group" },
                        React.createElement(FormToggle, {
                            id: "_autologin",
                            checked: attributes.autologin,
                            onChange: function onChange(_autologin) {
                                setAttributes({ autologin: _autologin.target.checked });
                            }
                        }),
                        React.createElement(
                            'label',
                            { htmlFor: "_autologin", style: { paddingLeft: "5px" } },
                            ' Auto Login'
                        )
                    ),
                    React.createElement(
                        'div',
                        { className: "form-group" },
                        React.createElement(FormToggle, {
                            id: "soconly",
                            checked: attributes.social_only,
                            onChange: function onChange(_social_only) {
                                setAttributes({ social_only: _social_only.target.checked });
                            }
                        }),
                        React.createElement(
                            'label',
                            { htmlFor: "soconly", style: { paddingLeft: "5px" } },
                            ' Social Signup Only'
                        )
                    )
                ),
                React.createElement(
                    PanelBody,
                    { title: __('Notes') },
                    React.createElement(TextControl, {
                        label: 'Before Form:',
                        help: 'Write if you have any special instructions',
                        value: attributes.note_before,
                        onChange: function onChange(note_before) {
                            return setAttributes({ note_before: note_before });
                        }
                    }),
                    React.createElement(TextControl, {
                        label: 'After Form:',
                        help: 'Write if you have any special instructions',
                        value: attributes.note_after,
                        onChange: function onChange(note_after) {
                            return setAttributes({ note_after: note_after });
                        }
                    })
                ),
                React.createElement(
                    PanelBody,
                    { title: __('Logo:') },
                    React.createElement(MediaUpload, {
                        onSelect: function onSelect(img) {
                            setAttributes({
                                logo: img.url
                            });
                        },
                        type: 'image',
                        value: attributes.logo,
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
                                attributes.logo && !!attributes.logo.length && React.createElement(
                                    'div',
                                    null,
                                    React.createElement('img', { style: { margin: "10px 0", height: "128px", width: 'auto' }, src: attributes.logo }),
                                    React.createElement(
                                        IconButton,
                                        {
                                            className: 'ab-cta-inspector-media',
                                            label: __('Remove Image'),
                                            icon: 'dismiss',
                                            onClick: function onClick() {
                                                setAttributes({
                                                    logo: ''
                                                });
                                            }
                                        },
                                        __('Remove')
                                    )
                                )
                            );
                        }
                    })
                )
            )
        ), React.createElement(ServerSideRender, {
            block: "download-manager/signup-form",
            attributes: attributes
        })];
    },
    save: function save() {
        return null;
    }
});