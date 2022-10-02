var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var wpdmCategories = [];

var Util = function () {
    function Util() {
        _classCallCheck(this, Util);
    }

    _createClass(Util, null, [{
        key: 'hexToRgba',
        value: function hexToRgba(hex, alpha) {
            if (!hex || hex === 'transparent') return 'transparent';
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            var rgba = result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16),
                a: alpha / 100
            } : null;
            return "rgba( " + rgba.r + ", " + rgba.g + ", " + rgba.b + ", " + rgba.a + ")";
        }
    }, {
        key: 'defaultColor',
        value: function defaultColor() {
            /* Default colors */
            var defaultColors = [{ color: '#ffffff', name: 'white' }, { color: '#392F43', name: 'black' }, { color: '#3373dc', name: 'royal blue' }, { color: '#209cef', name: 'sky blue' }, { color: '#2BAD59', name: 'green' }, { color: '#ff3860', name: 'pink' }, { color: '#7941b6', name: 'purple' }, { color: '#F7812B', name: 'orange' }, { color: 'transparent', name: 'Transparent' }];

            return defaultColors;
        }
    }, {
        key: 'loadCategories',
        value: function loadCategories() {
            wp.apiFetch({ path: "/wpdm/v1/categories" }).then(function (categories) {
                wpdmCategories.push({ label: "Select a Category", value: 0 });
                jQuery.each(categories, function (key, val) {
                    wpdmCategories.push({ label: val.label, value: val.id });
                });
            });
        }
    }]);

    return Util;
}();

Util.loadCategories();