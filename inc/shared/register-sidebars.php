<?php
/**
 * Register widget areas programitically
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


/**
 * Register the widget areas, and determine the width of said area to use to 
 * size the widgets correctly
 */
function bootswatches_widgets_init() {
    $templates = bootswatches_the_template_list(true, true);
    $sidebars = wp_get_sidebars_widgets();
    foreach($templates as $name => $args){
        $sidebar_size = '';
        
        $widgets = isset($sidebars[$name]) ? $sidebars[$name] : array();
        $count = count($widgets);

        $horizontals = array(
            'banner-widget-area',
            'footer-widget-area-1',
            'footer-widget-area-2',
            'frontpage-widget-area-1',
            'frontpage-widget-area-2',
            'frontpage-widget-area-3',
            'widgetized-widget-area-1',
            'widgetized-widget-area-2',
            'widgetized-widget-area-3',
        );

        // $sidebar_size = bootswatches_determine_widget_width_rules($pos, $name);
        // determine whether or not to apply withs to the widgets
        if ( in_array($name, $horizontals) ){
            $sidebar_size = 'full';
        }

        // figure out which width rules to use
        if($sidebar_size == 'full')
            $width = bootswatches_calculate_widget_width($count);
        else
            $width = '';

        $description = isset($args['widget_description']) ? $args['widget_description'] : '';
        register_sidebar( array(
            'name'          => sprintf( '%s ', ucfirst($args['label']) ),
            'id'            => (string) $name,
            /* translators: sidebar description. */
            'description'   => sprintf(  __('%s ', 'bootswatch'), $description ),
            'before_widget' => '<div id="%1$s" class="widget widget-area--' . $name . ' '. $width . '">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }


}
add_action( 'init', 'bootswatches_widgets_init' );



function add_classes_to__widget($args){
    global $horizontal_sidebars_count;

    if( !array_key_exists($args[0]['id'], $horizontal_sidebars_count) )
        return $args;
    $horizontal_sidebars_count[$args[0]['id']]['current']++;

    // store the variables into something i dont hate writing
    $current = $horizontal_sidebars_count[$args[0]['id']]['current'];
    $count = $horizontal_sidebars_count[$args[0]['id']]['count'];
    $cols = 12;

    // if there are no widgets just return
    if($count == 0)
        return $args;

    if( ($current == $count) && ($cols % $count > 0) ){
        $last = 'col-md-'. floor(($cols / $count) + ($cols % $count));
        $args[0]['before_widget'] = preg_replace('/(col-md-[0-9]+)/', $last, $args[0]['before_widget']);
    }

    return $args;
}
// add_filter('dynamic_sidebar_params', 'add_classes_to__widget');



/**
 * Count the number of widgets set in an a widget area, this is used to automatically
 * resize all the widgets to take up the full width of the area
 * @param  [type] $count [description]
 * @return [type]        [description]
 */
function bootswatches_calculate_widget_width($count){
    $cols = 12;
    if($count <= 0)
        return '';
    return 'col-md-'.floor($cols / $count);
}


/**
 * Deactivate and hide the widget area if it is not "active"
 * @return [type] [description]
 */
function bootswatches_hide_inactive_templates_on_widget_screen(){
    $screen = get_current_screen();

    if($screen->id !== 'widgets')
        return;

    $horizontals = array(
        'footer-widget-area-1',
        'footer-widget-area-2',
        'frontpage-widget-area-1',
        'frontpage-widget-area-2',
        'frontpage-widget-area-3',
        'widgetized-widget-area-1',
        'widgetized-widget-area-2',
        'widgetized-widget-area-3',
    );

    $templates = bootswatches_the_template_list(true);

    // loop through all the templates
    foreach($templates as $name => $args){
        
        // if we are on the default template or that template's settings 
        // have been activated, then skip it.
        if( $name == DEFAULT_TEMPLATE || get_theme_mod($name.'_settings_active') == 'yes' )
            continue;

        // skip the following areas
        $skip_horz = array('banner-widget-area');
        

        // loop through the list of horizontal areas
        foreach($horizontals as $area){

            $setting = strtok($area, '-');
            $sortables = get_theme_mod($setting . '_sortables_setting', null);
            // if the area is active, then add it to the skip list
            $target = ltrim(ltrim($area, $setting), '-');
            if(strpos($sortables, $target) )
                $skip_horz[] = $area;

        }

        if(in_array($name, $skip_horz ))
            continue;

        unregister_sidebar((string) $name);
    }

}
add_action('sidebar_admin_setup', 'bootswatches_hide_inactive_templates_on_widget_screen');
