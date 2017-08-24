<?php



// Should we display a page in the header?
$wp_customize->add_setting( '_404_header_page_content_setting', array(
    'default'        => 0,
    'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( '_404_header_page_content_control', array(
        'description' => __('Select page content to the header, this is great when the header size is set to full and the other page parts are hidden.','bootswatch'),
        'label'   => __('Use page content in header', 'bootswatch'),
        'section' => '_404_settings_section',
        'settings'=> '_404_header_page_content_setting',
        'type' => 'select',
        'type'    => 'dropdown-pages',
        'priority' => 1,
     )
);


// What is the page content? The premade default, or a user created page?
$wp_customize->add_setting( '_404_page_content_setting', array(
    'default'  => 'default',
    'sanitize_callback' => array($this->validation, '404_content_sanitize'),
) );

$wp_customize->add_control( '_404_page_content_control', array(
        'description' => __('Display some default content provided by the theme or select a page to display.','bootswatch'),
        'label'   => __('Page Content', 'bootswatch'),
        'section' => '_404_settings_section',
        'settings'=> '_404_page_content_setting',
        'priority' => 1,
        'type' => 'select',
        'choices' => array(
            'default' => 'Default',
            'page' => 'Select a Page',
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
        'section' => '_404_settings_section',
        'settings'=> '_404_page_select_setting',
        'type'    => 'dropdown-pages',
        'priority' => 1,
     )
);
