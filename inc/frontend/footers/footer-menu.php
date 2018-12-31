<div class="usa-footer-primary-section">
    <div class="usa-grid">
    <?php
        $args =  array(
            'theme_location' => 'footer',
            'container' => 'nav',
            'container_class' => 'usa-footer-nav',
            'depth'=> 0,
            'menu_class' => 'usa-unstyled-list',
            'walker' => new BootswatchesFooterNavbarWalker(),
            'fallback_cb' => 'bootswatches_set_default_menu'
        );
        wp_nav_menu($args);
    ?>
    </div>
</div>
