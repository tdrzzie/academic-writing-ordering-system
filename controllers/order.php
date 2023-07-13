<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once HELPERS_PATH.'/validation.php';

class AWOrderControllerOrder extends AWOrder{
	
	function getModel(){
		if(class_exists('AWOrderModelOrder')) return new AWOrderModelOrder();
		return false;
	}
	
	function save(){		
		$user = wp_get_current_user();
		$fields = json_decode(get_option("_fields", '[]'), true);
		
		$validation = new validation();
		$validation->set_rules('ordtopic', 'Order Topic', 'required|trim');
		if(isset($fields['service'])) $validation->set_rules('service', 'Service Type', 'required|trim');
		if(isset($fields['doctype'])) $validation->set_rules('doctype', 'Document Type', 'required|trim|integer');
		if(isset($fields['aclevel'])) $validation->set_rules('aclevel', 'Academic Level', 'required|trim|integer');
		if(isset($fields['ordsubj'])) $validation->set_rules('ordsubj', 'Order Subject', 'required|trim|integer');
		if(isset($fields['pages'])) $validation->set_rules('pages', 'Pages', 'required|trim|integer');
		if(isset($fields['pages'])) $validation->set_rules('words', 'Number of Words', 'required|trim|integer');
		if(isset($fields['style'])) $validation->set_rules('style', 'Paper Format', 'trim');
		if(isset($fields['urgency'])) $validation->set_rules('urgency', 'Urgency', 'required|trim');
		$validation->set_rules('urg_id', 'Urgency ID', 'required|trim|integer');
		if(isset($fields['sources'])) $validation->set_rules('sources', 'Number of Sources', 'trim|integer');
		if(isset($fields['slides'])) $validation->set_rules('slides', 'Number of Slides', 'trim|integer');
		if(isset($fields['english'])) $validation->set_rules('english', 'English', 'required|trim');
		$validation->set_rules('currency', 'Currency', 'required|trim');
		$validation->set_rules('desciption', 'Order Description', 'required|trim');
		if(isset($fields['couponcode'])) $validation->set_rules('couponcode', 'Coupon Code', 'trim');
		if(isset($fields['minamount'])) $validation->set_rules('minamount', 'Amount To Pay', 'required|trim|float');
		
		if($valid_data = $validation->run()){
			$valid_data = array_merge(array('user'=>$user->ID, 'origin'=>get_site_url(), 'order_id'=>(int)sanitize_text_field($_POST['order_id'])), $valid_data);
			
			$valid_data['spacing'] = isset($_POST['spacing']) ? 2 : 1;
			$valid_data['t10w'] = isset($_POST['t10w']) ? (float)sanitize_text_field($_POST['t10w']) : 0;
			$valid_data['vipsupport'] = isset($_POST['vipsupport']) ? (float)sanitize_text_field($_POST['vipsupport']) : 0;
			if(isset($_POST['full_name'])) $valid_data['full_name']=sanitize_text_field($_POST['full_name']);
			if(isset($_POST['email'])) $valid_data['email']=sanitize_email($_POST['email']);
			if(isset($_POST['username'])) $valid_data['username']=sanitize_user($_POST['username'], true);
			if(isset($_POST['password'])) $valid_data['password']=sanitize_text_field($_POST['password']);
			if(isset($_POST['country'])) $valid_data['country']=(int)sanitize_text_field($_POST['country']);
			if(isset($_POST['phone'])) $valid_data['phone']=sanitize_text_field($_POST['phone']);
			if(!isset($_POST['aclevel'])) $valid_data['aclevel']=4;
			if(!empty($fields)) $valid_data['fields']=$fields;
			
			$autologin=false;
			if(!$user->ID){
				if(email_exists($valid_data['email'])){
					$this->setMessage('The email address already exists', 'danger');
				}
				elseif(username_exists($valid_data['username'])){
					$this->setMessage('The username already exists', 'danger');
				}
				else{
					$password = wp_hash_password($valid_data['password']);
					$user_id = wp_create_user ( $valid_data['username'], $valid_data['password'], $valid_data['email'] );
					$name = explode(' ', $valid_data['full_name']);
					wp_update_user(array(
						'ID'=>$user_id, 
						'nickname'=>$valid_data['username'],
						'first_name'=>$name[0],
						'last_name'=>count($name)>1?$name[1]:$name[0],
						'country'=>$valid_data['country'],
						'phone'=>$valid_data['phone']
					));
					$currentUser = new WP_User( $user_id );
					$currentUser->set_role( 'subscriber' );
					$user=$currentUser;
					$autologin=true;
					$valid_data['user'] = $user->ID;
					
					$emailBody = '<p><strong>Dear '.$valid_data['full_name'].'</strong></p>'
								.'<p>You  have successfully registered in our site '.str_replace('http://', '', get_site_url()).' and the following is  your credentials</p>'
								.'<p><strong>Username:</strong> '.$valid_data['username'].'<br>'
								.'<strong>Password:</strong> '.$valid_data['password'].'</p>'
								.'<p><strong>Regards<br>'
								.'Support Team</p>'
								.'<strong>'.get_site_url().'</strong>';
					$this->sendEmail($valid_data['email'], 'Thank you for registering with '.get_site_url(), $emailBody);
				}
			}
			
			if($user->ID){
				$model = $this->getModel();
				$doctypes = (array)$model->getDoctypes();
				$subjects = (array)$model->getSubjects();
				$levels = (array)$model->getAcademicLevels();
				$urgencys = (array)$model->getUrgency();
				$currency = unserialize(get_option('_currency'));
				
				$cexr = isset($currency[$valid_data['currency']]) ? $currency[$valid_data['currency']]['exchange_rate'] : 1;
				
				if(isset($fields['total'])):
					
					$pages= isset($valid_data['pages']) ? $valid_data['pages'] : 1;
					$spacing= isset($valid_data['spacing']) ? $valid_data['spacing'] : 1;
					$level = isset($valid_data['aclevel']) ? $levels[$valid_data['aclevel']]->amount : 1;
					$urgency = isset($valid_data['urg_id']) ? $urgencys[$valid_data['urg_id']]->amount : 1;
					$top10cost = $valid_data['t10w'];
					$vipcost = $valid_data['vipsupport'];
					$essayType = isset($valid_data['doctype']) ? $doctypes[$valid_data['doctype']]->amount : 1;
					$revieworedit_per = $valid_data['service'] == 'Revision / Editing' ? get_option('_revedit_percentage', 0.3) : 1;
					
					$valid_data['total'] = round( ( ( (( $level + $urgency + $top10cost ) * ($pages * $essayType * $spacing)) + $vipcost ) * $revieworedit_per) * $cexr, 2);
				
				else:
				
					$top10cost = $valid_data['t10w'];
					$vipcost = $valid_data['vipsupport'];
					$valid_data['total'] = round( ($valid_data['minamount'] + $top10cost + $vipcost) * $cexr, 2 );
					
				endif;
				
				if(isset($valid_data['couponcode']) && strlen($valid_data['couponcode'])){
					global $wpdb;
					$coupon = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."coupons WHERE code LIKE '".$valid_data['couponcode']."' AND status LIKE 'ACTIVE'" );
					if(!empty($coupon) && $valid_data['total'] >= $coupon->min_amount){
						$valid_data['total']-=$valid_data['total']*$coupon->discount;
					}
				}
				
				$apiConfigs = unserialize(get_option('apiconfigs'));
				$valid_data['payment_status'] = 'NOT PAID';
				
				$args = array(
					'method'=>'POST',
					'body'=>json_encode($valid_data),
					'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),		
					'sslverify' => 0,
					'timeout' => 15
				);
				
				$response=wp_remote_post($this->apihost.'&task=api.save_order', $args);
				$response_data = json_decode(wp_remote_retrieve_body($response), true);
				
				if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data['error'])){
					if($autologin){
						wp_set_current_user($user->ID, $valid_data['first_name']);
						wp_set_auth_cookie( $user->ID );
					}
					$this->setMessage('Order Saved', 'success');
									
					ob_start();
						$order = $valid_data;
						$order['doctype'] = $doctypes[$order['doctype']]->type;
						$order['subject'] = $subjects[$order['ordsubj']]->subject;
						$order['level'] = $levels[$order['aclevel']]->level;
						$order['amount'] = $order['currency'].' '.number_format($order['total'], 2);
						include_once VIEW_PATH.'/order/tmpl/foremail.php';
					$orderTbl = ob_get_clean();
					
					$link=get_site_url().'/aworder/order/?view=order&ordid='.$response_data['ordid'];
					$emailBody = '<p><strong>Dear '.(isset($user->data->first_name)?$user->data->first_name:$user->data->display_name).',</strong></p>
								<p>You  have successfully placed an order <a href="'.$link.'">#'.$response_data['order_id'].'</a> and the following are the details</p>'
								.$orderTbl
								.'<p>Please click <a href="'.$link.'">here</a> to pay for your order.</p>
									<p>Once the payments are done, we will assign your order to a writer immediately. </p>
									<p>Please do not hesitate to find us on chat suppose you need further support.</p>
									<p>Regards,<strong><br>
									</strong>Support  Team <strong><br/>'
								.'<strong>'.get_site_url().'</strong>';
					
					$this->sendEmail($user->data->user_email, 'Your Order #'.$response_data['order_id'].' was successfully received', $emailBody);
					header('Location: '.site_url('/order/?view=order&task=order.email_notify&ordid='.$response_data['ordid']));
					//wp_redirect( site_url('/order/?view=order&task=order.email_notify&ordid='.$response_data['ordid']) );
				}
				else{
					if(!is_array($response)) $this->setMessage(wp_remote_retrieve_response_message($response), 'danger');
					else $this->setMessage(isset($response_data['danger'])?$response_data['error']:$response['response']['message'], 'danger');
				}
				header('Location: '.site_url('/order/?view=order&ordid='.$response_data['ordid']));
				//wp_redirect( site_url('/order/?view=order&ordid='.$response_data['ordid']) );
			}
		}
		else $this->setMessage('The following errors occured: <p>'.implode('</p><p>', $validation->errors).'</p>', 'danger');;
		
	}
	
	function email_notify(){
		$postdata = array();
		foreach($_GET as $key=>$val) $postdata[$key]=sanitize_text_field($val);
		$apiConfigs = unserialize(get_option('apiconfigs'));
		$args = array(
			'method'=>'POST',
			'body'=>json_encode(array('order'=>$postdata['ordid'])),
			'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),		
			'sslverify' => 0,
			'timeout' => 15
		);
		//echo $this->apihost.'&task=api.save_order<br/>';
		$response=wp_remote_post($this->apihost.'&task=api.new_order_email', $args);
		//print_r($response); exit;
		$response_data = json_decode(wp_remote_retrieve_body($response), true);
		
		wp_remote_retrieve_response_code($response)==200 && !isset($response_data['error']);
		sleep(1);
		wp_redirect( get_site_url().'/order/?view=order&ordid='.$postdata['ordid'] );
	}
	
	function set_status(){
		
		$user = wp_get_current_user();
		
		if($user->ID){
			$apiConfigs = unserialize(get_option('apiconfigs'));
			$status = sanitize_text_field($_GET['status']);
			$orderid = (int)$_GET['id'];
			
			$args = array(
				'method'=>'POST',
				'body'=>json_encode(array('status'=>$status, 'ordid'=>$orderid)),
				'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),
				'sslverify' => false
			);
			$response=wp_remote_post($this->apihost.'&task=api.set_status', $args);
			$response_data = json_decode(wp_remote_retrieve_body($response), true);
			if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data['error'])){
				echo json_encode(array('success'=>'Status Changed'));
			}
			else echo json_encode(array('error'=>'An error occured. Try again later'));
		}
		else{
			echo json_encode(array('error'=>'Please Login', 'redirect'=>get_site_url().'/wp-login.php'));
		}
		exit;
	}
	
	function sendmessage(){
		$user = wp_get_current_user();
		$apiConfigs = unserialize(get_option('apiconfigs'));
		if($user->ID){
			$args = array(
				'method'=>'POST',
				'body'=>json_encode(array('message'=>sanitize_text_field($_POST['message']), 'ordid'=>sanitize_text_field($_POST['orderid']), 'to'=>'admin')),
				'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),
				'sslverify' => false
			);
			$response=wp_remote_post($this->apihost.'&task=api.send_message', $args);
			$response_data = json_decode(wp_remote_retrieve_body($response), true);

			if(wp_remote_retrieve_response_code($response)==200 && !isset($response_data['error'])){
				$this->setMessage('Message Sent', 'success');
			}
			else $this->setMessage('Message not sent', 'warning');
			wp_redirect(get_site_url().'/order?ordid='.$_POST['orderid'].'#messages');
		}
		else auth_redirect();
	}
	
	function payment(){
		$user = wp_get_current_user();
		if($user->ID){
			if(isset($_GET['state']) && isset($_GET['ordid'])){
				switch($_GET['state']){
					case 'cancelled':
						$this->setMessage('Please complete your order payment', 'warning');
					break;
					case 'done':
						$apiConfigs = unserialize(get_option('apiconfigs'));
						$args = array(
							'method'=>'POST',
							'body'=>json_encode(array('payment_status'=>'PENDING PAYMENT', 'ordid'=>$_GET['ordid'])),
							'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),
							'sslverify' => false
						);
						$response=wp_remote_post($this->apihost.'&task=api.set_paymentstatus', $args);
						//print_r($response); exit;
						$response_data = json_decode(wp_remote_retrieve_body($response), true);
						
						$this->setMessage('You have successfull completed the payment process. We will notify you once we receive payment', 'success');
					break;
				}
				wp_redirect(get_site_url().'/order?ordid='.sanitize_text_field($_GET['ordid']));
			}
			else wp_redirect(get_site_url());
			exit;
		}
		else auth_redirect();
	}
	
	function PDTResponse(){
		
		list($orderid, $userid) = explode('-', sanitize_text_field($_GET['item_number']));
		
		$pp_hostname = "www.sandbox.paypal.com"; // Change to www.paypal.com to test against sandbox
		
		$apiConfigs = unserialize(get_option('apiconfigs'));

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-synch';
		 
		$tx_token = sanitize_text_field($_GET['tx']);
		$auth_token = $apiConfigs['paypalidt'];
		$req .= "&tx=$tx_token&at=$auth_token";
		 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		//set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
		//if your server does not bundled with default verisign certificates.
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
		$res = curl_exec($ch);
		curl_close($ch);
		
		if(!$res){
			$this->setMessage('Payment Failed', 'danger');
		}
		else{
			 // parse the data
			$lines = explode("\n", $res);
			$keyarray = array();
			if (strcmp ($lines[0], "SUCCESS") == 0) {
				for ($i=1; $i<count($lines);$i++){
					list($key,$val) = explode("=", $lines[$i]);
					$keyarray[urldecode($key)] = urldecode($val);
				}
				
				$payment_status = $keyarray['payment_status'];
				$payment_amount = $keyarray['mc_gross'];
				$payment_currency = $keyarray['mc_currency'];
				$txn_id = $keyarray['txn_id'];
				$receiver_email = $keyarray['receiver_email'];
				$payer_email = $keyarray['payer_email'];
				
				$model = $this->getModel();
				$item=$model->getItem((int)$orderid, (int)($userid));
				
				if(strtolower($payment_status) === 'completed' && $apiConfigs['paypalemail'] == $receiver_email){
					$item_payment_status = 'COMPLETE';
					if($payment_amount < $item->amount){
						$item_payment_status = 'BALANCE REMAINING';
					}
					
					$args = array(
						'method'=>'POST',
						'body'=>json_encode(array('payment_status'=>$item_payment_status, 'ordid'=>$item->id, 'txn_id'=>$txn_id, 'payment_data'=>json_encode($keyarray))),
						'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),
						'sslverify' => false
					);
					$response=wp_remote_post($this->apihost.'&task=api.set_paymentstatus', $args);
					$response_data = json_decode(wp_remote_retrieve_body($response), true);
					
					$user=get_userdata( $item->user );
					
					$emailBody = '<p><strong>Dear '.$user->data->first_name .'</strong><br>
								  Thank  you for paying for order <a href="'.get_site_url().'/aworder/order/?view=order&ordid='.$item->id.'">#'.$item->order_id.'</a>,<br>
								  Your  order has been assigned to a writer and is under progress. </p>
								<p>Please  do not hesitate to view the details online or find us on chat.</p>
								<p>Regards<strong><br>
								  </strong>Support  Team</p>'
								.'<strong>'.get_site_url().'</strong>';
								
					$this->sendEmail($user->data->user_email, 'You have Successfully paid for order #'.$item->order_id, $emailBody);
					
					$this->setMessage('Payment Complete', 'success');
				}
				else $this->setMessage('Payment not yet complete', 'warning');
			}
			else if (strcmp ($lines[0], "FAIL") == 0) {
				$this->setMessage('Payment Failed', 'danger');
			}			
		}
		wp_redirect(get_site_url().'/order?ordid='.$orderid);
	}
	
	function payment_listener(){
		
		// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
		// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
		// Set this to 0 once you go live or don't require logging.
		define("DEBUG", 1);
		
		// Set to 0 once you're ready to go live
		define("USE_SANDBOX", 0);
		
		
		define("LOG_FILE", "./ipn.log");
		
		
		// Read POST data
		// reading posted data directly from $_POST causes serialization
		// issues with array data in POST. Reading raw POST data from input stream instead.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}
		
		// Post IPN data back to PayPal to validate the IPN data is genuine
		// Without this step anyone can fake IPN data
		
		if(USE_SANDBOX == true) {
			$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		} else {
			$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
		}
		
		$ch = curl_init($paypal_url);
		if ($ch == FALSE) {
			return FALSE;
		}
		
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		
		if(DEBUG == true) {
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		}
		
		// CONFIG: Optional proxy configuration
		//curl_setopt($ch, CURLOPT_PROXY, $proxy);
		//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
		
		// Set TCP timeout to 30 seconds
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
		// of the certificate as shown below. Ensure the file is readable by the webserver.
		// This is mandatory for some environments.
		
		//$cert = __DIR__ . "./cacert.pem";
		//curl_setopt($ch, CURLOPT_CAINFO, $cert);
		
		$res = curl_exec($ch);
		if (curl_errno($ch) != 0) // cURL error
			{
			if(DEBUG == true) {	
				error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
			}
			curl_close($ch);
			exit;
		
		} else {
				// Log the entire HTTP response if debug is switched on.
				if(DEBUG == true) {
					error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
					error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
				}
				curl_close($ch);
		}
		
		// Inspect IPN validation result and act accordingly
		
		// Split response headers and payload, a better way for strcmp
		$tokens = explode("\r\n\r\n", trim($res));
		$res = trim(end($tokens));
		
		
		if (strcmp ($res, "VERIFIED") == 0) {
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment and mark item as paid.
		
			// assign posted variables to local variables
			$item_name = $myPost['item_name'];
			list($orderid, $userid) = explode('-', $myPost['item_number']);
			$payment_status = $myPost['payment_status'];
			$payment_amount = $myPost['mc_gross'];
			$payment_currency = $myPost['mc_currency'];
			$txn_id = $myPost['txn_id'];
			$receiver_email = $myPost['receiver_email'];
			$payer_email = $myPost['payer_email'];
			
			$apiConfigs = unserialize(get_option('apiconfigs'));
			
			$model = $this->getModel();
			$item=$model->getItem((int)$orderid, (int)($userid));
			
			if(strtolower($payment_status) === 'completed' && $apiConfigs['paypalemail'] == $receiver_email){
				$item_payment_status = 'COMPLETE';
				if($payment_amount < $item->amount){
					$item_payment_status = 'BALANCE REMAINING';
				}
				
				$apiConfigs = unserialize(get_option('apiconfigs'));
				$args = array(
					'method'=>'POST',
					'body'=>json_encode(array('payment_status'=>$item_payment_status, 'ordid'=>$item->id, 'txn_id'=>$txn_id, 'payment_data'=>json_encode($myPost))),
					'headers' => array( "Content-type" => "application/json", "Authentication"=>"Basic ".base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret'])),
					'sslverify' => false
				);
				$response=wp_remote_post($this->apihost.'&task=api.set_paymentstatus', $args);
				$response_data = json_decode(wp_remote_retrieve_body($response), true);
				
				$user=get_userdata( $item->user );
				
				$emailBody = '<p><strong>Dear '.$user->data->first_name .'</strong><br>
							  Thank  you for paying for order <a href="'.get_site_url().'/aworder/order/?view=order&ordid='.$item->id.'">#'.$item->order_id.'</a>,<br>
							  Your  order has been assigned to a writer and is under progress. </p>
							<p>Please  do not hesitate to view the details online or find us on chat.</p>
							<p>Regards<strong><br>
							  </strong>Support  Team</p>'
							.'<strong>'.get_site_url().'</strong>';
							
				//$this->sendEmail($user->data->user_email, 'You have Successfully paid for order #'.$item->order_id, $emailBody);
				
			}
		
			
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
			}
		} else if (strcmp ($res, "INVALID") == 0) {
			// log for manual investigation
			// Add business logic here which deals with invalid IPN messages
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
			}
		}

	}
	
	function get_customer(){
		$apiConfigs = unserialize(get_option('apiconfigs'));
		$usr = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : ( isset($_SERVER['HTTP_PHP_AUTH_USER']) ? $_SERVER['HTTP_PHP_AUTH_USER'] : false );
		$pwd = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : ( isset($_SERVER['HTTP_PHP_AUTH_PW']) ? $_SERVER['HTTP_PHP_AUTH_PW'] : false );
		if($usr && $pwd && $usr === $apiConfigs['api_key'] && $pwd === $apiConfigs['api_secret']):
			
			$uid=(int)sanitize_text_field($_POST['user']);
			$user = get_user_by('id', $uid);
			$userMeta = get_user_meta($uid, '', false);
			
			echo json_encode(array(
				'name'=>$userMeta['first_name'][0].' '.$userMeta['last_name'][0],
				'email'=>$user->data->user_email
			));
		
		else:
			echo 'not seen';
		endif;
			
		exit;
	}
	
	function varify_upload(){
		
		$apiConfigs = unserialize(get_option('apiconfigs'));
		$uid=(int)sanitize_text_field($_POST['user']);
		$user = get_userdata($uid);
		$orderid = (int)sanitize_text_field($_POST['order_id']);
		
		if(	isset($_SERVER['HTTP_AUTHORIZATION']) && base64_encode($apiConfigs['api_key'].':'.$apiConfigs['api_secret']) === str_replace('Basic ', '', $_SERVER['HTTP_AUTHORIZATION'])):
			$userMeta = get_user_meta($user->id, '', false);
			$emailBody = '<p><strong>Dear '.$userMeta['first_name'][0].',</strong></p>
						<p>You  have successfully uploaded a files to order <a href="'.get_site_url().'/aworder/order/?view=order&ordid='.$orderid.'">#'.$orderid.'</a>. 
						We are currently checking your file content and suppose we need more information we will get back to you.</p>
						<p>Thanks  you.</p>
						<p>Regards,<br>
						Support  Team<br>'.get_site_url().'</p>';
							
			$this->sendEmail($user->data->user_email, 'You have successfully uploaded a file for Order #'.$orderid, $emailBody);			
			echo json_encode(array('success'=>'Please do upload'));			
		
		else:
			echo json_encode(array('error'=>'Invalid'));;
		endif;
			
		exit;
	}
	
	function download(){
		$user = wp_get_current_user();
		
		if($user->ID){
			
			$model = $this->getModel();
			$order = $model->getItem(sanitize_text_field($_GET['ordid']));
			$file=array();
			foreach(json_decode($order->files) as $file)
				if($file->newname == sanitize_text_field($_GET['f'])) break;
			
			if(!empty($file)){
				$URL=parse_url($this->apihost);
				$filePath = $URL['scheme'].'://'.$URL['host'].'/media/'.$order->files_dir.'/files/'.$file->newname;
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.$file->name.'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				echo file_get_contents($filePath);
				exit;
			}
		}
		else auth_redirect();
	}
	
	function remote_sendemail(){
		
		$apiConfigs = unserialize(get_option('apiconfigs'));
		
		if(	isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) && 
			$_SERVER['PHP_AUTH_USER'] === $apiConfigs['api_key'] && $_SERVER['PHP_AUTH_PW'] === $apiConfigs['api_secret']
		):
			
			$uid=(int)sanitize_text_field($_POST['user']);
			$user = get_user_by('id', $uid);
			$userMeta = get_user_meta($uid, '', false);
			
			$message = sanitize_text_field($_POST['message']);
			$subject = sanitize_text_field($_POST['subject']);
			
			if($this->sendEmail($user->data->user_email, $subject, $message)):
				echo json_encode(array('success'=>'Successfully Sent')); 
			else:
				echo json_encode(array('error'=>'Message not Sent')); 
			endif;
		
		else:
			echo 'not seen';
		endif;
			
		exit;
		
		$apiConfigs = unserialize(get_option('apiconfigs'));
		$uid=(int)sanitize_text_field($_POST['user']);
		$user = get_userdata($uid);
	}
	
}