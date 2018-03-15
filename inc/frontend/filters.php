<?php


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bootswatches_body_classes( $classes ) {
    unset($classes);
       $classes = array();


      if( get_theme_mod('navbar_sticky_setting', false) ) {
        $classes[] = 'sticky-nav';
      }


       if( is_user_logged_in() ){
           $classes[] = 'logged-in';
       }

       if ( is_front_page() ) {
           $classes[] = 'frontpage';
       }

       if( is_home()) {
           $classes[] = 'home';
           $classes[] = 'archive';
       }

       if( is_search() ){
           $classes[] = 'search';
       }

       if( is_singular('post') ){
           $classes[] = 'singular';
       }

       if(is_author() ){
           $classes[] = 'author';
       }

       if ( is_page() && !is_front_page() ){
           global $post;
           $title = $post->post_title;
           $classes[] = 'page';
           $classes[] = 'page--'.str_replace(' ', '-', strtolower($title) );
       }

       if( is_single() ){
           global $post;
           $title = get_the_title();
           $classes[] = 'single';
           $classes[] = 'single--'.str_replace(' ', '-', strtolower($title) );
       }


       if( is_404() ){
           $classes[] = 'page-404';
       }
       if( is_category() ){
           global $wp_query;
           $classes[] = 'archive--category';
       }

       if( is_archive() ){
           global $wp_query;
           $classes[] = 'archive';
           $post_types = array_filter( (array) get_query_var( 'post_type' ) );
           if ( count( $post_types ) == 1 ) {
               $post_type = reset( $post_types );
               $classes[] = "archive--".$post_type;
           }
       }

       if( is_paged() ){
           $classes[] = 'paged';
           $classes[] = get_query_var('paged') ? 'paged--'.get_query_var('paged') : '' ;
       }
       if( is_tax() ){
           global $wp_query;
           $paged = get_query_var('paged') ? get_query_var('paged') : 1;
           $classes[] = 'archive--taxonomy';
       }
       return $classes;
}
add_filter( 'body_class', 'bootswatches_body_classes' );



function bootswatches_archive_link($link) {

    $find = array(
        '</a>',
        '</li>'
    );

    $replace = array(
        '',
        '</a></li>'
    );

    $link = str_replace($find, $replace, $link);
    return $link;
}
add_filter( 'get_archives_link', 'bootswatches_archive_link' );


remove_filter( 'the_content', 'wpautop' );

function bootswatches_autop_false($content) {
    return wpautop( $content, false );
}
add_filter( 'the_content', 'bootswatches_autop_false', 10 );
