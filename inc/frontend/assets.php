<?php


/**
 * Enqueue scripts and styles.
 */
function bootswatch_scripts() {

    if(is_admin())
        return;


    $theme = get_theme_mod('color_scheme_setting');
    $file = get_template_directory() . '/assets/css/'.$theme.'/bootswatch.css';


    if( is_readable($file) )
        $uri = get_template_directory_uri() . '/assets/css/'.$theme.'/bootswatch.css';
    else
        $uri = get_template_directory_uri() . '/assets/bootstrap/bootswatch.css';


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
