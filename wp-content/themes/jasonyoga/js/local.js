/*
 * Local Script
 * Author: Jackson Solutions Group
 */


// Self Invoking Function. This runs imediately.
(function($) {

	var local = (function() {

		return {

			changeHref: function(elm) {

				var origin = $(elm).attr('href');

				if (origin) {

					var newHref = origin.replace('jasonyoga.go-jsg.com', 'localhost/jasonyoga');

					$(elm).attr('href', newHref);

				}

			},

			changeSrc: function(elm) {

				var origin = $(elm).attr('src');

				if (origin) {
			
					var newHref = origin.replace('jasonyoga.go-jsg.com', 'localhost/jasonyoga');

					$(elm).attr('src', newHref);

				}

			},

			checkDomain: function() {

				if(document.location.href.indexOf('localhost') > -1) {

					$('body').find('a').each(function(){

						local.changeHref(this);

					});

					$('head').find('link').each(function(){

						local.changeHref(this);

					});

					$('body').find('img').each(function(){

						local.changeSrc(this);

					});

				}

			},

			init: function() {

				this.checkDomain();

			}

		}

	}());

	local.init();

})(jQuery);