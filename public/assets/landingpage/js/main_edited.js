$(document).ready(function () {
	"use strict";

	var window_width = $(window).width(),
		window_height = window.innerHeight,
		header_height = $(".default-header").height(),
		header_height_static = $(".site-header.static").outerHeight(),
		fitscreen = window_height - header_height;

	$(".fullscreen").css("height", window_height)
	$(".fitscreen").css("height", fitscreen);

	$('.navbar-nav li.dropdown').hover(function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function () {
		$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});

	$('.img-pop-up').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	// Search Toggle
	$("#search_input_box").hide();
	$("#search").on("click", function () {
		$("#search_input_box").slideToggle();
		$("#search_input").focus();
	});
	$("#close_search").on("click", function () {
		$('#search_input_box').slideUp(500);
	});

	/*==========================
		javaScript for sticky header
		============================*/
	$(".sticky-header").sticky();

	/*=================================
	Javascript for banner area carousel
	==================================*/
	$(".active-banner-slider").owlCarousel({
		items: 1,
		autoplay: false,
		autoplayTimeout: 5000,
		loop: true,
		nav: true,
		navText: ["<img src='assets/landingpage/img/banner/prev.png'>", "<img src='assets/landingpage/img/banner/next.png'>"],
		dots: false
	});

	/*=================================
	Javascript for product area carousel
	==================================*/
	$(".active-product-area").owlCarousel({
		items: 1,
		autoplay: false,
		autoplayTimeout: 5000,
		loop: true,
		nav: true,
		navText: ["<img src='assets/landingpage/img/banner/prev.png'>", "<img src='assets/landingpage/img/banner/next.png'>"],
		dots: false
	});

	/*=================================
	Javascript for single product area carousel
	==================================*/
	$(".s_Product_carousel").owlCarousel({
		items: 1,
		autoplay: false,
		autoplayTimeout: 5000,
		loop: true,
		nav: false,
		dots: true
	});

	/*=================================
	Javascript for exclusive area carousel
	==================================*/
	$(".active-exclusive-product-slider").owlCarousel({
		items: 1,
		autoplay: false,
		autoplayTimeout: 5000,
		loop: true,
		nav: true,
		navText: ["<img src='assets/landingpage/img/banner/prev.png'>", "<img src='assets/landingpage/img/banner/next.png'>"],
		dots: false
	});

	//--------- Accordion Icon Change ---------//

	$('.collapse').on('shown.bs.collapse', function () {
		$(this).parent().find(".lnr-arrow-right").removeClass("lnr-arrow-right").addClass("lnr-arrow-left");
	}).on('hidden.bs.collapse', function () {
		$(this).parent().find(".lnr-arrow-left").removeClass("lnr-arrow-left").addClass("lnr-arrow-right");
	});

	// Select all links with hashes
	$('.main-menubar a[href*="#"]')
		// Remove links that don't actually link to anything
		.not('[href="#"]')
		.not('[href="#0"]')
		.click(function (event) {
			// On-page links
			if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
				&&
				location.hostname == this.hostname
			) {
				// Figure out element to scroll to
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$('html, body').animate({
						scrollTop: target.offset().top - 70
					}, 1000, function () {
						// Callback after animation
						// Must change focus!
						var $target = $(target);
						$target.focus();
						if ($target.is(":focus")) { // Checking if the target was focused
							return false;
						} else {
							$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
							$target.focus(); // Set focus again
						};
					});
				}
			}
		});


	if (document.getElementById("js-countdown")) {

		var countdown = new Date("October 17, 2018");

		function getRemainingTime(endtime) {
			var milliseconds = Date.parse(endtime) - Date.parse(new Date());
			var seconds = Math.floor(milliseconds / 1000 % 60);
			var minutes = Math.floor(milliseconds / 1000 / 60 % 60);
			var hours = Math.floor(milliseconds / (1000 * 60 * 60) % 24);
			var days = Math.floor(milliseconds / (1000 * 60 * 60 * 24));

			return {
				'total': milliseconds,
				'seconds': seconds,
				'minutes': minutes,
				'hours': hours,
				'days': days
			};
		}

		function initClock(id, endtime) {
			var counter = document.getElementById(id);
			var daysItem = counter.querySelector('.js-countdown-days');
			var hoursItem = counter.querySelector('.js-countdown-hours');
			var minutesItem = counter.querySelector('.js-countdown-minutes');
			var secondsItem = counter.querySelector('.js-countdown-seconds');

			function updateClock() {
				var time = getRemainingTime(endtime);

				daysItem.innerHTML = time.days;
				hoursItem.innerHTML = ('0' + time.hours).slice(-2);
				minutesItem.innerHTML = ('0' + time.minutes).slice(-2);
				secondsItem.innerHTML = ('0' + time.seconds).slice(-2);

				if (time.total <= 0) {
					clearInterval(timeinterval);
				}
			}

			updateClock();
			var timeinterval = setInterval(updateClock, 1000);
		}

		initClock('js-countdown', countdown);

	};


	$('.quick-view-carousel-details').owlCarousel({
		loop: true,
		dots: true,
		items: 1,
	})
});
