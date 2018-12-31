<?php
$sticky = get_theme_mod('navbar_sticky_setting', 'no') == 'yes' ? 'sticky' : '';
?>
<nav class="navbar navbar-default<?php echo $sticky; ?>">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"><?php echo __('Toggle navigation', 'bootswatches'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo bootswatches_get_navbar_brand(); // WPCS: xss ok.?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
                $args =  array(
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'nav navbar-nav',
                    'walker' => new BootswatchesNavbarWalker(),
                    'fallback_cb' => 'bootswatches_set_default_menu'
                );

                wp_nav_menu($args);
            ?>

            <?php if (get_theme_mod('navbar_search_setting', 'none') == 'navbar') : ?>
            <?php get_search_form(); ?>
            <?php endif;?>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
