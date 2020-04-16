(function($, window, document, undefined) {
    "use strict";

    // SEARCH POP-UP
    $('.main-header__search-btn').on('click', function() {
        $('.search-popup').addClass('open');
        return false;
    });

    $('.search-popup .close').on('click', function() {
        $('.search-popup').removeClass('open');
        return false;
    });


    // TOP LINE SCROLL

    // var scrolSection = $('.wpc-navigation nav a');
    // var scrolSection = $('.wpc-navigation nav a');

    function scrollOnPage(link) {
        link.on('click ', function() {
            var el = $(this).attr('href');
            $('body,html').animate({
                scrollTop: $(el).offset().top - 100
            }, 1000);

            return false;
        });
    }

    scrollOnPage($('.wpc-navigation nav a'));
    scrollOnPage($('.main-footer__up-btn'));
    scrollOnPage($('.main-header__action-link'));

    var $topLine = $('.main-header__menu-line');

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 50) {
            $topLine.addClass('main-header__menu-line--scroll');
        } else if (!($('.nav-menu-icon').hasClass('active'))) {
            $topLine.removeClass('main-header__menu-line--scroll');
        }
    });


// menu
    var $first_child_link = $('.menu-item-has-children > a').append('<span class="fa fa-angle-down"></span>');

    $('.nav-menu-icon').on('click', function(e) {
        $(this).toggleClass('active');
        $('.wpc-navigation').toggleClass('active');
        $('.main-header__topline').toggleClass('main-header__topline--mobile');
        if ($(window).scrollTop() > 50) {
            $topLine.addClass('main-header__menu-line--scroll');
        } else {
            $topLine.toggleClass('main-header__menu-line--scroll');
        }

    });

    $first_child_link.find('span').click(function(e) {
        $(this).closest('li').toggleClass('active');
    });

    $('.menu-item a').on('click', function(event) {
        event.preventDefault();
        $('.wpc-navigation').toggleClass('active');
    });


    // BACKGROUND IMAGE
    function wpc_add_img_bg(img_sel, parent_sel) {

        if (!img_sel) {
            console.info('no img selector');
            return false;
        }

        var $parent, _this;

        $(img_sel).each(function() {
            _this = $(this);
            $parent = _this.closest(parent_sel);
            $parent = $parent.length ? $parent : _this.parent();
            $parent.css('background-image', 'url(' + this.src + ')');
            _this.hide()
        });

    }

    wpc_add_img_bg('.main-header__bg');
    wpc_add_img_bg('.about__bg');
    wpc_add_img_bg('.teammate__img');
    wpc_add_img_bg('.testimonials__img');
    wpc_add_img_bg('.pricing__bg');
    wpc_add_img_bg('.contact-us__bg');
    // wpc_add_img_bg('.portfolio__img');



    // FACTS COUNTER
    var counters = function(parent_sel, item_sel, multiplier, bar) {
        $(parent_sel + ' ' + item_sel).not('.animated').each(function() {
            if ($(window).scrollTop() >= $(this).offset().top - $(window).height() * multiplier) {
                $(this).addClass('animated').countTo();
                if (bar) {
                    $('.skills__progress').each(function() {
                        $(this).width(($(this).attr('data-fill') + '%'));
                    })
                }

            }
        });
    }

    counters('.fact', '.fact__number', 0.95);
    counters('.skills__name', '.skills__counter', 1, true);

    $(window).on('scroll', function() {
        counters('.fact', '.fact__number', 0.95);
        counters('.skills__name', '.skills__counter', 1, true);
    });
    /* Run counters() on load, resize and scroll events */


    // ABOUT VIDEO

    $('.about__play-btn').on('click', function() {
        var videoSrc = $(this).attr('data-video');
        $('.about__video-iframe').attr('src', videoSrc);
        $('.about__video-tmb').hide();
        $('.about__video-iframe').show();
        $('.about__close-btn').show();
    })

    $('.about__close-btn').on('click', function() {
        $('.about__video-iframe').attr('src', 'about:blank');
        $('.about__video-tmb').show();
        $('.about__video-iframe').hide();
        $('.about__close-btn').hide();
    })




    // equal column

    $('.plan').matchHeight();
    $('.plan .plan__header').matchHeight();
    $('.advantage').matchHeight();
    $(window).on("orientationchange", function() {
        $('.plan').matchHeight();
        $('.plan .plan__header').matchHeight();
        $('.advantage').matchHeight();
    });



    /*============================*/
    /* 01 - VARIABLES */
    /*============================*/
    var swipers = [],
        winW, winH, winScr, _isresponsive, smPoint = 768,
        mdPoint = 992,
        lgPoint = 1200,
        addPoint = 1600,
        _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);


    /*========================*/
    /* 02 - PAGE CALCULATIONS */
    /*========================*/
    function pageCalculations() {
        winW = $(window).width();
        winH = $(window).height();
    }


    /*=================================*/
    /* 03 - FUNCTION ON DOCUMENT READY */
    /*=================================*/
    pageCalculations();


    /*============================*/
    /* 04 - FUNCTION ON PAGE LOAD */
    /*============================*/

    $(window).on('load', function() {
        initSwiper();
    });


    /*==============================*/
    /* 05 - FUNCTION ON PAGE RESIZE */
    /*==============================*/
    function resizeCall() {
        pageCalculations();

        $('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function() {
            var thisSwiper = swipers['swiper-' + $(this).attr('id')],
                $t = $(this),
                slidesPerViewVar = updateSlidesPerView($t),
                centerVar = thisSwiper.params.centeredSlides;
            thisSwiper.params.slidesPerView = slidesPerViewVar;
            thisSwiper.reInit();
            if (!centerVar) {
                var paginationSpan = $t.find('.pagination span');
                var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
                if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
                else $t.removeClass('pagination-hidden');
                paginationSlice.show();
            }
        });
    }
    if (!_ismobile) {
        $(window).on('resize', function() {
            resizeCall();
        });
    } else {
        window.addEventListener("orientationchange", function() {
            resizeCall();
        }, false);
    }

    /*=====================*/
    /* 06 - SWIPER SLIDERS */
    /*=====================*/

    function initSwiper() {

        var initIterator = 0;
        $('.swiper-container').each(function() {
            var $t = $(this);

            var index = 'swiper-unique-id-' + initIterator;

            $t.addClass('swiper-' + index + ' initialized').attr('id', index);
            $t.find('.pagination').addClass('pagination-' + index);

            var autoPlayVar = parseInt($t.attr('data-autoplay'), 10);
            var mode = $t.attr('data-mode');
            var slidesPerViewVar = $t.attr('data-slides-per-view');
            if (slidesPerViewVar === 'responsive') {
                slidesPerViewVar = updateSlidesPerView($t);
            } else slidesPerViewVar = parseInt(slidesPerViewVar, 10);

            var loopVar = parseInt($t.attr('data-loop'), 10);
            var speedVar = parseInt($t.attr('data-speed'), 10);
            var centerVar = parseInt($t.attr('data-center'), 10);
            swipers['swiper-' + index] = new Swiper('.swiper-' + index, {
                speed: speedVar,
                pagination: '.pagination-' + index,
                loop: loopVar,
                paginationClickable: true,
                autoplay: autoPlayVar,
                slidesPerView: slidesPerViewVar,
                keyboardControl: true,
                calculateHeight: true,
                simulateTouch: true,
                roundLengths: true,
                centeredSlides: centerVar,
                mode: mode || 'horizontal',
                onInit: function(swiper) {
                    $t.find('.swiper-slide').addClass('active');

                    if ($t.hasClass('teammates-swiper')) {
                        $('.skills__counter').countTo();

                    }
                },
                onSlideChangeEnd: function(swiper) {
                    var activeIndex = (loopVar === 1) ? swiper.activeLoopIndex : swiper.activeIndex;

                    if ($t.hasClass('teammates-swiper')) {
                        $('.skills__counter').countTo();
                        $('.swiper-slide-active').find('.skills__progress').each(function() {
                            $(this).width(($(this).attr('data-fill') + '%'));
                        })
                    }
                },
                onSlideChangeStart: function(swiper) {

                    if ($t.hasClass('teammates-swiper')) {
                        $('.skills__counter').html('0');
                        $('.skills__progress').width('0');
                    }

                    $t.find('.swiper-slide.active').removeClass('active');
                }
            });
            swipers['swiper-' + index].reInit();
            if ($t.attr('data-slides-per-view') === 'responsive') {
                var paginationSpan = $t.find('.pagination span');
                var paginationSlice = paginationSpan.hide().slice(0, (paginationSpan.length + 1 - slidesPerViewVar));
                if (paginationSlice.length <= 1 || slidesPerViewVar >= $t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
                else $t.removeClass('pagination-hidden');
                paginationSlice.show();
            }

            if ($t.find('.default-active').length) {
                swipers['swiper-' + index].swipeTo($t.find('.swiper-slide').index($t.find('.default-active')), 0);
            }

            initIterator++;
        });

    }

    function updateSlidesPerView(swiperContainer) {
        // counters('.skills__name', '.skills__counter', 0.95, true);
        if (winW >= addPoint) return parseInt(swiperContainer.attr('data-add-slides'), 10);
        else if (winW >= lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'), 10);
        else if (winW >= mdPoint) return parseInt(swiperContainer.attr('data-md-slides'), 10);
        else if (winW >= smPoint) return parseInt(swiperContainer.attr('data-sm-slides'), 10);
        else return parseInt(swiperContainer.attr('data-xs-slides'), 10);
    }


    //swiper arrows
    $('.swiper-arrow-left').on('click', function() {
        swipers['swiper-' + $(this).parent().attr('id')].swipePrev();
    });

    $('.swiper-arrow-right').on('click', function() {
        swipers['swiper-' + $(this).parent().attr('id')].swipeNext();
    });

    $('.swiper-outer-left').on('click', function() {
        swipers['swiper-' + $(this).parent().find('.swiper-container').attr('id')].swipePrev();
    });

    $('.swiper-outer-right').on('click', function() {
        swipers['swiper-' + $(this).parent().find('.swiper-container').attr('id')].swipeNext();
    });


    // ISOTOPE PORTFOLIO


    var $grid = $('.portfolio__grid').isotope({
        itemSelector: '.portfolio__item',
        masonry: {
            columnWidth: '.col-md-3'
        }
    });

    $('#filters').on('click', '.but', function() {
        var izotope_container = $('.portfolio__grid');
        for (var i = izotope_container.length - 1; i >= 0; i--) {
            $(izotope_container[i]).find('.item').removeClass('animated');
        }

        $('#filters .but').removeClass('activbut');
        $(this).addClass('activbut');
        var filterValue = $(this).attr('data-filter');
        izotope_container.isotope({ filter: filterValue });


        return false;
    });


    // PORTFOLIO POP-UP

    $('.portfolio__popup').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom',
    });
})(jQuery, window, document);
