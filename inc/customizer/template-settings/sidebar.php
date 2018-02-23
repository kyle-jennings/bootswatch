<?php


/**
 * Label
 */
$wp_customize->add_setting(
    $name . '_sidebar_label', array(
        'default' => 'none',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
    )
);
$args = array(
    'label' => __('Sidebar Settings', 'bootswatches'),
    'type' => 'label',
    'section' => $name . '_settings_section',
    'settings' => $name . '_sidebar_label',
    'input_attrs' => array(
      'data-toggled-by' => $name . '_settings_active',
    )
);


$wp_customize->add_control(
    new Bootswatches_Label_Custom_Control(
        $wp_customize,
        $name . '_sidebar_label_control',
        $args
    )
);


/**
 * Sidebar position
 */
$wp_customize->add_setting( $name . '_sidebar_position_setting', array(
    'default' => 'none',
    'sanitize_callback' => 'bootswatches_sidebar_position_sanitize',
) );

$sidebar_pos_args = array(
    'description' => __('Hide or move your sidebar to change the layout of the content area.','bootswatches'),
    'label' => __('Sidebar Position', 'bootswatches'),
    'section' => $name . '_settings_section',
    'settings' => $name . '_sidebar_position_setting',
    'type' => 'select',
    'choices' => array(
        'none' => __('No sidebar', 'bootswatches'),
        'left' => __('Left', 'bootswatches'),
        'right' => __('Right', 'bootswatches'),
    ),
    'input_attrs' => array(
      'data-toggled-by' => $name . '_settings_active',
    )
);

$wp_customize->add_control($name . '_sidebar_position_control', $sidebar_pos_args);


/**
 * Sidebar Visibility
 */
$wp_customize->add_setting( $name . '_sidebar_visibility_setting', array(
    'default' => 'always-visible',
    'sanitize_callback' => 'bootswatches_sidebar_visibility_sanitize',
) );
$sidebar_visibility_args = array(
    'description' => __('Hide or show the sidebar on different screen size (ie: hide on phones)', 'bootswatches'),
    'label' => __('Sidebar Visibility', 'bootswatches'),
    'section' => $name . '_settings_section',
    'settings' => $name . '_sidebar_visibility_setting',
    'type' => 'select',
    'choices' => array(
        'always-visible' => __('Always visible', 'bootswatches'),
        'hidden-medium-up' => __('Hide on medium screens and larger', 'bootswatches'),
        'hidden-large-up' => __('Hide on desktop', 'bootswatches'),
        'visible-medium-up' => __('Visible on medium screens and larger', 'bootswatches'),
        'visible-large-up' => __('Visible on desktop', 'bootswatches'),
    ),
    'input_attrs' => array(
      'data-toggled-by' => $name . '_settings_active',
    )
);

$wp_customize->add_control($name . '_sidebar_visibility_control', $sidebar_visibility_args);
