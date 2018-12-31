<?php

/**
 * 
 * @return [type] [description]
 */
function bootswatches_get_default_header_srotables()
{
    $banner_label = __('Banner', 'bootswatches');
    $navbar_label = __('Navbar', 'bootswatches');
    $hero_label = __('Hero', 'bootswatches');

    $json = '[';
    $json .= '{"name":"banner","label": "' . $banner_label . '"}, ';
    $json .= '{"name":"navbar","label":"' . $navbar_label . '"}, ';
    $json .= '{"name":"hero","label":"' . $hero_label . '"}';
    $json .= ']';

    return $json;
}


function bootswatches_get_default_footer_sortables()
{

    $return_label = __('Return to top', 'bootswatches');
    $footer_label = __('Footer menu', 'bootswatches');

    $json = '[';
    $json .= '{"name":"return-to-top","label":"' . $return_label . '"},';
    $json .= '{"name":"footer-menu","label":"' . $footer_label . '"}';
    $json .= ']';

    return $json;
}


/**
 * Sets some default values when the theme is first loaded
 *
 * Sets the following values (if not previously set) when the theme is activated:
 *
 * The archive page sidebar position
 * The archive page hero sanitize_bookmark
 * The archive header order
 */
function bootswatches_set_default_settings()
{

    if (!get_theme_mod('archive_sidebar_position_setting')) {
        set_theme_mod('archive_sidebar_position_setting', 'right');
    }

    if (!get_theme_mod('archive_hero_size_setting')) {
        set_theme_mod('archive_hero_size_setting', 'slim');
    }

    if (!get_theme_mod('header_sortables_setting')) {
        set_theme_mod('header_sortables_setting', bootswatches_get_default_header_srotables() );
    }

    if (!get_theme_mod('footer_sortables_setting')) {
        set_theme_mod('footer_sortables_setting', bootswatches_get_default_footer_sortables());
    }
}

add_action('after_switch_theme', 'bootswatches_set_default_settings');



/**
 * Sets default menu items when no menu is set
 * @param  [type] $args [description]
 * @return [type]       [description]
 */
function bootswatches_set_default_menu($args = array())
{

    // see wp-includes/nav-menu-template.php for available arguments
    extract($args);

    $link_arr = array(
        home_url() => __('Home', 'bootswatches'),
        wp_login_url() => __('Login', 'bootswatches')
    );

    if (is_user_logged_in()) {
        $link_arr = array(
            home_url() => __('Home', 'bootswatches'),
            admin_url() => __('Admin', 'bootswatches'),
            admin_url('nav-menus.php') => __('Add a Menu', 'bootswatches'),
            admin_url('customize.php') => __('Customize your Site', 'bootswatches'),
            wp_logout_url(home_url()) => __('Logout', 'bootswatches')
        );
    }

    $links = array();
    
    $items_wrap = isset($items_wrap) ? $items_wrap : '';
    $menu_id = isset($menu_id) ? $menu_id : '';
    $menu_class = isset($menu_class) ? $menu_class : '';
    $echo = isset($echo) ? $echo : false;


    $li_class = $theme_location == 'footer' ? 'col-sm-2 footer-primary-content' : '';
    $link_class = $theme_location == 'footer' ? 'footer-primary-link' : '';

    // loop through the list of links, add some escaped markup, the before and afters, as well as the lable
    foreach ($link_arr as $url => $label) {
        $links[] = '<a class="' . esc_attr($link_class) . '" href="' . esc_url($url) . '">' .
        esc_html($label) . '</a>';
    }

    // wrap all link items
    foreach ($links as &$link) {
        $link = '<li class="'.esc_attr($li_class).'">' . $link . '</li>';
    }

    $output = sprintf($items_wrap, $menu_id, $menu_class, implode('', $links));
    if (!empty($container)) {
        $output  = '<' . esc_attr($container) . ' class="' . esc_attr($container_class) . '" id="' .
        esc_attr($container_id) . '">' . $output . '</' . esc_attr($container) . '>'; //$output cannot be escaped
    }

    if ($echo) {
        echo $output; // WPCS: xss ok;
    }

    return $output;
}



function bootswatches_default_header_order()
{
    $arr = array(
        (object) array(
            'name' => 'banner',
            'label' => __('Banner', 'bootswatches')
        ),
        (object) array (
            'name' => 'navbar',
            'label' => __('Navbar', 'bootswatches')
        ),
        (object) array (
            'name' => 'hero',
            'label' => __('Hero', 'bootswatches')
        ),
    );

    return $arr;
}
