<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	$apiConfigs = unserialize(get_option('apiconfigs'));

	global $current_user;
	//https://www.paypal.com/cgi-bin/webscr
?>



<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

<input type="hidden" name="cmd" value="_xclick">

<input type="hidden" name="business" value="<?=$this->item->paypalemail;?>">

<input type="hidden" name="item_name" value="Order #<?=str_pad($this->item->order_id, 5, '0', STR_PAD_LEFT);?> topic:<?=$this->item->topic;?>">

<input type="hidden" name="item_number" value="<?=str_pad($this->item->id, 5, '0', STR_PAD_LEFT).'-'.str_pad($current_user->ID, 5, '0', STR_PAD_LEFT);?>">

<input type="hidden" name="amount" value="<?=number_format($this->item->amount, 2);?>">

<input type="hidden" name="currency_code" value="<?=$this->item->currency;?>">

<input type="hidden" name="first_name" value="<?=$current_user->user_firstname;?>">

<input type="hidden" name="last_name" value="<?=$current_user->user_lastname;?>">

<input type="hidden" name="notify_url" value="<?=get_site_url();?>/aworder/order?task=order.payment_listener">

<input type="hidden" name="cancel_return" value="<?=get_site_url();?>/aworder/order?ordid=<?=$this->item->id;?>&task=order.payment&state=cancelled">

<input type="image" name="submit" border="0" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_paynow_cc_144x47.png" alt="PayPal - The safer, easier way to pay online">

</form>