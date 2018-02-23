<?php

/**
 * Get all the settings needed for the template layout
 * @return array keyed array with the settings
 */
function bootswatches_template_settings($log = null) {

    // if the settings have already been gathered, return them
    if( !empty($GLOBALS['bootswatches-settings']) ){
        return $GLOBALS['bootswatches-settings'];
    }
    // otherwise we have to gather and set them

    $template = bootswatches_get_template();
    $sidebar_position = get_theme_mod($template . '_sidebar_position_setting', 'none');

    $main_width = '';
    // if the sidebar is not displayed, the main area is full width
    // otherwise calculate the main area's width and visibility
    if($sidebar_position == 'none') {
        $main_width = BOOTSWATCHES_FULL_WIDTH;
    } else {
        $main_width = bootswatches_get_main_width($sidebar_position);
        $main_width .= ' ' . bootswatches_get_main_visibility($template, $sidebar_position);
    }

    $hide_content = bootswatches_hide_layout_part('page-content', $template);

    // set the settings to the global variable, and return them to the caller
    return $GLOBALS['bootswatches-settings'] = array(
        'template' => $template,
        'main_width' => $main_width,
        'hide_content' => $hide_content,
        'sidebar_position' => $sidebar_position,
    );
}


/**
 * Get the "current" page template
 *
 * I saw "current" because unless the current page's template settings are
 * activated, then we will fall back onto the "feed" settings
 * there are 5 main types. Frontpage, a single post,
 * a single page, the 404 page, or a feed
 *
 * @return str template name
 */
function bootswatches_get_template() {

    //  if the page is a post type
    if( is_front_page() && bootswatches_settings_active('frontpage') ) :
        return 'frontpage';
    elseif( is_single() && $cpt = bootswatches_which_cpt() ) :
        return $cpt;
    elseif ( is_single() && $single = bootswatches_is_single() ) :
        return $single;
    elseif ( is_page() && $page = bootswatches_is_page()  && !is_front_page() ) :
        return $page;
    elseif (is_404() && bootswatches_settings_active('_404') ) :
        return '_404';
    elseif( is_post_type_archive( bootswatches_get_cpts()) && $cpt = bootswatches_which_cpt('feed') ) :
        return $cpt;
    elseif( $feed = bootswatches_is_feed() ) :
        return $feed;
    else:
        return DEFAULT_TEMPLATE;
    endif;
}


/**
 * If the template is a single post type...
 * @return str|boolean the template name or false
 */
function bootswatches_is_single(){

    if (is_embed() && bootswatches_settings_active('embed') ) :
        return 'embed';
    elseif (is_attachment() && bootswatches_settings_active('attachment') ) :
        return 'attachment';
    elseif (is_single() && bootswatches_settings_active('single') ) :
        return 'single';
    else:
        return false;
    endif;
}


/**
 * If the tempalte is a "feed" type, determine the type
 * @return string tempalte name
 */
function bootswatches_is_feed(){

    if( is_search() && bootswatches_settings_active('search'))
        return 'search';
    elseif( is_home() && bootswatches_settings_active('home') ){
        return 'home';
    }elseif( is_tax() && bootswatches_settings_active('taxonomy') ){
        return 'taxonomy';
    }elseif( is_category() && bootswatches_settings_active('cetegory') ){
        return 'category';
    }elseif( is_tag() && bootswatches_settings_active('tag') ){
        return 'tag';
    }elseif( is_author() && bootswatches_settings_active('author') ){
        return 'author';
    }elseif( is_date() && bootswatches_settings_active('date') ){
        return 'date';
    }elseif( (is_archive() || is_home() ) && bootswatches_settings_active('archive')){
        return 'archive';
    }else{
        return null;
    }
}


function bootswatches_which_cpt($feed = null) {
    $cpts = bootswatches_get_cpts();
    $name = get_queried_object()->name;

    if(!$feed)
        $name = get_queried_object()->post_type;

    if($feed == 'feed')
        $feed = '-feed';

    if(in_array( $name, $cpts))
        return $name . $feed;

    return false;
}

/**
 * If the archive type is a "date", determine the date type
 * @return str|boolean the template name or false
 */
function bootswatches_is_date(){
    if(is_day())
        return 'day';
    elseif( is_month())
        return 'month';
    else
        return 'year';
}



/**
 * If the template is a single page, determine whether or not its a custom template
 * @return str|boolean the template name or false
 */
function bootswatches_is_page(){
    if ( is_page_template() && $p_template = bootswatches_is_page_template() ):
        return $p_template;
    elseif (is_page() && bootswatches_settings_active('page') ):
        return 'page';
    else :
        return false;
    endif;
}


/**
 * If we are on a page template, lets ensure it's a valid one
 * @return str|boolean the template name or false
 */
function bootswatches_is_page_template(){

    if ( is_page_template('page-templates/sidenav.php') && bootswatches_settings_active('sidenav') )
        return 'sidenav';
    if ( is_page_template('page-templates/widgetized.php') && bootswatches_settings_active('widgetized') )
        return 'widgetized';
    if ( is_page_template('page-templates/template-1.php') && bootswatches_settings_active('template-1') )
        return 'template-1';
    if ( is_page_template('page-templates/template-2.php') && bootswatches_settings_active('template-2') )
        return 'template-2';
    if ( is_page_template('page-templates/template-3.php') && bootswatches_settings_active('template-3') )
        return 'template-3';
    if ( is_page_template('page-templates/template-4.php') && bootswatches_settings_active('template-4') )
        return 'template-4';
    else
        return false;
}



/**
 * Hides a part of the template layout
 * @param  str $needle   page part (navbar, footer, ect)
 * @param  str  $template the "current" templat
 * @return boolean
 */
function bootswatches_hide_layout_part( $needle, $template ) {

    $layout_settings = get_theme_mod($template.'_page_layout_setting', '[]');
    $layout_settings = json_decode($layout_settings);
    $layout_settings = $layout_settings ? $layout_settings : array();
    $result = in_array($needle, $layout_settings);

    return $result;
}



/**
 * Have the settings been activated?
 * @param  [type] $template [description]
 * @return [type]           [description]
 */
function bootswatches_settings_active($template = null){

    $active = get_theme_mod($template . '_settings_active', 'no');
    return ($active == 'yes') ? true : false;
}
