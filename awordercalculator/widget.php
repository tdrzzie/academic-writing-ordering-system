<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	
	$currency = unserialize(get_option('_currency', ''));
	
	$t10w_cost = get_option('_t10w_cost', 2.95);
	$vip_cost = get_option('_vip_cost', 9.95);
	$wordsperpage = get_option('_wordsperpage', 275);
	
	if ( ! empty( $instance['title'] ) ) echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
	
	$calcAction = $ordmdl->getView().'-'.$ordmdl->getLayout() === 'order-edit' ? '' : str_replace('aworder/aworder/', '', 'aworder/'.get_page_by_path('placeorder', 'OBJECT', 'aworder')->post_name);
?>

<form action="<?=site_url('aworder/placeorder');?>" method="post" class="form">
	
   
    <div class="form-group">
        <label class="control-label col-3" for="calc-doctype">Type of Document</label>
        <div class="col-7">
        <select name="calc-doctype" class="form-control" id="calc-doctype" required>
            <option value="1">Select Document Type</option>
            <? foreach($this->order->get('Doctypes') as $doctype):?>
            <option amnt="<?=$doctype->amount;?>" value="<?=$doctype->id;?>" <?=isset($_POST['calc-doctype'])&&$_POST['calc-doctype']==$doctype->id?'selected':'';?>><?=$doctype->type;?></option>
            <? endforeach;?>
        </select>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-3" for="calc-aclevel">Academic Level</label>
        <div class="col-7">
        <select name="calc-aclevel" id="calc-aclevel" class="form-control" required>
            <option value="">Select</option>
            <? foreach($this->order->get('AcademicLevels') as $acLevel):?>
          <option value="<?=$acLevel->id;?>" cost="<?=$acLevel->amount;?>" <?=isset($_POST['calc-aclevel'])&&$_POST['calc-aclevel']==$acLevel->id?'selected':'';?>><?=$acLevel->level;?></option>
            <? endforeach;?>
        </select>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-3" for="calc-pagewords">No. of pages</label>
        <div class="col-7">
        <select name="calc-pages" class="form-control" id="calc-pages" required>
            <? for($p=1; $p<100; $p++):?><option value="<?=$p;?>" <?=$p==$_POST['calc-pages']?'selected':'';?>><?=$p;?></option><? endfor;?>
        </select>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="control-label col-3" for="calc-urgency">Deadline</label>
        <div class="col-7">
        <input type="hidden" name="calc-urg_id" id="calc-urg_id" value="<?=isset($_POST['calc-urg_id'])?esc_html($_POST['calc-urg_id']):'';?>" />
        <select name="calc-urgency" id="calc-urgency" class="form-control" required onchange="($=jQuery)('#calc-urg_id').val($(this).find('option:selected').attr('urgid'));">
            <option value="" cost="1">Select</option>
            <? foreach($this->order->get('Urgency') as $urgency): $optval='+'.($urgency->time*($urgency->marker=='days'?24:1)).' hours';?>
        <option urgid="<?=$urgency->id;?>" value="<?=$optval;?>" cost="<?=$urgency->amount;?>" <?=isset($_POST['calc-urgency'])&&$_POST['calc-urgency']==$optval?'selected':'';?>><?=$urgency->time.' '.$urgency->marker;?></option>
            <? endforeach;?>
        </select>
        </div>
    </div>
   
    <div class="form-group">
    	<div class="row">
            <div class="col-lg-5">
                <select name="calc-currency" class="form-control" style="width:100%;">
                    <option value="USD">USD</option>
                    <? if($currency) foreach($currency as $key=>$curr): if($key=='task') continue;?>
                    <option value="<?=$key;?>" <?=isset($_POST['calc-currency'])&&$_POST['calc-currency']==$key?'selected':'';?>><?=$key;?></option>
                    <? endforeach;?>
                </select>
            </div>
            
            <div class="col-lg-7">
                <input type="text" name="calc-total" id="calc-total" class="form-control" readonly value="<?=isset($_POST['calc-total'])?esc_html($_POST['calc-total']):'0.00';?>" style="font-size:24px; border:none; width:100%; background:none"  />
           </div>
       </div>
    </div>
    
    <div class="form-group">
    	<input type="submit" class="btn btn-success" value="ORDER NOW" />
    </div>
    
</form>

<script>
	(function($){
		$(window).load(function(){
			var calcOrder = new window.order(calcConfig={wordsPerPage:<?=$wordsperpage;?>, top10cost:0, vipcost:0}),
				cpages=1, cspacing=1, clevel=1, curgency=1, ctotalPer=1, cessayType=$('#calc-doctype').length ? parseInt($('#calc-doctype').find('option:selected').val()) : 1, 
				ccurrency = <?=json_encode($currency);?>, cex_rate = 1, cminamount=parseFloat($('#calc-minamount').val()) || 0;
			
			$('#calc-doctype').change(function(){
				cessayType=parseInt($(this).find('option:selected').attr('amnt'));
				$('#calc-total').val( parseFloat((calcOrder.total(cpages, cspacing, clevel, curgency, cessayType)*ctotalPer)*cex_rate).toFixed(2) );
			});
			
			$('#calc-aclevel').change(function(){
				clevel=parseInt($(this).find('option:selected').attr('cost'));
				$('#calc-total').val( parseFloat((calcOrder.total(cpages, cspacing, clevel, curgency, cessayType)*ctotalPer)*cex_rate).toFixed(2) );
			});
			
			$('#calc-urgency').change(function(){
				curgency=parseInt($(this).find('option:selected').attr('cost'));
				$('#calc-total').val( parseFloat((calcOrder.total(cpages, cspacing, clevel, curgency, cessayType)*ctotalPer)*cex_rate).toFixed(2) );
			});
			
			$('#calc-pages').change(function(){
				cpages=parseInt($(this).val());
				$('#calc-total').val( parseFloat((calcOrder.total(cpages, cspacing, clevel, curgency, cessayType)*ctotalPer)*cex_rate).toFixed(2) );
			});//.trigger('change');
			
			$('select[name="calc-currency"]').change(function(){
				cex_rate = ccurrency[$(this).val()] ? ccurrency[$(this).val()].exchange_rate : 1;
				$('#calc-total').val( parseFloat((calcOrder.total(cpages, cspacing, clevel, curgency, cessayType)*ctotalPer)*cex_rate).toFixed(2) );
			});
		});
	})(jQuery);
</script>