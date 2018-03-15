<?php




/**
 * Get the header parts
 *
 * - banner" (only available if the domain is a .gov or .mil)
 * - navbar
 * - hero banner
 *
 * @return markup the echo mark up
 */
function bootswatches_the_header() {
    $template = bootswatches_get_template();

    $layout_settings = get_theme_mod($template.'_page_layout_setting', '[]');
    $layout_settings = json_decode($layout_settings);

    $order = json_decode(get_theme_mod('header_sortables_setting', '[{"name":"banner","label":"Banner"},{"name":"navbar","label":"Navbar"},{"name":"hero","label":"Hero"}]'));

    $order = $order ? $order : bootswatches_default_header_order();

    foreach($order as $component):
        if($layout_settings && in_array($component->name, $layout_settings))
            continue;
        switch($component->name):
            case 'navbar':
                get_template_part('inc/frontend/navbars/navbar');
                break;
            case 'hero':
                $hero = new Hero($template);
                echo $hero; //WPCS: xss ok.
                break;
        endswitch;
    endforeach;
}


function bootswatches_get_post_format_video_hero()
{

    global $post;
    $video = get_post_meta($post->ID, '_post_format_video', true);

    if(!$video)
        return null;

    $output = '';

    $output .= '<div class="video-screen">';
        $output .= '<div class="container">';
            $output .= '<div class="row">';
                $output .= '<div class="col-md-12">';
                    $output .= bootswatches_get_the_video_markup($video);
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';


    return $output;
}


function bootswatches_post_format_video_hero() {
    echo bootswatches_get_post_format_video_hero(); // WPCS: xss ok.
}
/**
 * gets the 404 settings
 * @return array keyed array with settings
 */
function bootswatches_get_404_settings() {

    $content = get_theme_mod('_404_page_content_setting', 'default');
    $pid = get_theme_mod('_404_page_select_setting', null);
    $header_page = get_theme_mod('_404_header_page_content_setting', null);

    $args = array(
        'header_page' => $header_page,
        'content' => $content,
        'pid' => $pid,
    );

    return $args;
}


/**
 * The footer conditional
 */
function bootswatches_footer() {
    $template = bootswatches_get_template();

    $sortables = get_theme_mod('footer_sortables_setting', '[]');

    if(!$sortables || bootswatches_hide_layout_part('footer', $template) ) {
        return;
    }

    $sortables = json_decode($sortables);

    foreach($sortables as $s):
        $name = $s->name;

        switch($name):
            case 'footer-menu':
                get_template_part('inc/frontend/footers/footer', 'menu');
                break;
            case 'widget-area-1':
                get_template_part('inc/frontend/footers/footer', 'widgets-1');
                break;
            case 'widget-area-2':
                get_template_part('inc/frontend/footers/footer', 'widgets-2');
                break;

        endswitch;

    endforeach;
}
