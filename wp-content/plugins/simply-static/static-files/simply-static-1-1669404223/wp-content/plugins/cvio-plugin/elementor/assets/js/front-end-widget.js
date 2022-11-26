(function ($) {
	"use strict";

	/* Init Elementor Front Scripts */
	$(window).on('elementor/frontend/init', function () {

		/*
			Set full height in blocks
		*/
		var width = $(window).width();
		var height = $(window).height();

		// Global
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', function( $scope ) {
			
			/*
				Typed Subtitle
			*/
			if(($('.typed-subtitle').length) && ($('.h-subtitle p').length > 1)){
				$('.typed-subtitle').each(function(){
					$(this).typed({
						stringsElement: $(this).prev('.typing-subtitle'),
						typeSpeed: 80,
						backDelay: 1800,
						loop: true
					});
				});
			}
			
			/*
				Typed Breadcrumbs
			*/
			setTimeout(function(){
				$('.h-subtitles').addClass('ready');
				if($('.typed-bread').length){
					$('.typed-bread').typed({
						stringsElement: $('.typing-bread'),
						showCursor: false
					});
				}
			}, 1000);

			/*
				Jarallax
			*/
			if($('.jarallax').length){
				$('.jarallax').jarallax();
			}

			/*
				Background enabled
			*/
			if($('.jarallax-video').length) {
				$('body').addClass('background-enabled');
				$('.jarallax-video').jarallax();
			}

			/*
				Grained
			*/
			if($('#grained_container').length){
			var grained_options = {
				'animate': true,
				'patternWidth': 400,
				'patternHeight': 400,
				'grainOpacity': 0.15,
				'grainDensity': 3,
				'grainWidth': 1,
				'grainHeight': 1
			}
			grained('#grained_container', grained_options);
			}

			/*
				Started Slider
			*/
			if($('.started-carousel').length){
				var slider_container = $('.started-carousel .swiper-container');
				var is_autoplaytime = slider_container.data('autoplaytime');
				var is_loop = slider_container.data('loop');
				var started_slider = new Swiper ('.started-carousel .swiper-container', {
					init: false,
					loop: is_loop,
					spaceBetween: 0,
					effect: 'fade',
					slidesPerView: 1,
					simulateTouch: false,
					autoplay: {
						delay: is_autoplaytime,
						disableOnInteraction: false,
						waitForTransition: false,
					},
					navigation: {
						nextEl: '.started .swiper-button-next',
						prevEl: '.started .swiper-button-prev',
					},
				});
				started_slider.on('slideChange', function () {
					var index = started_slider.realIndex;
					var total = started_slider.slides.length;

					$('.started-carousel .swiper-slide').removeClass('first');
					$('.started-carousel .swiper-slide').each(function(i, slide){
						if((index-1)>=i) {
							$(slide).addClass('swiper-clip-active');
						} else {
							$(slide).removeClass('swiper-clip-active');
						}
					});
					$('.started-carousel .swiper-slide').each(function(i, slide){
						$(slide).css({'z-index': total - i});
					});
				});
				started_slider.init();
			}

			/*
				Hover Button Effect
			*/
			$('.hover-animated .circle').on({
				mouseenter: function (e) {
					if ($(this).find(".ink").length === 0) {
						$(this).prepend("<span class='ink'></span>");
					}
					var ink = $(this).find(".ink");
					ink.removeClass("animate");
					if (!ink.height() && !ink.width()) {
						var d = Math.max($(this).outerWidth(), $(this).outerHeight());
						ink.css({
							height: d,
							width: d
						});
					}
					var x = e.pageX - $(this).offset().left - ink.width() / 2;
					var y = e.pageY - $(this).offset().top - ink.height() / 2;
					ink.css({
						top: y + 'px',
						left: x + 'px'
					}).addClass("ink-animate");
					$('.cursor-follower').addClass('hide');
				},
				mouseleave: function (e) {
					var ink = $(this).find(".ink");
					var x = e.pageX - $(this).offset().left - ink.width() / 2;
					var y = e.pageY - $(this).offset().top - ink.height() / 2;
					ink.css({
						top: y + 'px',
						left: x + 'px'
					}).removeClass("ink-animate");
					$('.cursor-follower').removeClass('hide');
				}
			});

			/*
				Dotted Skills Line
			*/
			function skills(){
				var skills_dotted = $('.skills.dotted .progress');
				var skills_dotted_w = skills_dotted.width();
				if(skills_dotted.length){
					skills_dotted.append('<span class="dg"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>');
					skills_dotted.find('.percentage').append('<span class="da"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>');
					skills_dotted.find('.percentage .da').css({'width':skills_dotted_w});
				}
			}
			setTimeout(skills, 1000);

			/*
				Circle Skills Line
			*/
			var skills_circles = $('.skills.circles .progress');
			if(skills_circles.length){
				skills_circles.append('<div class="slice"><div class="bar"></div><div class="fill"></div></div>');
			}

			/*
				Initialize Portfolio
			*/
			var $container = $('.portfolio-items');
			$container.imagesLoaded(function() {
				$container.isotope({
					percentPosition: true,
					itemSelector: '.box-item'
				});

				/*
					Portfolio items parallax
				*/
				if($('.portfolio-items.portfolio-new').length){
					var s_parallax = document.getElementsByClassName('wp-post-image');
					new simpleParallax(s_parallax);
				}

			});

		} );

		elementorFrontend.hooks.addAction( 'frontend/element_ready/widget', function( $scope ) {
		} );

	});
})(jQuery);