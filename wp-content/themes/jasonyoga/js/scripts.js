/*
 * Site: FIT
 * Author: Jackson Solutions Group
 */

// Self Invoking Function. This runs imediately.
(function($) {

	$(document).ready(function() {
		
		var $win = $(window), $wrapper = $('.contentwrapper');
		
		$win.on('resize', function(e) {
			var w = $win.width(), h = $win.height();
			if (w < 960 && w > 828) {
				var left = $('#menu-main-menu').children().first().position().left + 18;
				$wrapper.css({ marginLeft: left + 'px', width: (w - left) + 'px' });
			}
			else {
				$wrapper.css({ marginLeft: '', width: '' });
			}
		});

		$(window).on('load', function() { $win.resize(); });

	});

})(jQuery);
