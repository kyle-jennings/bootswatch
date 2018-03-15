<?php


/**
 * Hides CSS files from teh media library
 *
 * When a user creates their own color scheme, it is compile to a CSS file, and 
 * then uploaded to WordPress and thus would show up in the media library.  We 
 * want to hide that to avoid accidental deletion.
 * 
 */
function bootswatches_hide_css_files($query) {
  $include = array();
  $exclude = array();
  $temp_query = new WP_Query($query);
  if($temp_query->have_posts()) {
    while($temp_query->have_posts()) {
      $temp_query->the_post();
      $meta = wp_get_attachment_metadata(get_the_ID());
      $meta['mime-type'] = get_post_mime_type(get_the_ID());
      if(isset($meta['mime-type']) && ($meta['mime-type'] == 'text/css') ) {
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