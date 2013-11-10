<?php 
	require_once('../../../../../wp-load.php');
	$aShortcodes = ts_get_shortcodes_list();
?>
/**
 * Shortcodes selector
 *
 */
(function() {
	//******* Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('example');

	tinymce.create('tinymce.plugins.ShortcodesSelector', {
		/**
		 * Plugin initalization, will be executed after the plugin has been created.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init: function ( ed, url )
		{
			ed.addCommand("shortcodesPopup", function ( a, params )
			{
				tb_show("<?php _e("Shortcodes","framework") ?>", "<?php echo get_template_directory_uri();?>/framework/popup.php?shortcode=" + params.shortcode + "&width=" + 630);
			});
		},

		/**
		 * Creates control instances based in the incomming name
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			if(n=='ShortcodesSelector'){
                var mlb = cm.createListBox('ShortcodesSelectorList', {
                    title : '<?php _e("Shortcodes","framework") ?>',
					onselect : function(v) { //Option value as parameter
						
						if (v != "")
						{
							tinyMCE.activeEditor.execCommand("shortcodesPopup", false, {
								shortcode: v
							})
						}
					} 	
                });
				
				// Add some values to the list box
				/*<?php foreach ($aShortcodes as $aShortcode): ?>*/
					mlb.add('<?php echo $aShortcode["name"];?>', '<?php echo sanitize_text_field($aShortcode["shortcode"]);?>');
				/*<?php endforeach; ?>*/
				
				return mlb;
             }
             
             return null;
		},

		/**
		 * Returns information about the plugin
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : '<?php _e("Shortcodes","framework") ?>'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('ShortcodesSelector', tinymce.plugins.ShortcodesSelector);
})();