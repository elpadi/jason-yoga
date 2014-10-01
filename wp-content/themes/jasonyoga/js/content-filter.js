/*
 * Content Filter
 * Author: Jackson Solutions Group
 */


(function($) {

	var filter = (function() {

		return {

			preselect: "most-recent",

			preselectContent: function(content) {

				this.filterContent(content);

			},

			filterContent: function(content) {

				var title = $('[data-filter="'+content+'"').text();

				$('.mediabox, [data-filter]').removeAttr('data-selected');

				$('h2').text(title);

				$('.'+content+', [data-filter="'+content+'"]').attr('data-selected', 'selected');

			},

			bindEvents: function() {

				var self = this;

				$('[data-filter]').on('click', function(e) {

					e.preventDefault();

					var content = $(this).attr('data-filter');

					self.filterContent(content);

				});

			},

			initLinks: function() {

				$('ul.categories a').each(function(){

					var $this = $(this);
					
					var origin = $this.text().replace(' ', '-');
					
					origin = origin.toLowerCase();
					
					$this.attr('data-filter', origin);
				
				});

			},

			init: function() {

				this.initLinks();

				this.bindEvents();

				this.preselectContent(this.preselect);

			}

		}

	}());

	filter.init();

})(jQuery);