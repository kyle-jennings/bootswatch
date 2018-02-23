<?php


function bootswatch_select_colorscheme($wp_customize) {

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

    $default = get_template_directory_uri() . '/assets/frontend/css/bootstrap/bootstrap.min.css';

    // color scheme
    $wp_customize->add_setting(
        'color_scheme_setting',
        array(
            'default' => $default,
            'sanitize_callback' => 'bootswatch_color_scheme_sanitize',
            'validate_callback' => 'bootswatch_color_scheme_validate',
        )
    );


    $themes = bootswatch_get_scheme_css();
    
    $themes = apply_filters('bootswatch_filter_themes', $themes);

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

add_action('customize_register', 'bootswatch_select_colorscheme');
