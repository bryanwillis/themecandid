/**
 * Scripts enqueued on theme options
 *
 */

jQuery(document).ready(function($) {
	
	//create an array of all radio button names with class="switcher"
	var getAllSwitchers = function($switcherType)
	{
		//replace radio buttons with switcher
		var switchers = new Array();
		
		jQuery("input:radio").each(function(){
		
			if (jQuery(this).attr("class") != undefined && jQuery(this).attr("class").indexOf($switcherType) >= 0)
			{
				var $name = jQuery(this).attr("name");

				if (jQuery.inArray($name, switchers) == -1)
				{
					switchers[switchers.length] = $name;
				}
			}
		});
		return switchers;
	}
	
	var switchSwitchers = function($switchers,$first,$last)
	{
		//create switchers in place of radio buttons
		for (i = 0; i < $switchers.length; i++)
		{
			$group = jQuery('input:radio[name="' + $switchers[i] + '"]');

			if ($group.filter(':first').is(':checked'))
			{
				$button_state = $first;
			}
			if ($group.filter(':last').is(':checked'))
			{
				$button_state = $last;
			}
			else
			{
				$group.filter(':first').attr('checked',true);
				$button_state = $first;
			}

			//skip if more than 2 buttons for one radio buttons group
			if ($group.length != 2)
			{
				continue;
			}
			$container = $group.parent('p').parent('.format-setting-inner');
			$group.parent('p').css('position','absolute');
			$group.parent('p').css('left','-5000px');
			$container.append('<div id="switcher-button-' + $first + '-' + i + '" class="switcher-button ' + $button_state + '"></div>');

			//switch to another state on click
			jQuery('#switcher-button-' + $first + '-' + i).click(function() {

				$group = jQuery(this).closest('.format-setting-inner').find('p').find('input:radio');
				
				//switch from on to off
				if ($group.filter(':first').is(':checked'))
				{
					jQuery(this).removeClass($first);
					jQuery(this).addClass($last);
					$group.filter(':last').attr('checked',true);
				}
				//switch from off to on
				else if ($group.filter(':last').is(':checked'))
				{
					jQuery(this).removeClass($last);
					jQuery(this).addClass($first);
					$group.filter(':first').attr('checked',true);
				}
			});
		}
	}
	
	switchersOn = getAllSwitchers('switcher-on');
	switchersOff = getAllSwitchers('switcher-off');
	switchSwitchers(switchersOn,'on','off');
	switchSwitchers(switchersOff,'off','on');
	
	
	//disable "---google web fonts---" option
	jQuery("#title_font option[value='google_web_fonts']").attr("disabled","disabled");
	jQuery("#content_font option[value='google_web_fonts']").attr("disabled","disabled");
	jQuery("#menu_font option[value='google_web_fonts']").attr("disabled","disabled");
	jQuery("#headers_font option[value='google_web_fonts']").attr("disabled","disabled");
	
	//preview font in theme options
	var usedFonts = new Array();
	var previewFont = function(element) {
		font_wrapper = jQuery(element).parents(".select-wrapper");
		
		font = jQuery(element).val();
		//load google web font if necessary
		if (jQuery(element).val().search('google_web_font') != -1)
		{
			font = jQuery(element).val().replace('google_web_font_','').replace(' ','+');
			
			if (jQuery.inArray(font, usedFonts) == -1)
			{
				jQuery('head').append('<link href="http://fonts.googleapis.com/css?family=' + font + ':regular,bold" rel="stylesheet" type="text/css">');
			}
			usedFonts[usedFonts.length] = font;
		}
		
		preview = "<div id='" + element.replace('#','') + "_preview' style='padding-left: 10px; padding-top: 2px; line-height: 26px; height: 28px; display: inline; font-family: " + font + "; font-size: 20px;'>Sample Text</div>";
		jQuery(element + '_preview').remove();
		
		//show preview
		if (jQuery(element).val() != 'default')
		{
			jQuery( preview ).insertAfter( font_wrapper );
		}
	}
	//generate preview font on change
	jQuery( "#title_font" ).change(function()
	{
		previewFont("#title_font");
	});
	//generate preview font on change
	jQuery( "#content_font" ).change(function()
	{
		previewFont("#content_font");
	});
	//generate preview font on change
	jQuery( "#menu_font" ).change(function()
	{
		previewFont("#menu_font");
	});
	//generate preview font on change
	jQuery( "#headers_font" ).change(function()
	{
		previewFont("#headers_font");
	});
	//load preview font on tab select
	jQuery('.wrap.settings-wrap .ui-tabs').bind("tabsselect", function(event, ui) {
		
		previewFont("#title_font");
		previewFont("#content_font");
		previewFont("#menu_font");
		previewFont("#headers_font");
	});
});
