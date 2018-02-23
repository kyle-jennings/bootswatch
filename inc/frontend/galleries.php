<?php


function bootswatches_carousel_markup($images =array(), $size = 'carousel-feed') {
    if(empty($images))
        return null;

    $images = explode(',', $images);
    $count = count($images);


    ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php for($num = 0; $num < $count; $num++ ): ?>
            <?php $active = ($num == 0) ? 'class="active"' : ''; ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo esc_attr($num); ?>" <?php echo esc_attr($active); ?> ></li>
        <?php endfor; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php foreach($images as $i=>$id): ?>
                <?php
                    $image = get_post($id);
                    $image_title = $image->post_title;
                    $image_caption = $image->post_excerpt;
                    $src = wp_get_attachment_image_src($id, $size);
                    if(empty($src))
                        continue;

                    $active = ($i == 0) ? 'active' : '';

                 ?>
                <div class="item <?php echo esc_attr($active); ?>">
                    <img src="<?php echo esc_url($src[0]); ?>" alt="...">
                    <div class="carousel-caption">
                        <?php echo esc_html($image_caption); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
}


function bootswatches_get_carousel_markup($images =array(), $size = 'carousel-feed'){
    $content = '';
    ob_start();
        bootswatches_carousel_markup($images, $size);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
