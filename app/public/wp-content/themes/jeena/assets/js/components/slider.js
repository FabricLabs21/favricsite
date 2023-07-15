; (function ($) {
    'use strict';

    $(window).on("elementor/frontend/init", function () {
        var moduleHandler = elementorModules.frontend.handlers.Base;

        // Jeena Slider
        var jeenaSlider = moduleHandler.extend({
            getDefaultSettings: function getDefaultSettings() {
                const dotsWrap = this.findElement('.jeena-slider-dots'),
                    prevButton = this.findElement('.arrow-prev'),
                    nextButton = this.findElement('.arrow-next');
                return {
                    autoplay: true,
                    arrows: false,
                    container: '.jeena-slider-active',
                    dots: true,
                    infinite: true,
                    rows: 0,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    centerPadding: 0,
                    appendDots: dotsWrap,
                    prevArrow: prevButton,
                    nextArrow: nextButton,
                    vertical: false,
                    fade: false,
                };
            },
            getDefaultElements: function getDefaultElements() {
                return {
                    $container: this.findElement(this.getSettings('container'))
                };
            },
            getSlickSettings: function getSlickSettings() {
                var settings = {
                    infinite: !!this.getElementSettings('loop'),
                    autoplay: !!this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('speed'),
                    arrows: !!this.getElementSettings('show_arrows'),
                    dots: !!this.getElementSettings('show_dots'),
                    pauseOnHover: !!this.getElementSettings('pause_on_hover'),
                    centerMode: !!this.getElementSettings('center_mode'),
                    slidesToShow: parseInt(this.getElementSettings('slides_per_view')) || 1,
                    slidesToScroll: parseInt(this.getElementSettings('slides_to_scroll')) || 1,
                };
                if ( !!this.getElementSettings('center_mode') ) {
                    settings.centerPadding = this.getElementSettings('center_padding').size + this.getElementSettings('center_padding').unit;
                }
                let responsiveSettings = [];
                const breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
                Object.keys(breakpoints).forEach(breakpointName => {
                    const slidesPerViewKey = 'slides_per_view' + ('desktop' === breakpointName ? '' : '_' + breakpointName),
                        slidesPerScrollKey = 'slides_to_scroll' + ('desktop' === breakpointName ? '' : '_' + breakpointName),
                        centerPaddingKew = 'center_padding' + ('desktop' === breakpointName ? '' : '_' + breakpointName);
                    const breakpoint_data = {
                        breakpoint: breakpoints[breakpointName].value + 1,
                        settings: {
                            slidesToShow: parseInt(this.getElementSettings(slidesPerViewKey)),
                            slidesToScroll: parseInt(this.getElementSettings(slidesPerScrollKey)),
                        }
                    }
                    if ( !!this.getElementSettings('center_mode') ) {
                        breakpoint_data.settings.centerPadding = this.getElementSettings(centerPaddingKew).size + this.getElementSettings(centerPaddingKew).unit;
                    }
                    responsiveSettings.push(breakpoint_data);
                });
                settings.responsive = responsiveSettings;
                return $.extend({}, this.getSettings(), settings);
            },
            bindEvents: function bindEvents() {
                this.elements.$container.slick(this.getSlickSettings());
            },
        });

        // Jeena Advanced Slider
        var jeenaAdvancedSlider = moduleHandler.extend({
            getDefaultSettings: function getDefaultSettings() {
                const dotsWrap = this.findElement('.jeena-slider-dots'),
                    prevButton = this.findElement('.arrow-prev'),
                    nextButton = this.findElement('.arrow-next');
                return {
                    autoplay: true,
                    arrows: false,
                    container: '.jeena-slider-active',
                    dots: true,
                    infinite: true,
                    rows: 0,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    centerPadding: 0,
                    appendDots: dotsWrap,
                    prevArrow: prevButton,
                    nextArrow: nextButton,
                    vertical: false,
                    fade: false,
                };
            },
            getDefaultElements: function getDefaultElements() {
                return {
                    $container: this.findElement(this.getSettings('container'))
                };
            },
            getSlickSettings: function getSlickSettings() {
                var settings = {
                    infinite: !!this.getElementSettings('loop'),
                    autoplay: !!this.getElementSettings('autoplay'),
                    autoplaySpeed: this.getElementSettings('autoplay_speed'),
                    speed: this.getElementSettings('speed'),
                    arrows: !!this.getElementSettings('show_arrows'),
                    dots: !!this.getElementSettings('show_dots'),
                    pauseOnHover: !!this.getElementSettings('pause_on_hover'),
                    fade: !!this.getElementSettings('effect'),
                };

                return $.extend({}, this.getSettings(), settings);
            },
            bindEvents: function bindEvents() {
                this.elements.$container.slick(this.getSlickSettings());
            },
        });

        // Slider Handlers
        var sliderHandlers = {
            'jeena-clients-logo.default': jeenaSlider,
            'jeena-posts.default': jeenaSlider,
            'jeena-portfolio.default': jeenaSlider,
            'jeena-testimonial.default': jeenaSlider,
            'jeena-team.default': jeenaSlider,
        };

        $.each(sliderHandlers, function (widgetName, handlerClass) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, function ($scope) {
                elementorFrontend.elementsHandler.addHandler(handlerClass, {
                    $element: $scope
                });
            });
        });

        elementorFrontend.hooks.addAction('frontend/element_ready/jeena-advanced-slider.default', function ($scope) {
            elementorFrontend.elementsHandler.addHandler(jeenaAdvancedSlider, {
                $element: $scope
            });
        });

    });
})(jQuery);