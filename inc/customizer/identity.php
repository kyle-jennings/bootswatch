<?php


/**
 * Site Identity - these settings control some site branding
 * @param  [type] $wp_customize [description]
 * @return [type]               [description]
 */
function bootswatches_site_identity($wp_customize) {


    $logo_desc = __('The logo appears in the navbar and must be toggled in the ', 'bootswatches');
    $logo_desc .= '<a href="' . esc_attr("javascript:wp.customize.control( 'navbar_brand_control' ).focus();") . '">';
    $logo_desc .= __('header settings section</a>.', 'bootswatches');

    $wp_customize->get_control( 'custom_logo' )->description = sprintf('%s',$logo_desc);


}
add_action('customize_register', 'bootswatches_site_identity');
