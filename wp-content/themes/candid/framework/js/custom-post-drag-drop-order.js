function update_simple_ordering_callback(response) {
	if ( response == 'children' ) {
		window.location.reload();
		return;
	}

	var changes = jQuery.parseJSON( response );

	var new_pos = changes.new_pos;
	for ( key in new_pos ) {
		if ( key == 'next' )
			continue;

		if ( jQuery('#inline_'+key).length > 0 ) {
			if ( new_pos[key]['menu_order'] != null ) {
				jQuery('#inline_'+key+' .menu_order').html( new_pos[key]['menu_order'] );
				jQuery('#inline_'+key+' .post_parent').html( new_pos[key]['post_parent'] );
				var post_title = jQuery('#inline_'+key+' .post_title').html();
				var dashes = 0;
				while ( dashes < new_pos[key]['depth'] ) {
					post_title = '&mdash; ' + post_title;
					dashes++;
				}
				jQuery('tr#post-'+key+' a.row-title').html( post_title );
			} else {
				jQuery('#inline_'+key+' .menu_order').html(new_pos[key]);
			}
		}
	}

	if ( changes.next ) {
		jQuery.post( ajaxurl, {
			action: 'simple_page_ordering',
			id: changes.next['id'],
			previd: changes.next['previd'],
			nextid: changes.next['nextid'],
			start: changes.next['start'],
			excluded: changes.next['excluded']
		}, update_simple_ordering_callback );
	} else {
		jQuery('.check-column .waiting').siblings('input').show().siblings('img').remove();
		jQuery('tr.iedit').css('cursor','move');
		jQuery(".wp-list-table tbody").sortable('enable');
	}
}

jQuery('tr.iedit').css('cursor','move');

jQuery(".wp-list-table tbody").sortable({
	items: 'tr:not(.inline-edit-row)',
	cursor: 'move',
	axis: 'y',
	containment: 'table.widefat',
	scrollSensitivity: 20,
	helper: function(e, element) {
		element.children().each(function() { jQuery(this).width(jQuery(this).width()); });
		return element;
	},
	start: function(event, element) {
		element.item.css( 'border-top', '1px solid #dfdfdf' );
		element.item.css( 'background-color', '#FFFFFF' );
	},
	stop: function(event, element) {
		element.item.removeAttr('style');
		element.item.children('td,th').css('border-bottom-width','1px');
	},
	update: function(event, element) {
		jQuery('tr.iedit').css('cursor','default');
		jQuery(".wp-list-table tbody").sortable('disable');

		var postid = element.item.attr('id').substr(5); // post id

		var prevpostid = false;
		var prevpost = element.item.prev();
		if ( prevpost.length > 0 )
			prevpostid = prevpost.attr('id').substr(5);

		var nextpostid = false;
		var nextpost = element.item.next();
		if ( nextpost.length > 0 )
			nextpostid = nextpost.attr('id').substr(5);

		// show spinner
		element.item.find('.check-column input').hide().after('<img alt="processing" src="images/wpspin_light.gif" class="waiting" style="margin-left: 6px;" />');

		// go do the sorting stuff via ajax
		jQuery.post( ajaxurl, { action: 'simple_page_ordering', id: postid, previd: prevpostid, nextid: nextpostid }, update_simple_ordering_callback );

		// fix cell colors
		jQuery( 'tr.iedit' ).each(function(i){
			if ( i%2 == 0 ) jQuery(this).addClass('alternate');
			else jQuery(this).removeClass('alternate');
		});
	}
});