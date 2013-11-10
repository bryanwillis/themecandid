/**
 * Scripts enqueued on post and pages edit form
 *
 */

jQuery(document).ready(function() {
	
	//switch shortcodes help for each shortcode
	jQuery('.toggle-shortcode, .framework-box h3').click(function(){
		if (jQuery(this).parent().find('.box-description').is(":visible"))
		{
			jQuery(this).parent().find('.box-description').hide();
		}
		else
		{
			jQuery(this).parent().find('.box-description').show();
		}
	});
	
	//show metaboxes for selected post format
	var switchPostFormatMetaBoxes = function() {
		var format = jQuery('input[name="post_format"]:checked').val();
		if (format != 0)
		{
			if (format == "gallery")
			{
				jQuery("label[for='gallery_images']").parents(".format-settings").show();
			}
			else
			{
				jQuery("." + format).parents(".format-settings").show();
			}
		}
		//hide all metaboxes with fields for different post formats
		jQuery('input[name="post_format"]').each(function()
		{
			if (jQuery(this).val() == "gallery" && jQuery(this).val() != format)
			{
				jQuery("label[for='gallery_images']").parents(".format-settings").hide();
			}
			else if (jQuery(this).val() != 0 && jQuery(this).val() != format)
			{
				jQuery("." + jQuery(this).val()).parents(".format-settings").hide();
			}
		});
	}
	jQuery('input[name="post_format"]').change(function(){
		switchPostFormatMetaBoxes();
	});
	switchPostFormatMetaBoxes();
	
	//hide/show all metaboxes, depends on selected template
	if (jQuery('#page_template').length > 0)
	{
		jQuery('#page_template').change(function(){
			switchTemplateMetaBoxes();
		});
		var switchTemplateMetaBoxes = function(){

			jQuery("#page_template > option").each(function() {

				if (this.value != 'default')
				{
					str = this.value;
					jQuery("." + str.replace('.php','')).parents(".format-settings").hide();
				}
			});
			str = jQuery("#page_template").val();
			jQuery("." + str.replace('.php','')).parents(".format-settings").show();
		}
		switchTemplateMetaBoxes();
	}
	//hiding sidebar radio button label (buttons are replaced with images, check page source code for details)
	
	jQuery('label[for="sidebar_position_single-0"]').hide();
	jQuery('label[for="sidebar_position_single-1"]').hide();
	jQuery('label[for="sidebar_position_single-2"]').hide();
	jQuery('label[for="sidebar_position_single-3"]').hide();
	jQuery('label[for="sidebar_position_single-4"]').hide();
	jQuery('label[for="sidebar_position_single-5"]').hide();
	
	var cssObj = {'float' : 'left', 'width' : 'auto', 'padding-right' : '10px'};
	
	jQuery("#sidebar_position_single-0").parents("p").css(cssObj);
	jQuery("#sidebar_position_single-1").parents("p").css(cssObj);
	jQuery("#sidebar_position_single-2").parents("p").css(cssObj);
	jQuery("#sidebar_position_single-3").parents("p").css(cssObj);
	jQuery("#sidebar_position_single-4").parents("p").css(cssObj);
	jQuery("#sidebar_position_single-5").parents("p").css(cssObj);
	
	//set visibility depend
	var setSidebarMetaBoxesVisibility = function(){
		
		if (jQuery("input:radio[name='sidebar_position_single']:checked").val() == 'left')
		{
			jQuery("#left_sidebar").parents(".format-settings").show();
			jQuery("#right_sidebar").parents(".format-settings").hide();
			jQuery("#left_sidebar_2").parents(".format-settings").hide();
			jQuery("#right_sidebar_2").parents(".format-settings").hide();
		}
		else if (jQuery("input:radio[name='sidebar_position_single']:checked").val() == 'left2')
		{
			jQuery("#left_sidebar").parents(".format-settings").show();
			jQuery("#right_sidebar").parents(".format-settings").hide();
			jQuery("#left_sidebar_2").parents(".format-settings").show();
			jQuery("#right_sidebar_2").parents(".format-settings").hide();
		}
		else if (jQuery("input:radio[name='sidebar_position_single']:checked").val() == 'right')
		{
			jQuery("#left_sidebar").parents(".format-settings").hide();
			jQuery("#right_sidebar").parents(".format-settings").show();
			jQuery("#left_sidebar_2").parents(".format-settings").hide();
			jQuery("#right_sidebar_2").parents(".format-settings").hide();
		}
		else if (jQuery("input:radio[name='sidebar_position_single']:checked").val() == 'right2')
		{
			jQuery("#left_sidebar").parents(".format-settings").hide();
			jQuery("#right_sidebar").parents(".format-settings").show();
			jQuery("#left_sidebar_2").parents(".format-settings").hide();
			jQuery("#right_sidebar_2").parents(".format-settings").show();
		}
		else if (jQuery("input:radio[name='sidebar_position_single']:checked").val() == 'both')
		{
			jQuery("#left_sidebar").parents(".format-settings").show();
			jQuery("#right_sidebar").parents(".format-settings").show();
			jQuery("#left_sidebar_2").parents(".format-settings").hide();
			jQuery("#right_sidebar_2").parents(".format-settings").hide();
		}
		//no sidebar
		else 
		{
			jQuery("#left_sidebar").parents(".format-settings").hide();
			jQuery("#right_sidebar").parents(".format-settings").hide();
			jQuery("#left_sidebar_2").parents(".format-settings").hide();
			jQuery("#right_sidebar_2").parents(".format-settings").hide();
		}
	};
	
	jQuery("input:radio[name='sidebar_position_single']").change(function(){
        setSidebarMetaBoxesVisibility();
	});
	setSidebarMetaBoxesVisibility();
});
