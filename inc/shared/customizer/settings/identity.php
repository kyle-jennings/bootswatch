<?php

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

// color scheme
$wp_customize->add_setting(
    'color_scheme_setting',
    array(
        'default' => 'bootstrap',
        'sanitize_callback' => 'wp_filter_nohtml_kses',
        'validate_callback' => array($this->validation, 'color_scheme_sanitize'),
    )
);

$themes = new BootswatchThemes();
$themes->setThemesAtts();
$themes = $themes->getThemes();

$wp_customize->add_control(
    new ColorSchemeControl(
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



$wp_customize->selective_refresh->add_partial(
    'color_scheme_setting_refresh',
    array(
        'container_inclusive' => true,
        'fallback_refresh' => false,
        'render_callback' => function() {
            return '*{ display: none; }';
        },
        'selector' => '#bootswatch--fake-target',
        'settings' => array('color_scheme_setting'),
    )
);



//
// $wp_customize->add_setting(
//     'sidebar_size_setting',
//     array(
//         'default' => 'BOOTSWATCH_ONE_THIRD',
//         'sanitize_callback' => array($this->validation, 'sidebar_width_sanitize'),
//     )
// );
//
// $wp_customize->add_control(
//     'sidebar_size_control',
//     array(
//         'label'   => 'Sizebar Size',
//         'section' => 'title_tagline',
//         'settings' => 'sidebar_size_setting',
//         'type' => 'select',
//         'choices' => array(
//             'BOOTSWATCH_ONE_THIRD' => 'Wide',
//             'BOOTSWATCH_ONE_FOURTH' => 'Narrow',
//         ),
//     )
// );
