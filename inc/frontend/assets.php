<?php
use bootswatch\builder;

/**
 * Enqueue scripts and styles.
 */
function bootswatch_scripts() {

    if(is_admin())
        return;


    $theme = get_theme_mod('color_scheme_setting');
    $BootSwatch = new \bootswatch\BootSwatch( $theme );
    $BootSwatch->doesCSSExist();
    $uri = $BootSwatch->getCSS('uri');

	wp_enqueue_script(
        'bootswatch-js', get_stylesheet_directory_uri() . '/assets/js/bootswatch.js',
         array('jquery'), null, true
    );

    wp_enqueue_style( 'bootswatch', $uri );

     // comment script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    wp_localize_script(
        'bootswatch-js',
        'ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );

}
add_action( 'wp_enqueue_scripts', 'bootswatch_scripts' );
