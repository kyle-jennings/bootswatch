<?php

class Hero {

    public $template;
    public $currentPage;
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

        $this->HeroContent = new HeroContent(null, $this->template);
        $this->HeroBackground = new HeroBackground(null, $this->template);


        $this->HeroBackground->getBackground($template);
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
        $class .= (get_post_format() == 'video' && $this->HeroContent->getPostFormatVideo()  ) ? ' hero--is-post-format' : '';

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



    /**
     * The hero has different sizes depending on which template is displayed
     * @param  [type] $template [description]
     * @return [type]           [description]
     */
    function heroSize($template = null){

        $setting = get_theme_mod($template . '_hero_size_setting', 'slim');

        $size ='hero--'.$setting;
        return $size;
    }


}
