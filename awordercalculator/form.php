<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>