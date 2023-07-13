<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class AWOrderViewOrder extends AWOrderModelOrder{
	
	function __construct(){
		$user = wp_get_current_user();
		
		if($this->getLayout() == 'default' && !isset($_GET['ordid'])) $this->setLayout('edit');
		elseif( $this->getLayout() == 'default' && isset($_GET['ordid']) && empty($user->ID)){
			echo '<script>window.location="'.wp_login_url( '//'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ).'"</script>';
			exit;
		}
		
		parent::__construct();
	}
	
	function display($tpl=null){
		
		$this->subjects = $this->get('Subjects');
		$this->doctypes = $this->get('Doctypes');
		$this->countries = $this->get('Countries');
		$this->item = $this->get('Item');
		$this->messages = $this->item->messages;
		
		return parent::display($tpl);
		
	}
	
	function markAsRead($messages){
		AWOrderModelOrder::markAdRead($messages);
	}
	
}