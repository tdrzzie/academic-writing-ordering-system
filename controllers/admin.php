<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



require_once HELPERS_PATH.'/validation.php';



class AWOrderControllerAdmin extends AWOrder{

	

	function __construct(){

		parent::__construct();

		$this->validation = new validation();

	}

	

	function save_api_configs(){

		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}

		$this->validation->set_rules('api_key', 'API Key', 'required|trim');

		$this->validation->set_rules('api_secret', 'API Secret', 'required|trim');

		/*$this->validation->set_rules('paypalemail', 'PayPal Email', 'required|trim|valid_email');
		$this->validation->set_rules('paypalidt', 'PayPal Identity Tocken', 'required|trim');*/

		$this->validation->set_rules('apihost', 'API Host', 'required|trim|valid_url');

		

		if($valid_data = $this->validation->run()){

			$apihost = $valid_data['apihost'];

			update_option('apiconfigs', serialize($valid_data));

			update_option('_apihost', $apihost);

			$this->setMessage('Configurations saved', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

		

	}

	

	function save_urgency(){

		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}

		$this->validation->set_rules('id', 'ID', 'trim|integer');

		$this->validation->set_rules('time', 'Time', 'required|trim|integer');

		$this->validation->set_rules('notation', 'Time Notation', 'required|trim');

		$this->validation->set_rules('amount', 'Amount', 'required|trim|float');

		

		if($valid_data = $this->validation->run()){

			global $wpdb;

			$fields=array(

				'time'=>$valid_data['time'],

				'marker'=>$valid_data['notation'],

				'amount'=>$valid_data['amount']

			);

			if($valid_data['id']) $fields['id']=$valid_data['id'];

			$wpdb->replace($wpdb->prefix.'urgency', $fields);

			

			$this->setMessage('Urgency Saved', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

		

	}

	

	function save_level(){

		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}

		$this->validation->set_rules('id', 'ID', 'required|trim|integer');

		$this->validation->set_rules('level', 'Level', 'required|trim');

		$this->validation->set_rules('amount', 'Amount', 'required|trim|float');

		

		if($valid_data = $this->validation->run()){

			global $wpdb;

			$fields=array(

				'level'=>$valid_data['level'],

				'amount'=>$valid_data['amount']

			);

			if($valid_data['id']) $fields['id']=$valid_data['id'];

			$wpdb->replace($wpdb->prefix.'aclevels', $fields);

			$this->setMessage('Level Saved', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

		

	}

	

	function save_doctype(){

		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}

		$this->validation->set_rules('id', 'ID', 'required|trim|integer');

		$this->validation->set_rules('type', 'Type', 'required|trim');

		$this->validation->set_rules('amount', 'Amount', 'required|trim|float');

		

		if($valid_data = $this->validation->run()){

			global $wpdb;

			$fields=array(

				'type'=>$valid_data['type'],

				'amount'=>$valid_data['amount']

			);

			if($valid_data['id']) $fields['id']=$valid_data['id'];

			$wpdb->replace($wpdb->prefix.'doctypes', $fields);

			$this->setMessage('Document Type Saved', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

		

	}

	

	

	function save_coupon(){

		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}

		$this->validation->set_rules('id', 'ID', 'required|trim');

		$this->validation->set_rules('name', 'Coupon Name', 'required|trim');

		$this->validation->set_rules('desc', 'Description', 'required|trim|trim');

		$this->validation->set_rules('code', 'Code', 'required|trim');

		$this->validation->set_rules('discount', 'Discount', 'required|trim|integer');

		$this->validation->set_rules('minamount', 'Minimum Amount', 'required|trim|float');

		$this->validation->set_rules('state', 'Status', 'required|trim');

		

		if($valid_data = $this->validation->run()){

			global $wpdb;

			$wpdb->show_errors();

			$fields=array(

				'name'=>$valid_data['name'],

				'instructions'=>$valid_data['desc'],

				'code'=>$valid_data['code'],

				'discount'=>$valid_data['discount']/100,

				'min_amount'=>$valid_data['minamount'],

				'status'=>$valid_data['state']

			);

			if($valid_data['id']) $fields['id']=$valid_data['id'];

			$wpdb->replace($wpdb->prefix.'coupons', $fields);

			$this->setMessage('Coupon Saved', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

			

		

	}

	

	function save_smtp(){

		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}

		$this->validation->set_rules('smtphost', 'SMTP Host', 'required|trim');

		$this->validation->set_rules('smtpfromname', 'From Name', 'required|trim');

		$this->validation->set_rules('smtpfromemail', 'From Email', 'required|trim|valid_email');

		$this->validation->set_rules('smtpusername', 'SMTP Username', 'required|trim');

		$this->validation->set_rules('smtppwd', 'SMTP Password', 'required|trim');

		

		if($valid_data = $this->validation->run()){

			$postdata = array();

			update_option('smtpconfigs', serialize($valid_data));

			$this->setMessage('SMTP Config saved', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

	}

	

	function save_revedit(){
		
		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}
		
		$this->validation->set_rules('_revedit_percentage', 'Revision / Edit Percentage', 'required|trim|integer');

		if($valid_data = $this->validation->run()){

			update_option('_revedit_percentage', $valid_data['_revedit_percentage']/100);

			$this->setMessage('Saved Successfully', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

	}

	

	function set_currency(){
		
		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}
		
		$postdata = array();

		foreach($_POST as $key=>$val) if(isset($val['exchange_rate'])) $postdata[$key] = array('exchange_rate'=> (float)sanitize_text_field($val['exchange_rate']));

		update_option('_currency', serialize($postdata));

		$this->setMessage('Currencies Saved', 'success');

	}

	

	function save_order_settings(){
		
		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}
		
		$this->validation->set_rules('t10w_cost', 'Top 10 Writer Cost', 'required|trim|float');

		$this->validation->set_rules('vip_cost', 'CIP Cost', 'required|trim|float');

		$this->validation->set_rules('wordsperpage', 'Words Per Page', 'required|trim|integer');

		

		if($valid_data = $this->validation->run()){

			foreach($valid_data as $key=>$val) update_option('_'.$key, $val);

			$this->setMessage('Saved successfully', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');

	}
	
	function save_fields(){
		
		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}
		
		foreach($_POST as $field=>$val)
			if($field != 'task')
			$this->validation->set_rules($field, 'Field', 'integer');
		
		if($valid_data = $this->validation->run()){
			
			update_option('_fields', json_encode($valid_data));
			$this->setMessage('Saved successfully', 'success');

		}

		else $this->setMessage('Error Occured <p>'.implode('</p><p>', $this->validation->errors).'</p>', 'danger');
	}
	
	function rm(){
		
		if(!is_admin()){
			$this->setMessage('<p>You are not allowed to perfome this action</p>', 'danger');
			return;
		}
		
		$this->validation->set_rules('resource', 'Resource', 'required|trim');
		$this->validation->set_rules('resource_id', 'Resource ID', 'required|trim|integer');
		if($valid_data = $this->validation->run()){
			global $wpdb;
			$wpdb->delete($wpdb->prefix.$valid_data['resource'], array('id'=>$valid_data['resource_id']));
		}
		die('Done');
	}
	

}