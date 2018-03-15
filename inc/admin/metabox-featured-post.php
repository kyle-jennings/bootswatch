<?php


/**
 * The form field to mark a post as "featured"
 * @param  [type] $post [description]
 * @return [type]       [description]
 */
function bootswatches_featured_post_metabox_markup($post) {

    $featured_post = get_option('featured-post--'.$post->post_type, null);
    $checked = ($post->ID === $featured_post) ? 'checked' : '';

?>

    <p>
        Marks this post as the "featured post" in the
        <b><?php echo esc_html($post->post_type); ?></b> feed.
    </p>

    <label for="featured-post--<?php echo esc_html($post->post_type); ?>">Feature this post?</label>
    <input name="featured-post--<?php echo esc_html($post->post_type); ?>" type="checkbox" value="true" <?php echo esc_html($checked); ?>>

<?php
}


/**
 * Registers the metabox
 * @return [type] [description]
 */
function bootswatches_featured_post_metabox() {
    $args = array(
       'public'   => true,
       'publicly_queryable' => true,
       '_builtin' => false
    );
    $cpts = get_post_types($args);
    array_push($cpts, 'post');

    add_meta_box(
        'featured_post',
        'Featured Post',
        'bootswatches_featured_post_metabox_markup',
        $cpts,
        'side',
        'high',
        null
    );
}
add_action( 'add_meta_boxes', 'bootswatches_featured_post_metabox' );



/**
 * Save the value to the DC
 * @param  int $post_id
 * @param  wp_post $post    the post object
 * @param  string? $update  has the post been updated?
 */
function bootswatches_save_featured_post($post_id, $post, $update) {

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    if($post->post_type == 'revision')
        return $post_id;

    // if the post has been stickies, remove that flag and apply our flag
    if( $post->post_type == 'post' && isset( $_POST['sticky'] ) ) {
        unset( $_POST['sticky'] );
        update_option('featured-post--'.$post->post_type, $post_id);
    } elseif( isset($_POST['featured-post--'.$post->post_type]) ) {
        update_option('featured-post--'.$post->post_type, $post_id);

    } elseif( !isset($_POST['featured-post--'.$post->post_type])
        && $post_id == get_option('featured-post--'.$post->post_type, true)
    ) {

        delete_option('featured-post--'.$post->post_type);
    }

}

add_action("save_post", "bootswatches_save_featured_post", 10, 3);
