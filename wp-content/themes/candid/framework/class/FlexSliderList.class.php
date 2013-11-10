<?php
/**
 * FlexSlider List
 * 
 * @package framework
 * @since framework 1.0
 */
class FlexSliderList extends WP_List_Table
{
	/**
	* Construct
	* @return void
	*/
	public function __construct()
	{
		//Set parent defaults
        parent::__construct( array(
            'singular'  => __('Slider','framework'),
            'plural'    => __('Sliders','framework'),
            'ajax'      => false
        ) );
	}
	
	/**
	* run
	* @return void
	*/
	public function run()
	{
		$this -> prepare_items();
	?>
		<div class="wrap">
			<h2><?php _e('Sliders','framework');?> <a href="admin.php?page=flexslider&action=new" class="add-new-h2"><?php _e('Add Slider','framework'); ?></a></h2>
			<?php FlexSliderInit::displayMessage(); ?>
			<form method="get" id="slides-list">
				<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
				<?php $this -> display(); ?>
			</form>
		</div>
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
	* Prepare column name
	*/
	public function column_default($item,$column_name)
	{
		return $item -> $column_name;
	}
	
	/**
	* Prepare column checkbox
	*/
	public function column_cb($item)
	{
		return sprintf(
				'<input type="checkbox" name="%1$s[]" value="%2$s" />',
				/*$1%s*/ 'slider',
				/*$2%s*/ $item -> slider_id
			);
	}
	
	/**
	* Prepare column actions
	*/
	public function column_actions($item)
	{
		return sprintf(
				'<a href="admin.php?page=flexslider&action=edit&id=%1$s">'.__('Edit','framework').'</a> | <a class="remove" href="admin.php?page=flexslider&action=remove&id=%1$s">'.__('Remove','framework').'</a>',
				/*$1%s*/ $item -> slider_id,
				/*$2%s*/ $item -> slider_id
			);
	}
	
	/**
	* Get columns definition
	* @return array columns array
	*/
	public function get_columns()
	{
        $columns = array(
//            'cb'     => '<input type="checkbox" />',
            'name'     => __('Name','framework'),
			'actions' => __('Actions','framework')
        );
        return $columns;
    }
	
	/**
	* Get sort columns definition
	* @return array sortable columns array
	*/
	public function get_sortable_columns()
	{
        $sortable_columns = array();
        return $sortable_columns;
    }
	
	/**
	* Prepare all required to generate table
	* @return void
	*/
	public function prepare_items() {
        
		$per_page = 30;
        
		//ustawianie kolumn
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns(); //nie mam
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        $current_page = $this->get_pagenum();
		$data = $this -> getData($per_page,$current_page);
        $total_items = $this -> getCountData();
        $this->items = $data;
        
        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }
	
	/**
	* Get List Query
	*
	* @param $per_page int records per page
	* @param $offset int current offset
	*/
	protected function _getListQuery($per_page,$offset)
	{
		global $wpdb;
		
		return '
			SELECT
				S.*
			FROM
				'.$wpdb -> prefix.'fs_sliders S
			ORDER BY
				name
			LIMIT
				'.$offset.','.$per_page;
	}
	
	/**
	* Get Count Query
	* @return string query
	*/
	protected function _getCountQuery()
	{
		global $wpdb;
	
		return '
			SELECT
				COUNT(*) AS rows
			FROM
				'.$wpdb -> prefix.'fs_sliders';
	}
	
	/**
	* Read data from db
	*
	* @param $per_page int records per page
	* @param $current_page int current offset
	* @return array 
	*/
	public function getData($per_page,$current_page)
	{
		global $wpdb;
		
		$offset = ($current_page - 1) * $per_page;
		
		$sQuery = $this -> _getListQuery($per_page,$offset);
		
		$oData = $wpdb -> get_results($sQuery);
		$aResults = array();
		foreach ( $oData as $iRow => $oRow ) 
		{
			$aResults[$iRow] = $oRow;
		}
		return $aResults;	
	}
	
	/**
	* Get count data
	*
	* @return int rows in table
	*/
	public function getCountData()
	{
		global $wpdb;
		$oData = $wpdb -> get_row($this -> _getCountQuery());
		return $oData -> rows;
	}
}