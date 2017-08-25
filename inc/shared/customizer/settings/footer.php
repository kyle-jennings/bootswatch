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


$choices = array(
        'footer-menu' => 'Footer Menu',
        'widget-area-1' => 'Widget Area 1',
        'widget-area-2' => 'Widget Area 2'
);

$wp_customize->add_section( 'footer_settings_section', array(
    'title'          => __('Footer Settings', 'bootswatch'),
    'priority'       => 38,
) );

$wp_customize->add_setting( 'footer_sortables_setting', array(
    'default'        => '',
    'sanitize_callback' => array($this->validation, 'footer_sortable_sanitize'),
) );


$description = __('The page content is sortable, and optional.  Simply drag the
available components from the "available" box over to active.  This setting
does not depend on the "Settings Active" setting above.', 'bootswatch');

$wp_customize->add_control( new Sortable( $wp_customize,
   'footer_sortables_control', array(
       'description' => $description,
       'label'   => __('Sortable Footer Parts', 'bootswatch'),
       'section' => 'footer_settings_section',
       'settings'=> 'footer_sortables_setting',
       'priority' => 1,
       'optional' => true,
       'choices' => $choices
       )
   )
);
