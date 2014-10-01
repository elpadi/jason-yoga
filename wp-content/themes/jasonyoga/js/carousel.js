/*
 * Carousel
 * Author: Jackson Solutions Group
 */


(function($) {

	var carousel = (function() {

		Handlebars.registerHelper("debug", function(optionalValue) {
			
			console.log("Current Context");
			console.log("====================");
			console.log(this);
			
			if (optionalValue) {
			
				console.log("Value");
				console.log("====================");
				console.log(optionalValue);
				
			}

		});

		return {

			model: null,

			$carousel: null,

			currentIndex: null,

			nextIndex: null,

			previousIndex: null,

			maxIndex: null,

			slideshowTimeout: null,

			assembleDataModel: function() {

				var slidesLength = gallery.slides.length;
				var i = 0;

				model = data;

				for(i; i < slidesLength; i++) {

					model.slides[i].image = gallery.slides[i].image;

				}

			},

			renderTemplate: function() {

				var source   = $("#slideshow-template").html();
				var template = Handlebars.compile(source);

				$carousel = $('.carousel');

				$carousel.append(template(model));

			},

			rotateSlides: function() {

				$('ul li', $carousel).attr('data-active', '');
				$('ul li', $carousel).removeClass('fadeOut');

				if(currentIndex == maxIndex) {

					prevIndex = maxIndex;

					currentIndex = 0;
					
				} else {

					prevIndex = currentIndex;

					currentIndex++;

				}

				nextIndex = currentIndex;
				
				$('ul li[data-index="'+nextIndex+'"]', $carousel).attr('data-active', 'active');
				$('ul li[data-index="'+nextIndex+'"]', $carousel).addClass('fadeIn');

				$('ul li[data-index="'+prevIndex+'"]', $carousel).removeClass('fadeIn');
				$('ul li[data-index="'+prevIndex+'"]', $carousel).addClass('fadeOut');
				
			},

			setSlideshowTimer: function() {

				var self = this;

				slideshowTimeout = setTimeout(function(){

					self.rotateSlides();

					clearTimeout(slideshowTimeout);
					
					self.setSlideshowTimer();

				}, 6000);

			},

			initSlideshow: function() {

				currentIndex = 0;

				maxIndex = $('ul li', $carousel).length - 1;

				$('ul li[data-index="'+currentIndex+'"]', $carousel).addClass('fadeIn');
				$('ul li[data-index="'+currentIndex+'"]', $carousel).attr('data-active', 'active');

				this.setSlideshowTimer();

			},

			init: function() {

				this.assembleDataModel();

				this.renderTemplate();

				this.initSlideshow();

			}

		}

	}());

	carousel.init();

})(jQuery);