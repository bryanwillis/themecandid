<?php
/**
 * Shortcode Title: Message
 * Shortcode: message
 * Usage: [message type="info"]Your text here...[/quotes]
 */
add_shortcode('message', 'ts_message_func');

function ts_message_func( $atts, $content = null ) {
    
	extract(shortcode_atts(array(
		"type" => 'info'
		), 
	$atts));
	
	return "
		<div class='sc-message sc-message-".$type."'>
			<div>".$content."</div>
			<a class='close' href='#'>
				<i class='icon-remove'></i>
			</a>
		</div>";
}