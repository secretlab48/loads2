jQuery(document).ready( function( $ ) {

    $('.page-template-pt-userpro-edit-profile .userpro-field-user_email input').attr('readonly', true);

    $('.cat-item.has-sub-categories > a').on( 'click', function( e ) {
        if ( $(e.target).hasClass('open-category') ) {
            e.preventDefault();
            let childrens = $(e.target).closest('.cat-item').find('.children');
            if ( childrens.length > 0 ) {
                let children = $(childrens)[0];
                if ( !$(e.target).closest('.cat-item').hasClass('opened') ) {
                    $(e.target).closest('.cat-item').addClass('opened')
                    $(children).find('> li.cat-item').slideDown();
                }
                else {
                    $(e.target).closest('.cat-item').removeClass('opened')
                    $(children).find('> li.cat-item').slideUp();
                }
            }
        }
    } );


    if ( !$('body').hasClass( 'wp-admin' ) ) {
        $("body").queryLoader2({
            barColor: '#000',
            backgroundColor: '#fff',
            percentage: true,
            barHeight: 2,
            completeAnimation: "grow",
            minimumTime: 100,
            onLoadComplete: hidePreLoader
        });

        function hidePreLoader() {
            $("#preloader").hide();
        }
    }

    $('.menu-manage').on( 'click', function( e ) {
        var trg;
        if ( !$(e.target).hasClass('menu-manage') )
            trg = $(e.target).parent();
        else
            trg = $(e.target);

        if ( !$('body').hasClass('top-menu-opened') ) {
            $('body').addClass('top-menu-opened');
            //$('.site-wrapper').animate( { 'left' : '300px' }, { 'duration' : 600, 'easing' : 'linear' } );
        }
        else {
            $('body').removeClass('top-menu-opened');
            //$('.site-wrapper').animate( { 'left' : 0 }, { 'duration' : 600, 'easing' : 'linear' } );
        }
    });

    $(document).on( 'click', '.sign-in-link > a', function( e ) {

        e.preventDefault();
        if ( !$(e.target).parents('.sign-in-link').hasClass('active-login') ) {
            $(e.target).parents('.sign-in-link').addClass('active-login');
            $(e.target).parents('.sign-in-link').find('.login-form-box').slideDown();
        }
        else {
            $(e.target).parents('.sign-in-link').removeClass('active-login');
            $(e.target).parents('.sign-in-link').find('.login-form-box').slideUp();
        }

    });


    $.datepicker.setDefaults(
        $.extend(
            {'dateFormat':'dd-mm-yy'},
            $.datepicker.regional['de']
        )
    );

    $('input.date-selector').datepicker({
        dateFormat: 'dd-mm-yy'
    });


    $('button.search-news').on( 'click', function( e ) {

        let href = document.location.origin;
        let data = [];

        if ( $('.search-word-input').val() != '' ) {
            data.push( 'search_word=' + $('.search-word-input').val() );
        }
        if ( $('.date-selector.start-date').val() != '' ) {
            data.push( 'start_date=' + $('.date-selector.start-date').val() );
        }
        if ( $('.date-selector.end-date').val() != '' ) {
            data.push( 'end_date=' + $('.date-selector.end-date').val() );
        }

        if ( data.length > 0 ) {
            location.href = document.location.origin + document.location.pathname.replace( /page\/[0-9]+\/?/, '' ) + '?' + data.join( '&' );
        }
        else {
            location.href = document.location.origin + document.location.pathname.replace( /page\/[0-9]+\/?/, '' );
        }

    });



    $('.partner-imgs').slick( {
        'slidesToShow' : 3,
        'slidesToScroll' : 1,
        'responsive' : [
            {
                breakpoint: 768,
                settings: {
                    'slidesToShow': 2,
                    'autoplay': true,
                    'infinite': true,
                }
            },
            {
                breakpoint : 480,
                settings : {
                    'slidesToShow' : 1,
                    'autoplay' : true,
                    'infinite' : true,
                }
            }
        ]
    } );


    /*if ( $(window).width() > 992 ) {

        $('.header-top-box').headroom({
            'offset': 205,
            'tolerance': {
                up: 5,
                down: 0
            },
            'classes': {
                "initial": "animated",
                "pinned": "slideDown",
                "unpinned": "slideUp"
            ,
        scroller : someElement,
        // callback when pinned, `this` is headroom object
        onPin : function() {},
        // callback when unpinned, `this` is headroom object
        onUnpin : function() {},
        // callback when above offset, `this` is headroom object
        onTop : function() {},
        // callback when below offset, `this` is headroom object
        onNotTop : function() {},
        // callback when at bottom of page, `this` is headroom object
        onBottom : function() {},
        // callback when moving away from bottom of page, `this` is headroom object
        onNotBottom : function() {}
        });

    }*/



    /*new ScrollMagic.Scene({
        triggerElement: 'main',
        triggerHook: 0.65,
        duration: 0,
        offset: 0.01
    })
        .setClassToggle('.header-top-container', 'small-top-img')
        //.addIndicators() // add indicators (requires plugin)
        .addTo(controller);*/


    /*var tween = new TimelineMax()
        .from(".news-content .news-item-box", 1.5, { scale: 0.7, opacity: 0 } )


    new ScrollMagic.Scene({
        triggerElement: ".standard-h2",
        triggerHook: 0.5,
        duration: 0,
        offset: 50
    })
        .setTween(tween)
        .addIndicators({name: "GSAP"}) // add indicators (requires plugin)
        .addTo(controller);*/


    if ( $('.parallaxParent').length > 0 ) {

        var parallaxController = new ScrollMagic.Controller( { globalSceneOptions: { triggerHook: "onEnter", duration: "150%" } } );

        new ScrollMagic.Scene({triggerElement: '.parallaxParent'})
            .setTween('.parallaxParent > .parallaxChild', {y: '100%', ease: Linear.easeNone})
            .addTo(parallaxController);

    }


    /*if ( $('.header-top-container').length > 0 ) {

        var controller = new ScrollMagic.Controller();

        new ScrollMagic.Scene({
            triggerElement: '.header-top-container',
            triggerHook: 0,
            duration: 0,
            offset: 0.01
        })
            .setClassToggle('.header-top-container', 'engaged')
            .setPin('.header-top-container')
            //.addIndicators() // add indicators (requires plugin)
            .addTo(controller);

    }*/


    let scroller = { 'settedClass' : false, 'wh' : 300 }

    $(document).mousewheel(function (e) {

        if (e.deltaY == -1) {
            if ( $(window).scrollTop() > 150 ) {
                if (!$('body').hasClass('top-menu-opened')) {
                    $('.header-top-container').addClass('hided-on-top');
                }
                if (!scroller.settedClass && ($(window).scrollTop() > scroller.wh)) {
                    $('.header-top-container').addClass('small-top-img engaged');
                    scroller.settedClass = true;
                }
            }
        }
        else {
            $('.header-top-container').removeClass('hided-on-top');
            if ( scroller.settedClass && ( $(window).scrollTop() < scroller.wh ) ) {
                $('.header-top-container').removeClass('small-top-img engaged');
                scroller.settedClass = false;
            }
        }

    });

    $(window).on( 'resize', function( e ) {
        scroller.wh = $(window).height();
    } );



    $('.sb-button').on( 'click', function( e ) {

        if ( !$('body').hasClass( 'loading' ) ) {

            $('body').addClass( 'loading' );

            $.ajax({
                'method': 'POST',
                'url': ajaxdata.url,
                'data': { 'action' : 'get_subscibtion_mail_answer', 'email' : $(e.target).parent().find('input').val() },
                'success': function (answer) {
                    var result = JSON.parse(answer);
                    $(e.target).parent().find('.ajax-answer').html( result.content );
                    $(e.target).parent().addClass('show-ajax-answer');
                    $('body').removeClass('loading');
                    setTimeout( function() {
                        $(e.target).parent().removeClass('show-ajax-answer');
                        $(e.target).parent().find('.ajax-answer').empty();
                    }, 10000 );
                },
                'error': function () {
                    $(e.target).parent().find('.ajax-answer').html( answer.content );
                    $(e.target).parent().addClass( 'tecnical error occurred' );
                    $('body').removeClass('loading');
                }
            });

        }

    });




    function initMap() {
        var place = { lat:  48.181108, lng: 11.511545 };
        var map = new google.maps.Map(
            $( '.map')[0],
            {
                zoom: 12,
                center: place,
                styles :

                    [
                        {
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                }
                            ]
                        },
                        {
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#616161"
                                }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "color": "#f5f5f5"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#bdbdbd"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#eeeeee"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#757575"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e5e5e5"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#9e9e9e"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#757575"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#dadada"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#616161"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#9e9e9e"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e5e5e5"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#eeeeee"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#c9c9c9"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "color": "#9e9e9e"
                                }
                            ]
                        }
                    ]
            }
        );

        var markerImage = location.protocol + '//' + location.hostname + '/wp-content/themes/UDFT/img/map-marker.jpg';
        var marker_img = { url : location.protocol + '//' + location.hostname + '/wp-content/themes/UDFT/img/map-marker-logo.jpg', size : new google.maps.Size(70, 60), scaledSize: new google.maps.Size(70, 60) };
        var marker = new google.maps.Marker( { position: place, map : map, icon: marker_img } );



        marker.addListener('click', function() {
            //infowindow.open(map, marker);
            if ( !$('body').hasClass('has-map-info-box') ) {
                if ( !$('.map-info-box').parent().hasClass('map') ) {
                    $('.map-info-box').detach().prependTo('.map');
                }

                $('body').addClass('has-map-info-box');
            }
            else {
                $('body').removeClass('has-map-info-box');
            }
        });

    }

    I = setInterval( function() {
        if ( ( typeof google === 'object' && typeof google.maps === 'object' ) ) {
            initMap();
            clearInterval(I);
        }
    }, 100 );


});
