(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 $( document ).ready(function() {
		$('.tabs-content-container .sp-data-table-container').each(function() {
			if($(this).hasClass("fadein")){
				$(this).addClass("fadein");
			}else{
				$(this).addClass("fadeout");
			}
		});
		$(".header-tabs-container .header-tabs a").click(function () {
			var element = $(this).attr('href');
			// alert($(this).attr('href'));

			$('.header-tabs-container .header-tabs').each(function() {
				$(this).removeClass("current-parent");
			});
			console.log($(this).parents('.header-tabs'));
			$(this).parents('.header-tabs').addClass("current-parent");

			$('.tabs-content-container .sp-data-table-container').each(function() {
				// console.log($(element));
				if($(this).hasClass("fadein")){
					$(this).removeClass("fadein").addClass("fadeout");
				}else{
					$(element).removeClass("fadeout").addClass("fadein");
				}
				if($(element) && $(this).hasClass("fadeout")){
					$(element).removeClass("fadeout").addClass("fadein");		
				}else{
					$(this).removeClass("fadein").addClass("fadeout");
				}
			});
		});
	 });
})( jQuery );
