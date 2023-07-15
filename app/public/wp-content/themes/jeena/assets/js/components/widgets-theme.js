; (function ($) {
    'use strict';

    // Nav Menu
    function navMenu() {
        $('.jeena-nav-menu').each(function () {
            const selector = $(this),
                navMenu = selector.find('.primary-menu'),
                navToggler = selector.find('.navbar-toggler'),
                slidePanel = selector.find('.slide-panel-wrapper'),
                slideOverly = selector.find('.slide-panel-overly'),
                panelClose = selector.find('.slide-panel-close'),
                showPanel = 'show-panel',
                breakpoint = $(this).data('breakpoint');

            navMenu.find("li a").each(function () {
                if ($(this).children('.submenu-toggler').length < 1) {
                    if ($(this).next().length > 0) {
                        $(this).append('<span class="submenu-toggler"><i class="far fa-angle-down"></i></span>');
                    }
                }
            });
            navToggler.on('click', function (e) {
                slidePanel.addClass(showPanel);
                e.preventDefault();
            });
            panelClose.on('click', function (e) {
                e.preventDefault();
                slidePanel.removeClass(showPanel);
            });
            slideOverly.on('click', function (e) {
                e.preventDefault();
                slidePanel.removeClass(showPanel);
            });
            slidePanel.find('.submenu-toggler').on('click', function (e) {
                e.preventDefault();
                $(this).parent().parent().siblings().children('ul.sub-menu').slideUp();
                $(this).parent().next('ul.sub-menu').stop(true, true).slideToggle(350);
                $(this).toggleClass('sub-menu-open');
            });

            function breakpointCheck() {
                var winWidth = window.innerWidth;

                if (winWidth <= breakpoint) {
                    selector.addClass('breakpoint-on');
                } else {
                    selector.removeClass('breakpoint-on');
                }
            }
            breakpointCheck();

            $(window).on('resize', function () {
                breakpointCheck();
            });
        });
    }

    // Mini Search
    function miniSearch() {
        $('.jeena-search-wrapper').each(function () {
            const selector = $(this),
                searchIcon = selector.find('.search-icon'),
                searchOverly = selector.find('.jeena-search-overly'),
                searchClose = selector.find('.search-close');

            searchIcon.on('click', function (e) {
                e.preventDefault();
                selector.toggleClass('show-search-canvas');
            });

            searchOverly.on('click', function (e) {
                e.preventDefault();
                selector.removeClass('show-search-canvas');
            });

            searchClose.on('click', function (e) {
                e.preventDefault();
                selector.removeClass('show-search-canvas');
            });

        });
    }

    // Preloader
    function preloader() {
        var $preloader = $('#preloader');
        $preloader.find(".animation-preloader").fadeOut('slow');

        if ($preloader.length > 0) {
            $('.preloader-layer .overly').animate({
                'left': '100%'
            }, {
                step: function (now, fx) {
                    $(this).css({ "transform": "translate3d(0px, 0px, 0px)" });
                },
                duration: 650,
                easing: 'linear',
                queue: false,
                complete: function () {
                    $preloader.fadeOut('slow');
                }
            }, 'linear');
        }
    }

    // Back to Top
    function backToTop() {
        var options = {
            scrollTop: $(window).height(),
            scrollSpeed: 400,
        };
        var scroll_up = $('#backToTop');

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > options.scrollTop) {
                scroll_up.addClass('active');
            } else {
                scroll_up.removeClass('active');
            }
        });

        scroll_up.on('click', function (e) {
            e.preventDefault();

            $('html,body').animate(
                {
                    scrollTop: 0,
                },
                options.scrollSpeed
            );
        });
    }

    jQuery(function() {
        miniSearch();
        navMenu();
        backToTop();
    });

    $(window).on('load', function () {
        preloader();
    });

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/jeena-nav-menu.default", function () {
            if (window.elementorFrontend.isEditMode()) {
                navMenu();
            }
        });

        elementorFrontend.hooks.addAction("frontend/element_ready/jeena-mini-search.default", function () {
            if (window.elementorFrontend.isEditMode()) {
                miniSearch();
            }
        });
    });
})(jQuery);