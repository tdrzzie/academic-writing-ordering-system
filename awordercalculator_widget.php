<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Order calculator widget
 */
 
require_once THEBASE.'/models/order.php';
 
class Awordercalculator_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	
	public $order;
	 
	function __construct() {
		$this->order = new AWOrderModelOrder();
		parent::__construct(
			'awordercalculator_widget', // Base ID
			__( 'Order Calculator', 'text_domain' ), // Name
			array( 'description' => __( 'This is a calculator for calculating the cost of an order', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $ordmdl;
		echo $args['before_widget'];
		include THEBASE.'/awordercalculator/widget.php';
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		include_once THEBASE.'/awordercalculator/form.php';
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget