<?php

$files = array(
    '_helpers',
    '_sanitizations',

    'controls/label',
    'controls/sortable',
    'controls/color-scheme',
    'controls/menu-dropdown',
    'controls/checkbox-group',
    'controls/ColorScheme',
    
    'identity',
    'header',
    'template-settings',
    'frontpage',
    'widgetized',
    'footer',
    'page-404',
    'color-schemes'
);

// load all the settings files
foreach($files as $file)
  require_once $file . '.php';



function bootswatch_customizer_controls($wp_customize){
  // $wp_customize->register_control_type( 'Bootswatch_Color_Scheme_Custom_Control' );
}

add_action( 'customize_register','bootswatch_customizer_controls', 20 );
/**
 * enqueues scripts to the WordPress Customizer
 * @return [type] [description]
 */
function bootswatch_customizer_enqueue() {

  // this script is minified, however a non minified version is included with the theme
	wp_enqueue_script(
        'custom-customize',
        get_stylesheet_directory_uri() . '/assets/backend/js/_bootswatch-customizer-min.js',
        null,
        '20170215',
        true
    );
}
add_action( 'customize_controls_enqueue_scripts', 'bootswatch_customizer_enqueue' );



/**
 * enqueues scripts to the WordPress Previewer
 * @return [type] [description]
 */
function bootswatch_previewer_enqueue() {
  wp_enqueue_script(
        'custom-previewer',
        get_stylesheet_directory_uri() . '/assets/frontend/js/previewer-min.js',
        null,
        '20170215',
        true
    );
}

add_action( 'customize_preview_init', 'bootswatch_previewer_enqueue' );



/**
 * ----------------------------------------------------------------------------
 * Active Callbacks for 5.2 support ::shakes fist::
 * ----------------------------------------------------------------------------
 */

function bootswatch_active_callback_filter($active, $control) {
  global $wp_customize;

  $toggled_by = !isset($control->input_attrs) ? $control->input_attrs['data-toggled-by'] : null;


  // toggle controls if the template has been "activated"
  if( strpos($toggled_by, '_settings_active') && $toggled_by !== DEFAULT_TEMPLATE.'_settings_active' ){
    // error_log('template');
    return 'yes' === $wp_customize->get_setting( $toggled_by )->value();
  
  // toggle the 404 header content page selection is "page" is selected
  } elseif( $control->id == '_404_header_page_content_control'){

    return 'page' == $wp_customize->get_setting( '_404_hero_content_setting' )->value();

  } elseif( $control->id == '_404_page_select_control' ){
    // error_log('404 page');
  
    return 'page' == $wp_customize->get_setting( '_404_page_content_setting' )->value();

  // toggle the frontpage header content page selection is "page" is selected  
  }elseif( $control->id == 'frontpage_hero_callout_control' ) {
    // error_log('frontpage hero');
    return 'callout' === $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();

  // something else with the frontage
  }elseif( $control->id == 'frontpage_hero_page_control' ) {
    // error_log('front page hero content');
    return 'page' == $wp_customize->get_setting( 'frontpage_hero_content_setting' )->value();
    
    // return $this->checkToggableSettings($active, $control, $wp_customize );
  }

  return $active;


}
add_filter( 'customize_control_active', 'bootswatch_active_callback_filter', 100, 2);
