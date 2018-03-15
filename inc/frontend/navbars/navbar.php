<?php
$sticky = get_theme_mod('navbar_sticky_setting', 'no') == 'yes' ? ' navbar-sticky' : '';
?>
<nav class="navbar navbar-default<?php echo $sticky; ?>">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
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
                'menu_class'     => 'nav navbar-nav',
                'walker' => new BootswatchesNavbarWalker(),
                'fallback_cb' => 'bootswatches_set_default_menu'
            );

             wp_nav_menu( $args );
            ?>
            <?php if(get_theme_mod('navbar_search_setting', 'none') == 'navbar' ): ?>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                  <input type="text" class="form-control"
                    name="s"
                    placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'bootswatches' ); ?>"
                    title="<?php echo esc_attr_x( 'Search for:', 'title','bootswatches' ); ?>"
                    type="search"
                    value="<?php echo get_search_query(); ?>"
                >
                </div>
                <button type="submit" class="btn btn-default"> <?php _e('Submit', 'bootswatches'); ?> </button>
            </form>

            <?php endif;?>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
