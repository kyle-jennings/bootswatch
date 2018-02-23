<div class="container">
    <div class="row">
<?php

    $args = array(
        'container' => '',
        'container_class' => '',
        'depth'=> 0,
        'menu_class' => 'list-inline col-md-12',
        'theme_location' => 'footer',
        'walker' => new FooterNavbarWalker(),
        'fallback_cb' => 'bootswatches_set_default_menu'
    );

    wp_nav_menu( $args );
?>

    </div>
</div>
