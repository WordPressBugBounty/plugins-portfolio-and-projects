(function($) {

	"use strict";

	/* Media Uploader */
	$( document ).on( 'click', '.wp-pap-img-uploader', function() {

		var imgfield, showfield, multiple_img, file_frame, button;
		imgfield		= jQuery(this).prev('input').attr('id');
		showfield		= jQuery(this).parents('td').find('.wp-pap-imgs-preview');
		multiple_img	= jQuery(this).attr('data-multiple');
		multiple_img	= (typeof(multiple_img) != 'undefined' && multiple_img == 'true') ? true : false;
		button			= jQuery(this);

		/* If the media frame already exists, reopen it. */
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		if( multiple_img == true ) {

			/* Create the media frame */
			file_frame = wp.media.frames.file_frame = wp.media({
				title: button.data( 'title' ),
				button: {
					text: button.data( 'button-text' ),
				},
				multiple: true  /* Set to true to allow multiple files to be selected */
			});

		} else {

			/* Create the media frame */
			file_frame = wp.media.frames.file_frame = wp.media({
				frame: 'post',
				state: 'insert',
				title: button.data( 'title' ),
				button: {
					text: button.data( 'button-text' ),
				},
				multiple: false /* Set to true to allow multiple files to be selected */
			});
		}

		file_frame.on( 'menu:render:default', function(view) {
			/* Store our views in an object */
			var views = {};

			/* Unset default menu items */
			view.unset('library-separator');
			view.unset('gallery');
			view.unset('featured-image');
			view.unset('embed');

			/* Initialize the views in our view object */
			view.set(views);
		});

		/* When an image is selected, run a callback */
		file_frame.on( 'select', function() {

			/* Get selected size from media uploader */
			var selected_size = $('.attachment-display-settings .size').val();
			var selection = file_frame.state().get('selection');

			selection.each( function( attachment, index ) {

				attachment = attachment.toJSON();

				/* Selected attachment url from media uploader */
				var attachment_id = attachment.id ? attachment.id : '';
				if( attachment_id && attachment.sizes && multiple_img == true ) {

					var attachment_url			= attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
					var attachment_edit_link	= attachment.editLink ? attachment.editLink : '';

					showfield.append('\
						<div class="wp-pap-img-wrp">\
							<div class="wp-pap-img-tools wp-pap-hide">\
								<span class="wp-pap-tool-icon wp-pap-edit-img dashicons dashicons-edit" title="'+WppapAdmin.img_edit_popup_text+'"></span>\
								<a href="'+attachment_edit_link+'" target="_blank" title="'+WppapAdmin.attachment_edit_text+'"><span class="wp-pap-tool-icon wp-pap-edit-attachment dashicons dashicons-visibility"></span></a>\
								<span class="wp-pap-tool-icon wp-pap-del-tool wp-pap-del-img dashicons dashicons-no" title="'+WppapAdmin.img_delete_text+'"></span>\
							</div>\
							<img class="wp-pap-img" src="'+attachment_url+'" alt="" />\
							<input type="hidden" class="wp-pap-attachment-no" name="wp_pap_img[]" value="'+attachment_id+'" />\
						</div>\
							');
					showfield.find('.wp-pap-img-placeholder').hide();
				}
			});
		});

		/* When an image is selected, run a callback. */
		file_frame.on( 'insert', function() {

			/* Get selected size from media uploader */
			var selected_size = $('.attachment-display-settings .size').val();

			var selection = file_frame.state().get('selection');
			selection.each( function( attachment, index ) {
				attachment = attachment.toJSON();

				/* Selected attachment url from media uploader */
				var attachment_url = attachment.sizes[selected_size].url;

				/* place first attachment in field */
				$('#'+imgfield).val(attachment_url);
				showfield.html('<img src="'+attachment_url+'" />');
			});
		});

		/* Finally, open the modal */
		file_frame.open();
	});

	/* Remove Single Gallery Image */
	$(document).on('click', '.wp-pap-del-img', function(){

		$(this).closest('.wp-pap-img-wrp').fadeOut(300, function(){ 
			$(this).remove();

			if( $('.wp-pap-img-wrp').length == 0 ){
				$('.wp-pap-img-placeholder').show();
			}
		});
	});

	/* Remove All Gallery Image */
	$(document).on('click', '.wp-pap-del-gallery-imgs', function() {

		var ans = confirm('Are you sure to remove all images from this gallery!');

		if(ans){
			$('.wp-pap-gallery-imgs-wrp .wp-pap-img-wrp').remove();
			$('.wp-pap-img-placeholder').fadeIn();
		}
	});

	/* Image ordering (Drag and Drop) */
	if( $('.wp-pap-gallery-imgs-wrp').length > 0 ) {
		$('.wp-pap-gallery-imgs-wrp').sortable({
			items: '.wp-pap-img-wrp',
			cursor: 'move',
			scrollSensitivity:40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			helper: 'clone',
			opacity: 0.8,
			placeholder: 'wp-pap-gallery-placeholder',
			containment: '.wp-pap-post-sett-table',
			start:function(event,ui){
				ui.item.css('background-color','#f6f6f6');
			},
			stop:function(event,ui){
				ui.item.removeAttr('style');
			}
		});
	}

	/* Open Attachment Data Popup */
	$(document).on('click', '.wp-pap-img-wrp .wp-pap-edit-img', function(){

		$('.wp-pap-img-data-wrp').show();
		$('.wp-pap-popup-overlay').show();
		$('body').addClass('wp-pap-no-overflow');
		$('.wp-pap-img-loader').show();

		var current_obj		= $(this);
		var nonce			= current_obj.closest('.wp-pap-imgs-preview').attr('data-nonce');
		var attachment_id	= current_obj.closest('.wp-pap-img-wrp').find('.wp-pap-attachment-no').val();

		var data = {
						action			: 'wp_pap_get_attachment_edit_form',
						attachment_id	: attachment_id,
						nonce			: nonce,
					};
		$.post(ajaxurl, data, function( result ) {
			if( result.success == 1 ) {
				$('.wp-pap-img-data-wrp  .wp-pap-popup-body-wrp').html( result.data );
				$('.wp-pap-img-loader').hide();
			}
		});
	});

	/* Close Popup */
	$(document).on('click', '.wp-pap-popup-close', function(){
		wp_pap_hide_popup();
	});

	/* `Esc` key is pressed */
	$(document).on('keyup', function(e) {
		if (e.keyCode == 27) {
			wp_pap_hide_popup();
		}
	});

	/* Save Attachment Data */
	$(document).on('click', '.wp-pap-save-attachment-data', function(){

		var current_obj	= $(this);
		var nonce		= current_obj.attr('data-nonce');

		current_obj.attr('disabled','disabled');
		current_obj.parent().find('.spinner').css('visibility', 'visible');

		var data = {
						action			: 'wp_pap_save_attachment_data',
						attachment_id	: current_obj.attr('data-id'),
						form_data		: current_obj.closest('form.wp-pap-attachment-form').serialize(),
						nonce			: nonce,
					};

		$.post(ajaxurl, data, function( result ) {

			if( result.success == 1 ) {
				current_obj.closest('form').find('.wp-pap-success').html(result.msg).fadeIn().delay(3000).fadeOut();
			} else if( result.success == 0 ) {
				current_obj.closest('form').find('.wp-pap-error').html(result.msg).fadeIn().delay(3000).fadeOut();
			}
			current_obj.prop("disabled", false);
			current_obj.parent().find('.spinner').css('visibility', '');
		});
	});

	/* Click to Copy the Text */
	$(document).on('click', '.wpos-copy-clipboard', function() {
		var copyText = $(this);
		copyText.select();
		document.execCommand("copy");
	});
})(jQuery);

/* Function to hide popup */
function wp_pap_hide_popup() {
	jQuery('.wp-pap-img-data-wrp').hide();
	jQuery('.wp-pap-popup-overlay').hide();
	jQuery('body').removeClass('wp-pap-no-overflow');
	jQuery('.wp-pap-img-data-wrp  .wp-pap-popup-body-wrp').html('');
}