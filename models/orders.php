<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



class AWOrderModelOrders extends AWOrder{

	

	function getOrders($status=null){

		

		$user = wp_get_current_user();

		$apiConfigs = unserialize(get_option('apiconfigs'));

		

		$body = array('user'=>$user->ID, 'origin'=>get_site_url());

		$params = $this->getParams();

		if($status && $status != 'my_projects') $body['status'] = $status;

		elseif(isset($params['status']) && $params['status'] != 'my_projects') $body['status'] = $params['status'];

		if(isset($body['status']) && strtolower($body['status'])=='completed') $body['status'] = 'Complete';

			/*print_r($body);
			exit;*/

		$args = array(

			'body'=>json_encode($body),

			'headers' => array( 
				"Content-type" => "application/json", 
				"Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret']),	
			),			
			'sslverify' => 0,
			'timeout' => 15,
			'httpversion' => '1.1', 

		);

		$response=wp_remote_post($this->apihost.'&task=api.get_orders', $args);
		
		/*echo $this->apihost.'&task=api.get_orders';
		print_r($response);
		exit;	*/
		$response_data = json_decode(wp_remote_retrieve_body($response));	
		

		if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data->error)){

			return $response_data;

		}

		else{
			
			if(!is_array($response)){
				print_r( $response );
			}
			else $this->setMessage(isset($response_data->error)?$response_data->error:$response['response']['message'], 'danger');

			return array();

		}

		

	}

	

	function getStats(){

		$user = wp_get_current_user();

		if($user->ID){

			$apiConfigs = unserialize(get_option('apiconfigs'));

			

			$args = array(

					'body'=>json_encode(array('user'=>$user->ID, 'origin'=>get_site_url())),
	
					'headers' => array(
						"Content-type" => "application/json", 
						"Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])
					),
				
					'sslverify' => 0,
					'timeout' => 15
			);
			
			
			$response=wp_remote_post($this->apihost.'&task=api.get_order_stats', $args);
			
			$response_data = json_decode(wp_remote_retrieve_body($response), true);
			

			if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data->error)){

				return $response_data;

			}

			else{

				$this->setMessage(isset($response_data->error)?$response_data->error:'', 'danger');

				return array();

			}

		}

		return array();

	}

}