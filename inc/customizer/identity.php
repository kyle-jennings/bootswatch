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


    $classic = array('#0c555d', '#399099', '#ff5049', '#ffffff', '#f5f5f5', '#000000');
    $standard = array('#112e51', '#02bfe7','#e31c3d', '#ffffff', '#f1f1f1', '#d6d7d9');


    // removing red color scheme for now
    $choices = array(
        'standard' => array(
            'uri' => BOOTSWATCHES_FRONTEND_ASSETS_DIR . 'css/bootswatches.min.css',
            'colors' => array('#112e51', '#02bfe7','#e31c3d', '#ffffff', '#f1f1f1', '#d6d7d9')
        ),
        'classic' => array(
            'uri' => BOOTSWATCHES_FRONTEND_ASSETS_DIR . 'css/bootswatches-classic.min.css',
            'colors' => array('#0c555d', '#399099', '#ff5049', '#ffffff', '#f5f5f5', '#000000')

        )
    );
    $choices = apply_filters('bootswatches_filter_color_schemes', $choices);


    // color scheme
    $wp_customize->add_setting( 'color_scheme_setting', array(
        'default' => $choices['standard']['uri'],
        'sanitize_callback' => 'bootswatches_color_scheme_sanitize',
        )
    );

    $description = 'Bootswatches comes with ' . count($choices) . ' color schemes, like color swatches.';
    $wp_customize->add_control( new Bootswatches_Color_Scheme_Custom_Control(
        $wp_customize, 'color_scheme_control', array(
            'description' => $description,
            'label'   => __('Color Scheme', 'bootswatches'),
            'section' => 'title_tagline',
            'settings' => 'color_scheme_setting',
            'choices' => $choices
            )
        )
    );


}
add_action('customize_register', 'bootswatches_site_identity');
