<?php

class Hero {

    public $template;
    public $currentpage;

    public $hasFeaturedVideo = false;
    public $hasFeaturedImage = false;
    public $hasFeaturedPost = false;

    public $size = 'hero--slim';
    public $image = null;
    public $video = null;

    public $title;
    public $pre_title;
    public $sub_title;

    public $url;
    public $content;

    public $HeroContent;
    public $HeroBackground;

    public function __construct($template = null) {
        $this->template = $template;

        if( is_front_page() )
            $this->currentpage = 'frontpage';
        elseif( is_404() )
            $this->currentpage = '_404';
        elseif( is_page() || is_single() || is_singular() )
            $this->currentpage = 'singular';
        elseif( is_author() )
            $this->currentpage = 'author';
        elseif( is_date() )
            $this->currentpage = 'date';
        elseif( is_tag() )
            $this->currentpage = 'tag';
        elseif( is_category() )
            $this->currentpage = 'category';
        elseif( is_search() )
            $this->currentpage = 'search';
        elseif( is_home() )
            $this->currentpage = 'home';
        elseif( is_archive() )
            $this->currentpage = 'archive';
        else
            $this->currentpage = 'fallback';


        $this->HeroContent = new HeroContent(null, $this->template, $this->currentpage);
        $this->HeroBackground = new HeroBackground(null, $this->template, $this->currentpage);

        $this->HeroBackground->getBackground();
    }

    public function __toString() {

        return $this->output();
    }


    // the output
    public function output(){
        $output = '';
        $size = $this->heroSize($this->template);
        $style = $this->HeroBackground->getStyle($this->template);


        $class = $size;
        $class .= ($this->HeroBackground->image) ? ' hero--has-background' : '';
        $class .= $this->isPostFormat() ? ' hero--is-post-format' : '';

        $output .= '<div class="section section--hero hero '.$class.'" '.$style.'>';
            $output .= '<div class="container">';
                $output .= '<div class="row">';
                    $output .= '<div class="'. BOOTSWATCH_FULL_WIDTH.'">';

                        $output .= $this->HeroContent->getContent();

                    $output .= '</div>';
                $output .= '</div><!-- /row -->';
            $output .= '</div><!-- container -->';
        $output .= '</div><!-- / section--hero -->';

        return $output;
    }


    function isPostFormat()
    {
        global $post;
        if($this->currentpage !== 'singular')
            return false;


        $format = get_post_format();

        if ( $format == 'video' && $this->HeroContent->getVideo() )
            return true;
        elseif ( $format == 'gallery' && $this->HeroContent->getGallery() )
            return true;
        elseif( $format == 'image' && $this->HeroContent->getImage() )
            return true;
        elseif($format == 'audio' && $this->HeroContent->getAudio()) {
            add_action('wp_footer', 'bootswatch_enqueue_visualizer_script' );
        }elseif( $format == 'quote' && $this->HeroContent->getQuote() )
            return true;
        else
            return false;

        return false;
    }


    /**
     * The hero has different sizes depending on which template is displayed
     * @param  [type] $template [description]
     * @return [type]           [description]
     */
    function heroSize($template = null)
    {

        $setting = get_theme_mod($template . '_hero_size_setting', 'slim');

        $size ='hero--'.$setting;
        return $size;
    }


}
