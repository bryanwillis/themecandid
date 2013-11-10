<?php
/**
 * FlexSliderForm
 *
 * @package framework
 * @since framework 1.0
 */
class FlexSliderForm
{
	/**
	 * Current Action (add,edit,remove)
	 * @var string
	 */
	protected $_sAction = 'add';
	
	/**
	 * Current element id, 0 if new
	 * @var int
	 */
	protected $_iId = 0;
	
	/**
	 * Parent element id, 0 if not exists
	 * @var int
	 */
	protected $_iParentId = 0;

	/**
	 * Record read from db
	 * @var object
	 */
	protected $_oRecord;
	
	/**
	 * Redirect array, contain redirect variables and its values
	 * @var array
	 */
	protected $_aRedirect = array();
	
	/**
	 * String added to cancel url
	 * @var string
	 */
	protected $_sAddToCancel = '';
	
	/**
	 * Show delete button?
	 * @var bool
	 */
	protected $_bDelete = true;
	
	/**
	* Construct
	* @return void
	*/
	public function __construct()
	{
		if (isset($_GET['action']))
		{
			$this -> _sAction = $_GET['action'];
		}
		
		if (!in_array($this -> _sAction,array('add','edit','remove')))
		{
			$this -> _sAction = 'add';
		}
		
		if (isset($_GET['id']))
		{
			$this -> _iId = $_GET['id'];
		}
		
		if (isset($_GET['parent_id']))
		{
			$this -> _iParentId = $_GET['parent_id'];
		}
	}
	
	/**
	* run
	* @return void
	*/
	public function run()
	{
		//check if can load form
		if ($this -> checkIfCanLoad() !== true)
		{
			return false;
		}
		if ($this -> _iId == 0)
		{
			$this -> _oRecord = new stdClass;
			$this -> _oRecord -> animation = null;
			$this -> _oRecord -> name = null;
			$this -> _oRecord -> direction = null;
			$this -> _oRecord -> slideshow_speed = null;
			$this -> _oRecord -> animation_speed = null;
			$this -> _oRecord -> reverse = null;
			$this -> _oRecord -> randomize = null;
			$this -> _oRecord -> control_nav = null;
			$this -> _oRecord -> direction_nav = null;
			$this -> _oRecord -> background = null;
		}
		else
		{
			$this -> _oRecord = $this -> _getRecord();
			
		}
		
		?>
		<div class="wrap">
			<h2><?php 
			if ($this -> _iId == 0):
				_e('Add Slider','framework');
			else:
				_e('Edit Slider','framework');
			endif;
			?> <a href="admin.php?page=flexslider" class="add-new-h2"><?php _e('Back to the list','framework')?></a></h2>
			<?php FlexSliderInit::displayMessage(); ?>
			<form id="slider" action="<?php echo $_SERVER['REQUEST_URI']?>" method="post" class="wrap">
				<input type="hidden" name="flexslider" value="1">
				<input type="hidden" name="page" value="<?php echo $_GET['page'];?>">
				<input type="hidden" name="posted" value="1">
				<div id="poststuff">
					<div id="post-body" class="metabox-holder columns-2">
						<div id="postbox-container-1" class="postbox-container">
							<?php $this -> displayColumn1(); ?>
						</div>
						<div id="postbox-container-2" class="postbox-container">
							<?php $this -> displayColumn2(); ?>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?php
	}
	
	/**
	* Display form content column 1
	* @return void
	*/
	public function displayColumn1()
	{
		?>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				
				jQuery(".remove").click(function() {
					
					if (confirm("<?php _e('You are about to permanently delete the selected items.\n\'Cancel\' to stop, \'OK\' to delete.','framework');?>"))
					{
						return true;
					}
					return false;
				});
			});
		</script>
		<?php
	}
	
	/**
	* Check if can load form
	* @return void
	*/
	public function checkIfCanLoad()
	{
		return true;
	}
	
	/**
	 * Display column 2
	 * @return void
	 */
	public function displayColumn2()
	{
		$oFlexSliderSlide = new FlexSliderSlide;
		$iNextId = $oFlexSliderSlide -> getNextId();
		if (empty($iNextId))
		{
			$iNextId = 1;
		}
		
		if ($this -> _iId > 0)
		{
			$oFlexSliderSlide = new FlexSliderSlide;
			$aSlides = $oFlexSliderSlide ->getSliderSlides($this -> _iId);
		}
		
		?>
		<div id="advanced-sortables" class="meta-box-sortables ui-sortable">
			<div id="smashing-post-class" class="postbox ">
				<div class="handlediv" title="<?php _e('Click to toggle','framework');?>"><br></div>
				<h3 class="hndle"><span><?php _e('Slider','framework'); ?></span></h3>
				<div class="inside" id="slidersettings">
					<div class="left">
						<p>
							<label for="smashing-post-class"><?php _e('Name','framework');?></label><br>
							<input type="text" name="name" id="name" size="30" class="required" value="<?php echo stripslashes($this -> _oRecord -> name);?>">
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Animation','framework');?></label><br>
							<select name="animation" id="animation">
								<option value="slide" <?php echo ($this -> _oRecord -> animation == 'slide' ? 'selected' : '');?>><?php _e('slide','framework');?></option>
								<option value="fade" <?php echo ($this -> _oRecord -> animation == 'fade' ? 'selected' : '');?>><?php _e('fade','framework');?></option>
							</select>
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Direction','framework');?></label><br>
							<select name="direction" id="direction">
								<option value="horizontal" <?php echo ($this -> _oRecord -> direction == 'horizontal' ? 'selected' : '');?>><?php _e('horizontal','framework');?></option>
								<option value="vertical" <?php echo ($this -> _oRecord -> direction == 'vertical' ? 'selected' : '');?>><?php _e('vertical','framework');?></option>
							</select>
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Slideshow speed (ms)','framework');?></label><br>
							<input type="text" name="slideshow_speed" id="slideshow_speed" size="30" class="required" value="<?php echo (empty($this -> _oRecord -> slideshow_speed) ? '7000': stripslashes($this -> _oRecord -> slideshow_speed));?>">
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Animation speed (ms)','framework');?></label><br>
							<input type="text" name="animation_speed" id="animation_speed" size="30" class="required" value="<?php echo (empty($this -> _oRecord -> animation_speed) ? '600': stripslashes($this -> _oRecord -> animation_speed));?>">
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Background','framework');?></label><br>
							<input type="hidden" name="background" value="0">
							<input type="text" size="40" id="background" type="text" name="background" value="<?php echo $this -> _oRecord -> background; ?>">
							<a class="button" id="upload_background" href="javascript:void(0);"><?php _e('Upload','framework')?></a>
						</p>
					</div>
					<div class="left">
						<p>
							<label for="smashing-post-class"><?php _e('Reverse','framework');?></label><br>
							<select name="reverse" id="reverse">
								<option value="1" <?php echo ($this -> _oRecord -> reverse == 1 ? 'selected' : '');?>><?php _e('yes','framework');?></option>
								<option value="0" <?php echo ($this -> _oRecord -> reverse != 1 ? 'selected' : '');?>><?php _e('no','framework');?></option>
							</select>
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Randomize','framework');?></label><br>
							<select name="randomize" id="randomize">
								<option value="1" <?php echo ($this -> _oRecord -> randomize == 1 ? 'selected' : '');?>><?php _e('yes','framework');?></option>
								<option value="0" <?php echo ($this -> _oRecord -> randomize != 1 ? 'selected' : '');?>><?php _e('no','framework');?></option>
							</select>
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Control Navigation','framework');?></label><br>
							<select name="control_nav" id="control_nav">
								<option value="1" <?php echo ($this -> _oRecord -> control_nav != 0 ? 'selected' : '');?>><?php _e('yes','framework');?></option>
								<option value="0" <?php echo ($this -> _oRecord -> control_nav == 0 ? 'selected' : '');?>><?php _e('no','framework');?></option>
							</select>
						</p>
						<p>
							<label for="smashing-post-class"><?php _e('Direction Navigation','framework');?></label><br>
							<select name="direction_nav" id="direction_nav">
								<option value="1" <?php echo ($this -> _oRecord -> direction_nav != 0 ? 'selected' : '');?>><?php _e('yes','framework');?></option>
								<option value="0" <?php echo ($this -> _oRecord -> direction_nav == 0 ? 'selected' : '');?>><?php _e('no','framework');?></option>
							</select>
						</p>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			
			<div id="smashing-post-class" class="postbox">
				<div class="handlediv" title="<?php _e('Click to toggle','framework');?>"><br></div>
				<h3 class="hndle"><span><?php _e('Slides','framework'); ?></span></h3>
				<div class="inside slide-fields">
					<ul id="slides">
						<?php if (isset($aSlides) && is_array($aSlides)):?>
						<?php foreach ($aSlides as $oSlide):?>
							<li class="slide">
								<p>
									<div class="left">
										<input type="hidden" name="new[<?php echo $oSlide -> slide_id; ?>]" value="0">
										<input type="text" size="30" id="slide_<?php echo $oSlide -> slide_id; ?>" type="text" name="image[<?php echo $oSlide -> slide_id; ?>]" value="<?php echo stripslashes($oSlide -> image); ?>" class="required">
										<a class="button" id="upload_<?php echo $oSlide -> slide_id; ?>" href="javascript:void(0);"><?php _e('Upload','framework')?></a>
									</div>
									<div class="right"><a class="button removeslide" href="#"><?php _e('Remove','framework');?></a></div>
									<div class="clear"></div>
									<script>
										jQuery('#upload_<?php echo $oSlide -> slide_id; ?>').click(function() {
											uploadID = jQuery(this).prev('input');
											formfield = jQuery('#image_<?php echo $oSlide -> slide_id; ?>').attr('name');
											tb_show('', 'media-upload.php?type=image&TB_iframe=true');
											return false;
										});
									</script>
								</p>
							</li>
						<?php endforeach;?>
						<?php endif;?>
					</ul>
					<div class="left"><a id="add_slide" class="button" href="#"><?php _e('Add','framework');?></a></div>
					<div class="right"><?php _e('Change Order by Drag & Drop','framework');?></div>
					<div class="clear"></div>
				</div>
			</div>
		
			<div id="smashing-post-class" class="postbox ">
				<div class="handlediv" title="<?php _e('Click to toggle','framework');?>"><br></div>
				<h3 class="hndle"><span><?php _e('Publish','framework'); ?></span></h3>
				<div class="inside">
					<p>
						<?php if ($this -> _iId != 0 && $this -> _bDelete === true): ?>
							<div id="slider-delete-action">
								<a class="delete button remove" href="admin.php?page=<?php echo $_GET['page'];?>&action=remove&id=<?php echo $this -> _iId;?>" tabindex="4"><?php _e('Delete','framework');?></a>
							</div>
						<?php endif; ?>
						<input type="submit" name="save" id="save" class="button-primary" value="<?php _e('Save Slider','framework');?>" tabindex="5" accesskey="p">
						
						<div class="clear"></div>
					</p>
				</div>
			</div>
			
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				
				//validate form
//				jQuery("#slider").validate({
//					
//					errorPlacement: function(error, element) {
//						
//						error.insertAfter(element);
//					}
//				});
				
				jQuery('#upload_background').click(function() {
					uploadID = jQuery(this).prev('input'); /*grab the specific input*/
					formfield = jQuery('#background').attr('name');
					tb_show('', 'media-upload.php?type=image&TB_iframe=true');
					return false;
				});
				
				var slides_count = <?php echo $iNextId; ?>;
				var formelement = '';
				
				//add new field to the group
				jQuery("#add_slide").click(function() {
					
					html_content = '<li class="slide"><p>';
					html_content += '<div class="left">';
					html_content += '<input type="hidden" name="new[' + slides_count + ']" value="1">';
					html_content += '<input type="text" size="30" id="image_' + slides_count + '" type="text" name="image[' + slides_count + ']" class="required">';
					html_content += '<a class="button" id="upload_' + slides_count + '" href="javascript:void(0);"><?php _e('Upload','framework')?></a>';
					html_content += '</div>';
					html_content += '<div class="right"><a class="button removeslide" href="#"><?php _e('Remove','framework');?></a></div>';
					html_content += '<div class="clear"></div>';
					html_content += '</p></li>';
					
					jQuery(html_content).appendTo("#slides");
					
					jQuery('#upload_' + slides_count).click(function() {
						uploadID = jQuery(this).prev('input'); /*grab the specific input*/
						formfield = jQuery('#image_' + slides_count).attr('name');
						tb_show('', 'media-upload.php?type=image&TB_iframe=true');
						return false;
					});
					
					slides_count++;
					
					//remove slide - register event for newly created elements
					jQuery(".removeslide").click(function() {
						jQuery(this).closest('.slide').remove();
						
					});
					return false;
				});
				
				window.send_to_editor = function(html) {
					imgurl = jQuery('img',html).attr('src');
					uploadID.val(imgurl);
					tb_remove();
				}
				
				//remove slide
				jQuery(".removeslide").click(function() {
					jQuery(this).closest('.slide').remove();
					
				});
				
				/*drag and drop order*/	
				jQuery("#slides").sortable({
					'tolerance':'intersect',
					'cursor':'pointer',
					'items':'li',
					'placeholder':'placeholder',
					stop: function(e, ui) {

					}
				});
				//jQuery("#slides").disableSelection();
			});
		</script>
		<?php
	}
	
	/**
	* Save
	* @return void
	*/
	public function save()
	{
		$this -> _aRedirect['page'] = 'flexslider';
		$this -> _aRedirect['action'] = $this -> _sAction;
		$this -> _aRedirect['id'] = $this -> _iId;
		
		switch ($this -> _sAction)
		{
			case 'add':
				$this -> _insert();
				break;
			case 'edit':
				$this -> _update();
				break;
			case 'remove':
				$this -> _delete();
				break;
		}
		
		$aRedirect = array();
		foreach ($this -> _aRedirect as $key => $val)
		{
			if ($this -> _aRedirect[$key] !== false)
			{
				$aRedirect[$key] = $key.'='.$this -> _aRedirect[$key];
			}
		}
		header("Location: ".get_admin_url().'admin.php?'.implode('&',$aRedirect));
		die();
	}
	
	/**
	* Get record from database
	* @return object
	*/
	protected function _getRecord()
	{
		$oFlexSliderSlider = new FlexSliderSlider($this -> _iId);
		return $oFlexSliderSlider -> get();
	}
	
	/**
	* Insert record to database
	* @return bool
	*/
	protected function _insert()
	{
		$oFlexSliderSlide = new FlexSliderSlider();
		$iInsertId = $oFlexSliderSlide -> insert($_POST);
		
		if ((int)$iInsertId > 0)
		{
			$this -> _iId = $iInsertId;
			$this -> _saveSlides($this -> _iId);
			
			$this -> _aRedirect['action'] = 'edit';
			$this -> _aRedirect['id'] = $this -> _iId;
			$this -> _aRedirect['message'] = 'saved';
		}
		else
		{
			$this -> _aRedirect['message'] = 'error';
		}
		return true;
	}
	
	/**
	* Update record in database
	* @return bool
	*/
	protected function _update()
	{
		$oFlexSliderSlide = new FlexSliderSlider($this -> _iId);
		$bStatus = $oFlexSliderSlide -> update($_POST);
		$this -> _saveSlides($this -> _iId);
		
		if ($bStatus === true)
		{
			$this -> _aRedirect['message'] = 'saved';
		}
		else
		{
			$this -> _aRedirect['message'] = 'error';
		}
		return true;
	}
	
	/**
	* Remove record in database
	* @return bool
	*/
	protected function _delete()
	{
		$oFlexSliderSlider = new FlexSliderSlider($this -> _iId);
		$mStatus = $oFlexSliderSlider -> delete();
		//$this -> _removeSlides($this -> _iId);
		$this -> _aRedirect['id'] = false;
		$this -> _aRedirect['action'] = false;
			
		if (is_string($mStatus))
		{
			$this -> _aRedirect['message'] = $mStatus;
		}
		else if ($mStatus === true)
		{
			$this -> _aRedirect['message'] = 'removed';
		}
		else
		{
			$this -> _aRedirect['message'] = 'error';
		}
		return true;
	}
	
	/**
	 * Update record to database
	 * @return bool
	 */
	protected function _saveSlides()
	{
		//saving all dates
		//1. set all existing update_status=0
		//2. insert new and update existing (all new and have update_status=1)
		//3. delete all not updated where update_status=0
		$oFlexSliderSlide = new FlexSliderSlide();
		$oFlexSliderSlide -> setStatusAsNotUpdated($this -> _iId);
		$i = 0;
		$iNextParentId = 0;
		
		if (is_array($_POST['image']))
		{
			foreach ($_POST['image'] as $iKey => $sVal)
			{
				$bStatus = $oFlexSliderSlide -> save($iKey,$this -> _iId,$sVal,$i);
				
				$i++;
			}
		}
		
		$oFlexSliderSlide -> deleteNotUpdated($this -> _iId);
		return true;
	}
}