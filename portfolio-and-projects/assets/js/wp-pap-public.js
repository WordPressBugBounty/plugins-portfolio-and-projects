/* Define global Variable */
var wppap_next_arrow = '<span class="slick-next slick-arrow" data-role="none" tabindex="0" role="button"><svg fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M69.8437,43.3876,33.8422,13.3863a6.0035,6.0035,0,0,0-7.6878,9.223l30.47,25.39-30.47,25.39a6.0035,6.0035,0,0,0,7.6878,9.2231L69.8437,52.6106a6.0091,6.0091,0,0,0,0-9.223Z"/></svg></span>';
var wppap_prev_arrow = '<span class="slick-prev slick-arrow" data-role="none" tabindex="0" role="button"><svg fill="currentColor" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M39.3756,48.0022l30.47-25.39a6.0035,6.0035,0,0,0-7.6878-9.223L26.1563,43.3906a6.0092,6.0092,0,0,0,0,9.2231L62.1578,82.615a6.0035,6.0035,0,0,0,7.6878-9.2231Z"/></svg></span>';

(function($) {

	"use strict";

	$( '.wppap-thumbs' ).each(function( index ) {

		var thumb_id	= $(this).attr('id');
		var thumb_conf	= JSON.parse( $('#'+thumb_id).attr('data-conf') );

		$('#'+thumb_id).portfolio({
			cols: parseInt(thumb_conf.grid),
			transition: 'slideDown'
		});
	});

	$( "ul.wppap-thumbs li a" ).on( "click", function() {

		var slick_id = $(this).closest('.wppap-main-wrapper').find('.wppap-content .wpapap-portfolio-img-slider').attr('id');		

		if( typeof(slick_id) !== 'undefined' && slick_id != '' ) {

			var slider_conf = JSON.parse( $('#'+slick_id).attr('data-conf') );

			$('#'+slick_id).slick({
				infinite			: true,
				autoplay			: true,
				pauseOnFocus		: false,
				speed				: 300,
				autoplaySpeed		: 3000,
				arrows				: (slider_conf.arrows) == "true"	? true : false,
				dots				: (slider_conf.dots) == "true"		? true : false,
				fade				: (slider_conf.effect)	== "fade"	? true : false,
				rtl					: (WpPap.rtl == 1)					? true : false,
				mobileFirst			: (WpPap.is_mobile == 1)			? true : false,
				nextArrow			: wppap_next_arrow,
				prevArrow			: wppap_prev_arrow,
			});
		}
	});

	/* Close Popup on esc */
	$(document).on('keyup', function(e) {
		if (e.keyCode == 27) {
			wp_pap_close_popup();
		}
	});

})(jQuery);

/* Close inline method popup */
function wp_pap_close_popup() {
	jQuery('ul.wppap-thumbs li .wppap-active-arrow').remove();
	jQuery('.wppap-main-wrapper ul.wppap-thumbs li.wppap-content').slideUp(300, function() {
		jQuery(this).remove();
	});
}