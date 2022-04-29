'use strict';

// Cache
var body = $('body');
var mainSlider = $('#main-slider');
var imageCarousel = $('.img-carousel');
var partnersCarousel = $('#partners');
var testimonialsCarousel = $('#testimonials');
var testimonialsCarouselAlt = $('#testimonials-alt');
var carCarousel = $('.car-carousel');
var topProductsCarousel = $('#top-products-carousel');
var featuredProductsCarousel = $('#featured-products-carousel');
var sidebarProductsCarousel = $('#sidebar-products-carousel');
var hotDealsCarousel = $('#hot-deals-carousel');
var owlCarouselSelector = $('.owl-carousel');
var isotopeContainer = $('.isotope');
var isotopeFiltrable = $('#filtrable a');
var toTop = $('#to-top');
var hover = $('.thumbnail');
var navigation = $('.navigation');
var superfishMenu = $('ul.sf-menu');
var priceSliderRange = $('#slider-range');
var swiperOffersBest = $('.swiper--offers-best .swiper-container');
var swiperOffersPopular = $('.swiper--offers-popular .swiper-container');
var swiperOffersEconomic = $('.swiper--offers-economic .swiper-container');

var swiperSlider1x1 = $('#swiperSlider1x1');
var swiperSlider1x2 = $('#swiperSlider1x2');
var swiperSlider1x3 = $('#swiperSlider1x3');
var swiperSlider1x4 = $('#swiperSlider1x4');
var swiperSlider1x5 = $('#swiperSlider1x5');

var swiperSlider2x1 = $('#swiperSlider2x1');
var swiperSlider2x2 = $('#swiperSlider2x2');
var swiperSlider2x3 = $('#swiperSlider2x3');
var swiperSlider2x4 = $('#swiperSlider2x4');
var swiperSlider2x5 = $('#swiperSlider2x5');

var swiperSlider3x1 = $('#swiperSlider3x1');
var swiperSlider3x2 = $('#swiperSlider3x2');
var swiperSlider3x3 = $('#swiperSlider3x3');
var swiperSlider3x4 = $('#swiperSlider3x4');
var swiperSlider3x5 = $('#swiperSlider3x5');

var swiperSlider4x1 = $('#swiperSlider4x1');
var swiperSlider4x2 = $('#swiperSlider4x2');
var swiperSlider4x3 = $('#swiperSlider4x3');
var swiperSlider4x4 = $('#swiperSlider4x4');
var swiperSlider4x5 = $('#swiperSlider4x5');

// Slide in/out with fade animation function
jQuery.fn.slideFadeToggle = function (speed, easing, callback) {
    return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
};
//
jQuery.fn.slideFadeIn = function (speed, easing, callback) {
    return this.animate({opacity: 'show', height: 'show'}, speed, easing, callback);
};
jQuery.fn.slideFadeOut = function (speed, easing, callback) {
    return this.animate({opacity: 'hide', height: 'hide'}, speed, easing, callback);
};

jQuery(document).ready(function () {
    // Prevent empty links
    // ---------------------------------------------------------------------------------------
    $('a[href=#]').on('click', function (event) {
        event.preventDefault();
    });
    // Sticky header/menu
    // ---------------------------------------------------------------------------------------
    if ($().sticky) {
        $('.header.fixed').sticky({topSpacing: 0});
        //$('.header.fixed').on('sticky-start', function() { console.log("Started"); });
        //$('.header.fixed').on('sticky-end', function() { console.log("Ended"); });
    }
    // SuperFish menu
    // ---------------------------------------------------------------------------------------
    if ($().superfish) {
        superfishMenu.superfish();
    }
    $('ul.sf-menu a').on('click', function () {
        body.scrollspy('refresh');
    });
    // Fixed menu toggle
    $('.menu-toggle').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    $('.menu-toggle-close').on('click', function () {
        if (navigation.hasClass('opened')) {
            navigation.removeClass('opened').addClass('closed');
        } else {
            navigation.removeClass('closed').addClass('opened');
        }
    });
    //
    if ($('.content-area.scroll').length) {
        $('.open-close-area').on('click', function () {
            if ($('.wrapper').hasClass('opened')) {
                $('.wrapper').removeClass('opened').addClass('closed');
            } else {
                $('.wrapper').removeClass('closed').addClass('opened');
            }
        });
    }
    // Smooth scrolling
    // ----------------------------------------------------------------------------------------
    $('.sf-menu a, .scroll-to').on('click', function () {

        $('.sf-menu a').removeClass('active');
        $(this).addClass('active');
        $('html, body').animate({
            scrollTop: $($(this).attr('href')).offset().top
        }, {
            duration: 1200,
            easing: 'easeInOutExpo'
        });
        return false;
    });
    // BootstrapSelect
    // ---------------------------------------------------------------------------------------
    if ($().selectpicker) {
        $('.selectpicker').selectpicker();
    }
    // prettyPhoto
    // ---------------------------------------------------------------------------------------
    if ($().prettyPhoto) {
        $("a[data-gal^='prettyPhoto']").prettyPhoto({
            theme: 'dark_square'
        });
    }
    // Scroll totop button
    // ---------------------------------------------------------------------------------------
    $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
            toTop.css({bottom: '15px'});
        } else {
            toTop.css({bottom: '-100px'});
        }
    });
    toTop.on('click', function () {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });
    // Add hover class for correct view on mobile devices
    // ---------------------------------------------------------------------------------------
    /*hover.on('hover',
     function () {
     $(this).addClass('hover');
     },
     function () {
     $(this).removeClass('hover');
     }
     );*/
    // Ajax / load external content in tabs
    // ---------------------------------------------------------------------------------------
    $('[data-toggle="tabajax"]').on('click', function (e) {
        e.preventDefault();
        var loadurl = $(this).attr('href');
        var targ = $(this).attr('data-target');
        $.get(loadurl, function (data) {
            $(targ).html(data);
        });
        $(this).tab('show');
    });
    // Sliders
    // ---------------------------------------------------------------------------------------
    if ($().owlCarousel) {
        var owl = $('.owl-carousel');
        owl.on('changed.owl.carousel', function (e) {
            // update prettyPhoto
            if ($().prettyPhoto) {
                $("a[data-gal^='prettyPhoto']").prettyPhoto({
                    theme: 'dark_square'
                });
            }
        });
        // Main slider
        if (mainSlider.length) {
            mainSlider.owlCarousel({
                //items: 1,
                autoplay: false,
                autoplayHoverPause: true,
                loop: true,
                margin: 0,
                dots: true,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
        // Top products carousel
        if (topProductsCarousel.length) {
            topProductsCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 5},
                    1280: {items: 6}
                }
            });
        }
        // Featured products carousel
        if (featuredProductsCarousel.length) {
            featuredProductsCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 2},
                    991: {items: 3},
                    1024: {items: 4}
                }
            });
        }
        // Sidebar products carousel
        if (sidebarProductsCarousel.length) {
            sidebarProductsCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
        // Partners carousel
        if (partnersCarousel.length) {
            partnersCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 2},
                    768: {items: 3},
                    991: {items: 4},
                    1024: {items: 5},
                    1280: {items: 6}
                }
            });
        }
        // Testimonials carousel
        if (testimonialsCarousel.length) {
            testimonialsCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 0,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1},
                    1280: {items: 1}
                }
            });
        }
        // Testimonials carousel alt version
        if (testimonialsCarouselAlt.length) {
            testimonialsCarouselAlt.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 0,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 2},
                    1024: {items: 2},
                    1280: {items: 2}
                }
            });
        }
        // Images carousel
        if (imageCarousel.length) {
            var isMulti = (imageCarousel.find('.item').length > 1) ? true : false
            imageCarousel.owlCarousel({
                autoplay: false,
                loop: isMulti,
                margin: 0,
                dots: true,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
        // Car carousel
        if (carCarousel.length) {
            carCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: false,
                nav: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsiveRefreshRate: 100,
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 2},
                    991: {items: 3},
                    1024: {items: 3}
                }
            });
        }
        // on tab click
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
            updater();
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            updater();
        });
    }
    // Sliders
    // ---------------------------------------------------------------------------------------
    if ($().swiper) {
        if (swiperOffersBest.length) {
            swiperOffersBest = new Swiper(swiperOffersBest, {
                direction: 'horizontal',
                slidesPerView: 3,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
        }
        if (swiperOffersPopular.length) {
            swiperOffersPopular = new Swiper(swiperOffersPopular, {
                direction: 'horizontal',
                slidesPerView: 3,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
        }
        if (swiperOffersEconomic.length) {
            swiperOffersEconomic = new Swiper(swiperOffersEconomic, {
                direction: 'horizontal',
                slidesPerView: 3,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: true,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });
        }
        var swiper = new Swiper('.navigation', {
            scrollbar: '.swiper-scrollbar',
            direction: 'vertical',
            slidesPerView: 'auto',
            mousewheelControl: true,
            freeMode: true
        });
        if ($('.content-area.scroll').length) {
            var swiper2 = new Swiper('.content-area.scroll', {
                scrollbar: '.swiper-scrollbar',
                direction: 'vertical',
                slidesPerView: 'auto',
                mousewheelControl: true,
                freeMode: true
            });
        }
        // swiper in tabs
        if (swiperSlider1x1.length) {
            swiperSlider1x1 = new Swiper(swiperSlider1x1, {
                pagination: '#swiperSlider1x1 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider1x2.length) {
            swiperSlider1x2 = new Swiper(swiperSlider1x2, {
                pagination: '#swiperSlider1x2 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider1x3.length) {
            swiperSlider1x3 = new Swiper(swiperSlider1x3, {
                pagination: '#swiperSlider1x3 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider1x4.length) {
            swiperSlider1x4 = new Swiper(swiperSlider1x4, {
                pagination: '#swiperSlider1x4 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider1x5.length) {
            swiperSlider1x5 = new Swiper(swiperSlider1x5, {
                pagination: '#swiperSlider1x5 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }

        if (swiperSlider2x1.length) {
            swiperSlider2x1 = new Swiper(swiperSlider2x1, {
                pagination: '#swiperSlider2x1 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider2x2.length) {
            swiperSlider2x2 = new Swiper(swiperSlider2x2, {
                pagination: '#swiperSlider2x2 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider2x3.length) {
            swiperSlider2x3 = new Swiper(swiperSlider2x3, {
                pagination: '#swiperSlider2x3 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider2x4.length) {
            swiperSlider2x4 = new Swiper(swiperSlider2x4, {
                pagination: '#swiperSlider2x4 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider2x5.length) {
            swiperSlider2x5 = new Swiper(swiperSlider2x5, {
                pagination: '#swiperSlider2x5 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }

        if (swiperSlider3x1.length) {
            swiperSlider3x1 = new Swiper(swiperSlider3x1, {
                pagination: '#swiperSlider3x1 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider3x2.length) {
            swiperSlider3x2 = new Swiper(swiperSlider3x2, {
                pagination: '#swiperSlider3x2 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider3x3.length) {
            swiperSlider3x3 = new Swiper(swiperSlider3x3, {
                pagination: '#swiperSlider3x3 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider3x4.length) {
            swiperSlider3x4 = new Swiper(swiperSlider3x4, {
                pagination: '#swiperSlider3x4 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider3x5.length) {
            swiperSlider3x5 = new Swiper(swiperSlider3x5, {
                pagination: '#swiperSlider3x5 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }

        if (swiperSlider4x1.length) {
            swiperSlider4x1 = new Swiper(swiperSlider4x1, {
                pagination: '#swiperSlider4x1 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider4x2.length) {
            swiperSlider4x2 = new Swiper(swiperSlider4x2, {
                pagination: '#swiperSlider4x2 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider4x3.length) {
            swiperSlider4x3 = new Swiper(swiperSlider4x3, {
                pagination: '#swiperSlider4x3 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider4x4.length) {
            swiperSlider4x4 = new Swiper(swiperSlider4x4, {
                pagination: '#swiperSlider4x4 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }
        if (swiperSlider4x5.length) {
            swiperSlider4x5 = new Swiper(swiperSlider4x5, {
                pagination: '#swiperSlider4x5 .row.car-thumbnails',
                paginationClickable: true,
                paginationBulletRender: function (index, className) {
                    return '<div class="col-xs-2 col-sm-2 col-md-3 ' + className + '"><a href="#"><img src="rentit/assets/img/preview/cars/car-70x70x' + (index + 1) + '.jpg" alt=""/></a></div>';
                }
            });
        }

        // /swiper in tabs
    }
    // countdown
    // ---------------------------------------------------------------------------------------
    if ($().countdown) {
        var austDay = new Date();
        austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
        $('#dealCountdown1').countdown({until: austDay});
        $('#dealCountdown2').countdown({until: austDay});
        $('#dealCountdown3').countdown({until: austDay});
    }
    // Google map
    // ---------------------------------------------------------------------------------------

    // Price range / need jquery ui
    // ---------------------------------------------------------------------------------------
    if (jQuery.ui) {
        if (jQuery(priceSliderRange).length) {
            var amount = jQuery("#amount");
            var amount_price = jQuery("#amout_rating");
            var space = '';
            if (rentit_obj.currency_pos == 'right_space' || rentit_obj.currency_pos == 'left_space') {
                space = ' ';

            }
            jQuery(priceSliderRange).slider({
                range: true,
                min: parseInt(amount.data('min')),
                max: parseInt(amount.data('max')),
                values: [amount.data('value_min'), amount.data('value_max')],
                slide: function (event, ui) {
                    if (rentit_obj.currency_pos == 'right' || rentit_obj.currency_pos == 'right_space') {
                        amount.val(ui.values[0] + space + rentit_obj.currency + " - " + ui.values[1] + space + rentit_obj.currency);
                        amount_price.val(ui.values[0] + ',' + ui.values[1]);
                    } else {
                        amount.val(rentit_obj.currency + space + ui.values[0] + " - " + rentit_obj.currency + space + ui.values[1]);
                        amount_price.val(ui.values[0] + ',' + ui.values[1]);
                    }
                }
            });

            if (rentit_obj.currency_pos == 'right' || rentit_obj.currency_pos == 'right_space') {
                amount.val(
                    jQuery("#slider-range").slider("values", 0) + space + rentit_obj.currency +
                    " - " + jQuery("#slider-range").slider("values", 1) + space + rentit_obj.currency
                );
            } else {
                amount.val(
                    rentit_obj.currency + space + jQuery("#slider-range").slider("values", 0) +
                    " - " + rentit_obj.currency + space + jQuery("#slider-range").slider("values", 1)
                );
            }
            amount_price.val(
                jQuery("#slider-range").slider("values", 0) + "," + jQuery("#slider-range").slider("values", 1)
            );

        }
    }
    // Shop categories widget slide in/out
    // ---------------------------------------------------------------------------------------
    $('.car-categories .arrow').on('click', function (event) {

        $(this).parent().parent().find('ul.children').removeClass('active');
        $(this).parent().parent().find('.fa-angle-up').addClass('fa-angle-down').removeClass('fa-angle-up');
        if ($(this).parent().find('ul.children').is(":visible")) {
            //$(this).find('.fa-angle-up').addClass('fa-angle-down').removeClass('fa-angle-up');
            //$(this).parent().find('ul.children').removeClass('active');
        }
        else {
            $(this).find('.fa-angle-down').addClass('fa-angle-up').removeClass('fa-angle-down');
            $(this).parent().find('ul.children').addClass('active');
        }
        $(this).parent().parent().find('ul.children').each(function () {
            if (!$(this).hasClass('active')) {
                $(this).slideFadeOut();
            }
            else {
                $(this).slideFadeIn();
            }
        });
    }
    );
    $('.car-categories ul.children').each(function () {
        if (!$(this).hasClass('active')) {
            $(this).hide();
        }
    });
    // Ripple effect on click for buttons
    // ---------------------------------------------------------------------------------------
    $(".ripple-effect").on('click', function (e) {
        var rippler = $(this);

        // create .ink element if it doesn't exist
        if (rippler.find(".ink").length == 0) {
            rippler.append("<span class='ink'></span>");
        }

        var ink = rippler.find(".ink");

        // prevent quick double clicks
        ink.removeClass("animate");

        // set .ink diametr
        if (!ink.height() && !ink.width())
        {
            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
            ink.css({height: d, width: d});
        }

        // get click coordinates
        var x = e.pageX - rippler.offset().left - ink.width() / 2;
        var y = e.pageY - rippler.offset().top - ink.height() / 2;

        // set .ink position and add class .animate
        ink.css({
            top: y + 'px',
            left: x + 'px'
        }).addClass("animate");
    })
    updater();
});

jQuery(window).load(function () {
    // Preloader
    $('#status').fadeOut();
    $('#preloader').delay(200).fadeOut(200);
    // Isotope
    if ($().isotope) {
        isotopeContainer.isotope({// initialize isotope
            itemSelector: '.isotope-item' // options...
                    //,transitionDuration: 0 // disable transition
        });
        isotopeFiltrable.on('click', function () { // filter items when filter link is clicked
            var selector = $(this).attr('data-filter');
            isotopeFiltrable.parent().removeClass('current');
            $(this).parent().addClass('current');
            isotopeContainer.isotope({filter: selector});
            return false;
        });
        isotopeContainer.isotope('reLayout'); // layout/reLayout
    }
    // Scroll to hash
    if (location.hash != '') {
        var hash = '#' + window.location.hash.substr(1);
        if (hash.length) {
            body.delay(0).animate({
                scrollTop: jQuery(hash).offset().top
            }, {
                duration: 1200,
                easing: "easeInOutExpo"
            });
        }
    }
    // OwlSliders
    if ($().owlCarousel) {
        // Hot deal carousel
        // must initialized after counters
        if (hotDealsCarousel.length) {
            hotDealsCarousel.owlCarousel({
                autoplay: false,
                loop: true,
                margin: 30,
                dots: true,
                nav: false,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {items: 1},
                    479: {items: 1},
                    768: {items: 1},
                    991: {items: 1},
                    1024: {items: 1}
                }
            });
        }
    }
    updater();
});

function updater() {
    if ($().sticky) {
        $('.header.fixed').sticky('update');
    }

    // refresh swiper slider
    if ($().swiper) {
        //

        jQuery('.swiper-container-GREAT-RENTAL').each(function (index, element) {
            jQuery(this).addClass('s' + index);
            var slidesPerView = 3;
            if (jQuery(window).width() > 991) {
                slidesPerView = 3;
            }
            else {
                if (jQuery(window).width() < 768) {
                    slidesPerView = 1;
                }
                else {
                    slidesPerView = 2;
                }
            }
            var swiper = jQuery('.swiper-container.s' + index);
            swiper.swiper({
                direction: 'horizontal',
                slidesPerView: slidesPerView,
                spaceBetween: 30,
                //autoplay: 2000,
                loop: false,
                paginationClickable: true,
                pagination: '.swiper-pagination',
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev'
            });


            if (typeof(swiper.length) == 'undefined') {
                swiper.update();
                swiper.onResize();

            }

        });



        if (typeof (swiperOffersBest.length) == 'undefined') {
            swiperOffersBest.update();
            swiperOffersBest.onResize();
            if ($(window).width() > 991) {
                swiperOffersBest.params.slidesPerView = 3;
                //swiperOffersBest.stopAutoplay();
                //swiperOffersBest.startAutoplay();
            }
            else {
                if ($(window).width() < 768) {
                    swiperOffersBest.params.slidesPerView = 1;
                    //swiperOffersBest.stopAutoplay();
                    //swiperOffersBest.startAutoplay();
                }
                else {
                    swiperOffersBest.params.slidesPerView = 2;
                    //swiperOffersBest.stopAutoplay();
                    //swiperOffersBest.startAutoplay();
                }
            }
        }
        //
        if (typeof (swiperOffersPopular.length) == 'undefined') {
            swiperOffersPopular.update();
            swiperOffersPopular.onResize();
            if ($(window).width() > 991) {
                swiperOffersPopular.params.slidesPerView = 3;
                //swiperOffersPopular.stopAutoplay();
                //swiperOffersPopular.startAutoplay();
            }
            else {
                if ($(window).width() < 768) {
                    swiperOffersPopular.params.slidesPerView = 1;
                    //swiperOffersPopular.stopAutoplay();
                    //swiperOffersPopular.startAutoplay();
                }
                else {
                    swiperOffersPopular.params.slidesPerView = 2;
                    //swiperOffersPopular.stopAutoplay();
                    //swiperOffersPopular.startAutoplay();
                }
            }
        }
        //
        if (typeof (swiperOffersEconomic.length) == 'undefined') {
            swiperOffersEconomic.update();
            swiperOffersEconomic.onResize();
            if ($(window).width() > 991) {
                swiperOffersEconomic.params.slidesPerView = 3;
                swiperOffersEconomic.stopAutoplay();
                swiperOffersEconomic.startAutoplay();
            }
            else {
                if ($(window).width() < 768) {
                    swiperOffersEconomic.params.slidesPerView = 1;
                    swiperOffersEconomic.stopAutoplay();
                    swiperOffersEconomic.startAutoplay();
                }
                else {
                    swiperOffersEconomic.params.slidesPerView = 2;
                    swiperOffersEconomic.stopAutoplay();
                    swiperOffersEconomic.startAutoplay();
                }
            }
        }
        // swiper in tabs
        // if (typeof (swiperSlider1x1.length) == 'undefined') {
        //     swiperSlider1x1.update();
        //     swiperSlider1x1.onResize();
        // }
        // if (typeof (swiperSlider1x2.length) == 'undefined') {
        //     swiperSlider1x2.update();
        //     swiperSlider1x2.onResize();
        // }
        // if (typeof (swiperSlider1x3.length) == 'undefined') {
        //     swiperSlider1x3.update();
        //     swiperSlider1x3.onResize();
        // }
        // if (typeof (swiperSlider1x4.length) == 'undefined') {
        //     swiperSlider1x4.update();
        //     swiperSlider1x4.onResize();
        // }
        // if (typeof (swiperSlider1x5.length) == 'undefined') {
        //     swiperSlider1x5.update();
        //     swiperSlider1x5.onResize();
        // }
        //
        // if (typeof (swiperSlider2x1.length) == 'undefined') {
        //     swiperSlider2x1.update();
        //     swiperSlider2x1.onResize();
        // }
        // if (typeof (swiperSlider2x2.length) == 'undefined') {
        //     swiperSlider2x2.update();
        //     swiperSlider2x2.onResize();
        // }
        // if (typeof (swiperSlider2x3.length) == 'undefined') {
        //     swiperSlider2x3.update();
        //     swiperSlider2x3.onResize();
        // }
        // if (typeof (swiperSlider2x4.length) == 'undefined') {
        //     swiperSlider2x4.update();
        //     swiperSlider2x4.onResize();
        // }
        // if (typeof (swiperSlider2x5.length) == 'undefined') {
        //     swiperSlider2x5.update();
        //     swiperSlider2x5.onResize();
        // }
        //
        // if (typeof (swiperSlider3x1.length) == 'undefined') {
        //     swiperSlider3x1.update();
        //     swiperSlider3x1.onResize();
        // }
        // if (typeof (swiperSlider3x2.length) == 'undefined') {
        //     swiperSlider3x2.update();
        //     swiperSlider3x2.onResize();
        // }
        // if (typeof (swiperSlider3x3.length) == 'undefined') {
        //     swiperSlider3x3.update();
        //     swiperSlider3x3.onResize();
        // }
        // if (typeof (swiperSlider3x4.length) == 'undefined') {
        //     swiperSlider3x4.update();
        //     swiperSlider3x4.onResize();
        // }
        // if (typeof (swiperSlider3x5.length) == 'undefined') {
        //     swiperSlider3x5.update();
        //     swiperSlider3x5.onResize();
        // }
        //
        // if (typeof (swiperSlider4x1.length) == 'undefined') {
        //     swiperSlider4x1.update();
        //     swiperSlider4x1.onResize();
        // }
        // if (typeof (swiperSlider4x2.length) == 'undefined') {
        //     swiperSlider4x2.update();
        //     swiperSlider4x2.onResize();
        // }
        // if (typeof (swiperSlider4x3.length) == 'undefined') {
        //     swiperSlider4x3.update();
        //     swiperSlider4x3.onResize();
        // }
        // if (typeof (swiperSlider4x4.length) == 'undefined') {
        //     swiperSlider4x4.update();
        //     swiperSlider4x4.onResize();
        // }
        // if (typeof (swiperSlider4x5.length) == 'undefined') {
        //     swiperSlider4x5.update();
        //     swiperSlider4x5.onResize();
        // }

    }

    // refresh waypoints
    //$.waypoints('refresh');
    // refresh owl carousels/sliders
    //owlCarouselSelector.trigger('refresh');
    //owlCarouselSelector.trigger('refresh.owl.carousel');

   // $('.datepicker').datetimepicker();

  $('#formFindCarDate').datetimepicker();


}

jQuery(window).resize(function () {
    // Refresh isotope
    if ($().isotope) {
        isotopeContainer.isotope('reLayout'); // layout/relayout on window resize
    }
    updater();
});

jQuery(window).scroll(function () {
    if ($().sticky) {
        $('.header.fixed').sticky('update');
    }
});