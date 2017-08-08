<?php

class HeroBackground
{

    public $post_id;
    public $template;

    public $hasFeaturedImage = false;
    public $isFeaturedPost = false;

    public function __construct($post_id, $template)
    {
        $this->post_id = $post_id;
        $this->template = $template;
    }

    // set the background image and video BG
    public function getBackground($template) {
        if( in_array( $template, array('single','page')) || is_single() || is_page() ){

            $this->image = $this->getSingularImage($template);
            // $this->video = $this->getSingularVideo($template);

        } elseif( is_front_page() || is_404() ) {

            $this->setMediaFromCustSetting($template);

        } elseif( is_home() || is_archive() ) {

            $post = get_queried_object();
            $this->postType = $post_type = is_a($post, 'WP_Post_Type') && !is_home() ? $post->name : 'post';
            $this->isFeaturedPost = get_option('featured-post--'.$post_type, false);

            // set the hero image
            if($this->isFeaturedPost){
                $this->featuredPost = new FeaturedPost($this->isFeaturedPost, $post_type);
                $this->image = $this->getFeaturedPostMedia('image');

            } else {
                $this->setMediaFromCustSetting($template);
            }

        } else {

            $this->setMediaFromCustSetting($template);
        }
    }


    // set the media BGs set in teh customizer
    public function setMediaFromCustSetting($template){
        $this->image = get_theme_mod($template . '_image_setting', null);
    }


    // Add some inline CSS to the hero when we are using a background image
    public function getStyle($template) {
        if(!$this->image)
            return;

        $pos = get_theme_mod($template.'_hero_position_setting', 'top-left');
        $pos = str_replace('-',' ', $pos);
        $output = 'style="';
            $output .= 'background-image: url(\''.$this->image.'\');';
            $output .= 'background-position: '.$pos.';';
        $output .= '"';

        return $output;
    }


    // grab the video markup
    public function videoMarkup() {
        if(!$this->video)
            return;
        return bootswatch_get_the_video_markup($this->video, 'background');
    }


    // singular templates either have a featured image, or custommizer setting
    public function getSingularImage($template) {

        global $post;
        $url = get_post_meta($post->ID, '_post_format_video', true);

        if(get_post_format() == 'video' && $url && $id = bootswatch_get_youtube_id($url))
            return 'http://img.youtube.com/vi/'.$id.'/maxresdefault.jpg';
        elseif( has_post_thumbnail() )
            return get_the_post_thumbnail_url();
        else
            return get_theme_mod($template . '_image_setting', null);

    }


    // A featured post well have a featured image
    public function getFeaturedPostMedia($media = 'image') {

        $media = 'image';

        if($this->featuredPost && $this->featuredPost->$media )
            $media = $this->featuredPost->$media;
        else
            $media = get_theme_mod($this->template . '_'.$media.'_setting', null);


        return $media;
    }


}
