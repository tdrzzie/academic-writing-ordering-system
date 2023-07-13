<? defined('ABSPATH') or die('Restricted Access');
	$user = wp_get_current_user();
	$messages=array();
?>

<div class="messaging">
	<div class="page-heading">
    	<h3>Messages</h3>
    </div>
    <form action="" method="post" id="msgfrm">
    	<input type="hidden" name="orderid" value="<?=$this->item->id;?>" />
        <textarea name="message" cols="100" rows="3" class="control" placeholder="Write a message to admin" style="width:80%" required></textarea>    
        <input type="hidden" name="task" value="order.sendmessage" /><br/>
        <input type="submit" name="btn" class="btn btn-success" value="Send Message">
    </form>
    
    <div style="padding:10px"><strong>New Messages</strong></div>
    <ul style="margin:0; padding:0; list-style:none" class="msgs">
    	<? foreach($this->messages as $message):
			if(!in_array($message->user_to, array('admin', 'customer')) || $message->user_from != $this->item->qao) continue;
			if($message->status) continue;
			if($user->id != $message->user_from) $messages[]=$message->id;
		?>
        
        <li style="margin:2px; padding:5px; background:#F2F2F2;">
        	<div style="width:20%; display:inline-block; vertical-align:top; background:#E9E9E9;" align="center">
            	<span style="font-size:16px"><?=($message->user_to == 'admin'?'Me':'Support');?></span>
                <div>
                	<span style="font-size:14px"><?=date('H:ia', strtotime($message->date_sent));?></span>
                    <div style="font-size:10px"><?=date('j M, Y ', strtotime($message->date_sent));?></div>
                </div>
            </div>
            <div style="width:75%; display:inline-block; vertical-align:top">
            	<?=nl2br($message->message);?>
            </div>
        </li>
        
        <? endforeach;?>
    </ul>
    
    <strong>Others</strong>
    <ul style="margin:0; padding:0; list-style:none" class="msgs">
    	<? foreach($this->messages as $message):
			if(!in_array($message->user_to, array('admin', 'customer')) || $message->user_from != $this->item->qao) continue;
			if(!$message->status) continue;
		?>
        
        <li style="margin:2px; padding:5px; background:#F2F2F2;">
        	<div style="width:20%; display:inline-block; vertical-align:top; background:#E9E9E9;" align="center">
            	<span style="font-size:16px"><?=($message->user_to == 'admin'?'Me':'Support');?></span>
                <div>
                	<span style="font-size:14px"><?=date('H:ia', strtotime($message->date_sent));?></span>
                    <div style="font-size:10px"><?=date('j M, Y ', strtotime($message->date_sent));?></div>
                </div>
            </div>
            <div style="width:75%; display:inline-block; vertical-align:top">
            	<?=nl2br($message->message);?>
            </div>
        </li>
        
        <? endforeach;?>
    </ul>
    
</div>
<script>
	(function($){
		var c = <?=count($this->messages);?>; $('#messagecount').html(c).css({color:(c>0?'red':'black')});
		$('.msgs').each(function(){
			if(!$(this).find('li').length) $(this).html('No New Messages');
		});
	})(jQuery)
</script>
<? $this->markAsRead($messages);?>