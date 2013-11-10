<?php
/**
 * Shortcode Title: Column One Third
 * Shortcode: one_third
 * Usage: [one_third]....[/one_third]
 */
function ts_one_third( $atts, $content = null )
{
   return '<div class="theme-one-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'ts_one_third');

/**
 * Shortcode Title: Column One Third Last
 * Shortcode: one_third_last
 * Usage: [one_third_last]....[/one_third_last]
 */
function ts_one_third_last( $atts, $content = null )
{
   return '<div class="theme-one-third theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'ts_one_third_last');

/**
 * Shortcode Title: Column One Two Third
 * Shortcode: two_third
 * Usage: [two_third]....[/two_third]
 */
function ts_two_third( $atts, $content = null )
{
   return '<div class="theme-two-third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'ts_two_third');

/**
 * Shortcode Title: Column One Two Third Last
 * Shortcode: two_third_last
 * Usage: [two_third_last]....[/two_third_last]
 */
function ts_two_third_last( $atts, $content = null )
{
   return '<div class="theme-two-third theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 'ts_two_third_last');

/**
 * Shortcode Title: Column One Half
 * Shortcode: one_half
 * Usage: [one_half]....[/one_half]
 */
function ts_one_half( $atts, $content = null )
{
   return '<div class="theme-one-half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'ts_one_half');

/**
 * Shortcode Title: Column One Half Last
 * Shortcode: one_half_last
 * Usage: [one_half_last]....[/one_half_last]
 */
function ts_one_half_last( $atts, $content = null )
{
   return '<div class="theme-one-half theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'ts_one_half_last');

/**
 * Shortcode Title: Column One Fourth
 * Shortcode: one_fourth
 * Usage: [one_fourth]....[/one_fourth]
 */
function ts_one_fourth( $atts, $content = null )
{
   return '<div class="theme-one-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'ts_one_fourth');

/**
 * Shortcode Title: Column One Fourth Last
 * Shortcode: one_fourth_last
 * Usage: [one_fourth_last]....[/one_fourth_last]
 */
function ts_one_fourth_last( $atts, $content = null )
{
   return '<div class="theme-one-fourth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'ts_one_fourth_last');

/**
 * Shortcode Title: Column Threee Fourth
 * Shortcode: three_fourth
 * Usage: [three_fourth]....[/three_fourth]
 */
function ts_three_fourth( $atts, $content = null )
{
   return '<div class="theme-three-fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'ts_three_fourth');

/**
 * Shortcode Title: Column Three Fourth Last
 * Shortcode: three_fourth_last
 * Usage: [three_fourth_last]....[/three_fourth_last]
 */
function ts_three_fourth_last( $atts, $content = null )
{
   return '<div class="theme-three-fourth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 'ts_three_fourth_last');

/**
 * Shortcode Title: Column One Fifth
 * Shortcode: one_fifth
 * Usage: [one_fifth]....[/one_fifth]
 */
function ts_one_fifth( $atts, $content = null )
{
   return '<div class="theme-one-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'ts_one_fifth');

/**
 * Shortcode Title: Column One Fifth Last
 * Shortcode: one_fifth_last
 * Usage: [one_fifth_last]....[/one_fifth_last]
 */
function ts_one_fifth_last( $atts, $content = null )
{
   return '<div class="theme-one-fifth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'ts_one_fifth_last');

/**
 * Shortcode Title: Column Two Fifth
 * Shortcode: two_fifth
 * Usage: [two_fifth]....[/two_fifth]
 */
function ts_two_fifth( $atts, $content = null )
{
   return '<div class="theme-two-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'ts_two_fifth');

/**
 * Shortcode Title: Column Two Fifth Last
 * Shortcode: two_fifth_last
 * Usage: [two_fifth_last]....[/two_fifth_last]
 */
function ts_two_fifth_last( $atts, $content = null )
{
   return '<div class="theme-two-fifth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'ts_two_fifth_last');

/**
 * Shortcode Title: Column Three Fifth
 * Shortcode: three_fifth
 * Usage: [three_fifth]....[/three_fifth]
 */
function ts_three_fifth( $atts, $content = null )
{
   return '<div class="theme-three-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'ts_three_fifth');

/**
 * Shortcode Title: Column Three Fifth Last
 * Shortcode: three_fifth_last
 * Usage: [three_fifth_last]....[/three_fifth_last]
 */
function ts_three_fifth_last( $atts, $content = null )
{
   return '<div class="theme-three-fifth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'ts_three_fifth_last');

/**
 * Shortcode Title: Column Four Fifth
 * Shortcode: four_fifth
 * Usage: [four_fifth]....[/four_fifth]
 */
function ts_four_fifth( $atts, $content = null )
{
   return '<div class="theme-four-fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'ts_four_fifth');

/**
 * Shortcode Title: Column Four Fifth Last
 * Shortcode: four_fifth_last
 * Usage: [four_fifth_last]....[/four_fifth_last]
 */
function ts_four_fifth_last( $atts, $content = null )
{
   return '<div class="theme-four-fifth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'ts_four_fifth_last');

/**
 * Shortcode Title: Column One Sixth
 * Shortcode: one_sixth
 * Usage: [one_sixth]....[/one_sixth]
 */
function ts_one_sixth( $atts, $content = null )
{
   return '<div class="theme-one-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'ts_one_sixth');

/**
 * Shortcode Title: Column One Sixth Last
 * Shortcode: one_sixth_last
 * Usage: [one_sixth_last]....[/one_sixth_last]
 */
function ts_one_sixth_last( $atts, $content = null )
{
   return '<div class="theme-one-sixth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'ts_one_sixth_last');

/**
 * Shortcode Title: Column Five Sixth
 * Shortcode: five_sixth
 * Usage: [five_sixth]....[/five_sixth]
 */
function ts_five_sixth( $atts, $content = null )
{
   return '<div class="theme-five-sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'ts_five_sixth');

/**
 * Shortcode Title: Column Five Sixth
 * Shortcode: five_sixth_last
 * Usage: [five_sixth_last]....[/five_sixth_last]
 */
function ts_five_sixth_last( $atts, $content = null )
{
   return '<div class="theme-five-sixth theme-column-last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'ts_five_sixth_last');