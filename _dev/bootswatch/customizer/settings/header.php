<?php


/**
 * Header Settings
 *
 * These settings include ordering the header area (banner, hero,) and the
 * navbar size
 * @param  [type] $wp_customize [description]
 * @return [type]               [description]
 */



// the section
$wp_customize->add_section( 'header_settings_section', array(
    'title'          => __('Header Settings', 'bootswatch'),
    'priority'       => 30,
) );

// header size
$header_components = array(
    'navbar' => 'Navbar',
    'hero' => 'Hero',
);

if(bootswatch_is_dot_gov())
    $header_components['banner'] = 'Banner';

$wp_customize->add_setting( 'header_sortables_setting', array(
    'default' => '[{"name":"navbar","label":"Navbar"},{"name":"hero","label":"Hero"}]',
    'sanitize_callback' => array($this->validation, 'header_sortable_sanitize'),
) );

$description = 'The header area is made of sortable parts.  Simply drag these
parts around to change the order they are displayed.';
$wp_customize->add_control(
    new Bootswatch_Sortable_Control( $wp_customize,
        'header_sortables_control', array(
            'description' => $description,
            'label' => __('Header Order', 'bootswatch'),
            'section' => 'header_settings_section',
            'settings' => 'header_sortables_setting',
            'choices' => $header_components
        )
    )
);


/**
 * Label
 */
$wp_customize->add_setting(
    'navbar_label', array(
        'default' => 'none',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);


$wp_customize->add_control(
    new Bootswatch_Label_Custom_Control(
        $wp_customize,
        'navbar_label_control',
        array(
            'label' => __('Navbar Settings', 'bootswatch'),
            'type' => 'label',
            'section' => 'header_settings_section',
            'settings' => 'navbar_label',
        )
    )
);


$wp_customize->add_setting( 'navbar_search_setting', array(
    'default' => 'none',
    'sanitize_callback' => array($this->validation, 'navbar_search_setting_sanitize'),
) );

$wp_customize->add_control('navbar_search_control', array(
        'label' => __('Display Search in Navbar', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'navbar_search_setting',
        'type' => 'select',
        'choices' => array(
            'none' => 'None',
            'navbar' => 'Navbar',
        )
    )
);




$wp_customize->add_setting( 'navbar_color_setting', array(
    'default' => 'light',
    'sanitize_callback' => array($this->validation, 'navbar_color_setting_sanitize'),
) );

$wp_customize->add_control('navbar_color_control', array(
        'label' => __('Navbar Color Scheme', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'navbar_color_setting',
        'type' => 'select',
        'choices' => array(
            'light' => 'Light',
            'dark' => 'Dark',
        )
    )
);


$wp_customize->add_setting( 'navbar_sticky_setting', array(
    'default' => 'no',
    'sanitize_callback' => array($this->validation, 'navbar_sticky_sanitize'),
) );

$wp_customize->add_control('navbar_sticky_control', array(
        'description' => __('Stick the navbar to the top of the screen when you scroll down the page', 'bootswatch'),
        'label' => __('Navbar sticky on scroll', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'navbar_sticky_setting',
        'type' => 'select',
        'choices' => array(
            'no' => 'No',
            'yes' => 'Yes',
        )
    )
);

$wp_customize->add_setting( 'navbar_brand_setting', array(
    'default' => 'text',
    'sanitize_callback' => array($this->validation, 'navbar_brand_sanitize'),
) );

$wp_customize->add_control('navbar_brand_control', array(
        'description' => 'Display your site logo, or site name in the navbar',
        'label' => __('Navbar Brand Type', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'navbar_brand_setting',
        'type' => 'select',
        'choices' => array(
            'text' => 'Text',
            'logo' => 'Logo',
        )
    )
);



/**
 * Label
 */
$wp_customize->add_setting(
    'banner_label', array(
        'default' => 'none',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);


$wp_customize->add_control(
    new Bootswatch_Label_Custom_Control(
        $wp_customize,
        'banner_label_control',
        array(
            'label' => __('Banner Settings', 'bootswatch'),
            'type' => 'label',
            'section' => 'header_settings_section',
            'settings' => 'banner_label',
        )
    )
);


$wp_customize->add_setting( 'banner_visibility_setting', array(
    'default' => 'hide',
    'sanitize_callback' => array($this->validation, 'banner_visibility_sanitize'),
) );

$wp_customize->add_control('banner_visibility_control', array(
        'description' => 'Display your site banner',
        'label' => __('Banner Visibility', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'banner_visibility_setting',
        'type' => 'select',
        'choices' => array(
            'hide' => 'Hide',
            'display' => 'Display',
        )
    )
);


$wp_customize->add_setting( 'banner_text_setting', array(
    'default' => '',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
) );

$wp_customize->add_control('banner_text_control', array(
        'label' => __('Banner Text', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'banner_text_setting',
        'type' => 'text',
    )
);


$wp_customize->add_setting( 'banner_read_more_setting', array(
    'default' => '',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
) );

$wp_customize->add_control('banner_read_more_control', array(
        'label' => __('Banner Read More', 'bootswatch'),
        'section' => 'header_settings_section',
        'settings' => 'banner_read_more_setting',
        'type' => 'text',
    )
);
