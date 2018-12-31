<?php



function bootswatches_404_settings( $wp_customize) {


    $template = bootswatches_get_template_info('_404');
    $section = '_404_content_section';

    // set up the section
    $section_args = array(
        'section' => $section,
        'title' => __('404 Page', 'bootswatches'),
        'description' => $template['description'],
    );
    bootswatches_customize_section( $wp_customize, $section_args );

    /**
     * This selects what we display in the page header area
     */
    
    // select the what to display in the header
    $wp_customize->add_setting( '_404_hero_content_setting', array(
        'default'  => 'title',
        'sanitize_callback' => 'bootswatches_404_hero_content_sanitize',
    ) );

    $wp_customize->add_control( '_404_hero_content_control', array(
            'description' => __('Select what to display in the header.','bootswatches'),
            'label'   => __('Header Content', 'bootswatches'),
            'section' => $section,
            'settings'=> '_404_hero_content_setting',
            'priority' => 1,
            'type' => 'select',
            'choices' => array(
                'page' => __('Select a Page', 'bootswatches'),
                'title' => __('Default title', 'bootswatches'),
            )
        )
    );


    $wp_customize->add_setting( '_404_header_page_content_setting', array(
        'default'        => 0,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( '_404_header_page_content_control', array(
            'description' => __('Select page content to the header, this is great when the header size is set to full and the other page parts are hidden.','bootswatches'),
            'label'   => __('Select header content from page', 'bootswatches'),
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
        'sanitize_callback' => 'bootswatches_404_content_sanitize',
    ) );

    $wp_customize->add_control( '_404_page_content_control', array(
            'description' => __('Display some default content provided by the theme or select a page to display.','bootswatches'),
            'label'   => __('Page Content', 'bootswatches'),
            'section' => $section,
            'settings'=> '_404_page_content_setting',
            'priority' => 1,
            'type' => 'select',
            'choices' => array(
                'default' => __('Default', 'bootswatches'),
                'page' => __('Select a Page', 'bootswatches'),
            )
        )
    );

    // if it is a user created page, then select the page
    $wp_customize->add_setting( '_404_page_select_setting', array(
        'default'        => 0,
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( '_404_page_select_control', array(
            'label'   => __('Select a Page', 'bootswatches'),
            'section' => $section,
            'settings'=> '_404_page_select_setting',
            'type'    => 'dropdown-pages',
            'priority' => 1,
         )
    );

}

add_action('customize_register', 'bootswatches_404_settings');
