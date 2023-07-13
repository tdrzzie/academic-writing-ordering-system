<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



class setup{	

	

	var $pages = array(

			array('title'=>'My Orders', 'name'=>'myorders', 'title_tag'=>'myorders_title', 'name_tag'=>'myorders_name', 'id_tag'=>'myorders_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'paid')))),

			

			array('title'=>'Place Order', 'name'=>'placeorder', 'title_tag'=>'placeorder_title', 'name_tag'=>'placeorder_name', 'id_tag'=>'placeorder_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'order_edit', 'field'=>array()))),

			

			array('title'=>'Order', 'name'=>'order', 'title_tag'=>'order_title', 'name_tag'=>'order_name', 'id_tag'=>'order_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'order_default', 'field'=>array()))),

			

			array('title'=>'Pending', 'name'=>'pending', 'title_tag'=>'pending_title', 'name_tag'=>'pending_name', 'id_tag'=>'peinding_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'Pending')))),

			

			array('title'=>'Assigned', 'name'=>'assigned', 'title_tag'=>'assigned_title', 'name_tag'=>'assigned_name', 'id_tag'=>'assigned_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'Assigned')))),

			

			array('title'=>'Revision', 'name'=>'revision', 'title_tag'=>'revision_title', 'name_tag'=>'revision_name', 'id_tag'=>'revision_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'Revision')))),

			

			array('title'=>'Complete', 'name'=>'complete', 'title_tag'=>'complete_title', 'name_tag'=>'complete_name', 'id_tag'=>'complete_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'Completed')))),

			

			array('title'=>'Rejected', 'name'=>'rejected', 'title_tag'=>'rejected_title', 'name_tag'=>'rejected_name', 'id_tag'=>'rejected_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'Rejected')))),

			

			array('title'=>'Unpaid', 'name'=>'unpaid', 'title_tag'=>'unpaid_title', 'name_tag'=>'unpaid_name', 'id_tag'=>'unpaid_id', 'meta'=>array('key'=>'_view', 'value'=>array('view'=>'orders_default', 'field'=>array('status'=>'Unpaid')))),

			

		);
		

	function install(){

		$this->execute(THEBASE.'/sql/install.sql');

		foreach($this->pages as $page) $this->addPage($page);

		

		update_option('_apihost', 'https://zimplugs.com');
		
		update_option('_fields', json_encode(array('total'=>1, 'service'=>1, 'doctype'=>1, 'aclevel'=>1, 'ordsubj'=>1, 
													'pages'=>1, 'spacing'=>1, 'urgency'=>1, 'sources'=>1, 'style'=>1, 'slides'=>1, 
													't10w'=>1, 'vipsupport'=>1, 'english'=>1, 'couponcode'=>1, 'country'=>1, 'phone'=>1
												)));

		

		if(file_exists(ABSPATH.'.htaccess')) rename(ABSPATH.'.htaccess', ABSPATH.'.htaccess.txt');

		

		$fp = fopen(ABSPATH.'.htaccess', 'w');

		$str = '# BEGIN WordPress 

<IfModule mod_rewrite.c> 

RewriteEngine On



RewriteBase /

RewriteRule ^index\.php$ - [L]

RewriteCond %{REQUEST_FILENAME} !-f

RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule . /index.php [L]

 

SetEnvIf Authorization .+ HTTP_AUTHORIZATION=$0

RewriteRule \/aworder\/order\?task=order\.varify\_upload\&ordid=[0-9]$ – [E=HTTP_AUTHORIZATION:%{HTTP:Authorization},L]

</IfModule>



# END WordPress';

		fwrite($fp, $str);

		fclose($fp);

		

		

	}

	

	function uninstall(){

		$this->execute(THEBASE.'/sql/uninstall.sql');

		foreach($this->pages as $page) $this->removePage($page);

		delete_option('_apihost');
		delete_option('_fields');

	}

	

	private function execute($file){

		

		global $wpdb;

		

		if(file_exists($file)){

			$queries=array(); $sql='';

			

			$fp=fopen($file, 'r');

			while(! feof($fp)){

				$sql.=str_replace(array('\r', '\n'), '', trim(fgets($fp)));

				if(substr($sql, -1, strlen($sql)) == ';'){

					$queries[]=$sql;

					$sql='';

				}

			}

			fclose($fp);

			

			foreach($queries as $query) $wpdb->query(str_replace('#__', $wpdb->prefix, $query));

		}

	}

	

	private function addPage($p){

		

		$title=$p['title'];

		$name=$p['name'];

		$title_tag=$p['title_tag'];

		$name_tag=$p['name_tag'];

		$id_tag=$p['id_tag'];

		$metas=$p['meta'];

		

		

		 global $wpdb;



		$the_page_title = $title;

		$the_page_name = $name;

	

		// the menu entry...

		delete_option($title_tag);

		add_option($title_tag, $the_page_title, '', 'yes');

		// the slug...

		delete_option($name_tag);

		add_option($name_tag, $the_page_name, '', 'yes');

		// the id...

		delete_option($id_tag);

		add_option($id_tag, '0', '', 'yes');

		

		

		// Create post object

		$_p = array();

		$_p['post_title'] = $the_page_title;

		$_p['post_content'] = "[opskill_accademic_writing_orders]";

		$_p['post_status'] = 'publish';

		$_p['post_type'] = 'aworder';

		$_p['comment_status'] = 'closed';

		$_p['ping_status'] = 'closed';

		$_p['post_name'] = $the_page_name;

		$_p['post_category'] = array(1); // the default 'Uncatrgorised'

	

		$the_page = get_page_by_title( $the_page_title );

	

		if ( ! $the_page ) {

	

			// Insert the post into the database

			$the_page_id = wp_insert_post( $_p );

			

			add_post_meta($the_page_id, $metas['key'], $metas['value']);

	

		}

		else {

			// the plugin may have been previously active and the page may just be trashed...

			

			$_p['ID'] = $the_page_id = $the_page->ID;

	

			//make sure the page is not trashed...

			$_p['post_status'] = 'publish';

			$the_page_id = wp_update_post( $_p );

	

		}

	

		delete_option( $id_tag );

		add_option( $id_tag, $the_page_id );

	

	}

	

	private function removePage($p){

		

		$title=$p['title'];

		$name=$p['name'];

		$title_tag=$p['title_tag'];

		$name_tag=$p['name_tag'];

		$id_tag=$p['id_tag'];

		$metas=$p['meta'];

		

		global $wpdb;



		$the_page_title = get_option( $title_tag );

		$the_page_name = get_option( $name_tag );

	

		//  the id of our page...

		$the_page_id = get_option( $id_tag );

		if( $the_page_id ) {

			

			delete_post_meta($the_page_id, $metas['key']);

			wp_delete_post( $the_page_id ); // this will trash, not delete

	

		}

	

		delete_option($title_tag);

		delete_option($name_tag);

		delete_option($id_tag);

	}

	

}

