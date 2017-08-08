<?php


    $banner_text = stripslashes( esc_html(get_theme_mod('banner_text_setting', null) ));
    $banner_read_more = stripslashes( esc_html(get_theme_mod('banner_read_more_setting', null) ));

    $sidebars = wp_get_sidebars_widgets();

    if(isset($sidebars['banner-widget-area-1']) || isset($sidebars['banner-widget-area-2']) )
        $count = count( $sidebars['banner-widget-area-1'] + $sidebars['banner-widget-area-1'] );
    else
        $count = 0;

?>
<!-- Gov banner BEGIN -->
<div class="container">

    <div class="row">


        <p>
            <?php echo $banner_text;  //WPCS: xss ok. ?>
            <?php if($count > 0): ?>
                <a aria-expanded="false" aria-controls="bannerCollapse"
                data-target="#bannerCollapse" data-toggle="collapse" >
                    <i class="fa fa-chevron-down"></i>
                    <?php echo $banner_read_more; //WPCS: xss ok. ?>
                </a>
            <?php endif; ?>
        </p>


        <?php if($count > 0 ): ?>
        <div class="collapse" id="bannerCollapse">

            <?php if( isset($sidebars['banner-widget-area-1']) && count($sidebars['banner-widget-area-1']) > 0 ): ?>
                <div class="sortable-row sortable-row--banner-widget-area-1 cf">
                    <?php dynamic_sidebar('banner-widget-area-1'); ?>
                </div>
            <?php endif; ?>

            <?php if( isset($sidebars['banner-widget-area-2']) && count($sidebars['banner-widget-area-2']) > 0 ): ?>
                <div class="sortable-row sortable-row--banner-widget-area-2 cf">
                    <?php dynamic_sidebar('banner-widget-area-2'); ?>
                </div>
            <?php endif; ?>

        </div> <!-- end accordion content -->
        <?php endif; ?>


    </div> <!-- end accordion -->
</div>

<!-- Gov banner END -->
