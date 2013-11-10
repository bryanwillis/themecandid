/**
 * Page builder functions
 */
jQuery(document).ready(function($) {

	//load default page builder based on selected page template
	var loadPageBuilder = function()
	{
		page_builder_height = $('#page-builder').height();
		if (page_builder_height < 20)
		{
			page_builder_height = 30;
		}
		
		$('#page-builder').css('height', page_builder_height + 'px');
		$('#page-builder').html('<img src="../wp-admin/images/loading.gif" />');
		
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'get_page_builder',
				template: $('#page_template').val(),
				post: $('#page-builder').attr('data-post')
			},
			success: function(data, textStatus, XMLHttpRequest) {
				$('#page-builder').css('height','auto');
				$('#page-builder').html(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				//alert(errorThrown);
			}
		});
	}
	loadPageBuilder();
	
	$('#page_template').change(function() {
		loadPageBuilder();
	});
	
	//define data
	var sizes = new Array('25%', '33.33%', '50%', '66.67%', '75%', '100%');
	var sizes_text = new Array('1/4', '1/3', '1/2', '2/3', '3/4', '1/1');
	
//Get next free item id
	var getNextItemId = function(elem) {
		
		next_item_id = 1;
		
		$(elem).find(".pb_inner .pb_item").each(function(index) {
			item_id = $(this).attr('data-item-id');
			item_id = parseInt(item_id);
			if (item_id >= next_item_id)
			{
				next_item_id = item_id + 1;
			}
		});
		return next_item_id;
	}
	
	
	//add shortcode item on click to page builder
	$("#page-builder").on("click", ".pb_add_item", function(event){
		
		selected_item = $(this).parent().find('.pb_select_items').val();
		selected_item_text = $(this).parent().find('.pb_select_items option:selected').text();
		page_builder_container = $(this).parents('.page_builder_container');
		
		if (selected_item != "")
		{
			next_item_id = getNextItemId(page_builder_container); //determine next free item id
			
			pb_item_code = new String;
			pb_item_code = $(page_builder_container).find('.pb_item_pattern').html();
			
			//replace tags with shortcode label and title
			pb_item_code = pb_item_code.replace('{$item}', selected_item);
			pb_item_code = pb_item_code.replace('{$type}', selected_item);
			pb_item_code = pb_item_code.replace('{$title}', selected_item_text);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id);
			pb_item_code = pb_item_code.replace('{$id}', next_item_id); //yes, 7x replace!!!
			next_item_id++;
			
			$(page_builder_container).find('.pb_clear').before(pb_item_code);
			editItem($(page_builder_container).find('.pb_item_edit:last'));			
		}
	});
	
	//edit item
	$("#page-builder").on("click", ".pb_item_edit", function(event) {
		editItem(this);
	});
	
	var editItem = function(elem) {
		tb_show("Shortcodes", $('#popup_url').val() + "popup.php?shortcode=" + $(elem).closest(".pb_item").attr("data-item") + "&width=630&pb_item_id=" + $(elem).closest(".pb_item").attr("data-item-id") + '&builder=' + $(elem).parents('.pb_inner').attr('data-builder'));
	}
	
	//remove item from page builder
	$("#page-builder").on("click", ".pb_item_remove", function(event) {
		if (confirm($(this).attr('data-msg')))
		{
			$(this).closest('.pb_item_wrapper').remove();
		}
	});

	//add size
	$("#page-builder").on("click", ".pb_item_plus", function(event) {
		current_size = $(this).closest('.pb_item').attr('data-size');
		current_key = $.inArray(current_size, sizes_text);
		//something is wrong, this should not happen
		if (current_key == -1)
		{
			return false;
		}
		//return false if we already have 1/1 item
		if (sizes_text[current_key + 1] === undefined)
		{
			return false;
		}
		$(this).closest('.pb_item_wrapper').css('width', sizes[current_key + 1]);
		$(this).closest('.pb_item').attr('data-size', sizes_text[current_key + 1]);
		$(this).closest('.pb_item').find('.pb_item_size').text(sizes_text[current_key + 1]);
		$(this).closest('.pb_item').find('.pb_item_size_value').val(sizes_text[current_key + 1]);
	});
	
	//sub size
	$("#page-builder").on("click", ".pb_item_minus", function(event) {
		current_size = $(this).closest('.pb_item').attr('data-size');
		current_key = $.inArray(current_size, sizes_text);
		//something is wrong, this should not happen
		if (current_key == -1)
		{
			return false;
		}
		//return false if we already have 1/1 item
		if (sizes_text[current_key - 1] === undefined)
		{
			return false;
		}

		$(this).closest('.pb_item_wrapper').css('width', sizes[current_key - 1]);
		$(this).closest('.pb_item').attr('data-size', sizes_text[current_key - 1]);
		$(this).closest('.pb_item').find('.pb_item_size').text(sizes_text[current_key - 1]);
		$(this).closest('.pb_item').find('.pb_item_size_value').val(sizes_text[current_key - 1]);
	});

	//duplicate element
	$("#page-builder").on("click", ".pb_item_clone", function(event) {
		
		//clone wrapper
		$cloned = $(this).closest(".pb_item_wrapper").clone();
		
		$next_item_id = getNextItemId($(this).closest('.pb_wrapper'));

		//get current element old container id
		$item = $(this).closest('.pb_item').find(".pb_item_data").attr("id");
		$item_values = $item.split("_");
		
		//when page builder container is "content" eg. pb_item_data_content_2
		if (typeof $item_values[5] == 'undefined') {
			
			$old_item_id = $item_values[4];
			$pb_inner_id = '';

			$old_item = $old_item_id;
			$new_item = $next_item_id;
			
		//when page builder container is "content_x" eg. pb_item_data_content_2_5
		} else {
			$old_item_id = $item_values[5];
			$pb_inner_id = $item_values[4];

			$old_item = $pb_inner_id + '_' + $old_item_id;
			$new_item = $pb_inner_id + "_" + $next_item_id;
		}
		
		//replace item id in cloned 
		$cloned = $cloned.find(".pb_item").attr("data-item-id",$next_item_id).closest('.pb_item_wrapper');
		$cloned = $cloned.find("#pb_item_data_content_" + $old_item).attr("name","pb_item_data_content_" + $new_item).closest('.pb_item_wrapper');
		$cloned = $cloned.find("#pb_item_data_content_" + $old_item).attr("id","pb_item_data_content_" + $new_item).closest('.pb_item_wrapper');
		$cloned = $cloned.find("#pb_item_size_content_" + $old_item).attr("name","pb_item_size_content_" + $new_item).closest('.pb_item_wrapper');
		$cloned = $cloned.find("#pb_item_size_content_" + $old_item).attr("id","pb_item_size_content_" + $new_item).closest('.pb_item_wrapper');
		$cloned = $cloned.find("#pb_item_type_content_" + $old_item).attr("name","pb_item_type_content_" + $new_item).closest('.pb_item_wrapper');
		$cloned = $cloned.find("#pb_item_type_content_" + $old_item).attr("id","pb_item_type_content_" + $new_item).closest('.pb_item_wrapper');

		$cloned_html = $('<div>').append($cloned).html();
		
		//append cloned item
		$(this).closest(".pb_inner").find('.pb_clear').before($cloned_html);
		
		//blink with new element
		$(this).closest('.pb_inner').find('.pb_item_wrapper').last().fadeTo('slow', 0.1).fadeTo('slow', 1.0);
		
		return;	
	});

	// Uploading files
	var file_frame;

	$('.upload_image_button').live('click', function(event) {

		event.preventDefault();

		$upload_field = $(this).prev('input');

		// If the media frame already exists, reopen it.
		if (file_frame) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: $(this).data('uploader_title'),
			button: {
				text: $(this).data('uploader_button_text'),
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on('select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();

			//set value to form and focus form field to trigger option-tree image preview event
			$upload_field.val(attachment.url);
			$upload_field.focus();
		});

		// Finally, open the modal
		file_frame.open();
	});
});