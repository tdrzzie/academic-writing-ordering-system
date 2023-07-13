<? defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



class validation{

	

	protected $rules = array();

	var $errors = array();

	

	function set_rules($field, $label, $rule_str){

		$this->rules[$field] = array('label'=>$label, 'rule_str'=>$rule_str, 'value'=>$_POST[$field]);

	}

	

	function run(){

		

		if(!empty($this->rules)){

			

			$valid_data = array();

			

			foreach($this->rules as $field=>$rules){

				$defined_rules = explode('|', $rules['rule_str']);

				

				$value = in_array('trim', $defined_rules, true) ? trim($rules['value']) : $rules['value'];

				

				if(in_array('required', $defined_rules, true) && !strlen($value)){

					$this->errors[$field] = 'Field '.$rules['label']. ' is required.';

				}

				

				if(in_array('valid_email', $defined_rules, true)){

					if(!is_email($value)) $this->errors[$field] = 'Invalid '.$rules['label'];

					else $value = sanitize_email($value);

				}

				elseif(in_array('integer', $defined_rules, true)){
					
					if((int)$value === 0) $value = intval($value);
					
					else if(!intval($value)) $this->errors[$field] = 'Invalid '.$rules['label'];

					else $value = intval($value);

				}

				elseif(in_array('float', $defined_rules, true)){

					$value = (float)$value;

				}

				elseif(in_array('valid_username', $defined_rules, true)){

					$value=sanitize_user($value, true);

				}

				elseif(in_array('valid_url', $defined_rules, true)){

					$value=sanitize_url($value);

				}

				else $value = sanitize_text_field($value);

				

				$valid_data[$field] = $value;

			}

			

			if(!empty($this->errors)) return false;

			else return $valid_data;

		}

		else return true;

	}

	

}