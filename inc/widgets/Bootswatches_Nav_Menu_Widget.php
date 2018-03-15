<?php
/**
 * This is basically a clone of the WP_Nav_Menu_Widget but has some additonal
 * display options and obviously the additonal markup for these display options.
 *
 * Examples of the new options are basically just adding different types of
 * list styles. Because this theme is using Bootstrap, it might be a complicated
 * and messy process to refactor the CSS to match the and since we have to add
 * the new display options, we might as well jsut go the extra mile and add the markup here
 */
class Bootswatches_Nav_Menu_Widget extends WP_Nav_Menu_Widget {

	/**
	 * Outputs the content for the current Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Custom Menu widget instance.
	 */
	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;


        $style = ! empty( $instance['menu_style'] ) ? $instance['menu_style'] : 'side_nav';


        $elm = ($style == 'ordered-list') ? 'ol' : 'ul' ;

        $list_item = ($style == 'list-group') ? 'list-group-item' : null ;

        if($style == 'unstyled-list')
            $class = 'list-unstyled';
        elseif($style == 'list-group')
            $class = 'list-group';
        elseif($style == 'pills')
            $class = 'nav nav-pills nav-stacked';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget']; // WPCS: xss ok.

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];  // WPCS: xss ok.


		$nav_menu_args = array(
            'container' => '',
            'items_wrap' => '<'.$elm.' id="%1$s" class="%2$s">%3$s</'.$elm.'>',
            'menu_class' => $class . ' widget-list',
			'menu' => $nav_menu,
            'walker' => new BootswatchesSideNavWalker,
            'list_item_classes' => $list_item
		);

		/**
		 * Filters the arguments for the Custom Menu widget.
		 *
		 * @since 4.2.0
		 * @since 4.4.0 Added the `$instance` parameter.
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
		 *
		 *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param WP_Term  $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 * @param array    $instance      Array of settings for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );
		echo $args['after_widget']; // WPCS: xss ok.
	}

	/**
	 * Handles updating settings for the current Custom Menu widget instance.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}

        if ( ! empty( $new_instance['menu_style'] ) ) {
            $instance['menu_style'] = sanitize_text_field($new_instance['menu_style']);
        }

		return $instance;
	}

    /**
	 * Outputs the settings form for the Custom Menu widget.
	 *
	 * @since 3.0.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		global $wp_customize;

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
        $saved_style = isset( $instance['menu_style'] ) ? $instance['menu_style'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

        // styles
        $find = array('-', '_');
        $menu_styles = array('unordered-list', 'ordered-list', 'unstyled-list', 'list-group', 'pills');

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php /* translators: link to create new menu if none exist */ printf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'bootswatches' ), esc_attr( $url ) ); //WPCS xss ok; ?>
		</p>
		<div class="nav-menu-widget-form-controls"
            <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
                    <?php echo __( 'Title:', 'bootswatches' );  // WPCS: xss ok. ?>
                </label>
				<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
                    name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"
                    value="<?php echo esc_attr( $title ); ?>"
                 />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'nav_menu' )); ?>">
                    <?php echo __( 'Select Menu:', 'bootswatches' ); // WPCS: xss ok. ?>
                </label>
				<select id="<?php echo esc_attr($this->get_field_id( 'nav_menu' )); ?>"
                    name="<?php echo esc_attr($this->get_field_name( 'nav_menu' )); ?>">
					<option value="0">
                        <?php echo esc_html( '&mdash; Select &mdash;', 'bootswatches' ); ?>
                    </option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>"
                            <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

            <p>
				<label for="<?php echo esc_attr($this->get_field_id( 'menu_style' )); ?>">
                    <?php echo esc_html__( 'Menu Style:', 'bootswatches' ); ?>
                </label>
				<select id="<?php echo esc_attr($this->get_field_id( 'menu_style' )); ?>"
                      name="<?php echo esc_attr($this->get_field_name( 'menu_style' )); ?>">
					<?php
                        foreach ( $menu_styles as $style ) :
                            $label = ucwords(str_replace($find, ' ', $style ));
                    ?>
						<option value="<?php echo esc_attr( $style ); ?>"
                            <?php selected( $saved_style, $style ); ?>>
							<?php echo esc_html( $label ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

			<?php if ( $wp_customize instanceof WP_Customize_Manager ) : ?>
				<p class="edit-selected-nav-menu" style="<?php if ( ! $nav_menu ) { echo 'display: none;'; } ?>">
					<button type="button" class="button"><?php echo esc_html( 'Edit Menu', 'bootswatches' ) ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
	}
}
