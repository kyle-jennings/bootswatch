<?php



/**
 * Layout settings for each templates
 *
 * Settings allow configuring th hero size, the hero image,
 * and the position of the navbar.  I will soon add the ability to "activate"
 * the settings.  So if a user wants, they would only need to set the "default"
 * layout settings
 * @param  object $wp_customize
 */
function bootswatches_template_layout_settings($wp_customize) {


    // create the panel for the other templates
    $wp_customize->add_panel(
        'extra_template_settings',
        array(
            'title' => __('More Templates Settings', 'bootswatches'),
            'priority' => 37,
        )
    );

    $templates = bootswatches_the_template_list(false, true);



    // for each template in the template list, we set up their customizer sections
    foreach($templates as $name => $args):

        $is_active = get_theme_mod($name . '_settings_active','no') == 'yes' ? 'is-active' : null;

        // the section's args, add the panel arg if the template is NOT the archive
        $section_args = array(
            /* translators: Displays the dynamically set label */
            'title' => sprintf( __('%s ', 'bootswatches'), ucfirst($args['label']) ),
            'priority' => 36,
            'description' => $args['description'],
            'type' => $is_active,
        );

        // do not put the default settings in the panel
        if( $name !== DEFAULT_TEMPLATE)
            $section_args['panel'] = 'extra_template_settings';


        // Add the section for the templates settings
        $wp_customize->add_section(
            $name . '_settings_section',
            $section_args
        );

        // now do the settings
        
        if($name!== DEFAULT_TEMPLATE)
            require('template-settings/activate.php');

        require('template-settings/header.php');
        require('template-settings/sidebar.php');
        // if($name!== DEFAULT_TEMPLATE)
        require('template-settings/layout.php');

    endforeach;

}
add_action('customize_register', 'bootswatches_template_layout_settings');

