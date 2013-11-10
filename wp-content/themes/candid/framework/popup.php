<?php
/**
 * Shortoces popup window.
 * Used in page builder and page editor (shortcodes drop down list)
 * If we have  $_GET['pb_item_id'] and $_GET['builder'] defined it means it's page builer
 * 
 */

require_once('../../../../wp-load.php');
require_once get_template_directory().'/framework/class/ShortcodesTinyMcePopup.class.php';

$data_field = '';
if (isset($_GET['pb_item_id']) && intval($_GET['pb_item_id']) && isset($_GET['builder']) && !empty($_GET['builder']))
{
	$field_id = intval($_GET['pb_item_id']);
	$data_field = $_GET['builder'].'_'.$_GET['pb_item_id'];
}

//callback function fired on save
$callback = '';
if (isset($_GET['callback']) && !empty($_GET['callback'])) {
	$callback = $_GET['callback'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<script>
jQuery(document).ready(function($) {
	
	<?php if (!empty($data_field)): ?>
		/**
		 * Remove item from page builder if item wasn't saved at least once using page builder window save button
	 	 * 
 		 */
		jQuery('#TB_overlay,.tb-close-icon').click(function() {
			
			jQuery(".shortcode-attribute").each(function (i) {
				
				if (jQuery(this).attr('data-type') == 'wp_editor')
				{
					tinyMCE.execCommand("mceRemoveControl", false, jQuery(this).attr('id'));
				}
			});
			
			if (jQuery('#pb_item_data_<?php echo $data_field; ?>').length > 0 && jQuery('#pb_item_data_<?php echo $data_field; ?>').val() == "")
			{
				jQuery('#pb_item_data_<?php echo $data_field; ?>').closest('.pb_item_wrapper').remove();
			}
		});
	<?php endif;?>
	
	/**
	 * Create all form fields
	 * Gets saved shortcode data if opened from 'Page Builder'
	 */
	processShortcode = function() {
			
		//prepare flat table with confirugration for each level eg. accordion and its items
		setLevels(shortcode_main,0);

		if (levels[0] !== undefined)
		{
			<?php if (!empty($data_field)): ?>
				//selected page builder shortcode data
				pb_tmp_data = jQuery.parseJSON(jQuery('#pb_item_data_<?php echo $data_field;?>').val());

				if (pb_tmp_data !== null && pb_tmp_data.data !== undefined)
				{
					pb_saved_data = pb_tmp_data.data;
				}
				else
				{
					pb_saved_data = undefined;
				}

				//iterate every level and add all saved fields
				if (pb_saved_data instanceof Array)
				{
					for (level = 0; level < pb_saved_data.length; level ++)
					{
						if (pb_saved_data[level] instanceof Array)
						{
							for (pbparent = 0; pbparent < pb_saved_data[level].length; pbparent ++)
							{
								if (pb_saved_data[level][pbparent] instanceof Array)
								{
									for (pbitem = 0; pbitem < pb_saved_data[level][pbparent].length; pbitem ++)
									{

										if (level == 0)
										{
											addItem(levels[0],0);
										}
										else
										{
											addItem(levels[level],level,'#level_form_' + (level - 1) + '_' + pbparent,pbparent);
										}
									}
								}
							}
						}
						else
						{
							//create default 0 level if level 0 array is empty
							addItem(levels[0],0);
						}
					}
				}
				else
				{
					//create default 0 level if not data is saved for this shortcode
					addItem(levels[0],0); 
					pb_saved_data = undefined;
				}	

			<?php else: ?>
				addItem(levels[0],0); //add first level of form fields
			<?php endif; ?>
		}
	};
	
	/**
	 * Set an array of all levels
	 *
	 */
	var setLevels = function(shortcode,current_level) {
		
		levels[current_level] = new Array();
		levels[current_level]['code'] = shortcode.code;
		levels[current_level]['add_child_button'] = shortcode.add_child_button;
		levels[current_level]['fields'] = shortcode.fields;
		levels[current_level]['name'] = shortcode.name;
		levels_item_iterator[current_level] = 0;
		
		if (shortcode.child != null && typeof shortcode.child === 'object')
		{
			setLevels(shortcode.child,current_level + 1);
		}
	};
	
	var formatIconDropdownShortcode = function(item) {
						
		if (item.text.indexOf("icon-") >= 0 || item.text.indexOf("icomoon-") >= 0) {

			item_text = item.text.replace('icon-','');
			item_text = item_text.replace('icomoon-','');
			return '<i class="' + item.text + '"></i> ' + item_text;
		}
		return item.text;
	}
	
	/**
	 * Add item - 
	 *
	 */
	addItem = function(level,current_level,parent_container,parent_iterator) {
		
		//set level item eg. 1_0 
		current_level_item = current_level + '_' + levels_item_iterator[current_level];
		
		//create level container
		level_container = '<div class="level_' + current_level + '" id="level_' + current_level_item + '"></div>';
		
		if (current_level == 0)
		{
			parent_container = '#shortcode-form-container';
			parent_iterator = 0;
		}
		
		//create iterator for parent container
		if (parent_container in items_in_container)
		{
			items_in_container[parent_container] ++;
		}
		else
		{
			items_in_container[parent_container] = 1;
		}
		
		//add level container to parent container or to main for level 0
		//add header and form fields container
		if (current_level == 0)
		{
			jQuery(parent_container).append(level_container);
			jQuery('#level_' + current_level_item).append('<div class="item_header">' + level.name + '</div>');
		}
		else
		{
			jQuery(parent_container).append(level_container);
			jQuery('#level_' + current_level_item).append('<div class="item_header edit">' + level.name + ' ' + items_in_container[parent_container] + '</div><div class="remove"><?php _e('remove','framework');?></div>');
		}
		jQuery('#level_' + current_level_item).append('<div class="clear"></div>');
		jQuery('#level_' + current_level_item).append('<div class="level_form_' + current_level + '" id="level_form_' + current_level_item + '"></div>');
		
		//check if have fields
		if (level.fields != null && typeof level.fields === 'object')
		{
			//iterate every field
			for (var key in level.fields) {
				var field = level.fields[key];
				
				//set current field key
				current_key = 'level_' + current_level + '_' + levels_item_iterator[current_level] + '_' + key;
				
				//create html for field header
				html = '<div class="format-settings" id="format-settings-' + current_key + '">'
				html += '<div class="format-setting-label">';
				html += '<label for="' + current_key + '" class="label">' + field.label + '</label>';
				html += '</div>';
				
				default_value = '';
				
				<?php if (!empty($data_field)): ?>
					if (pb_saved_data != undefined)
					{
						if (pb_saved_data[current_level] instanceof Array && pb_saved_data[current_level][parent_iterator][levels_item_iterator[current_level]] !== undefined)
						{
							default_value = pb_saved_data[current_level][parent_iterator][levels_item_iterator[current_level]][key];
						}
					}
				<?php endif; ?>
				
				css_class = '';
				if (field.class !== undefined) {
					css_class = field.class;
				}
				
				//create html for field type
				switch (field.type)
				{
					case 'colorpicker':
					
						html += '<div class="format-setting type-colorpicker has-desc">';
							html += '<div class="description">' + field.desc + '</div>';
							html += '<div class="format-setting-inner">';
								html += '<div class="option-tree-ui-colorpicker-input-wrap">';
									html += '<input type="text" name="' + current_key + '" id="' + current_key + '" value="' + default_value + '" parent="' + parent_iterator + '" data-type="' + field.type + '" class="shortcode-attribute widefat option-tree-ui-input cp_input ' + css_class + '" autocomplete="off"><div id="cp_' + current_key + '" class="cp_box" style="background-color: #f1f1f1; border-color: #ccc; background-position: initial initial; background-repeat: initial initial;"></div>';
								html += '</div>';
							html += '</div>';
						html += '</div>';
					
						break;
					case 'text':
						
						html += '<div class="format-setting type-text has-desc">';
							html += '<div class="description">' + field.desc + '</div>';
							html += '<div class="format-setting-inner">';
								html += '<input type="text" name="' + current_key + '" id="' + current_key + '" value="' + default_value + '" parent="' + parent_iterator + '"  data-type="' + field.type + '" class="shortcode-attribute widefat option-tree-ui-input cp_input ' + css_class + '" autocomplete="off">';
							html += '</div>';
						html += '</div>';
						break;
					case 'textarea':
						html += '<div class="format-setting type-text has-desc">';
							html += '<div class="description">' + field.desc + '</div>';
							html += '<div class="format-setting-inner">';
								html += '<textarea name="' + current_key + '" id="' + current_key + '" parent="' + parent_iterator + '" data-type="' + field.type + '" class="shortcode-attribute widefat option-tree-ui-textarea cp_input ' + css_class + '">' + default_value + '</textarea>';
							html += '</div>';
						html += '</div>';
						break;
					
					case 'select':
						html += '<div class="format-setting type-text has-desc">';
							html += '<div class="description">' + field.desc + '</div>';
							html += '<div class="format-setting-inner">';
								html +=	'<select name="' + current_key + '" id="' + current_key + '" parent="' + parent_iterator + '" data-type="' + field.type + '" class="shortcode-attribute ' + css_class + '">';
								for (var keyVal in field.values) {
									var value = field.values[keyVal];
									
									selected = '';
									if (keyVal == default_value)
									{
										selected = 'selected';
									}
									html +=	'<option value="' + keyVal + '" ' + selected + '>' + value + '</option>';
								}
								html += '</select>';	
							html += '</div>';
						html += '</div>';
						break;
						
					case 'upload':
						
						html += '<div class="format-setting type-text has-desc">';
							html += '<div class="description">' + field.desc + '</div>';
							html += '<div class="format-setting-inner">';
								html += '<div class="option-tree-ui-upload-parent">';
									html += '<input type="text" name="' + current_key + '" id="' + current_key + '" value="' + default_value + '" parent="' + parent_iterator + '" data-type="' + field.type + '" class="shortcode-attribute widefat option-tree-ui-upload-input ' + css_class + '">';
									html += '<a href="javascript:void(0);" class="upload_image_button option-tree-ui-button blue light" rel="4" title="Add Media"><span class="icon upload">Add Media</span></a>';
								html += '</div>';
							html += '</div>';
						html += '</div>';
						break;
						
					case 'wp_editor':
						
						html += '<div class="format-setting type-text has-desc">';
							html += '<div class="description">' + field.desc + '</div><div class="clear"></div>';
							html += '<div class="format-setting-inner-editor">';
								html += '<div class="wp-core-ui wp-editor-wrap">';
									html += '<div id="wp-scripts_header-editor-tools" class="wp-editor-tools hide-if-no-js">';
										//html += '<a class="wp-switch-editor switch-html">Text</a>';
										//html += '<a class="wp-switch-editor switch-tmce">Visual</a>';
										html += '<div id="wp-scripts_header-media-buttons" class="wp-media-buttons">';
											html += '<a href="javascript:void(0);" class="button insert-media-pb add_media" data-editor="' + current_key + '" title="Add Media"><span class="wp-media-buttons-icon"></span> Add Media</a>';
										html += '</div>';
									html += '</div>';
									html += '<div class="wp-editor-container">';
										html += '<textarea name="' + current_key + '" id="' + current_key + '" parent="' + parent_iterator + '" data-type="' + field.type + '" class="pb_tinymce shortcode-attribute widefat option-tree-ui-textarea cp_input ' + css_class + '">' + default_value + '</textarea>';
									html += '</div>';
								html += '</div>';
							html += '</div>';
						html += '</div>';
						
						break;
						
					case 'description':
						
						html += '<div class="format-setting type-text has-desc">';
							html += '<div class="description">' + field.desc + '</div>';
							html += '<input type="hidden" name="' + current_key + '" id="' + current_key + '" value="' + default_value + '" parent="' + parent_iterator + '"  data-type="' + field.type + '" class="shortcode-attribute widefat option-tree-ui-input cp_input ' + css_class + '" autocomplete="off">';
						html += '</div>';
						break;
				}
				html += '</div>';
				
				//append html to current item container
				jQuery('#level_form_' + current_level_item).append(html);
				
				//replace icons dropdown with 'select2' jquery dropdown replacement
				dropdown_id = '#format-settings-' + current_key + ' .icons-dropdown';
				if (jQuery(dropdown_id).length > 0) {
					
					jQuery(dropdown_id).select2({
						formatResult: formatIconDropdownShortcode,
						formatSelection: formatIconDropdownShortcode,
						escapeMarkup: function(m) { return m; }
					});
				}
				
				switch (field.type)
				{
					case 'wp_editor':	
						tinyMCE.execCommand( "mceAddControl", true, current_key );
						quicktags( { id : current_key } );
						pb_init_new_editor( current_key );
						break;
						
					case 'upload':
						jQuery("#" + current_key).focus();
						break;
				}
				
				//set colorpicker
				if (field.type == 'colorpicker')
				{
					OT_UI.bind_colorpicker(current_key);
				}
			}
		}
		
		function pb_init_new_editor(editor_id){
			if ( typeof tinyMCEPreInit.mceInit[editor_id] !== "undefined" ) return;
			var pb_new_hidden_editor_object = pb_hidden_editor_object;
			
			pb_new_hidden_editor_object['elements'] = editor_id;
			tinyMCEPreInit.mceInit[editor_id] = pb_new_hidden_editor_object;
		}
		
		//add button if defined
		if (level.add_child_button !== undefined && level.add_child_button != '')
		{
			jQuery('#level_form_' + current_level_item).append('<a href="#" class="add_item" id="add_item_' + current_level + '_' + levels_item_iterator[current_level] + '" parent="' + levels_item_iterator[current_level] + '" level=' + (parseInt(current_level) + 1) + ' container="#level_form_' + current_level_item + '">' + level.add_child_button + '</a>');
			
			jQuery('#add_item_' + current_level + '_' + levels_item_iterator[current_level]).click(function(event){
				event.preventDefault();
				addItem(levels[jQuery(this).attr('level')],jQuery(this).attr('level'),jQuery(this).attr('container'),jQuery(this).attr('parent'));
				return false;
			});
		}
		
		//hide all items for current level except new one
		jQuery('.level_form_' + current_level).hide();
		jQuery('.level_' + current_level).children('.edit').show();
		
		if (current_level == 0)
		{
			jQuery('#level_form_' + current_level_item).show();
		}
		//jQuery('#level_' + current_level_item).children('.edit').hide();
		
		//bind click to edit on current item
		jQuery('#level_' + current_level_item).children('.edit').click(function(){
			
			if(jQuery(this).siblings('.level_form_' + current_level).is(':visible')) {
				jQuery('.level_form_' + current_level).hide();
			}
			else {
				jQuery('.level_form_' + current_level).hide();
				jQuery(this).siblings('.level_form_' + current_level).show();
			}
			
			//jQuery(this).hide();
		});
		
		//bind remove on current item
		jQuery('#level_' + current_level_item).children('.remove').click(function(){
			jQuery(this).parents('.level_' + current_level).remove();
			
		});
		
		jQuery('#level_form_' + current_level_item).sortable({
			'tolerance':'intersect',
			'cursor':'pointer',
			'items':'div.level_' + (current_level + 1),
			'placeholder':'placeholder',
			start: function(e, ui){
				$(this).find('.pb_tinymce').each(function(){
					tinyMCE.execCommand( 'mceRemoveControl', false, $(this).attr('id') );
				});
			},
			stop: function(e,ui) {
				$(this).find('.pb_tinymce').each(function(){
					tinyMCE.execCommand( 'mceAddControl', true, $(this).attr('id') );
					//$(this).sortable("refresh");
				});
			}
		});
		
		
		levels_item_iterator[current_level] ++;
	}
	
	/**
	 * Click on "Insert Shortcode" button
	 *
	 */
	jQuery('#insert-shortcode').click(function(){
	
		//destroy all 'select2' objects
		jQuery('#shortcode-form-container .icons-dropdown').each( function (index) {
			jQuery(this).select2('destroy');
		});

		//gather all form values
		jQuery(".shortcode-attribute").each(function (i) {

			aName = jQuery(this).attr('name').split('_'); //each form name is like this one level_0_0_title
			level = aName[1];
			pbparent = jQuery(this).attr('parent'); //parent identifer
			pbitem = aName[2];
			field = aName[3];

			if (data[level] == undefined)
			{
				data[level] = new Array();
				data_order_help[level] = new Array();
				pb_data[level] = new Array();

			}
			if (data[level][pbparent] == undefined)
			{
				data[level][pbparent] = new Array();
				data_order_help[level][pbparent] = new Array();
				pb_data[level][pbparent] = new Array();
			}
			//using data_order_help is required because join and for (var in ..) in prepareShortcodeString return sorted array using keys
			//if they returned elements in order they were created it will be enough to use data[level][pbparent][[pbitem] instead of data[level][pbparent][i]
			//all above regards dragging elements
			if (data_order_help[level][pbparent][pbitem] == undefined)
			{
				data_order_help[level][pbparent][pbitem] = data[level][pbparent].length;
				i = data_order_help[level][pbparent][pbitem];
				data[level][pbparent][i] = levels[level]['code'];
				pb_data[level][pbparent][i] = {}; //create object instead of an array to avoid problems with JSON.stringify
			}
			else
			{
				i = data_order_help[level][pbparent][pbitem]; 
			}
			if (jQuery(this).attr('data-type') == 'wp_editor')
			{
				val = tinyMCE.get( jQuery(this).attr('id') ).getContent();
			}
			else
			{
				val = jQuery(this).val();
			}
			data[level][pbparent][i] = data[level][pbparent][i].replace('{' + field + '}',val);
			pb_data[level][pbparent][i][field] = val;

			//remove tinymce control
			if (jQuery(this).attr('data-type') == 'wp_editor')
			{
				tinyMCE.execCommand("mceRemoveControl", false, jQuery(this).attr('id'));
			}
		});
		shortocdeFinalString = prepareShortcodeString(shortcode_main,0,0);

		<?php 
		//save shortcode and JSONed data to page builder
		if (!empty($callback)): ?>
			<?php echo $callback.'("'.$data_field.'", "'.$field_id.'", pb_data);'; ?>
		<?php elseif (!empty($data_field)): ?>
			pb_tmp_data = {};
			pb_tmp_data['shortcode'] = shortocdeFinalString;
			pb_tmp_data['data'] = pb_data;

			jQuery('#pb_item_data_<?php echo $data_field;?>').val(JSON.stringify(pb_tmp_data));
		<?php else: ?>
			window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortocdeFinalString);
		<?php endif; ?>
		tb_remove();
		
		return false;
	});
	
	/**
	 * Prepare shortcode string - recursive function
	 *
	 */
	var prepareShortcodeString = function(shortcode,current_level,parent_iterator) {
		
		shortcodeString = '';
		//current level has no form fiels, we need to take shortcode code from settings
		if (shortcode.fields == null || typeof shortcode.fields !== 'object')
		{
			shortcodeString += shortcode.code;
			
			//run this funcion by recurrence if current level has child 
			if (shortcode.child != null && typeof shortcode.child == 'object')
			{
				shortcodeString = shortcodeString.replace('{child}',prepareShortcodeString(shortcode.child,current_level + 1,0));
			}
		}
		else
		{
			//happens when we don't have any added items for current_level
			if (data[current_level] == undefined)
			{
				return '';
			}
			//should never happen :)
			if (data[current_level][parent_iterator] == undefined)
			{
				return '';
			}
			
			//run this funcion by recurrence on every item from data if current level has child
			if (shortcode.child != null && typeof shortcode.child == 'object')
			{
				for (var item in data[current_level][parent_iterator]) {
					
					shortcodeString += data[current_level][parent_iterator][item].replace('{child}',prepareShortcodeString(shortcode.child,current_level + 1,item));
				}
			}
			//simply join if current level has no child
			else
			{
				shortcodeString += data[current_level][parent_iterator].join('');
			}
		}
		return shortcodeString;
	}
	
	// Uploading files
	var file_frame;
	
	jQuery('#shortcode-form-container').on( 'click', '.insert-media-pb', function( event ) {
		
		event.preventDefault();
		$upload_field = jQuery(this).closest('.wp-editor-wrap').find('textarea').attr('id');
				
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
			attachment = file_frame.state().get('selection').first().toJSON();
			ed = tinymce.get($upload_field);
			ed.execCommand('mceInsertContent', false, '<img src="' + attachment.url + '" alt="' + attachment.alt + '">');
		});

		file_frame.open();
	});
	
	/**
	 * Start script
	 *
	 */
	if (typeof tinyMCEPreInit !== 'undefined') {
		var pb_hidden_editor_object = tinyMCEPreInit.mceInit['pb_hidden_editor'];
	}
	var shortcode_main = jQuery.parseJSON(jQuery('input[name="shortcode"]').val()); //get all shortcodes configuration from hidden input field
	
	var levels = new Array(); //array of levels, each level is an array with settings for level
	var levels_item_iterator = new Array(); //amount of items per level
	var items_in_container = new Array(); //amount of items in container
	var data = new Array(); //data gathered from form fields
	var data_order_help = new Array(); //array helps to  receive proper order
	var pb_data = new Array(); //data to save to page builder
	var pb_saved_data = new Array(); //data from page builder (eg. saved shortcode values)
	jQuery('#TB_ajaxContent').css('height','90%');
	processShortcode(); //process shortcode config
});
</script>
<form >
<?php

$oShortcodesTinyMcePopup = new ShortcodesTinyMcePopup($_GET['shortcode']);
$oShortcodesTinyMcePopup -> display();

if (!empty($data_field))
{
	$button = __('Save','framework');;
}
else
{
	$button = __('Insert Shortcode','framework');
}

?>
<div id="shortcode-form-container"></div>
<input id="insert-shortcode" name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="<?php echo $button; ?>">
</form>
</body>
</html>