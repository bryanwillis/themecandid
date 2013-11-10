<?php
/**
 * FlexSlider Slide
 *
 * @package framework
 * @since framework 1.0
 */
class FlexSliderSlide
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
					'.$wpdb -> prefix.'fs_slides G
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
	 * Get all slides for slider
	 * @param int $iSliderId
	 * @return array/bool
	 */
	public function getSliderSlides($iSliderId)
	{
		global $wpdb;
		
		$aSlides = $wpdb->get_results($wpdb -> prepare('
			SELECT
				*
			FROM
				'.$wpdb -> prefix.'fs_slides
			WHERE
				slider_id= %d
			ORDER BY
				show_order',
			$iSliderId
			));
		
		if ($aSlides !== false && count($aSlides) > 0)
		{
			return $aSlides;
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
			$wpdb -> prefix.'fs_slides',
			array(
				'image' => $aValues['image']
			),
			array( 
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
				'image' => $aValues['image']
			), 
			array( 'slide_id' => $this -> _iId ), 
			array( 
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
					'.$wpdb -> prefix.'tp_treatment_groups
				WHERE
					treatment_group_id = %d',
				$this -> _iId
			)
		);
		if ($mStatus !== 0 && $mStatus !== false)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Get next not used id
	 * @return int
	 */
	public function getNextId()
	{
		global $wpdb;
		
		$max = $wpdb->get_var('
			SELECT
				MAX(slide_id)
			FROM
				'.$wpdb -> prefix.'fs_slides
			');
		
		if ($max != null && $max !== false)
		{
			return $max + 1;
		}
		return 1;
	}
	
	/**
	 * Save slides, insert when new and update existing
	 * @param int $iSlideId
	 * @param int $iSliderId
	 * @param string $sImage
	 * @param int $iShowOrder
	 * @return void
	 */
	public function save($iSlideId,$iSliderId,$sImage,$iShowOrder)
	{
		global $wpdb;
		
		$mStatus = $wpdb->query( 
			$q=$wpdb->prepare('
				INSERT IGNORE
					'.$wpdb -> prefix.'fs_slides
					(slide_id,slider_id,image,show_order,update_status)
				VALUES(
					%d,
					%d,
					%s,
					%d,
					1
				)
				ON DUPLICATE KEY UPDATE
					image = %s,
					show_order = %d,
					update_status = 1
				',
				$iSlideId,
				$iSliderId,
				$sImage,
				$iShowOrder,
				$sImage,
				$iShowOrder
			)
		);
		
		if ($mStatus !== 0 && $mStatus !== false)
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Set all dates update status to 0
	 * @return void
	 */
	public function setStatusAsNotUpdated($iSliderId)
	{
		global $wpdb;
		$mStatus = $wpdb->update( 
			$wpdb -> prefix.'fs_slides',
			array( 
				'update_status' => 0
			), 
			array( 'slider_id' => $iSliderId ), 
			array( 
				'%d'
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
	 * Delete not updated
	 * @return void
	 */
	public function deleteNotUpdated($iSliderId)
	{
		global $wpdb;
		
		$mStatus = $wpdb->query( 
			$wpdb->prepare('
				DELETE FROM
					'.$wpdb -> prefix.'fs_slides
				WHERE
					slider_id = %d AND
					update_status = 0',
				$iSliderId
			)
		);
		return true;
	}
}