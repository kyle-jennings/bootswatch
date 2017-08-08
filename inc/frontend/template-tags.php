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
 function bootswatch_get_hero_meta(){
     $post = get_queried_object();

     $user_i = 'fa-user';
     $calendar_i = 'fa-calendar';

     $id = $post->ID;
     $aid = $post->post_author;

     $m = get_the_time('m');
     $d = get_the_date('F j');
     $y = get_the_time('Y');

     $month_url = get_month_link($y, $m);
     $year_url = get_year_link($y);

     // date of post
     $date = '';
     $date .= '<i class="fa '.$calendar_i.'" aria-hidden="true"></i>';
     $date .= '<a class="post-date published" href="' . esc_url($month_url) . '">'.$d.'</a>, ';
     $date .= '<a class="post-date published" href="' . esc_url($year_url) . '">'.$y.'</a>';


     // author of post
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


     $output = '';
     $output .= '<span class="post-meta__field posted-on">' . $date . '</span>';
     $output .= '<span class="post-meta__field byline"> ' . $author . '</span>'; // WPCS: XSS OK.

     return $output;
 }


function bootswatch_posted_on() {
    echo bootswatch_get_posted_on(); //WPCS: xss ok.
}


/**
 * Gets the entry header info (meta of author and post date )
 *
 * this is used inside the loop, hence being a different function than the previous one
 * @return string html
 */
function bootswatch_get_posted_on(){
    global $post;

    $user_i = 'fa-user';
    $calendar_i = 'fa-calendar';
    $taxonomy_i = 'fa-folder-o';
    $comments_i = 'fa-comment-o';

    $id = get_the_ID();
    $aid = get_the_author_meta( 'ID', $post->post_author );

    $m = get_the_time('m');
    $d = get_the_date('F j');
    $y = get_the_time('Y');

    $month_url = get_month_link($y, $m);
    $year_url = get_year_link($y);

    $date = '';
    $date .= '<i class="fa '.$calendar_i.'" aria-hidden="true"></i>';
    $date .= '<a class="post-date published" href="' . esc_url($month_url) . '">'.$d.'</a>, ';
    $date .= '<a class="post-date published" href="' . esc_url($year_url) . '">'.$y.'</a>';

    $author = '';
    $author .= '<i class="fa '.$user_i.'" aria-hidden="true"></i>';
    $author .= '<span class="author vcard">';
    if ( function_exists( 'coauthors_posts_links' ) ) {
        $author .= coauthors_posts_links(null, null, null, null, false);
    } else {
        $author .= '<a class="url fn n"
            href="' . get_author_posts_url( $aid ) . '">';
            $author .= get_the_author();
        $author .= '</a>';
    }
    $author .= '</span>';

    $output = '';
    $output .= '<span class="post-meta__field posted-on">' . $date . '</span>';
    $output .= '<span class="post-meta__field byline"> ' . $author . '</span>'; // WPCS: XSS OK.

    return $output;
}



function bootswatch_get_entry_footer() {

}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bootswatch_entry_footer() {
    global $post;

    $tags_i = 'fa-tags';
    $taxonomy_i = 'fa-folder-o';
    $comments_i = 'fa-comment-o';

    $output ='';
    $output .= '<div class="post-meta">';

    	// Hide category and tag text for pages.
    	if ( 'page' !== get_post_type() ) {

            // categories
    		if ( $categories_list = bootswatch_get_the_category_list($post->ID) ) {
                /* translators: 1: list of categories. */
    			$output .= sprintf( '<div class="post-meta__field"><i class="fa fa-folder-o"></i>' . esc_html__( 'Posted in %1$s', 'bootswatch' ) . '</div>', $categories_list ); // WPCS: XSS OK.
    		}

            // tags
    		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'bootswatch' ) );
    		if ( $tags_list ) {
                /* translators: used between list items, there is a space after the comma */
    			$output .= sprintf( '<div class="post-meta__field"><i class="fa fa-tags"></i>' . esc_html__( 'Tagged with %1$s', 'bootswatch' ) . '</div>', $tags_list ); // WPCS: XSS OK.
    		}
    	}

        // comment link
    	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

    		$output .= '<div class="post-meta__field">';
                $output .= '<i class="fa fa-comments-o"></i>';
                ob_start();
        		/* translators: %s: post title */
        		comments_popup_link(
                    sprintf(
                        wp_kses( __( 'Leave a Comment <span class="screen-reader-text"> on %s</span>', 'bootswatch' ),
                            array( 'span' => array( 'class' => array() ) )
                        ),
                        get_the_title()
                    )
                );
                $content = ob_get_contents();
                ob_end_clean();
                $output .= $content;
    		$output .= '</div>';

    	}



    $output .= '</div>';
    echo $output;



}


function bootswatch_get_the_edit_post_link($post_id = null){

    $output = '';
    // Edit link
    ob_start();
    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'bootswatch' ),
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


function bootswatch_the_edit_post_link($post_id = null){
    echo bootswatch_get_the_edit_post_link($post_id);
}

/**
 * Gets tht html list of category links
 * @param  int $id post id
 * @return string     html list of links
 */
function bootswatch_get_the_category_list($id = null) {
    $post = get_post($id);
    $post_type = $post->post_type;

    $is_cat = ($post_type =='post') ? true : false;

    $terms = $is_cat ? get_the_category($id) : bootswatch_get_custom_tax_terms($id, $post_type);
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
function bootswatch_get_custom_tax_terms($id = null, $post_type = null) {
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
