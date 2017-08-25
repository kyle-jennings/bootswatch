<?php


/**
 * Label
 */
$wp_customize->add_setting(
    $name . '_header_label', array(
        'default' => 'none',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);
$args = array(
    'label' => __('Header Settings', 'bootswatch'),
    'type' => 'label',
    'section' => $name . '_settings_section',
    'settings' => $name . '_header_label',
    'input_attrs' => $input_attrs

);

$wp_customize->add_control(
    new Label(
        $wp_customize,
        $name . '_header_label_control',
        $args
    )
);

/**
 * Hero Image
 */
$wp_customize->add_setting( $name . '_image_setting', array(
    'default'      => null,
    'sanitize_callback' => 'absint'
) );

$hero_image_args = array(
    'description' => __('Change the header image, for best results use an image that is at least 1080px wide by 720px tall.', 'bootswatch'),
    'label'   => __('Header Image', 'bootswatch'),
    'section' => $name . '_settings_section',
    'settings'   => $name . '_image_setting',
    'height' => '900',
    'width' => '1600',
    'input_attrs' => $input_attrs
);


$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control(
        $wp_customize,
        $name . '_image_setting_control',
        $hero_image_args
    )
);


/**
 * Hero Size
 */
$wp_customize->add_setting( $name . '_hero_position_setting', array(
    'default' => 'center',
    'sanitize_callback' => array($this->validation, 'hero_position_sanitize'),
) );

$choices = array(
    'top' => 'Top',
    'center' => 'Center',
    'bottom' => 'Bottom',
);

$hero_position_args = array(
    'description' => __('Because the header image size can be changed, this option will give you some more control with how the image is displayed.','bootswatch'),
    'label' => __('Header Image Position', 'bootswatch'),
    'section' => $name . '_settings_section',
    'settings' => $name . '_hero_position_setting',
    'type' => 'select',
    'choices' => $choices,
    'input_attrs' => $input_attrs
);

$wp_customize->add_control( $name . '_hero_position_control', $hero_position_args );


/**
 * Hero Size
 */
$wp_customize->add_setting( $name . '_hero_size_setting', array(
    'default' => 'big',
    'sanitize_callback' => array($this->validation, 'hero_size_sanitize'),
) );

$hero_size_args = array(
    'description' => __('Changes the height of the hero banner', 'bootswatch'),
    'label' => __('Header Size', 'bootswatch'),
    'section' => $name . '_settings_section',
    'settings' => $name . '_hero_size_setting',
    'type' => 'select',
    'choices' => array(
        'slim' => 'Slim',
        'medium' => 'Medium',
        'big' => 'Big',
        'full' => 'Full Screen'
    ),
    'input_attrs' => array('toggable'),
);


$wp_customize->add_control( $name . '_hero_size_control', $hero_size_args );
