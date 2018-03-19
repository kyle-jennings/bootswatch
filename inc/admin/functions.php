<?php


/**
 * Hides CSS files from teh media library
 *
 * When a user creates their own color scheme, it is compile to a CSS file, and
 * then uploaded to WordPress and thus would show up in the media library.  We
 * want to hide that to avoid accidental deletion.
 *
 */
function bootswatches_hide_css_files($query)
{
    $include = array();
    $exclude = array();
    $temp_query = new WP_Query($query);
    if ($temp_query->have_posts()) {
        while ($temp_query->have_posts()) {
            $temp_query->the_post();
            $meta = wp_get_attachment_metadata(get_the_ID());
            $meta['mime-type'] = get_post_mime_type(get_the_ID());
            if (isset($meta['mime-type']) && ($meta['mime-type'] == 'text/css')) {
                $exclude[] = get_the_ID();
            }
        }
    }

    wp_reset_query();
    $query['post__in']     = $include;
    $query['post__not_in'] = $exclude;
    return $query;
}

add_filter('ajax_query_attachments_args', 'bootswatches_hide_css_files');



/**
 * Recursive sanitation for text or array
 *
 * @author https://wordpress.stackexchange.com/a/255861/19536
 * @param $val (array|string)
 * @since  0.1
 * @return mixed
 */
function bootswatches_sanitize_text_or_array_field($val)
{
    
    if (is_string($val)) {
        $val = sanitize_text_field(wp_unslash($val));
    } elseif (is_array($val)) {
        foreach ($val as $key => &$value) {
            if (is_array($value)) {
                $value = bootswatches_sanitize_text_or_array_field($value);
            } else {
                $value = sanitize_text_field(wp_unslash($value));
            }
        }
    }

    return $val;
}


/**
 * Creates the post format metaboxes
 * @return void
 */
function bootswatches_setup_postformats()
{

    $files      = array('aside','audio', 'chat', 'gallery','image', 'link', 'quote', 'status', 'video', '_markup');
    $admin_root = dirname(__FILE__);

    foreach ($files as $file) {
        require_once $admin_root . DIRECTORY_SEPARATOR . 'post-formats' . DIRECTORY_SEPARATOR . $file . '.php';
    }

    PostFormat::init(array('post', 'page'));
}

add_action('admin_init', 'bootswatches_setup_postformats');
