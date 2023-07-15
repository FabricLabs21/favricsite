; (function ($) {
    'use strict';

    $(window).on("elementor/frontend/init", function () {
        var moduleHandler = elementorModules.frontend.handlers.Base;

        // Content Switcher
        var contentSwitcher = function ($scope) {
            $scope.find('.jeena-content-switcher').each(function () {
                var selector = $(this),
                    toggleSwitch = selector.find('.switcher-input-label'),
                    input = selector.find('input.switcher-checkbox'),
                    primarySwitcher = selector.find('.primary-switch'),
                    secondarySwitcher = selector.find('.secondary-switch'),
                    primaryContent = selector.find('.primary-switch-content'),
                    secondaryContent = selector.find('.secondary-switch-content');
                toggleSwitch.on('click', function (e) {
                    if (input.is(':checked')) {
                        primarySwitcher.removeClass('active');
                        primaryContent.removeClass('active');
                        secondarySwitcher.addClass('active');
                        secondaryContent.addClass('active');
                    } else {
                        secondarySwitcher.removeClass('active');
                        secondaryContent.removeClass('active');
                        primarySwitcher.addClass('active');
                        primaryContent.addClass('active');
                    }
                });
            });
        };

        // Counter
        var counterHandler = function ($scope, $) {
            setTimeout(function () {
                elementorFrontend.waypoint($scope.find('.elementor-counter-number'), function () {
                    var $number = $(this),
                        data = $number.data();
                    var decimalDigits = data.toValue.toString().match(/\.(.*)/);
                    if (decimalDigits) {
                        data.rounding = decimalDigits[1].length;
                    }
                    $number.numerator(data);
                });
            }, 150);
        };

        // Accordion
        var accordionHandler = function ($scope, $) {
            $scope.find(".jeena-accordion .accordion-item .accordion-header").on("click", function (e) {
                e.preventDefault();
                const target = $(this).data("target"),
                    parent = $(this).parents(".jeena-accordion"),
                    active_items = parent.find(".accordion-header.active");
                $.each(active_items, function (index, item) {
                    var item_target = $(item).data("target");
                    if (item_target != target) {
                        $(item).removeClass("active");
                        $(this).parent().removeClass("active-accordion");
                        $(item_target).slideUp(400);
                    }
                });
                $(this).parent().toggleClass("active-accordion");
                $(this).toggleClass("active");
                $(target).slideToggle(400);
            });
        };

        // Tabs
        var tabHandler = function ($scope, $) {
            const tab_heading = $scope.find(".tabs-headings-wrapper .tab-heading");

            tab_heading.click(function () {
                tab_heading.removeClass('active');
                $(this).addClass('active');
                $scope.find('.tab-content').hide();
                var itemTarget = $(this).data('target');
                $(itemTarget).show();

                return false;
            });
        };

        // Play Video
        var videoHandler = function ($scope, $) {
            $scope.find('.popup-video').each(function () {
                const play_button = $(this);

                play_button.magnificPopup({
                    type: 'iframe',
                });
            });
        }

        // Offcanvas
        var offCanvasHandler = function ($scope, $) {
            $scope.find('.jeena-offcanvas').each(function () {
                var selector = $(this),
                    toggle = selector.find('.offcanvas-toggle'),
                    overly = selector.find('.offcanvas-overly'),
                    close = selector.find('.offcanvas-close'),
                    wrapper = selector.find('.jeena-offcanvas-wrapper');
                toggle.on('click', function (e) {
                    wrapper.toggleClass('show-offcanvas');
                });
                overly.on('click', function (e) {
                    wrapper.removeClass('show-offcanvas');
                });
                close.on('click', function (e) {
                    wrapper.removeClass('show-offcanvas');
                });
            });
        };

		// Sticky Section
        var stickySection = function($scope) {
			$.each($scope, function(index) {
				const $sticky = $(this),
					$stickyH = $sticky.height(),
					$stickyID = $sticky.data('id'),
					$stickyPos = $sticky.position(),
					$currStickyPos = $stickyPos.top + $stickyH,
					$stickyAfter = '<div class="jeena-sticky-gap sticky-gap-' + $stickyID + '" style="height: ' + $stickyH + 'px"></div>';
				if($sticky.hasClass('jeena-sticky')) {
					$sticky.after($stickyAfter);
					const $stickyGap = $('.sticky-gap-' + $stickyID + '');
					$(window).on("scroll", function() {
						if($(this).scrollTop() < $currStickyPos) {
							$sticky.removeClass('jeena-sticky-active');
							$stickyGap.removeClass('active-sticky-gap');
						} else {
							$sticky.addClass('jeena-sticky-active');
							$stickyGap.addClass('active-sticky-gap');
						}
					});
				}
			});
		};

        // Widget Handlers
        var widgetHandlers = {
            'jeena-content-switcher.default': contentSwitcher,
            'jeena-counter.default': counterHandler,
            'jeena-accordion.default': accordionHandler,
            'jeena-tabs.default': tabHandler,
            'jeena-play-video.default': videoHandler,
            'jeena-offcanvas.default': offCanvasHandler,
            'jeena-advanced-slider.default': videoHandler,
        };

        $.each(widgetHandlers, function (widgetName, handlerFn) {
            elementorFrontend.hooks.addAction('frontend/element_ready/' + widgetName, handlerFn);
        });

		elementorFrontend.hooks.addAction("frontend/element_ready/section", stickySection);
    });
})(jQuery);