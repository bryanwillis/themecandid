<?php 
	require_once('../../../../../wp-load.php');
?>


/**
 * Columns selector
 *
 */
(function() {
	//******* Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('example');

	tinymce.create('tinymce.plugins.ColumnsSelector', {
		/**
		 * Plugin initalization, will be executed after the plugin has been created.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			
		},

		/**
		 * Creates control instances based in the incomming name
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			if(n=='ColumnsSelector'){
                var mlb = cm.createListBox('ColumnsSelectorList', {
                     title : '<?php _e("Columns","framework") ?>',
                     onselect : function(v) { //Option value as parameter
                     	
						switch (v)
						{
							case '2_columns':
								content = '[one_half]' + tinyMCE.activeEditor.selection.getContent() + '[/one_half]';
								content += '[one_half_last][/one_half_last]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
								
							case '3_columns':
								content = '[one_third]' + tinyMCE.activeEditor.selection.getContent() + '[/one_third]';
								content += '[one_third][/one_third]';
								content += '[one_third_last][/one_third_last]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							case '4_columns':
								content = '[one_fourth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_fourth]';
								content += '[one_fourth][/one_fourth]';
								content += '[one_fourth][/one_fourth]';
								content += '[one_fourth_last][/one_fourth_last]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							case '5_columns':
								content = '[one_fifth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_fifth]';
								content += '[one_fifth][/one_fifth]';
								content += '[one_fifth][/one_fifth]';
								content += '[one_fifth][/one_fifth]';
								content += '[one_fifth_last][/one_fifth_last]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							case '6_columns':
								content = '[one_sixth]' + tinyMCE.activeEditor.selection.getContent() + '[/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth][/one_sixth]';
								content += '[one_sixth_last][/one_sixth_last]';
								tinyMCE.activeEditor.selection.setContent(content);
								break;
							
							default:
								if(tinyMCE.activeEditor.selection.getContent() != '')
								{
									tinyMCE.activeEditor.selection.setContent('[' + v + ']' + tinyMCE.activeEditor.selection.getContent() + '[/' + v + ']');
								}
								else
								{
									tinyMCE.activeEditor.selection.setContent('[' + v + '][/' + v + ']');
								}
						}
						
						
                     }
                });

                // Add some values to the list box
				mlb.add('1/2', 'one_half');
				mlb.add('1/2 last', 'one_half_last');
				
				mlb.add('1/3', 'one_third');
				mlb.add('1/3 last', 'one_third_last');
				mlb.add('2/3', 'two_third');
				mlb.add('2/3 last', 'two_third_last');
				
				mlb.add('1/4', 'one_fourth');
				mlb.add('1/4 last', 'one_fourth_last');
				mlb.add('3/4', 'three_fourth');
				mlb.add('3/4 last', 'three_fourth_last');
				
				mlb.add('1/5', 'one_fifth');
				mlb.add('1/5 last', 'one_fifth_last');
				mlb.add('2/5', 'two_fifth');
				mlb.add('2/5 last', 'two_fifth_last');
				mlb.add('3/5', 'three_fifth');
				mlb.add('3/5 last', 'three_fifth_last');
				mlb.add('4/5', 'four_fifth');
				mlb.add('4/5 last', 'four_fifth_last');
				
				mlb.add('1/6', 'one_sixth');
				mlb.add('1/6 last', 'one_sixth_last');
				mlb.add('5/6', 'five_sixth');
				mlb.add('5/6 last', 'five_sixth_last');
				
				mlb.add('2 columns', '2_columns');
				mlb.add('3 columns', '3_columns');
				mlb.add('4 columns', '4_columns');
				mlb.add('5 columns', '5_columns');
				mlb.add('6 columns', '6_columns');
				
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
				longname : '<?php _e("Columns","framework") ?>'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('ColumnsSelector', tinymce.plugins.ColumnsSelector);
})();