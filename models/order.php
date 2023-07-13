<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



class AWOrderModelOrder extends AWOrder{

	

	function getItem($pk=null, $user=null){

		

		$pk = $pk ? $pk : (isset($_GET['ordid']) ? sanitize_title($_GET['ordid']) : 0);

		

		$user = $user ? $user : wp_get_current_user();

		$apiConfigs = unserialize(get_option('apiconfigs'));

		//echo base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret']); exit;

		$args = array(

			'body'=>json_encode(array('user'=>$user->ID, 'order_id'=>$pk)),

			'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),		
			'sslverify' => 0,
			'timeout' => 15

		);
		
		$response=wp_remote_post($this->apihost.'&task=api.get_order', $args);

		$response_data = json_decode(wp_remote_retrieve_body($response));

		

		if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data->error)){
			$response_data->upload_url = str_replace('http:', '', $apiConfigs['apihost']).'?view=api&task=api.upload_files';
			$response_data->uptoken = md5(hash_hmac('sha256', $response_data->file_upload_token.$response_data->id, $apiConfigs['api_secret']));
			return $response_data;

		}

		else{

			$this->setMessage(isset($response_data->error)?$response_data->error:'', 'danger');

			return array();

		}

	}

	

	function getSubjects(){

		global $wpdb;

		$subjects = array();

		foreach($wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'subjects', object) as $subject){

			$subjects[$subject->id] = $subject;

		}

		return (object)$subjects;

	}

	

	function getDoctypes(){

		global $wpdb;

		$doctypes = array();

		foreach($wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'doctypes', object) as $doctype){

			$doctypes[$doctype->id] = $doctype;

		}

		return (object)$doctypes;

	}

	

	function getCountries(){

		global $wpdb;

		$countries = array();

		foreach($wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'country', object) as $country){

			$countries[$country->id] = $country;

		}

		return (object)$countries;

	}

	

	function getAcademicLevels(){		

		global $wpdb;

		$acLevels = array();

		foreach($wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'aclevels', object) as $aclevel){

			$acLevels[$aclevel->id] = $aclevel;

		}

		return (object)$acLevels;

	}

	

	function getUrgency(){		

		global $wpdb;

		$Urgencies = array();

		foreach($wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'urgency', object) as $urgency){

			$Urgencies[$urgency->id] = $urgency;

		}

		return (object)$Urgencies;

	}

	

	function getCoupons(){

		global $wpdb;

		//$wpdb->show_errors();

		$coupons = array();

		foreach($wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'coupons', object) as $coupon){

			$coupons[$coupon->id] = $coupon;

		}

		return (object)$coupons;

	}

	

	function markAdRead($messages){

		$user = wp_get_current_user();

		if($user->ID){

			$apiConfigs = unserialize(get_option('apiconfigs'));

				

			$args = array(

				'method'=>'POST',

				'body'=>json_encode(array('messages'=>$messages)),

				'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret']))

			);

			$response=wp_remote_post($this->apihost.'&task=api.markasread', $args);

			$response_data = json_decode(wp_remote_retrieve_body($response), true);

			

			if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data['error'])){

				return array('successful'=>'yes');

			}

		}

	}

	function getUploadUrl($orderid){

		global $wp_session;

		$user = wp_get_current_user();

		

		if($user->ID){

			$apiConfigs = unserialize(get_option('apiconfigs'));

			

			$args = array(

				'method'=>'POST',

				'body'=>json_encode(array('req'=>'upload_token', 'ordid'=>$orderid)),

				'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),		
			'sslverify' => 0,
			'timeout' => 15

			);
			
			echo $this->apihost.'&task=api.upload_files';
			
			$response=wp_remote_post($this->apihost.'&task=api.upload_files', $args);

			$response_data = json_decode(wp_remote_retrieve_body($response), true);

			if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data['error'])){
				
				$response_data['url']=$apiConfigs['apihost'].'&task=api.upload_files';

				$wp_session['uploadToken']=$user->ID;

				return $response_data;

			}

			else echo json_encode(array('error'=>'An error occured. Try again later'));

		}

		exit;

	}

	

}