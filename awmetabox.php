<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function call_aworder_metabox() {
    new aworder_metabox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_aworder_metabox' );
    add_action( 'load-post-new.php', 'call_aworder_metabox' );
}

class aworder_metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
            $post_types = array('aworder');     //limit meta box to certain post types
            if ( in_array( $post_type, $post_types )) {
		add_meta_box(
			'aworder_metabox'
			,__( 'Order Display Settings', 'aworder_textdomain' )
			,array( $this, 'render_meta_box_content' )
			,$post_type
			,'advanced'
			,'high'
		);
            }
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['aworder_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['aworder_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'aworder_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted,
                //     so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'aworder' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = array('field'=>$_POST['field'], 'view'=>sanitize_text_field( $_POST['aworder_view'] ));
		$menuIcon = $_POST['icon'];

		// Update the meta field.
		update_post_meta( $post_id, '_view', $mydata );
		update_post_meta($post_id, '_menu_icon', $menuIcon);
	}


	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'aworder_inner_custom_box', 'aworder_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_view', true);
		$icon = get_post_meta( $post->ID, '_menu_icon', true);
		//$metafields = get_post_meta( $post->ID, '_view' );
		
		echo '<label for="aworder_view">';
			_e( 'The Order Layout', 'aworder_textdomain' );
		echo '</label> <select name="aworder_view" id="aworder_view" required><option value="">Select</option>';
		$fields=array();
		// Display the form, using the current value.
		$dp=opendir($views=VIEW_PATH);
		while($dir = readdir($dp)){
			if(!is_dir($views.'/'.$dir) || !file_exists($views.'/'.$dir.'/metabox-fields.xml')) continue;
			$xml = simplexml_load_file($views.'/'.$dir.'/metabox-fields.xml');			
			
			foreach($xml->layout as $layout){
				if(!isset($fields[$dir.'_'.(string)$layout['name']]) && $layout->fields->children())
					$fields[$dir.'_'.(string)$layout['name']] = $layout->fields->children()->asXML();
				echo '<option value="'.$dir.'_'.(string)$layout['name'].'" '.($value['view']==$dir.'_'.(string)$layout['name']?'selected':'').'>'.$layout['label'].'</option>';
			}
		}
		closedir($dp);
		echo '</select>';/*</div>*/
		echo '<script>
			(function($){
				$(document).ready(function(){
					var fields = '.json_encode($fields).', subfields='.json_encode(isset($value['field'])?$value['field']:array()).';
					$("#aworder_view").change(function(){
						$("#fields").remove();
						if(fields[$(this).val()]){
							$(this).after(\'<div id="fields"><p>Select how you would like this to be loaded</p>\'+fields[$(this).val()]+\'</div>\');
							$("#fields").find("select, input, textarea").each(function(){
								if(subfields[$(this).attr("name")]) $(this).val(subfields[$(this).attr("name")]);
								$(this).attr("name", "field["+$(this).attr("name")+"]");
							});
						}
					}).trigger("change");
				});
			})(jQuery)
		</script>';
	}
}