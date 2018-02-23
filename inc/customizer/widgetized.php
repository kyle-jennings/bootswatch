<?php



function bootswatches_widgetized_settings($wp_customize) {

    $section = 'widgetized_content_section';
    $template = bootswatches_get_template_info('widgetized');

    $section_args = array(
        'section' => $section,
        'title' => __('Widgetized Page', 'bootswatches'),
        'description' => $template['description'],
    );


    bootswatches_customize_section( $wp_customize, $section_args );


    $wp_customize->add_setting( 'widgetized_sortables_setting', array(
        'default'        => '[{"name":"page-content","label":"Page Content"}]',
        'sanitize_callback' => 'bootswatches_widgetized_sortable_sanitize',
    ) );

    $description = __('The page content is sortable, and optional.  Simply drag the
    available components from the "available" box over to active.  This setting
    does not depend on the "Settings Active" setting above.', 'bootswatches');

    $wp_customize->add_control( new Bootswatches_Sortable_Control( $wp_customize,
       'widgetized_sortables_control', array(
           'label'   => __('Sortable Page Content', 'bootswatches'),
           /* translators: use the $description variable above - states that the content is sortable via drag and drop */
           'description' => sprintf( __('%s ', 'bootswatches'), $description ),
           'section' => $section,
           'settings'=> 'widgetized_sortables_setting',
           'optional' => true,
           'choices' => array(
                   'widget-area-1' => __('Widget Area 1', 'bootswatches'),
                   'widget-area-2' => __('Widget Area 2', 'bootswatches'),
                   'widget-area-3' => __('Widget Area 3', 'bootswatches'),
                   'page-content' => __('Page Content', 'bootswatches'),
               )
           )
       )
    );

}
add_action('customize_register', 'bootswatches_widgetized_settings');
