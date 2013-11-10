<?php
/**
 * Flexslider
 *
 * @package framework
 * @since framework 1.0
 */

if ( is_admin())
{
   require_once 'class/FlexSliderInit.class.php';
   $oFlexSlider = new FlexSliderInit;
   $oFlexSlider -> init();
}