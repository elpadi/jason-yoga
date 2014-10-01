/*
 * Sticky
 * Author: Jackson Solutions Group
 */

(function($) {

	var sticky = (function() {

		return {

			elm: null,

			container: null,

			windowPosition: null,

			containerPosition: null,

			stickElement: function() {

				windowPosition = $(window).scrollTop();

				//console.log(windowPosition);

				if((windowPosition >= containerPosition) && elm.hasClass('canstick')) {

					elm.addClass('sticky');

				} else {

					elm.removeClass('sticky');

				}

			},

			checkElementPosition: function() {

				containerPosition = container.offset().top;

			},

			checkDeviceWidth: function() {

				var deviceWidth = parseInt($('body').width());

				if(deviceWidth > 568) {

					elm.addClass('canstick');

				} else {

					elm.removeClass('canstick');

				}

			},

			init: function() {

				elm = $("[data-sticky]");

				container = $(".backgroundwrapper");

				this.checkDeviceWidth();

				this.checkElementPosition();

			}

		}

	}());

	sticky.init();

	$(window).scroll(sticky.stickElement);

	$(window).resize(sticky.checkDeviceWidth);

})(jQuery);