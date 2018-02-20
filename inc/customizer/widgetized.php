<?php



function bootswatch_widgetized_settings($wp_customize) {

    $section = 'widgetized_content_section';
    $template = bootswatch_get_template_info('widgetized');

    $section_args = array(
        'section' => $section,
        'title' => __('Widgetized Page', 'bootswatch'),
        'description' => $template['description'],
    );


    bootswatch_customize_section( $wp_customize, $section_args );


    $wp_customize->add_setting( 'widgetized_sortables_setting', array(
        'default'        => '[{"name":"page-content","label":"Page Content"}]',
        'sanitize_callback' => 'bootswatch_widgetized_sortable_sanitize',
    ) );

    $description = __('The page content is sortable, and optional.  Simply drag the
    available components from the "available" box over to active.  This setting
    does not depend on the "Settings Active" setting above.', 'bootswatch');

    $wp_customize->add_control( new Bootswatch_Sortable_Control( $wp_customize,
       'widgetized_sortables_control', array(
           'label'   => __('Sortable Page Content', 'bootswatch'),
           /* translators: use the $description variable above - states that the content is sortable via drag and drop */
           'description' => sprintf( __('%s ', 'bootswatch'), $description ),
           'section' => $section,
           'settings'=> 'widgetized_sortables_setting',
           'optional' => true,
           'choices' => array(
                   'widget-area-1' => __('Widget Area 1', 'bootswatch'),
                   'widget-area-2' => __('Widget Area 2', 'bootswatch'),
                   'widget-area-3' => __('Widget Area 3', 'bootswatch'),
                   'page-content' => __('Page Content', 'bootswatch'),
               )
           )
       )
    );

}
add_action('customize_register', 'bootswatch_widgetized_settings');
