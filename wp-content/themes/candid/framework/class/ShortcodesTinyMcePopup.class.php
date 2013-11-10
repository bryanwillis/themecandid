<?php
/**
 * Shortcodes TinyMCE popup
 * 
 * @package framework
 * @since framework 1.0
 */

class ShortcodesTinyMcePopup
{
	/**
	 * Shortcodes list
	 * @var array
	 */
	protected $_aShortcodes = array();
	
	/**
	 * Current shortcode
	 * @var array
	 */
	protected $_sShortcode = '';
	
	/**
	 * Construct
	 * @param string $sShortcode
	 * @return void
	 */
	public function __construct($sShortcode)
	{
		$this -> _aShortcodes = ts_get_shortcodes_list();
		$this -> _sShortcode = $sShortcode;
	}

	/**
	 * Display codes
	 * @return bool
	 */
	public function display()
	{
		//show error if no shortcode or array of shortcodes is empty
		if (!empty($sShortode) || !is_array($this -> _aShortcodes))
		{
			$this -> _showError();
			return false;
		}
		//search for current shortcode in the array of all available shortcodes
		$aCurrent = false;
		foreach ($this -> _aShortcodes as $aShortcode)
		{
			if ($aShortcode['shortcode'] == $this -> _sShortcode)
			{
				$aCurrent = $aShortcode;
				break;
			}
		}
		//show error if current shortcode was not found in the array
		if ($aCurrent === false)
		{
			$this -> _showError();
			return false;
		}
		
		$this -> _showCurrentShortcodeFields($aCurrent);
	}
	
	/**
	 * Show current shortcode
	 * @return void
	 */
	protected function _showCurrentShortcodeFields($aCurrent)
	{
		?>
		<input type="hidden" name="shortcode" value='<?php echo json_encode($aCurrent); ?>' />
		<?php
	}
	
	/**
	 * Show field
	 * @return void
	 */
	protected function _showField($sField,$aField)
	{
		
	}
	
	/**
	 * Show error on the screen
	 * @return void
	 */
	protected function _showError()
	{
		echo __('Error or invalid shortcode','framework');
	}
}