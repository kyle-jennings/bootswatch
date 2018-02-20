<?php



function bootswatch_404_settings($wp_customize) {


    $template = bootswatch_get_template_info('_404');
    $section = '_404_content_section';

    // set up the section
    $section_args = array(
        'section' => $section,
        'title' => __('404 Page', 'bootswatch'),
        'description' => $template['description'],
    );
    bootswatch_customize_section( $wp_customize, $section_args );

    /**
     * This selects what we display in the page header area
     */
    
    // select the what to display in the header
    $wp_customize->add_setting( '_404_hero_content_setting', array(
        'default'  => 'title',
        'sanitize_callback' => 'bootswatch_404_hero_content_sanitize',
    ) );

    $wp_customize->add_control( '_404_hero_content_control', array(
            'description' => __('Select what to display in the header.','bootswatch'),
            'label'   => __('Header Content', 'bootswatch'),
            'section' => $section,
            'settings'=> '_404_hero_content_setting',
            'priority' => 1,
            'type' => 'select',
            'choices' => array(
                'page' => __('Select a Page', 'bootswatch'),
                'title' => __('Default title', 'bootswatch'),
            )
        )
    );


    $wp_customize->add_setting( '_404_header_page_content_setting', array(
        'default'        => 0,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( '_404_header_page_content_control', array(
            'description' => __('Select page content to the header, this is great when the header size is set to full and the other page parts are hidden.','bootswatch'),
            'label'   => __('Select header content from page', 'bootswatch'),
            'section' => $section,
            'settings'=> '_404_header_page_content_setting',
            'type' => 'select',
            'type'    => 'dropdown-pages',
            'priority' => 1,
         )
    );


    /**
     * This controls the page content
     */
    $wp_customize->add_setting( '_404_page_content_setting', array(
        'default'  => 'default',
        'sanitize_callback' => 'bootswatch_404_content_sanitize',
    ) );

    $wp_customize->add_control( '_404_page_content_control', array(
            'description' => __('Display some default content provided by the theme or select a page to display.','bootswatch'),
            'label'   => __('Page Content', 'bootswatch'),
            'section' => $section,
            'settings'=> '_404_page_content_setting',
            'priority' => 1,
            'type' => 'select',
            'choices' => array(
                'default' => __('Default', 'bootswatch'),
                'page' => __('Select a Page', 'bootswatch'),
            )
        )
    );

    // if it is a user created page, then select the page
    $wp_customize->add_setting( '_404_page_select_setting', array(
        'default'        => 0,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( '_404_page_select_control', array(
            'label'   => __('Select a Page', 'bootswatch'),
            'section' => $section,
            'settings'=> '_404_page_select_setting',
            'type'    => 'dropdown-pages',
            'priority' => 1,
         )
    );

}

add_action('customize_register', 'bootswatch_404_settings');
