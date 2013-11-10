<?php
/**
 * Shortcode Title: Quotes
 * Shortcode: quotes
 * Usage: [quotes style="modern" author="John Doe"]Your text here...[/quotes] [quotes style="classic" align="" author="John Doe"]Your text here...[/quotes]
 */
add_shortcode('quotes', 'quotes_func');

function quotes_func( $atts, $content = null ) {

  extract(shortcode_atts(array(
    "author" => '',
    "style" => 'classic',
    "align" => 'center',
    ),
  $atts));

  switch ($align)
  {
    case 'left':
    case 'right':
      //do nothing
      break;
    default:
      $align = 'center';
  }
  $modern = 'blockquote-classic';
  if ($style == 'modern')
  {
    $modern = 'blockquote-modern';
  }

  $html = "
    <div class='blockquote-container-".$align."'>
      <div class='blockquote ".$modern."'>
        <p>".$content."</p>
        ".(!empty($author) ? '<span>'.$author.'</span><div class="clear"></div>' : '')."
      </div>
    </div>";

  return $html;
}