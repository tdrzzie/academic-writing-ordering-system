<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class AWOrderViewOrders extends AWOrderModelOrders{
	
	function __construct(){
		$user = wp_get_current_user();		
		if( empty($user->ID) ){
			echo '<script>window.location="'.wp_login_url( '//'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ).'"</script>';
			exit;
		}
		
		parent::__construct();
	}
	
	function display(){
		
		$this->orders = $this->get('Orders');
		$order=$this->getInstance('Order', 'AWOrderModel');
		$this->subjects = $order->getSubjects();
		$this->doctypes = $order->getDoctypes();
		$this->aclevels = $order->getAcademicLevels();
		return parent::display();
		
	}
	
}