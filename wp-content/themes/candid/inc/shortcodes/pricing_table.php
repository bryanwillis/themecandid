<?php

/* ---------------------------------------------------------------------- */
/*	Pricing Table
/* ---------------------------------------------------------------------- */
// Pricing table container
function ts_framework_pricing_table_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'column_count' => '4',
		'type'         => 'simple'
	), $atts) );
	// Reset everything
	$GLOBALS['pricing_column_count'] = 0;
	$GLOBALS['pricing_columns'] = null;
	$extended_features_list = null;
	$featured = null;
	$count = 0;
	do_shortcode( $content );
	if( is_array( $GLOBALS['pricing_columns'] ) ) {
		foreach( $GLOBALS['pricing_columns'] as $i => $pricing_column ) {
			// Remove any old data
			$features_list = null;
			$features = null;
			$data_feature = null;
			// Strip list items
			$features = preg_replace( array('%</?ul>%', '%</li>%') , '', $pricing_column['content'] );
			$features = explode('<li>', $features);
			// And create array
			foreach ( $features as $k => $feature ) {
				if( $k > 0 )
					$features_list[$i][] = trim( $feature );
			}
			// Remove any old data
			$features = '';
			// Loop through items
			foreach ( $features_list[$i] as $k => $feature ) {
				// Check if has tooltip and if does, apply it
				$data_tooltip = preg_match( '/\[tooltip\stext="/', $feature );
				if( $data_tooltip ) {
					
					$data_tooltip = ' data-tooltip="' . preg_replace( array('/\[tooltip\stext="/', '/"].+/'), '', $feature ) . '"';
					$feature = preg_replace( '/\[tooltip\stext=".+"]/', '', $feature );
				} else {
					$data_tooltip = '';
				}
				// If extended table's features list, save it for later use
				if( $pricing_column['type'] == 'features-list' && $type == 'extended' )
					$extended_features_list[] = trim( $feature );
				// If extended table's and normal column, apply feature to each fields
				if( $pricing_column['type'] != 'features-list' && $type == 'extended' )
					$data_feature = ' data-feature="' . $extended_features_list[$k] . '"';
				$features .= '<li' . $data_tooltip . $data_feature . '>' . $feature . '</li>';
			}
			// Create new column
			if( $pricing_column['special'] == 'featured' )
				$featured = 'featured';
			$pricing_columns[$i] = '<div class="column ' . $pricing_column['type'] . ' ' . $pricing_column['special'] . '">';
				if( $pricing_column['discount'] )
						$pricing_columns[$i] .= '<span class="discount">' . $pricing_column['discount'] . '</span>';
				
				$pricing_columns[$i] .= '<div class="header">';
					if( $pricing_column['title'] )
						$pricing_columns[$i] .= '<h2 class="title">' . $pricing_column['title'] . '</h2>';
					if( $pricing_column['price'] )
						$pricing_columns[$i] .= '<h3 class="price"><span class="price-value">' . htmlspecialchars_decode($pricing_column['price']) . '</span>' . '<span class="price-period">' . $pricing_column['period'] . '</span>' . '</h3>';
					if( $pricing_column['description'] && $type == 'simple' )
						$pricing_columns[$i] .= '<h5 class="description">' . $pricing_column['description'] . '</h5>';
				$pricing_columns[$i] .= '</div><!-- end .header -->';
				$pricing_columns[$i] .= '<ul class="features">' . do_shortcode( $features ) . '</ul><!-- end .features -->';
				if( $pricing_column['sign_up_title'] ) {
					$pricing_columns[$i] .= '<div class="footer">';
						$pricing_columns[$i] .= '<a class="button" href="' . $pricing_column['sign_up_url'] . '">' . $pricing_column['sign_up_title'] . '</a>';
					$pricing_columns[$i] .= '</div><!-- end .footer -->';
				}
			$pricing_columns[$i] .= '</div><!-- end .column -->';
		}
		$output = "\n". '<section class="' . esc_attr( $type ) . '-pricing-table col' . esc_attr( $column_count ) . ' ' . $featured . ' clearfix">' . implode( "\n", $pricing_columns ) . '</section><div class="clear"></div><!-- end pricing-table -->';
	}
	return $output;
}
add_shortcode('pricing_table', 'ts_framework_pricing_table_sc');

// Pricing table columns
function ts_framework_pricing_table_columns_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type'          => '',
		'title'         => '',
		'price'         => '',
		'discount'      => '',
		'period'        => '',
		'description'   => '',
		'sign_up_title' => '',
		'sign_up_url'   => '',
		'special'       => ''
	), $atts ) );
	$i = $GLOBALS['pricing_column_count'];

		$GLOBALS['pricing_columns'][$i] = array(
		'type'          => esc_attr( $type ),
		'title'         => esc_attr( $title ),
		'content'       => $content,
		'price'         => esc_attr( $price ),
		'discount'      => esc_attr( $discount ),
		'period'        => esc_attr( $period ),
		'description'   => esc_attr( $description ),
		'sign_up_title' => esc_attr( $sign_up_title ),
		'sign_up_url'   => esc_url( $sign_up_url ),
		'special'       => esc_attr( $special )
	);
	$GLOBALS['pricing_column_count']++;
}
add_shortcode('pricing_column', 'ts_framework_pricing_table_columns_sc') ;

// Pricing table check icon
function ts_framework_pricing_table_check_sc( $atts, $content = null ) {
	return '<span class="check">&check;</span>';
}

add_shortcode('check', 'ts_framework_pricing_table_check_sc');

// Pricing table uncheck icon
function ts_framework_pricing_table_uncheck_sc( $atts, $content = null ) {
	return '<span class="uncheck">&mdash;</span>';
}
add_shortcode('uncheck', 'ts_framework_pricing_table_uncheck_sc');