<?php
/**
 * Widget API: WP_Widget_Calendar class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Calendar widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class Bootswatches_Widget_Calendar extends WP_Widget {
	/**
	 * Ensure that the ID attribute only appears in the markup once
	 *
	 * @since 4.4.0
	 *
	 * @static
	 * @access private
	 * @var int
	 */
	private static $instance = 0;

	/**
	 * Sets up a new Calendar widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_calendar',
			'description' => __( 'A calendar of your site&#8217;s Posts.', 'bootswatch' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'calendar', __( 'Calendar', 'bootswatch' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Calendar widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {
		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget']; //WPCS: xss ok.
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];  //WPCS: xss ok.
		}
		if ( 0 === self::$instance ) {
			echo '<div id="calendar_wrap" class="calendar_wrap">';
		} else {
			echo '<div class="calendar_wrap">';
		}

        $search = '/(<table id)/';
        $replace = '<table class="table" id';
		$cal = get_calendar(true, false);
        $cal = preg_replace($search, $replace, $cal);
        echo $cal;  //WPCS: xss ok.
		echo '</div>';
		echo $args['after_widget'];  //WPCS: xss ok.

		self::$instance++;
	}

	/**
	 * Handles updating settings for the current Calendar widget instance.
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

		return $instance;
	}

	/**
	 * Outputs the settings form for the Calendar widget.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = sanitize_text_field( $instance['title'] );
		?>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php echo __('Title:', 'bootswatch');  // WPCS: xss ok. ?>
            </label>
	          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
              name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
              value="<?php echo esc_attr($title); ?>" />
      </p>
		<?php
	}
}
