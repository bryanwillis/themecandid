<?php
/**
 * FlexSlider Slider
 *
 * @package framework
 * @since framework 1.0
 */
class FlexSliderSlider
{
	/**
	* Construct
	* @return void
	*/
	public function __construct($iId = 0)
	{
		$this -> _iId = (int)$iId;
	}
	
	/**
	 * Get record from database
	 * @return obj/bool
	 */
	public function get()
	{
		global $wpdb;
		
		$row = $wpdb->get_row(
			$wpdb -> prepare('
				SELECT
					*
				FROM
					'.$wpdb -> prefix.'fs_sliders G
				WHERE
					slider_id = %d',$this -> _iId
			)
		);
		
		if ($row !== false)
		{
			return $row;
		}
		return false;
	}
	
	/**
	 * Insert record to database
	 * @return void
	 */
	public function insert($aValues)
	{
		global $wpdb;
		
		$bStatus = $wpdb -> insert(
			$wpdb -> prefix.'fs_sliders',
			array(
				'name' => $aValues['name'],
				'animation' => $aValues['animation'],
				'direction' => $aValues['direction'],
				'slideshow_speed' => $aValues['slideshow_speed'],
				'animation_speed' => $aValues['animation_speed'],
				'reverse' => $aValues['reverse'],
				'randomize' => $aValues['randomize'],
				'control_nav' => $aValues['control_nav'],
				'direction_nav' => $aValues['direction_nav'],
				'background' => $aValues['background']
			),
			array( 
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%d',
				'%s'
			)
		);
		if ($bStatus === false)
		{
			return false;
		}
		$this -> _iId = $wpdb -> insert_id;
		return $wpdb -> insert_id;
	}
	
	/**
	 * Update record
	 * @return void
	 */
	public function update($aValues)
	{
		global $wpdb;
	
		$mStatus = $wpdb->update( 
			$wpdb -> prefix.'fs_sliders',
			array(
				'name' => $aValues['name'],
				'animation' => $aValues['animation'],
				'direction' => $aValues['direction'],
				'slideshow_speed' => $aValues['slideshow_speed'],
				'animation_speed' => $aValues['animation_speed'],
				'reverse' => $aValues['reverse'],
				'randomize' => $aValues['randomize'],
				'control_nav' => $aValues['control_nav'],
				'direction_nav' => $aValues['direction_nav'],
				'background' => $aValues['background']
			),
			array( 'slider_id' => $this -> _iId ), 
			array( 
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%d',
				'%s'
			),
			array( '%d' ) 
		);
		if ($mStatus !== false)
		{
			return true;
		}
		return false;
	}
	/**
	 * Delete record
	 * @return void
	 */
	public function delete()
	{
		global $wpdb;
		
		$mStatus = $wpdb->query( 
			$wpdb->prepare('
				DELETE FROM
					'.$wpdb -> prefix.'fs_sliders
				WHERE
					slider_id = %d',
				$this -> _iId
			)
		);
		
		if ($mStatus !== 0 && $mStatus !== false)
		{
			return true;
		}
		return false;
	}
}