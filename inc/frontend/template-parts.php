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
function bootswatch_the_header() {
    $template = bootswatch_get_template();

    $layout_settings = get_theme_mod($template.'_page_layout_setting', '[]');
    $layout_settings = json_decode($layout_settings);

    $order = json_decode(get_theme_mod('header_sortables_setting', '[{"name":"banner","label":"Banner"},{"name":"navbar","label":"Navbar"},{"name":"hero","label":"Hero"}]'));

    $order = $order ? $order : bootswatch_default_header_order();

    foreach($order as $component):
        if($layout_settings && in_array($component->name, $layout_settings))
            continue;
        switch($component->name):
            case 'banner':
                if( get_theme_mod('banner_visibility_setting', 'hide') !== 'hide')
                    get_template_part('template-parts/section', 'banner');
                break;
            case 'navbar':
                get_template_part('template-parts/navbars/navbar');
                break;
            case 'hero':
                $hero = new Hero($template);
                echo $hero; //WPCS: xss ok.
                break;
        endswitch;
    endforeach;
}


function bootswatch_get_post_format_video_hero()
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
                    $output .= bootswatch_get_the_video_markup($video);
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';
    $output .= '</div>';


    return $output;
}


function bootswatch_post_format_video_hero() {
    echo bootswatch_get_post_format_video_hero(); // WPCS: xss ok.
}
/**
 * gets the 404 settings
 * @return array keyed array with settings
 */
function bootswatch_get_404_settings() {

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
function bootswatch_footer() {
    $template = bootswatch_get_template();

    $sortables = get_theme_mod('footer_sortables_setting', '[]');

    if(!$sortables || bootswatch_hide_layout_part('footer', $template) ) {
        return;
    }

    $sortables = json_decode($sortables);

    foreach($sortables as $s):
        $name = $s->name;

        switch($name):
            case 'footer-menu':
                get_template_part('template-parts/footers/footer', 'menu');
                break;
            case 'widget-area-1':
                get_template_part('template-parts/footers/footer', 'widgets-1');
                break;
            case 'widget-area-2':
                get_template_part('template-parts/footers/footer', 'widgets-2');
                break;

        endswitch;

    endforeach;
}
