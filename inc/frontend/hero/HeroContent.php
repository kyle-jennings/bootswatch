<?php

class HeroContent
{

    public $post_id;
    public $template;

    public $hasFeaturedVideo = false;
    public $hasFeaturedImage = false;
    public $hasFeaturedPost = false;

    public function __construct($post_id, $template)
    {
        $this->post_id = $post_id;
        $this->template = $template;
    }

    function __toString() {
        return $this->getContent();
    }

    /**
     * The Feed title will either show the author tagline, category / tag tag line
     * The date (month / year), search results, or the post type's featured post
     * @return [type] [description]
     */
    function getContent() {

        if( is_front_page() )
            return $this->frontpageContent();
        elseif( is_404() )
            return $this->the404title();
        elseif( is_page() || is_single() || is_singular() )
            return $this->singularTitle();
        elseif( is_author() )
            return $this->authorFeedTitle();
        elseif( is_date() )
            return $this->dateTitle();
        elseif( is_tag() )
            return $this->tagFeedTitle();
        elseif( is_category() )
            return $this->catFeedTitle();
        elseif( is_search() )
            return $this->searchTitle();
        elseif( is_home() || is_archive() )
            return $this->feedContent();
        else
            return $this->defaultTitle();

    }


    // the fallback
    public function defaultTitle() {
        $post = get_queried_object();
        if( $post->post_title)
            $title = $post->post_title;
        elseif($post->name)
            $title = $post->name;

        return '<h1 class="hero__title">' . $title .'</h1>';
    }


    // the 404 page has special powers
    public function the404title(){
        /**
         * the 404 settings
         *
         * returns:
         * $content
         * $pid
         * $header_page
         *
         */
        extract(bootswatch_get_404_settings());

        if($header_page) {
            $page = get_page($header_page);
            return apply_filters('the_content', $page->post_content);
        } else {

            $output = '';
            $output .= '<span class="hero__pre-title">';
                $output .= '<i class="fa fa-question-circle" aria-hidden="true"></i>';
                $output .= '404';
            $output .= '</span>';

            $output .= '<h1 class="hero__title">Page not found</h1>';

            return $output;
        }

    }

    /**
     * If we are on a single post, CPT or page
     *
     * We need to get its title and meta, or it's featured video if its a
     * post format of video
     * @return [type] [description]
     */
    public function singularTitle() {
        $output = '';

        if(get_post_format() == 'video' && $this->getPostFormatVideo() ):
            $output .= $this->getPostFormatVideo();
        else :
            $output .= $this->getSingularTitle();
        endif;

        return $output;
    }


    /**
     * If we are on a single post or a page...
     * then we grab its title and meta data (if a post)
     * @return [type] [description]
     */
    public function getSingularTitle()
    {

        $output = '';

        $output .= '<h1 class="hero__title">'.get_the_title().'</h1>';

        if ( 'page' !== get_post_type() ) :
            $output .= '<div class="post-meta">';
                $output .= bootswatch_get_hero_meta();
            $output .= '</div>';
        endif;

        return $output;
    }



    /**
     * If the current post is of the post format "video" then lets get that video
     * @return [type] [description]
     */
    public function getPostFormatVideo()
    {
        global $post;
        $url = get_post_meta($post->ID, '_post_format_video', true);

        if(!$url)
            return null;

        $output = '';
        $output .= bootswatch_get_the_video_markup($url);

        return $output;
    }


    // author feed title
    public function authorFeedTitle(){
        $auth = get_user_by('slug', get_query_var('author_name'));

        $output = '';
        $output .= '<span class="hero__pre-title">';
            $output .= '<i class="fa fa-user" aria-hidden="true"></i>';
            $output .= 'Posted by';
        $output .= '</span>';

        $output .= '<h1 class="hero__title">' . $auth->display_name . '</h1>';

        return $output;
    }


    /**
     * The Date title
     *
     * Grabs the markup for either the month date, or the year depending on where we are
     * @return [type] [description]
     */
    public function dateTitle() {

        $output = '';

        if( is_month()){

            $output .= '<span class="hero__pre-title">';
                $output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
                $output .= 'Posted in ';
            $output .= '</span>';

            $output .= '<h1 class="hero__title">' . get_the_date('F') .'</h1>';
            $output .= '<span class="hero__sub-title">' . get_the_date('Y') .'</span>';

        } else{

            $output .= '<span class="hero__pre-title">';
                $output .= '<i class="fa fa-calendar" aria-hidden="true"></i>';
                $output .= 'Posted in ';
            $output .= '</span>';

            $output .= '<h1 class="hero__title">' . get_the_date('Y') .'</h1>';

        }

        return $output;
    }


    // Tags
    public function tagFeedTitle() {
        ob_start();
            single_tag_title();
            $buffered_cat = ob_get_contents();
        ob_end_clean();

        $output = '';
        $output .= '<span class="hero__pre-title">';
            $output .= '<i class="fa fa-tags" aria-hidden="true"></i>';
            $output .= 'Tagged as';
        $output .= '</span>';

        $output .= '<h1 class="hero__title">' . $buffered_cat . '</h1>';

        return $output;

    }

    // category feed title
    public function catFeedTitle() {
        ob_start();
            single_cat_title();
            $buffered_cat = ob_get_contents();
        ob_end_clean();

        $output = '';
        $output .= '<span class="hero__pre-title">';
            $output .= '<i class="fa fa-folder-o" aria-hidden="true"></i>';
            $output .= 'Posted in';
        $output .= '</span>';

        $output .= '<h1 class="hero__title">' . $buffered_cat . '</h1>';

        return $output;

    }


    // search title
    public function searchTitle() {
        global $wp_query;
        $total_results = $wp_query->found_posts;
        // $title = $total_results ? 'Search Results for: '.get_search_query() : 'No results found' ;

        $output = '';
        $output .= '<span class="hero__pre-title">';
            $output .= '<i class="fa fa-search" aria-hidden="true"></i>';
            $output .= 'Search results for';
        $output .= '</span>';

        $output .= '<h1 class="hero__title">' . get_search_query() . '</h1>';

        return $output;

    }


    // The feed either shows the featured post content, the feed type, or the name of the page
    public function feedContent() {
        $output = '';

        $post = get_queried_object();
        $post_type = is_a($post, 'WP_Post_Type') ? $post->name : 'post';

        if($this->hasFeaturedPost) {
            $output = $this->featuredPost->output;
        } elseif( $post->post_title )  {
            $output = '<h1 class="hero__title">' . $post->post_title . '</h1>';
        } elseif($post->name) {
            $output = '<h1 class="hero__title">' . $post->name . '</h1>';
        } else {
            $output = '<h1 class="hero__title"> Home </h1>';
        }

        return $output;
    }


    public function frontpageContent() {

        $output = '';
        $content = get_theme_mod('frontpage_hero_content_setting', 'callout');

        if($content == 'page') {
            $page = get_theme_mod('frontpage_hero_page_setting', 0);
            if( !is_null($page) && $page != 0 ) {
                $page = get_page($page);
                $output .= apply_filters('the_content', $page->post_content);
            }
        } elseif($content == 'callout') {
            $output .= $this->heroCallout();
        } else {
            $output = '<h1 class="hero__title">' . get_bloginfo( 'name' ) . '</h1>';
        }

        return $output;
    }


    /**
     * The front page displays a "callout", here is the markup
     * @return [type] [description]
     */
    public function heroCallout(){
        $id = get_theme_mod('frontpage_hero_callout_setting', 0);

        $description = get_bloginfo( 'description', 'display' );
        $title = get_bloginfo( 'name', 'display' );

        if(!$title || !$description)
            return '<h1 class="hero__title">' . $title .'</h1>';


        $output = '';

        $output .= '<div class="hero-callout">';
            $output .= '<h1 class="hero__title">'.$title.'</h1>';

                if ( $description || is_customize_preview() )
                    $output .= '<p class="hero__sub-title">'.$description.'</p>';

                if( !is_null($id) && $id != 0 )
                    $output .= '<a class="btn btn-primary"
                        href="'.get_the_permalink($id).'">Learn More</a>';

        $output .= '</div>';

        return $output;
    }
}
