<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Accademic Writing Ordering System
Plugin URI:  https://zimplugs.com/wp-plugins
Description: This is a plugin for academic writing orders
Version:     4.0.0
Author:      Nyasha Mandizvidza
Author URI:  https://ntaftie.com/njmwas
License:     GPL3
*/

error_reporting (0);

include_once ABSPATH.'wp-includes/pluggable.php';

define('THEBASE', plugin_dir_path(__file__));
define('MODEL_PATH', plugin_dir_path(__file__).'/models');
define('CONTROLLER_PATH', plugin_dir_path(__file__).'/controllers');
define('VIEW_PATH', plugin_dir_path(__file__).'/views');
define('HELPERS_PATH', plugin_dir_path(__file__).'/helpers');

require_once plugin_dir_path(__file__).'/awmetabox.php';
require_once str_replace('//', '/', plugin_dir_path(__file__).'/awordercalculator_widget.php');

 /** Activation Hookds **/
include_once plugin_dir_path(__file__).'/setup.php';
function installer(){
	$setup = new Setup();
	$setup->install();
}
register_activation_hook(__file__, 'installer');

function uninstaller(){
	$setup = new Setup();
	$setup->uninstall();
}
register_uninstall_hook(__file__, 'uninstaller');

/* Initialize common variables */
$task=isset($_POST['task']) ? $_POST['task'] : (isset($_GET['task']) ? $_GET['task'] : false);

/********* Email COnfigurations ****************** */
function wpdocs_set_html_mail_content_type(){
	return 'text/html';
}
add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );


function mailer_config(PHPMailer $phpmailer){
	
	$configs=unserialize(get_option('smtpconfigs'));
	
	if(isset($configs['smtphost'])){
		
		$phpmailer->SMTPDebug = 0;
		$phpmailer->debug = 0;
		$phpmailer->Debugoutput = 'html';
		//$phpmailer->SMTPSecure = 'tls';
		$phpmailer->Port = 25;
		$phpmailer->SMTPAuth = true;
		$phpmailer->Host = $configs['smtphost'];
		$phpmailer->Username = $configs['smtpusername'];
		$phpmailer->Password = $configs['smtppwd'];
		
	}
	
}

/******************* End of Email Configs ***************** */

/* Define the base controller class */
class AWOrder{
	
	protected $view='order';
	protected $layout='default';
	protected $params=array();
	protected $redirect='';
	var $apihost='';
	var $messages=array();
	
	function __construct(){		
		if(strlen($this->redirect)){
			wp_redirect($this->redirect);
			exit;
		}
		
		$this->apihost = get_option('_apihost').'?view=api';
		if(isset($_GET['layout'])) $this->setLayout(sanitize_text_field($_GET['layout']));
		if(isset($_GET['view'])) $this->setView(sanitize_text_field($_GET['view']));
	}
	
	public function setParams($key, $value=''){
		if(is_array($key)) $this->params = array_merge($this->params, $key);
		else $this->params[$key] = $value;
	}
	
	public function getParams($param='all'){
		if($param=='all') return $this->params;
		return $this->params[$param];
	}
	
	public function getView(){
		return $this->view;
	}
	
	public function getLayout(){
		return $this->layout;
	}
	
	public function setView($view){
		$this->view=$view;
	}
	
	public function setLayout($layout){
		$this->layout=$layout;
	}
	
	public function get($item, $params=array()){
		if(method_exists($this, 'get'.$item)){
			return call_user_func_array(array($this, 'get'.$item), $params);
		}
	}
	
	public function display($include=false){
		if(!session_id) session_start();
		global $wp_session;
		
		if($include){
			include plugin_dir_path(__file__).'/views/'.$this->view.'/tmpl/'.$this->layout.'.php';
			return;
		}
		else{
			ob_start();
			include plugin_dir_path(__file__).'/views/'.$this->view.'/tmpl/'.$this->layout.'.php';
			return ob_get_clean();
		}
		
	}
	
	public function setRedirect($page, $message=''){
		global $redirect;
		$this->redirect = $page;
	}
	
	public function getRedirect(){
		return $this->redirect;
	}
	
	public function setMessage($message, $type='warning'){
		if(!isset($_SESSION['messages'])) $_SESSION['messages']=array();
		$_SESSION['messages'][]=array($message, $type);
		
	}
	
	public function showMessages(){
		if(isset($_SESSION['messages']) && !empty($_SESSION['messages'])){
			$msgs='';
			foreach($_SESSION['messages'] as $message):
				if(!strlen($message[0])) continue;
				$msgs.='<div class="alert alert-'.$message[1].'" role="alert">
				  <span class="glyphicon glyphicon-'.($message[1]=='danger'?'exclamation-sign':($message[1]=='warning'?'warning-sign':'ok-circle')).'" aria-hidden="true"></span>
				  '.$message[0].'
				</div>';
			endforeach;
			$_SESSION['messages']=array();
			return $msgs;
		}
	}
	
	public function getInstance($resource, $prefix){
		$folder=strtolower(str_replace('AWOrder', '', $prefix));
		if(is_file($file=plugin_dir_path(__file__).'/'.$folder.'s/'.strtolower($resource).'.php')){
			require_once $file;
			$className = $prefix.$resource;
			return new $className();
		}
	}

	
	public function sendEmail($to, $subject, $message){
		
		add_action( 'phpmailer_init', 'mailer_config', 10, 1);
		
		$configs=unserialize(get_option('smtpconfigs'));
		$headers = array('From: '.$configs['smtpfromname'].'<'.$configs['smtpfromemail'].'>', 'Content-Type: text/html');
		if(!($e=wp_mail($to, $subject, $message, $headers))){
			//die(print_r($e, true));
			error_log('Error sending email to '.$to);
			return false;
		}
		//error_log('Successfully sent to '.$to);
		return true;
		
	}
	
}

/* Execute a task */
function run($cmd){
	if(!session_id) session_start();
	// load the data model
	if(strstr($cmd, '.')){
		list($class, $func) = explode('.', $cmd);
		
		if(is_file($modelFile=plugin_dir_path(__file__).'/models/'.$class.'.php'))
			require_once $modelFile;
		
		if(is_file($taskCtrlFile=plugin_dir_path(__file__).'/controllers/'.$class.'.php'))
			require_once $taskCtrlFile;
		
		$className = 'AWOrderController'.ucwords($class);
		if(class_exists($className) && method_exists($className, $func)){
			call_user_func(array(new $className(), $func));
		}
	}
	elseif(method_exists(AWOrder, $cmd)){
		call_user_func(array(AWOrder, $func));
	}
}
if($task) run($task);

/** present the view to the user **/
require_once MODEL_PATH.'/orders.php';
$ordmdl=new AWOrderModelOrders();
$ordStats = $ordmdl->getStats();
function manageTitle($title, $id=null){
	global $ordStats;
	$page=get_page_by_title($title, 'object', 'aworder');
	if(!empty($page)){
		$_view = get_post_meta($page->ID, '_view', true);
		$status = strtolower((string)$_view['field']['status']);
		if(isset($_view['field']['status']) && isset($ordStats[$status]) && !is_admin())
			$title.=' <span class="order_'.$status.'">('.$ordStats[$status]['c'].')</span>';
	}
	
	return $title;
}
add_filter('the_title', 'manageTitle');

function render_page($content){
	
	if( isset($_GET['aworder']) || get_post_type(get_the_ID()) == 'aworder'){
		
		$view=isset($_GET['view']) ? strtolower(sanitize_title($_GET['view'])) : 'order';
		$layout=isset($_GET['layout']) ? strtolower(sanitize_title($_GET['layout'])) : 'default';
				
		$_view = get_post_meta(get_the_ID(), '_view', true);
		if(isset($_view['view']) && strstr($_view['view'], '_')){
			list($view, $layout)=explode('_', $_view['view']);
			$params = isset($_view['field'])?$_view['field']:array();
		}
		
		// load the data model
		if(is_file($modelFile=plugin_dir_path(__file__).'/models/'.$view.'.php'))
			require_once $modelFile;
		
		//load the controller
		if(is_file($ctrlFile=plugin_dir_path(__file__).'/controllers/'.$view.'.php'))
			require_once $ctrlFile;
		
		//load the view
		require_once plugin_dir_path(__file__).'/views/'.$view.'/view.html.php';
		$viewClass = 'AWOrderView'.ucwords($view);
		$wpAWOrderView = new $viewClass();
		
		$wpAWOrderView->setView($view);
		$wpAWOrderView->setLayout($layout);
		
		global $ordmdl;
		$ordmdl->setView($view);
		$ordmdl->setLayout($layout);
		if(isset($params) && !empty($params)) $wpAWOrderView->setParams($params);
		
		return $wpAWOrderView->display();
		
	}
	return $content;
}
add_filter('the_content', 'render_page');

add_action( 'init', 'aworder_post_type' );
function aworder_post_type() {
	register_post_type( 'aworder',
	array(
		'labels' => array(
			'name' => __( 'Orders' ),
			'singular_name' => __( 'Order' )
		),
		'public' => true,
		'has_archive' => true,
		'supports'=>array(
			'title',
			//'editor',
			'author',
			'thumbnail',
			'page-attributes',
			'custom-fields'
		),
		
	)
	);
}

add_action( 'admin_menu', 'register_order_menu_page' );

function register_order_menu_page(){
	add_menu_page( 'Orders Configurations', 'Orders Configurations', 'manage_options', 'orderconfigs', 'order_admin_menu_page', plugins_url( 'myplugin/images/icon.png' ), 6 ); 
}

add_action( 'widgets_init', 'register_aworder_calculator');
function register_aworder_calculator(){
	register_widget( 'Awordercalculator_widget' );
}

function order_admin_menu_page(){
	
	// load the data model
	if(is_file($modelFile=plugin_dir_path(__file__).'/models/admin.php'))
		require_once $modelFile;
	
	//load the controller
	if(is_file($ctrlFile=plugin_dir_path(__file__).'/controllers/admin.php'))
		require_once $ctrlFile;
	
	//load the vuew
	require_once plugin_dir_path(__file__).'/views/admin/view.html.php';
		
	$adminView = new AWOrderViewAdmin();
	$adminView->setView('admin');
	$adminView->setLayout(isset($_GET['layout'])?sanitize($_GET['layout']):'default');
	
	$task=isset($_POST['task']) ? sanitize_text_field($_POST['task']) : (isset($_GET['task']) ? sanitize($_GET['task']) : false);
	
	wp_enqueue_style( 'aworder_style', plugins_url( 'assets/css/layout.css', __FILE__ ) );	
	wp_enqueue_script( 'bootstap', plugins_url( 'assets/bootstrap/js/bootstrap.min.js', __FILE__ ), array('jquery') );
	
	//if($task) run($task);
	$adminView->display(true);
	
}

/* CSS and Scripts */
function theme_name_scripts() {
	
	wp_enqueue_style( 'style-name', get_stylesheet_uri() );
	wp_enqueue_style( 'aworder_style', plugins_url( 'assets/css/layout.css', __FILE__ ) );
	
	wp_enqueue_script( 'bootstap', plugins_url( 'assets/bootstrap/js/bootstrap.min.js', __FILE__ ), array('jquery') );
	wp_enqueue_script( 'Order', plugins_url( 'assets/js/order.js', __FILE__ ), array('jquery') );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );



