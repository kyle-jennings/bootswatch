<?php

/**
 * Enqueue scripts and styles.
 */
function bootswatches_admin_assets() {

    $dir = get_template_directory_uri() . '/assets/admin/';
    // the following style and script files are minified, however non minified
    // versions are incuded with this theme
    wp_enqueue_style( 'admin-style',
        $dir. 'css/bootswatches-admin.min.css' );

    wp_enqueue_script( 'admin-scripts',
        $dir. 'js/_bootswatches-admin-min.js',
        array('jquery'), '20170215', true
    );

    $ajax_object = array('ajax_url' => admin_url('admin-ajax.php'));
    wp_localize_script('admin-scripts', 'ajax_object', $ajax_object);
}
add_action( 'admin_enqueue_scripts', 'bootswatches_admin_assets' );
