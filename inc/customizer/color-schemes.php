<?php


function bootswatches_select_colorscheme($wp_customize) {

    /**
     * Site Identity - these settings control some site branding
     * @param  [type] $wp_customize [description]
     * @return [type]               [description]
     */
    $wp_customize->add_section(
        'color_schemes',
        array(
            'title' => 'Color Themes',
            'priority' => 20,
        )
    );

    $themes = bootswatches_get_scheme_css();
    $themes = apply_filters('bootswatches_filter_themes', $themes);
    $default = reset($themes);
    $default = array(
        'uri' => $default->css_uri,
        'name' => $default->name
    );


    // color scheme
    $wp_customize->add_setting(
        'color_scheme_setting',
        array(
            'default' => json_encode($default),
            // 'sanitize_callback' => 'bootswatches_color_scheme_sanitize',
            // 'validate_callback' => 'bootswatches_color_scheme_validate',
        )
    );


    // examine($themes);
    $wp_customize->add_control(
        new ColorScheme(
            $wp_customize,
            'color_scheme_setting',
            array(
                'choices' => $themes,
                'description' => '',
                'label'   => 'Color Scheme',
                'section' => 'color_schemes',
                'settings' => 'color_scheme_setting',
                'transport' => 'postMessage'
            )
        )
    );

}

add_action('customize_register', 'bootswatches_select_colorscheme');
