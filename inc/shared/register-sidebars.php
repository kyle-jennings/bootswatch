<?php
/**
 * Register widget areas programitically
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

$horizontal_sidebar_list = array(
    'banner-widget-area-1',
    'banner-widget-area-2',
    'widgetized-widget-area-1',
    'widgetized-widget-area-2',
    'widgetized-widget-area-3',
    'frontpage-widget-area-1',
    'frontpage-widget-area-2',
    'frontpage-widget-area-3',
    'footer-widget-area-1',
    'footer-widget-area-2',
);


$horizontal_sidebars_count = array();

function bootswatch_widgets_init() {

    global $horizontal_sidebar_list;
    global $horizontal_sidebars_count;

    $templates = bootswatch_the_template_list(true);
    $sidebars = wp_get_sidebars_widgets();

    foreach($templates as $name => $args){
        $sidebar_size = '';

        $widgets = isset($sidebars[$name]) ? $sidebars[$name] : array();
        $count = count($widgets);
        $pos = get_theme_mod($name . '_sidebar_position_setting', 'none');




        $well = 'well';
        // $sidebar_size = bootswatch_determine_widget_width_rules($pos, $name);
        // determine whether or not to apply withs to the widgets
        if ( in_array($name, $horizontal_sidebar_list) ){
            $sidebar_size = 'full';
            $well = '';

            $horizontal_sidebars_count[$name] = array(
                'count' => $count,
                'current' => 0
            );
        }

        // figure out which width rules to use
        if($sidebar_size == 'full')
            $width = bootswatch_calculate_widget_width($count);
        else
            $width = '';

        $description = isset($args['widget_description']) ? $args['widget_description'] : '';
        register_sidebar( array(
    		'name'          => ucfirst($args['label']),
    		'id'            => (string) $name,
            /* translators: sidebar description. */
    		'description'   => sprintf(  '%s', $description ),
    		'before_widget' => '<div id="%1$s" class="'.$well.' widget '.$width.'">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3 class="widget-title">',
    		'after_title'   => '</h3>',
    	) );

    }


}
add_action( 'init', 'bootswatch_widgets_init' );

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
add_filter('dynamic_sidebar_params', 'add_classes_to__widget');


function bootswatch_calculate_widget_width($count){
    $cols = 12;
    if($count <= 0)
        return '';

    return 'col-md-'.floor($cols / $count);
}


function bootswatch_hide_inactive_templates_on_widget_screen(){

    global $horizontal_sidebar_list;
    $screen = get_current_screen();

    if($screen->id !== 'widgets')
        return;


    $templates = bootswatch_the_template_list(true);

    foreach($templates as $name => $args){
        if( $name == 'archive' || get_theme_mod($name.'_settings_active') == 'yes' )
            continue;

        $skip_horz = array('banner-widget-area-1','banner-widget-area-2');
        foreach($horizontal_sidebar_list as $area){

            $setting = strtok($area, '-');
            $sortables = get_theme_mod($setting . '_sortables_setting', null);

            $target = ltrim(ltrim($area, $setting), '-');
            if(strpos($sortables, $target) )
                $skip_horz[] = $area;

        }

        if(in_array($name, $skip_horz ))
            continue;

        unregister_sidebar((string) $name);
    }

}
add_action('sidebar_admin_setup', 'bootswatch_hide_inactive_templates_on_widget_screen');
