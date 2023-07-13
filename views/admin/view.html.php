<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



require_once MODEL_PATH.'/order.php';



class AWOrderViewAdmin extends AWOrder{

	

	function display($tpl=null){

		

		$this->apiConfigs = unserialize(get_option('apiconfigs'));

		$this->smtpconfigs = unserialize(get_option('smtpconfigs'));

		$orderModel = new AWOrderModelOrder();

		

		$this->urgency = $orderModel->getUrgency();

		$this->aclevels = $orderModel->getAcademicLevels();

		$this->coupons = $orderModel->getCoupons();

		$this->doctypes = $orderModel->getDoctypes();
		
		$this->currencies = array();
		foreach($orderModel->getCountries() as $country)
			if(!in_array($country->currency_iso3, $this->currencies))
				$this->currencies[] = $country->currency_iso3;
		
		$this->countries = $orderModel->getCountries();		

		$this->_revedit_percentage = get_option('_revedit_percentage');

		$this->_currency = unserialize(get_option('_currency'));

		

		return parent::display($tpl);

	}

	

}