<?php
/*
Plugin Name: Ziteboard Online Whiteboard
Plugin URI: https://wordpress.org/plugins/ziteboard-online-whiteboard/
Description: Embed an infinite, zoomable whiteboard from Ziteboard (https://ziteboard.com) - an online whiteboard with real-time collaboration.
Version: 3.0.0
Author: Ziteboard <hello@ziteboard.com>
Author URI: https://ziteboard.com
License: GPLv3
License URI: https://ziteboard.com/faq/
*/

//function load_plugin_textdomain() {
//  load_plugin_textdomain( 'ziteboard-online-whiteboard', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
//}

function ziteboard_online_whiteboard_shortcode( $atts ) {
	$defaults = array(
		'src'         => 'https://view.ziteboard.com/shared/cUEJg5uORd2HxI5GjMi',
		'width'       => '600px',
		'height'      => '400px',
		'class'       => 'ziteboard-class',
		'style'       => '',
		'open'        => 'enable',
		'fullscreen'  => 'enable'
	);

	if ($atts['open'] == 'disable') {$atts['src'] = $atts['src'].'&openbutton=0';}
	if ($atts['fullscreen'] == 'disable') {$atts['src'] = $atts['src'].'&fullscreen=0';}

	foreach ( $defaults as $default => $value ) { // add defaults
		if ( ! @array_key_exists( $default, $atts ) ) {
			$atts[$default] = $value;
		}
	}

	$style = 'width:'.esc_attr($atts['width']).';height:'.esc_attr($atts['height']).';border:1px solid #ccc;'.esc_attr($atts['style']);

	$title = __( 'Ziteboard - zoomable, vector graphics whiteboard', 'ziteboard-online-whiteboard' );
	$html = "\n".'<!-- ziteboard plugin started -->'."\n";
	$html .= '<div onmouseover="document.body.style.overflow = \'hidden\';"  onmouseout="document.body.style.overflow = \'auto\';"  class="'.esc_attr($atts["class"]).'" style="'.esc_attr($style).'">'."\n";
	$html .= '<iframe frameborder="0" scrolling="no" seamless="seamless" allowfullscreen allow="camera; microphone" style="position:relative;width: 100%; height: 100%;top:-40px;"';
	$html .= ' src="'.esc_attr($atts['src']).'" name="ziteboard-online-whiteboard-wp-plugin"></iframe>'."\n";
	$html .= '</div>'."\n";
	$html .= '<!-- ziteboard plugin ended -->'."\n";
	return $html;
}
//add_action( 'plugins_loaded', 'load_plugin_textdomain' );
add_shortcode( 'ZITEBOARD', 'ziteboard_online_whiteboard_shortcode' );
