<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Bootswatch
 */

/**
 * Gets the entry header info (meta of author and post date )
 *
 * this is used outside the loop, hence being a different function
 * @return string html
 */
 function bootswatches_get_hero_meta($post_id = null){

     if(!$post_id)
        $post = get_queried_object();
    else
        $post = get_post($post_id);

     $output = '';
     $output .= bootswatches_get_the_date($post);
     $output .= bootswatches_get_the_author($post);
     $output .= bootswatches_get_the_comment_count_link($post);

     return $output;
 }


function bootswatches_posted_on() {
    echo bootswatches_get_posted_on(); //WPCS: xss ok.
}


/**
 * Gets the entry header info (meta of author and post date )
 *
 * this is used inside the loop, hence being a different function than the previous one
 * @return string html
 */
function bootswatches_get_posted_on(){

    $output = '';
    $output .= bootswatches_get_the_date();
    $output .= bootswatches_get_the_author();

    // Hide category and tag text for pages.
    if ( 'page' !== get_post_type() ) {

        $output .= bootswatches_get_the_comment_popup();
        $output .= bootswatches_get_categories_links();
        $output .= bootswatches_get_tags_links();
    }

    return $output;
}


function bootswatches_get_the_author($post = null) {
    if(!$post)
        global $post;

    $user_i = 'fa-user';

    $aid = get_the_author_meta( 'ID', $post->post_author );

    $author = '';
    $author .= '<i class="fa '.$user_i.'" aria-hidden="true"></i>';
    $author .= '<span class="author vcard">';
    if ( function_exists( 'coauthors_posts_links' ) ) {
        $author .= coauthors_posts_links(null, null, null, null, false);
    } else {
        $author .= '<a class="url fn n"
            href="' . get_author_posts_url( $aid ) . '">';
            $author .= get_the_author_meta('display_name', $aid);
        $author .= '</a>';
    }
    $author .= '</span>';


    $output = '<span class="post-meta__field byline"> ' . $author . '</span>'; // WPCS: XSS OK.

    return $output;
}


/**
 * Gets the posted date
 *
 * Used in the loop
 * @return string markup with links to date archives
 */
function bootswatches_get_the_date($post = null) {
    if(!$post)
        global $post;

    $user_i = 'fa-user';
    $calendar_i = 'fa-calendar';


    $m = get_the_time('m', $post);
    $d = get_the_date('F j', $post);
    $y = get_the_time('Y', $post);

    $month_url = get_month_link($y, $m);
    $year_url = get_year_link($y);

    $date = '';
    $date .= '<i class="fa '.$calendar_i.'" aria-hidden="true"></i>';
    $date .= '<a class="post-date published" href="' . esc_url($month_url) . '">'.$d.'</a>, ';
    $date .= '<a class="post-date published" href="' . esc_url($year_url) . '">'.$y.'</a>';

    $output = '<span class="post-meta__field posted-on">' . $date . '</span>';

    return $output;
}


function bootswatches_get_the_comment_count_link($post = null) {
    if(!$post)
        global $post;

    if( !comments_open( $post->ID ))
        return '';

    $output = '';
    $comments = '';
    $count = wp_count_comments( $post->ID );

    $count = $count->approved;
    $comments_i = $count > 1 ? 'fa-comments' : 'fa-comment' ;

    $text = '';
    switch($count):
        case 0:
        $text = __( 'Leave a Comment', 'bootswatches' );
            break;
        case 1:
            $text = __( '1 comment', 'bootswatches' );
            break;
        default:
            // translators: number of comments
            $text = sprintf( __( '%s comments', 'bootswatches' ), $count);
            break;
    endswitch;



    $comments = '<i class="fa '.$comments_i.'"></i>';
    $comments .= '<a href="#comments">'.$text.'</a>';


    $output = '<span class="post-meta__field"> ' . $comments . '</span>'; // WPCS: XSS OK.

    return $output;
}

function bootswatches_get_the_comment_popup($anchor = null) {

    global $post;


    if( !comments_open( $post->ID ))
        return '';

    $output = '';
    $comments = '';
    $count = wp_count_comments( $post->ID );
    $count = $count->approved;
    $comments_i = $count > 1 ? 'fa-comments' : 'fa-comment' ;
    // comment link
    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {



            $comments .= '<i class="fa '.$comments_i.'"></i>';
            ob_start();
            /* translators: %s: post title */
            comments_popup_link(
                wp_kses( __( 'Leave a Comment', 'bootswatches' ),
                    array( 'span' => array( 'class' => array() ) )
                ),
                wp_kses( __( '1 comment', 'bootswatches' ),
                    array( 'span' => array( 'class' => array() ) )
                ),
                wp_kses( __( '% comments', 'bootswatches' ),
                    array( 'span' => array( 'class' => array() ) )
                ),
                null,
                ''
            );
            $content = ob_get_contents();
            ob_end_clean();
            $comments .= $content;


        $output = '<span class="post-meta__field"> ' . $comments . '</span>'; // WPCS: XSS OK.
    }

    return $output;
}


function bootswatches_get_categories_links($post = null) {
    if(!$post)
        global $post;
    $output = '';
    // categories
    if ( $categories_list = bootswatches_get_the_category_list($post->ID) ) {
        $output .= sprintf( '<span class="post-meta__field"><i class="fa fa-folder"></i>' . esc_html( '%s' ) . '</span>', $categories_list );
    }

    return $output;
}


function bootswatches_get_tags_links() {

    $output = '';
    // tags
    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'bootswatches' ) );
    if ( $tags_list ) {
        $output .= sprintf( '<span class="post-meta__field"><i class="fa fa-tags"></i>' . esc_html( '%s' ) . '</span>', $tags_list);
    }

    return $output;
}

function bootswatches_get_entry_footer($post = null) {
    if(!$post)
        global $post;

    $output = '';

    $output .= '<footer class="entry-footer post-meta">';
        $output .= wp_link_pages( array(
            'before' => '<nav aria-label="Page navigation"><ul class="pagination">',
            'after'  => '</ul></nav>',
            'echo' => false
        ) );
        if ( 'page' !== get_post_type() ):
        $output .= '<div class="post-meta">';
            $output .= bootswatches_get_categories_links();
            $output .= bootswatches_get_tags_links();
        $output .= '</div>';
        endif;

        $output .= '<div class="post-meta">';
            $output .= bootswatches_get_the_edit_post_link();
        $output .= '</div>';
    $output .= '</footer>';

    return $output;
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bootswatches_entry_footer( $post = null ) {

    echo bootswatches_get_entry_footer( $post); //WPCS. xss ok.

}


function bootswatches_get_the_edit_post_link($post_id = null){

    $output = '';
    // Edit link
    ob_start();
    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'bootswatches' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        '<div class="post-meta__field"> <i class="fa fa-pencil"></i>',
        '</div>',
        $post_id
    );
    $contents = ob_get_contents();
    ob_end_clean();
    $output .= $contents;

    return $output;
}


function bootswatches_the_edit_post_link($post_id = null){
    echo bootswatches_get_the_edit_post_link($post_id); //WPCS. xss ok.
}


/**
 * Gets tht html list of category links
 * @param  int $id post id
 * @return string     html list of links
 */
function bootswatches_get_the_category_list($id = null) {
    $post = get_post($id);
    $post_type = $post->post_type;

    $is_cat = ($post_type =='post') ? true : false;

    $terms = $is_cat ? get_the_category($id) : bootswatches_get_custom_tax_terms($id, $post_type);
    $output = '';
    $count = 0;

    foreach($terms as $term):
        if($term->term_id == 1 && ($term->slug == 'uncategorized') || ($term->name == 'Uncategorized'))
            continue;

        $url = $is_cat ? get_category_link($term->term_id) : get_term_link($term->term_id);
        $output .= '<a href="'.$url.'">'.$term->name.'</a>, ';
        $count ++;
    endforeach;

    if($count == 0)
        return false;
    $output = rtrim($output, ', ');

    return $output;
}



/**
 * Gets the array of taxonmy terms (does not include categories)
 * @param  int $id        post id
 * @param  string $post_type the post type
 * @return array            array of terms
 */
function bootswatches_get_custom_tax_terms($id = null, $post_type = null) {
    if(!$id)
        return;

    if(!$post_type){
        $post = get_post($id);
        $post_type = $post->post_type;
    }

    if( !$post_type)
        return;


    $terms = array();
    $taxonomy_names = get_object_taxonomies( $post_type );
    foreach($taxonomy_names as $tax)
        $terms += wp_get_post_terms($id, $tax);


    // examine(wp_get_post_terms($id, 'topics'));
    return $terms;
}

function bootswatches_get_post_thumbnail($post = null){
    if(!$post)
        global $post;

    $output = '';
    if( has_post_thumbnail() ):

        $output .= '<figure class="post-featured-image">';
            $output .= '<a href="'.esc_url( get_the_permalink() ).'" rel="bookmark">';
                $output .= get_the_post_thumbnail($post);
            $output .= '</a>';
        $output .= '</figure>';
    endif;

    return $output;
}
function bootswatches_post_thumbnail($post = null) {
    echo bootswatches_get_post_thumbnail($post); //WPCS. xss ok.
}

function bootswatches_post_format_icon($format = null) {

    $icon = null;


    switch($format):
        case 'gallery':
            $icon = 'camera-retro';
            break;
        case 'image':
            $icon = 'photo';
            break;
        case 'link':
            $icon = 'link';
            break;
        case 'video':
            $icon = 'video-camera';
            break;
        case 'audio':
            $icon = 'volume-up';
            break;
        case 'aside':
            $icon = 'file-text';
            break;
        case 'chat':
            $icon = 'comments';
            break;
        case 'quote':
            $icon = 'quote-left';
            break;
        case 'status':
            $icon = 'commenting';
            break;
        default:
            $icon = '';
            break;
    endswitch;
    //
    if( is_sticky() )
        $icon = 'thumb-tack';

    if(!$icon)
        return '';

    $output = '<i class="fa fa-'.$icon.'"></i>';

    return $output;
}
