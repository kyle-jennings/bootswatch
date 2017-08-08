<?php
/**
 * Widget API: WP_Widget_Categories class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */
/**
 * Core class used to implement a Categories widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Bootswatch_Widget_Categories extends WP_Widget {
	/**
	 * Sets up a new Categories widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_categories',
			'description' => __( 'A list or dropdown of categories.', 'bootswatch' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'categories', __( 'Categories','bootswatch' ), $widget_ops );
	}


    public function dropdown($c, $args, $first_dropdown)
    {

        $dropdown_id = "{$this->id_base}-dropdown-{$this->number}";
        $first_dropdown = false;

        $args['show_option_none'] = __( 'Select Category', 'bootswatch' );
        $args['id'] = $dropdown_id;
        $args['class'] = 'form-control';
        /**
         * Filters the arguments for the Categories widget drop-down.
         *
         * @since 2.8.0
         *
         * @see wp_dropdown_categories()
         *
         * @param array $args An array of Categories widget drop-down arguments.
         */
        wp_dropdown_categories( apply_filters( 'widget_categories_dropdown_args', $args ) );
        ?>

        <script type='text/javascript'>
        /* <![CDATA[ */
        (function() {
        var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );
        function onCatChange() {
            if ( dropdown.options[ dropdown.selectedIndex ].value > 0 ) {
                location.href = "<?php echo esc_url( home_url() ); ?>/?cat=" + dropdown.options[ dropdown.selectedIndex ].value;
            }
        }
        dropdown.onchange = onCatChange;
        })();
        /* ]]> */
        </script>

        <?php
    }


    public function list($c, $style, $cat_args)
    {

        $class = '';
        $elm = 'ul';
        $format = 'html';
        $before = null;
        $li_class = '';
        if($style == 'unordered-list'):
            $elm = 'ul';
        elseif($style == 'ordered-list'):
            $elm = 'ol';
        elseif($style == 'unstyled-list') :
            $class = 'list-unstyled';
        elseif( $style == 'list-group') :
            $class = 'list-group';
            $li_class = 'class="list-group-item"';
            $format = 'custom';
            $before = '<li class="list-group-item">';
        elseif($style == 'pills'):
            $class = 'nav nav-pills nav-stacked';
        endif;

        echo '<'.$elm .' class="widget-list '.$class .'">';

        		$cat_args['title_li'] = '';
        		/**
        		 * Filters the arguments for the Categories widget.
        		 *
        		 * @since 2.8.0
        		 *
        		 * @param array $cat_args An array of Categories widget options.
        		 */
        		$cats = get_categories( apply_filters( 'widget_categories_args', $cat_args ) );
                foreach($cats as $cat){
                    echo '<li '.$li_class.'>';
                        echo '<a href="'.get_category_link($cat->term_id).'">';
                            echo  $cat->name;
                            echo '&nbsp;('.$cat->count.')';
                        echo '</a>';
                    echo '</li>';
                }

        ?>
        		</<?php echo $elml ?>>
        <?php
    }
	/**
	 * Outputs the content for the current Categories widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Categories widget instance.
	 */
	public function widget( $args, $instance ) {
		static $first_dropdown = true;
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories', 'bootswatch' ) : $instance['title'], $instance, $this->id_base );
		$c = ! empty( $instance['count'] ) ? '1' : '0';
		$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
		$d = ! empty( $instance['dropdown'] ) ? '1' : '0';
        $style = ! empty( $instance['menu_style'] ) ? $instance['menu_style'] : 'side_nav';

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$cat_args = array(
			'orderby'      => 'name',
			'show_count'   => $c,
			'hierarchical' => $h
		);

		if ( $style == 'dropdown' ) {
			$this->dropdown($c, $cat_args, $first_dropdown);
		} else {
            $this->list($c, $style, $cat_args);
		}
		echo $args['after_widget'];
	}
	/**
	 * Handles updating settings for the current Categories widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
		$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
		$instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

        if ( ! empty( $new_instance['menu_style'] ) ) {
            $instance['menu_style'] = sanitize_text_field($new_instance['menu_style']);
        }

		return $instance;
	}
	/**
	 * Outputs the settings form for the Categories widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = sanitize_text_field( $instance['title'] );
		$count = isset($instance['count']) ? (bool) $instance['count'] :false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
        $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;

        $saved_style = isset( $instance['menu_style'] ) ? $instance['menu_style'] : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'bootswatch' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" placeholder="<?php esc_attr_e( 'Categories', 'bootswatch' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<!-- <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('dropdown'); ?>" name="<?php echo $this->get_field_name('dropdown'); ?>"<?php checked( $dropdown ); ?> />
		<label for="<?php echo $this->get_field_id('dropdown'); ?>"><?php _e( 'Display as dropdown', 'bootswatch' ); ?></label><br /> -->

		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts', 'bootswatch' ); ?></label><br />

		<!-- <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy', 'bootswatch' ); ?></label></p> -->

        <?php
        // styles
        $find = array('-', '_');
        $menu_styles = array('dropdown', 'unordered-list', 'ordered-list', 'unstyled-list', 'list-group', 'pills');

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'menu_style' ); ?>">
                    <?php _e( 'Menu Style:', 'bootswatch' ); ?>
            </label>
            <select id="<?php echo $this->get_field_id( 'menu_style' ); ?>"
                  name="<?php echo $this->get_field_name( 'menu_style' ); ?>">
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
		<?php
	}
}
