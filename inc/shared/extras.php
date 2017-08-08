<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bootswatch
 */



/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function bootswatch_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bootswatch_pingback_header' );


add_filter('widget_text','do_shortcode');

// add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') );
$post_formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
$post_formats = new PostFormats( $post_formats, array('post', 'page') );
