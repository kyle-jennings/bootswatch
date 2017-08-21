<?php


// select the what to display in the header
$wp_customize->add_setting( 'frontpage_hero_content_setting', array(
    'default'  => 'callout',
    'sanitize_callback' => array($this->validation, 'frontpage_hero_content_sanitize'),
) );

$wp_customize->add_control( 'frontpage_hero_content_control', array(
        'description' => __('Select what to display in the header.','bootswatch'),
        'label'   => __('Header Page Content', 'bootswatch'),
        'section' => 'frontpage_settings_section',
        'settings'=> 'frontpage_hero_content_setting',
        'priority' => 1,
        'type' => 'select',
        'choices' => array(
            'callout' => 'Title, Tagline, and Link',
            'page' => 'Select a Page',
            'title' => 'site title',
        )
    )
);


// Select the page link to use in the callout
 $wp_customize->add_setting( 'frontpage_hero_callout_setting', array(
     'default' => '',
     'sanitize_callback' => 'absint',
 ) );
 $wp_customize->add_control( 'frontpage_hero_callout_control',
     array(
         'description' => __('Display a button link in the callout to a selected page','bootswatch'),
         'label'   => __('Callout Button Link', 'bootswatch'),
         'section' => 'frontpage_settings_section',
         'settings'=> 'frontpage_hero_callout_setting',
         'type'    => 'dropdown-pages',
         'priority' => 1,
         'active_callback' => function() use ( $wp_customize ) {
              return 'callout' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
         },
        //  'active_callback' => $this->frontpageCalloutActiveCallback($wp_customize),
     )
 );



$wp_customize->add_setting( 'frontpage_hero_page_setting', array(
    'default'        => '',
    'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'frontpage_hero_page_control', array(
        'label'   => __('Select a Page', 'bootswatch'),
        'section' => 'frontpage_settings_section',
        'settings'=> 'frontpage_hero_page_setting',
        'type'    => 'dropdown-pages',
        'priority' => 1,
        'active_callback' => function() use ( $wp_customize ) {
             return 'page' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
        },
        // 'active_callback' => $this->frontpageHeroPageActiveCallback($wp_customize),
     )
);



 /**
  * Sortables
  * @var string
  */
 $wp_customize->add_setting( 'frontpage_sortables_setting', array(
     'default'        => '[{"name":"page-content","label":"Page Content"}]',
     'sanitize_callback' => array($this->validation, 'frontpage_sortable_sanitize'),
 ) );

 $description = 'The page content is sortable, and optional.  Simply drag the
 available components from the "available" box over to active.  This setting
 does not depend on the "Settings Active" setting above.';

 $wp_customize->add_control( new Bootswatch_Sortable_Control( $wp_customize,
    'frontpage_sortables_control', array(
        'description' => $description,
        'label'   => __('Sortable Page Content', 'bootswatch'),
        'section' => 'frontpage_settings_section',
        'settings'=> 'frontpage_sortables_setting',
        'priority' => 1,
        'optional' => true,
        'choices' => array(
                'widget-area-1' => 'Widget Area 1',
                'widget-area-2' => 'Widget Area 2',
                'widget-area-3' => 'Widget Area 3',
                'page-content' => 'Page Content'
            ),
        )
    )
);
