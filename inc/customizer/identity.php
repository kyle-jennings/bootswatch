<?php


/**
 * Site Identity - these settings control some site branding
 * @param  [type] $wp_customize [description]
 * @return [type]               [description]
 */
function bootswatches_site_identity($wp_customize) {


    $logo_desc = __('The logo appears in the navbar and must be toggled in the ', 'bootswatch');
    $logo_desc .= '<a href="' . esc_attr("javascript:wp.customize.control( 'navbar_brand_control' ).focus();") . '">';
    $logo_desc .= __('header settings section</a>.', 'bootswatch');

    $wp_customize->get_control( 'custom_logo' )->description = sprintf('%s',$logo_desc);


    $classic = array('#0c555d', '#399099', '#ff5049', '#ffffff', '#f5f5f5', '#000000');
    $standard = array('#112e51', '#02bfe7','#e31c3d', '#ffffff', '#f1f1f1', '#d6d7d9');
    $red = array('#912b27', '#ba1b16','#046b99', '#ffffff', '#f1f1f1', '#d6d7d9');



    // color scheme
    $wp_customize->add_setting( 'color_scheme_setting', array(
        'default' => 'standard',
        'sanitize_callback' => 'bootswatches_color_scheme_sanitize',
        )
    );

    // removing red color scheme for now
    // 'red' => $red,
    $description = 'Bootswatch currently comes with 3 premade color schemes, like color swatches.';
    $wp_customize->add_control( new Bootswatches_Color_Scheme_Custom_Control(
        $wp_customize, 'color_scheme_control', array(
            'description' => $description,
            'label'   => __('Color Scheme', 'bootswatch'),
            'section' => 'title_tagline',
            'settings' => 'color_scheme_setting',
            'choices' => array(
                        'standard' => $standard,
                        'classic' => $classic,
                    )
            )
        )
    );

    $wp_customize->add_setting( 'sidebar_size_setting', array(
        'default' => 'BOOTSWATCHES_ONE_THIRD',
        'sanitize_callback' => 'bootswatches_sidebar_width_sanitize',
        )
    );

    $wp_customize->add_control( 'sidebar_size_control', array(
            'label'   => 'Sizebar Size',
            'section' => 'title_tagline',
            'settings' => 'sidebar_size_setting',
            'type' => 'select',
            'choices' => array(
                        'BOOTSWATCHES_ONE_THIRD' => __('Wide', 'bootswatch'),
                        'BOOTSWATCHES_ONE_FOURTH' => __('Narrow', 'bootswatch'),
                    ),
        )
    );

}
add_action('customize_register', 'bootswatches_site_identity');
