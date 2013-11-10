<?php
/**
 * FlexSlider
 * 
 * @package framework
 * @since framework 1.0
 */
class FlexSliderInit
{
	function __construct()
	{
		global $wpdb;
	}
	
	/**
	* Init
	* @return void
	*/
	public function init()
	{
		//save form
		if ((isset($_GET['action']) && $_GET['action'] == 'remove') || ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['flexslider']) && $_POST['flexslider'] == 1))
		{
			$this -> initSave();
		}
		add_action('admin_enqueue_scripts', array($this,'loadScripts') );
		add_action('admin_menu', array($this,'registerMenu'));
	}
	
	/**
	* Load scriptss
	* @return void
	*/
	public function loadScripts()
	{
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
		
		wp_enqueue_style('thickbox');
	}
	
	/**
	* Register menu
	* @return void
	*/
	public function registerMenu()
	{
		add_menu_page(__('FlexSlider','framework'), __('FlexSlider','tp'), 'add_users', 'flexslider', array($this,'initFlexSlider'),   false, 104);
	}
	
	/**
	* Init treatments
	*
	*/
	public function initFlexSlider()
	{
		if ($this -> _checkIfForm())
		{
			require_once 'FlexSliderSlider.class.php';
			require_once 'FlexSliderSlide.class.php';
			require_once 'FlexSliderForm.class.php';
			$oFlexSliderForm = new FlexSliderForm();
			$oFlexSliderForm -> run();
		}
		else
		{
			require_once 'FlexSliderList.class.php';
			$oFlexSliderList = new FlexSliderList();
			$oFlexSliderList -> run();
		}
	}
	
	/**
	* Init treatments
	*
	*/
	public function initSave()
	{
		require_once 'FlexSliderSlider.class.php';
		require_once 'FlexSliderSlide.class.php';
		require_once 'FlexSliderForm.class.php';
		$oFlexSliderForm = new FlexSliderForm;
		$oFlexSliderForm -> save();
	}
	
	/**
	* Check if form view
	* @return bool
	*/
	protected function _checkIfForm()
	{
		if (isset($_GET['action']) && in_array($_GET['action'],array('new','edit','remove')))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Display message, depends on get variable
	 * @return void
	 */
	static public function displayMessage()
	{
		if (!isset($_GET['message']))
		{
			return false;
		}
		
		$sClass = 'updated';
		if (strstr($_GET['message'],'error'))
		{
			$sClass = 'error';
		}
		
		switch ($_GET['message'])
		{
			case 'saved': $sMessage = __('Saved successfully','framework'); break;
			case 'removed': $sMessage = __('Removed successfully','framework'); break;
			case 'error': $sMessage = __('Error! Request cancelled','framework'); break;
		}
		?>
		<div id="message" class="message <?php echo $sClass?>"><p><strong><?php echo $sMessage; ?></strong></p></div>
		<?php
	}
}

?>
