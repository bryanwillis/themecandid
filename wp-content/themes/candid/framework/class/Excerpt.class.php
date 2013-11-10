<?php
/**
 * Exerpt length
 * 
 * @package framework
 * @since framework 1.0
 */

class ts_Excerpt {

  // Default length (by WordPress)
  public static $length = 55;

  public static $types = array(
      'tiny' => TINY_EXCERPT,
      'short' => SHORT_EXCERPT,
      'regular' => REGULAR_EXCERPT,
      'long' => LONG_EXCERPT
    );

  /**
   * Sets the length for the excerpt,
   *
   * @param string $new_length 
   * @return void
   */
  public static function length($new_length = 55) {
    ts_Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'ts_Excerpt::new_length');

    ts_Excerpt::output();
  }
  
  /**
   * Sets the length for the excerpt 
   *
   * @param string $new_length 
   * @return void
   */
  public static function get_by_length($new_length = 55) {
    ts_Excerpt::$length = $new_length;

    add_filter('excerpt_length', 'ts_Excerpt::new_length');

    return ts_Excerpt::get();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(ts_Excerpt::$types[ts_Excerpt::$length]) )
      return ts_Excerpt::$types[ts_Excerpt::$length];
    else
      return ts_Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
    the_excerpt();
  }
  
  // Echoes out the excerpt
  public static function get() {
    return get_the_excerpt();
  }
}