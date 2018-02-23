<?php


/**
 * The footer settings
 *
 * Settings include, the footer "size" (how many footer sections), and the
 * content type (widgets or menu), and if menu is selected then the menu.
 *
 * The content and menu options will probably be removed in the future in lieu
 * of creating a new footer nav widget
 * @param  object $wp_customize
 */

function bootswatches_footer_settings($wp_customize) {
    $choices = array(
            'return-to-top' => __('Return to Top', 'bootswatch'),
            'footer-menu' => __('Footer Menu', 'bootswatch'),
            'widget-area-1' => __('Widget Area 1', 'bootswatch'),
            'widget-area-2' => __('Widget Area 2', 'bootswatch'),
    );

    $wp_customize->add_section( 'footer_settings_section', array(
        'title'          => __('Footer Settings', 'bootswatch'),
        'priority'       => 38,
    ) );

    $wp_customize->add_setting( 'footer_sortables_setting', array(
        'default'        => '',
        'sanitize_callback' => 'bootswatches_footer_sortable_sanitize',
    ) );


    $description = __('The page content is sortable, and optional.  Simply drag the
    available components from the "available" box over to active.  This setting
    does not depend on the "Settings Active" setting above.', 'bootswatch');

    $wp_customize->add_control( new Bootswatches_Sortable_Control( $wp_customize,
       'footer_sortables_control', array(
           'description' => sprintf('%s', $description),
           'label'   => __('Sortable Footer Parts', 'bootswatch'),
           'section' => 'footer_settings_section',
           'settings'=> 'footer_sortables_setting',
           'priority' => 1,
           'optional' => true,
           'choices' => $choices
           )
       )
   );


}
add_action('customize_register', 'bootswatches_footer_settings');
