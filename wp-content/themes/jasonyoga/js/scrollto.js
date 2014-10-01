/*
 * Scroll To
 * Author: Jackson Solutions Group
 */


(function($) {

	var scrollto = (function() {

		var $elm = $("[data-scroll]");

		return {

			scrollTo: function(anchor) {

				var scrollAmount = $('[data-anchor="'+anchor+'"]').offset().top;

				$('body,html').animate({scrollTop:scrollAmount}, 1000);

			},

			bindEvent: function() {

				var self = this;
				var $anchor;

				$elm.on("click", function(evt) {

					evt.preventDefault();

					anchor = $(this).attr('data-scrollto');

					self.scrollTo(anchor);

				});

			},

			init: function() {

				this.bindEvent();

			}

		}

	}());

	scrollto.init();

})(jQuery);