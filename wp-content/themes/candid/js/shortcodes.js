/**
 * Shortcodes scripts
 *
 */
jQuery(document).ready(function() {

	//scroll to top
	jQuery('.sc-divider-scroll').click(function(){
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

	  function is_visible(el) {
		var el_off = el.offset(),
			 el_top = el_off.top;
			 if ($(window).scrollTop() > el_top - window.innerHeight/2) {
				return true;
			 }
	  }	
		
	jQuery('.sc-skillbar .sc-skillbar-bar').data('play','false');
	/*
	jQuery('.sc-skillbar .sc-skillbar-bar').each(function(){
	if (is_visible($(this)) && $(this).data('play') == 'false') {
	    per = jQuery(this).attr('data-percentage');
	    color = jQuery(this).attr('data-color');
		color_style = '';
		if (color != "")
		{
			color_style = 'background-color: ' + color;
		}
		var sb_per = (jQuery(this).parents('.sc-skillbar').hasClass('sc-skillbar-style-2')) ? '<span></span>' : '';
		jQuery(this).append('<div style="width: 0; ' + color_style + '">'+sb_per+'</div>');
	    jQuery(this).children('div').delay(1000).animate({ "width" : per + "%"},
	    	{
	    		step:function(){

  						var skill_width = jQuery(this).attr('style').match(/\d+/)[0];
	    					jQuery(this).find('span').html(parseInt(skill_width)+1+'%');
	    				 },
	    		duration:  per*30
	  		});
			$(this).data('play','true') 
		}	
	});
*/
	jQuery('.sc-skillbar-vertical .sc-skillbar-bar').each(function(){
	    per = jQuery(this).attr('data-percentage');
		color = jQuery(this).attr('data-color');
		color_style = '';
		if (color != "")
		{
			color_style = 'background-color: ' + color;
		}
		jQuery(this).append('<div style="width: 25px; height: 0px; ' + color_style + '"></div>');
	    jQuery(this).children('div').delay(1000).animate({ "height" : per + "%"}, per*30);
	});
});
