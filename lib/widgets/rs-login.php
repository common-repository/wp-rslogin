<?php

class RS_login extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @var array
	 */
	protected $defaults;
	
	function RS_login(){
		$this->__construct();
	}
	
	/**
	 * Constructor. Set the default widget options and create widget.
	 *
	 * @since 0.1.8
	 */
	function __construct() {

		$this->defaults = array(
			'title'			=> '',
		);

		$widget_ops = array(
			'classname'   => 'rs-login',
			'description' => __( 'This will display RS Login form.', RS_DOMAIN ),
		);

		$control_ops = array(
			'id_base' => 'rs-login',
			'width'   => 240,
			'height'  => 300,
		);

		$this->WP_Widget( 'rs-login', __( 'RS Login Form', RS_DOMAIN ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		
		global $add_seminar_id, $my_profile_id, $my_event_id, $my_cart_id;
		
		extract( $args );

		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;

		?>
		<div class="rs-login-wrapper">
			<?php if( !empty( $instance['title'] ) ): ?>
				<h3 class="widget-title"><?php _e( $instance['title'], RS_DOMAIN ); ?></h3>
			<?php else : ?>
				<h3 class="widget-title"><?php _e('RS Login'); ?></h3>
			<?php endif; ?>
			
			<?php echo do_shortcode('[wp_rslogin]'); ?>
			
		</div>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$new_instance['title']			= $new_instance['title'];
		
		return $new_instance;
	}

	function form( $instance ) {
		/** Merge with defaults */
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		?>
		<div class="widget-body">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', RS_DOMAIN ); ?>:</label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
			</p>
		</div>
		<?php
	}
	
}

?>