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
function bootswatches_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'bootswatches_pingback_header' );

// do shortcodes inside of widgets
add_filter('widget_text','do_shortcode');


// lets add soem new image sizes
add_image_size('featured-image', '262', '262', true);
add_image_size('carousel-feed', '1066', '600', true);



$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
// add_theme_support( 'custom-header', $defaults );
