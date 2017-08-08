<?php

/**
 * Get all the settings needed for the template layout
 * @return array keyed array with the settings
 */
function bootswatch_template_settings($log = null) {

    // if the settings have already been gathered, return them
    if( !empty($GLOBALS['bootswatch-settings']) ){
        return $GLOBALS['bootswatch-settings'];
    }
    // otherwise we have to gather and set them

    $template = bootswatch_get_template();
    $sidebar_position = get_theme_mod($template . '_sidebar_position_setting', 'none');

    $main_width = '';
    // if the sidebar is not displayed, the main area is full width
    // otherwise calculate the main area's width and visibility
    if($sidebar_position == 'none') {
        $main_width = BOOTSWATCH_FULL_WIDTH;
    } else {
        $main_width = bootswatch_get_main_width($sidebar_position);
        $main_width .= ' ' . bootswatch_get_main_visibility($template, $sidebar_position);
    }

    $hide_content = bootswatch_hide_layout_part('page-content', $template);

    // set the settings to the global variable, and return them to the caller
    return $GLOBALS['bootswatch-settings'] = array(
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
function bootswatch_get_template() {

    //	if the page is a post type
    if( is_front_page() && bootswatch_settings_active('frontpage') ) :
        return 'frontpage';
    elseif( is_single() && $cpt = bootswatch_which_cpt() ) :
        return $cpt;
    elseif ( is_single() && $single = bootswatch_is_single() ) :
        return $single;
    elseif ( is_page() && $page = bootswatch_is_page()) :
        return $page;
    elseif (is_404() && bootswatch_settings_active('_404') ) :
        return '_404';
    elseif( is_post_type_archive( bootswatch_get_cpts()) && $cpt = bootswatch_which_cpt('feed') ) :
        return $cpt;
    else :
        return bootswatch_is_feed();
    endif;
}


/**
 * If the template is a single post type...
 * @return str|boolean the template name or false
 */
function bootswatch_is_single(){

    if (is_embed() && bootswatch_settings_active('embed') ) :
        return 'embed';
    elseif (is_attachment() && bootswatch_settings_active('attachment') ) :
        return 'attachment';
    elseif (is_single() && bootswatch_settings_active('single') ) :
        return 'single';
    else:
        return false;
    endif;
}


/**
 * If the tempalte is a "feed" type, determine the type
 * @return string tempalte name
 */
function bootswatch_is_feed(){

    if( is_search() && bootswatch_settings_active('search'))
        return 'search';
    elseif( is_home() && bootswatch_settings_active('home') ){
        return 'home';
    }elseif( is_tax() && bootswatch_settings_active('taxonomy') ){
        return 'taxonomy';
    }elseif( is_category() && bootswatch_settings_active('cetegory') ){
        return 'category';
    }elseif( is_tag() && bootswatch_settings_active('tag') ){
        return 'tag';
    }elseif( is_author() && bootswatch_settings_active('author') ){
        return 'author';
    }elseif( is_date() && bootswatch_settings_active('date') ){
        return 'date';
    }else{
        return 'archive';
    }
}


function bootswatch_which_cpt($feed = null) {
    $cpts = bootswatch_get_cpts();
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
function bootswatch_is_date(){
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
function bootswatch_is_page(){
    if ( is_page_template() && $p_template = bootswatch_is_page_template() ):
        return $p_template;
    elseif (is_page() && bootswatch_settings_active('page') ):
        return 'page';
    else :
        return false;
    endif;
}


/**
 * If we are on a page template, lets ensure it's a valid one
 * @return str|boolean the template name or false
 */
function bootswatch_is_page_template(){

    if ( is_page_template('page-templates/sidenav.php') && bootswatch_settings_active('sidenav') )
        return 'sidenav';
    if ( is_page_template('page-templates/widgetized.php') && bootswatch_settings_active('widgetized') )
        return 'widgetized';
    if ( is_page_template('page-templates/template-1.php') && bootswatch_settings_active('template-1') )
        return 'template-1';
    if ( is_page_template('page-templates/template-2.php') && bootswatch_settings_active('template-2') )
        return 'template-2';
    if ( is_page_template('page-templates/template-3.php') && bootswatch_settings_active('template-3') )
        return 'template-3';
    if ( is_page_template('page-templates/template-4.php') && bootswatch_settings_active('template-4') )
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
function bootswatch_hide_layout_part( $needle, $template ) {

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
function bootswatch_settings_active($template = null){

    $active = get_theme_mod($template . '_settings_active', 'no');
    return ($active == 'yes') ? true : false;
}
