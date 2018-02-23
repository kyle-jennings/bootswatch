<?php


/**
 * Enqueue scripts and styles.
 */
function bootswatches_scripts() {

    if(is_admin())
        return;

    $default = get_template_directory_uri() . '/assets/frontend/css/bootstrap/bootstrap.css';

    $theme = get_theme_mod('color_scheme_setting', $default);
    
	wp_enqueue_script(
        'bootswatches-js', get_template_directory_uri() . '/assets/frontend/js/bootswatches.js',
         array('jquery'), null, true
    );

    wp_enqueue_style( 'bootswatches', $theme );

     // comment script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    wp_localize_script(
        'bootswatches-js',
        'ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );

}
add_action( 'wp_enqueue_scripts', 'bootswatches_scripts' );
