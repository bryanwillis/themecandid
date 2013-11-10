/* 
 * Framework scripts
 */

jQuery(document).ready(function($) {
	
	$("#update-nav-menu").on("click", ".edit-menu-button-icon", function(event) {
		$nav_item_id = $(this).attr('data-id');
		tb_show("Shortcodes", popupurl + "?custom_popup_items=1&shortcode=custom_icon&width=630&pb_item_id=" + $nav_item_id + '&builder=edit-menu-item-icon&callback=insert_nav_icon');
	});
	
	$("#update-nav-menu").on("click", ".edit-menu-remove-icon", function(event) {
		$nav_item_id = $(this).attr('data-id');
		jQuery('#edit-menu-item-icon_' + $nav_item_id).val('');
		jQuery('#edit-menu-preview-icon-' + $nav_item_id).html('');
	});
});

var insert_nav_icon = function(field, nav_item_id, data) {	
	
	icon = data[0][0][0].icon;
	jQuery('#edit-menu-preview-icon-' + nav_item_id).html('<i class="' + icon + '"></i>');
	jQuery('#edit-menu-item-icon_' + nav_item_id).val(icon);
	return false;
	
}
