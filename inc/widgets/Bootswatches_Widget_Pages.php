<?php
/**
 * Widget API: WP_Widget_Pages class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */
/**
 * Core class used to implement a Pages widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Bootswatches_Widget_Pages extends WP_Widget {
	/**
	 * Sets up a new Pages widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_pages',
			'description' => __( 'A list of your site&#8217;s Pages.', 'bootswatch' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'pages', __( 'Pages', 'bootswatch' ), $widget_ops );
	}


    public function dropdown_js($dropdown_id)
    {

        ob_start();
        ?>
        <script type='text/javascript'>
        /* <![CDATA[ */
        (function() {
        var dropdown = document.getElementById( "<?php echo esc_js( $dropdown_id ); ?>" );

        function onCommentChange() {
            if (dropdown.selectedIndex <= 0 )
                return false;

            location.href = dropdown.options[ dropdown.selectedIndex ].value;
        }
        dropdown.onchange = onCommentChange;
        })();
        /* ]]> */
        </script>
        <?php
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }


    public function dropdown($sortby, $exclude, $show_children = 0)
    {
        $dropdown_id = "{$this->id_base}-dropdown-{$this->number}";

        $output = '';
		$output .= '<select class="form-control" id="'.$dropdown_id.'">';
        $output .= '<option>-- Select Page --</option>';
        $pages = get_pages(array(
            'sort_column' => $sortby,
            'exclude' => $exclude,
            'depth' => 1
        ));


        $last_id = 0;
        foreach($pages as $page){

            // sets the indent
            $indent = ($show_children == '1' && $page->post_parent > 0)
                ? '&nbsp;&nbsp; - ' : '' ;

            $output .= '<option value="'.get_permalink($page->ID).'">';
                $output .= $indent . $page->post_title;
            $output .= '</option>';
        }
        $output .= '</select>';
        $output .= $this->dropdown_js($dropdown_id);

        echo $output; //WPCS: xss ok;
    }


    public function child_menu($children, $style)
    {

        $class = '';
        $elm = 'ul';
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
        elseif($style == 'pills'):
            $class = 'nav nav-pills nav-stacked';
        endif;


        $output = '';
        $output .= '<'.$elm.' class="widget-list '.$class.'">';
        foreach($children as $child){
            $output .= '<li '.$li_class.'>';
                $output .= '<a href="'.get_permalink($child->ID).'">';
                    $output .= $child->post_title;
                $output .= '</a>';
            $output .= '</li>';
        }
        $output .= '</'.$elm.'>';

        return $output;
    }

    public function menu($sortby, $exclude, $style, $show_children)
    {

        $class = '';
        $elm = 'ul';
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
        elseif($style == 'pills'):
            $class = 'nav nav-pills nav-stacked';
        endif;

        $output = '';
		$output .= '<'.$elm.' class="widget-list '.$class.'">';

        $pages = get_pages(array(
            'sort_column' => $sortby,
            'exclude' => $exclude,
            'parent' => 0
        ));

        $children = array();
        if($show_children == '1'):
            $children_q = get_pages(array(
                'sort_column' => $sortby,
                'exclude' => $exclude,
            ));

            foreach($children_q as $child) {
                if($child->post_parent > 0){
                    $children[$child->post_parent][] = $child;
                }
            }
        endif;


        $last_id = 0;
        foreach($pages as $page){

            $output .= '<li '.$li_class.'>';
                $output .= '<a href="'.get_permalink($page->ID).'">';
                    $output .= $page->post_title;
                $output .= '</a>';

                if(!empty($children[$page->ID]))
                    $output .= $this->child_menu($children[$page->ID], $style);

            $output .= '</li>';

            $last_id = $page->ID;

        }

        $output .= '</'.$elm.'>';

        echo $output;  //WPCS: xss ok;
    }

	/**
	 * Outputs the content for the current Pages widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Pages widget instance.
	 */
	public function widget( $args, $instance ) {
		/**
		 * Filters the widget title.
		 *
		 * @since 2.6.0
		 *
		 * @param string $title    The widget title. Default 'Pages'.
		 * @param array  $instance An array of the widget's settings.
		 * @param mixed  $id_base  The widget ID.
		 */
         $children = ! empty( $instance['children'] ) ? '1' : '0';

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? null : $instance['title'], $instance, $this->id_base );
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];
		if ( $sortby == 'menu_order' )
			$sortby = 'menu_order, post_title';

        $style = ! empty( $instance['menu_style'] ) ? $instance['menu_style'] : 'side_nav';

		/**
		 * Filters the arguments for the Pages widget.
		 *
		 * @since 2.8.0
		 *
		 * @see wp_list_pages()
		 *
		 * @param array $args An array of arguments to retrieve the pages list.
		 */
		$depth = ($children == '1') ? 2 : 1;
		$out = wp_list_pages( apply_filters( 'widget_pages_args', array(
			'title_li'    => '',
			'echo'        => 0,
			'sort_column' => $sortby,
			'exclude'     => $exclude,
            'depth'       => $depth
		) ) );

        // if no pages exists, just return false. this prevents further code
        // execution as well as prevents WP's original nested conditionals.
		if ( empty( $out ) )
            return false;

		echo $args['before_widget']; //WPCS: xss ok;
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title']; //WPCS: xss ok;
		}

        if($style == 'dropdown') {
            $this->dropdown($sortby, $exclude, $children);
        } elseif($style !== 'list') {
            $this->menu($sortby, $exclude, $style, $children);
        } else {
            echo '<ul>';
                echo $out;  //WPCS: xss ok;
            echo '</ul>';
        }

		echo $args['after_widget']; //WPCS: xss ok;

	}
	/**
	 * Handles updating settings for the current Pages widget instance.
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
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}
		$instance['exclude'] = sanitize_text_field( $new_instance['exclude'] );
        $instance['children'] = !empty($new_instance['children']) ? 1 : 0;

        if ( ! empty( $new_instance['menu_style'] ) ) {
            $instance['menu_style'] = sanitize_text_field($new_instance['menu_style']);
        }

		return $instance;
	}
	/**
	 * Outputs the settings form for the Pages widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'post_title', 'title' => '', 'exclude' => '') );
        $saved_style = isset( $instance['menu_style'] ) ? $instance['menu_style'] : '';
        $children = isset( $instance['children'] ) ? (bool) $instance['children'] : false;

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php echo __( 'Title:', 'bootswatch' );  // WPCS: xss ok.?>
            </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                placeholder="<?php echo esc_attr__( 'Pages', 'bootswatch' ); ?>"
                type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"
            />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sortby' ) ); ?>">
                <?php echo __( 'Sort by:', 'bootswatch' ); // WPCS: xss ok. ?>
            </label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'sortby' ) ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'sortby' ) ); ?>"
                class="widefat"
            >
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>>
                    <?php echo __('Page title', 'bootswatch');  // WPCS: xss ok.?>
                </option>
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>>
                    <?php echo __('Page order', 'bootswatch');  // WPCS: xss ok.?>
                </option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>>
                    <?php echo __( 'Page ID', 'bootswatch' );  // WPCS: xss ok.?>
                </option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>">
                <?php echo __( 'Exclude:', 'bootswatch' );  // WPCS: xss ok. ?>
            </label>
			<input type="text" value="<?php echo esc_attr( $instance['exclude'] ); ?>"
                name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>"
                id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" class="widefat"
            />
			<br />
			<small><?php  echo __( 'Page IDs, separated by commas.', 'bootswatch' );  // WPCS: xss ok. ?></small>
		</p>

        <p>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('children')); ?>"
                name="<?php echo esc_attr($this->get_field_name('children')); ?>"<?php checked( $children ); ?>
            />
    		<label for="<?php echo esc_attr($this->get_field_id('children')); ?>">
                <?php echo __( 'Show child pages', 'bootswatch' );  // WPCS: xss ok.?>
            </label>
        </p>


        <?php
        // styles
        $find = array('-', '_');
        $menu_styles = array('dropdown', 'unordered-list', 'ordered-list', 'unstyled-list', 'list-group', 'pills');

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'menu_style' )); ?>">
                    <?php echo __( 'Menu Style:', 'bootswatch' );  // WPCS: xss ok.?>
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

		<?php
	}
}