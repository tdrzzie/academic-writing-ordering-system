<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	$currency = unserialize(get_option('_currency', ''));
	
	$t10w_cost = get_option('_t10w_cost', 2.95);
	$vip_cost = get_option('_vip_cost', 9.95);
	$wordsperpage = get_option('_wordsperpage', 275);
	
	$fields = json_decode(get_option("_fields", '[]'), true);
?>

<div class="BEx">
	
    <div class="page-heading">
    	<h3>Custom Paper Details</h3>
    </div>
    
    <?=$this->showMessages()?>
    
    <form action="" method="post" id="aw-order-form" class="form-horizontal">
        <input type="hidden" name="order_id" value="0" />
        
        
        <div class="form-group">
            <label class="control-label col-3" for="topic">Title</label>
            <div class="col-7">
            	<input type="text" name="ordtopic" class="form-control" id="ordtopic" required value="<?=isset($_POST['ordtopic'])?esc_html($_POST['ordtopic']):'';?>" />
            </div>
        </div>
        
        <? if(isset($fields['service'])):?>
        <div class="form-group">
            <label class="control-label col-3" for="service">Type of service:</label>
            <div class="col-7">
            <select name="service" class="form-control" id="service" required>
                <option value="">Select</option>
                <option value="Writing from scratch" <?=isset($_POST['service'])&&$_POST['service']=='Writing from scratch'?'selected':'';?>>Writing from scratch</option>
                <option value="Revision / Editing" <?=isset($_POST['service'])&&$_POST['service']=='Revision / Editing'?'selected':'';?>>Revision / Editing</option>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['doctype'])):
			$dt=isset($_POST['doctype']) ? esc_html($_POST['doctype']) : 1;
		?>
        <div class="form-group">
            <label class="control-label col-3" for="doctype">Type of Document</label>
            <div class="col-7">
            <select name="doctype" class="form-control" id="doctype" required>
                <option value="1">Select Document Type</option>
                <? foreach($this->doctypes as $doctype):?>
                <option amnt="<?=$doctype->amount;?>" value="<?=$doctype->id;?>" <?=$dt==$doctype->id?'selected':'';?>><?=$doctype->type;?></option>
                <? endforeach;?>
            </select>
            </div>
        </div>
        <? endif?>
        
        <? if(isset($fields['aclevel'])):
			$acl=isset($_POST['aclevel']) ? esc_html($_POST['aclevel']) : '';
		?>
        <div class="form-group">
            <label class="control-label col-3" for="aclevel">Academic Level</label>
            <div class="col-7">
            <select name="aclevel" id="aclevel" class="form-control" required>
                <option value="">Select</option>
                <? foreach($this->get('AcademicLevels') as $acLevel):?>
              <option value="<?=$acLevel->id;?>" cost="<?=$acLevel->amount;?>" <?=$acl==$acLevel->id?'selected':'';?>><?=$acLevel->level;?></option>
                <? endforeach;?>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['ordsubj'])):?>
        <div class="form-group">
            <label class="control-label col-3" for="ordsubj">Subject or Discipline</label>
            <div class="col-7">
            <select name="ordsubj" class="form-control" id="ordsubj" required>
                <option value="">Select</option>
                <? foreach($this->subjects as $subject):?>
                <option value="<?=$subject->id;?>" <?=isset($_POST['ordsubj'])&&$_POST['ordsubj']==$subject->id?'selected':'';?>><?=$subject->subject;?></option>
                <? endforeach;?>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['pages'])):
			$pgs=isset($_POST['pages']) ? esc_html($_POST['pages']) : 1;
		?>
        <div class="form-group">
            <label class="control-label col-3" for="pagewords">No. of pages</label>
            <div class="col-7">
            <select name="pages" class="form-control" id="pages" required>
                <? for($p=1; $p<100; $p++):?><option value="<?=$p;?>" <?=$p==$pgs?'selected':'';?>><?=$p;?></option><? endfor;?>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['spacing'])):?>
        <div class="form-group">
            <div class="control-label col-3"><strong>Spacing</strong></div>
            <div class="col-7">
            <input type="checkbox" name="spacing" id="spacing" <?=isset($_POST['spacing'])?'checked':'';?> /> 
            <label class="col-3" for="spacing">Single Space</label>
          </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['pages'])):?>
        <div class="form-group">
            <div class="control-label col-3"><strong>No. of words</strong></div>
            <div class="col-7">
            <input type="text" name="words" id="words" readonly value="<?=isset($_POST['words'])?esc_html($_POST['words']):$wordsperpage;?>" />
            <label class="col-3" for="words">Words</label>
          </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['urgency'])):
			$ags=isset($_POST['urgency']) ? esc_html($_POST['urgency']) : 1;
			$urgids=isset($_POST['urg_id']) ? esc_html($_POST['urg_id']) : '';
		?>
        <div class="form-group">
            <label class="control-label col-3" for="urgency">Deadline</label>
            <div class="col-7">
            <input type="hidden" name="urg_id" id="urg_id" value="<?=$urgids;?>" />
            <select name="urgency" id="urgency" class="form-control" required onchange="($=jQuery)('#urg_id').val($(this).find('option:selected').attr('urgid'));">
                <option value="" cost="1">Select</option>
                <? foreach($this->get('Urgency') as $urgency): $optval='+'.($urgency->time*($urgency->marker=='days'?24:1)).' hours';?>
            <option urgid="<?=$urgency->id;?>" value="<?=$optval;?>" cost="<?=$urgency->amount;?>" <?=$ags==$optval?'selected':'';?>><?=$urgency->time.' '.$urgency->marker;?></option>
                <? endforeach;?>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['style'])):?>
        <div class="form-group">
            <label class="control-label col-3" for="style">Paper format:</label>
            <div class="col-7">
           <select  name="style" id="style" class="form-control">
           		<option value="">Select</option>
                <option value="APA" <?=isset($_POST['style'])&&$_POST['style']=='APA'?'selected':'';?>>APA</option>
                <option value="MLA" <?=isset($_POST['style'])&&$_POST['style']=='MLA'?'selected':'';?>>MLA</option>
                <option value="Turabian" <?=isset($_POST['style'])&&$_POST['style']=='Turabian'?'selected':'';?>>Turabian</option>
                <option value="Chicago" <?=isset($_POST['style'])&&$_POST['style']=='Chicago'?'selected':'';?>>Chicago</option>
                <option value="Harvard" <?=isset($_POST['style'])&&$_POST['style']=='Harvard'?'selected':'';?>>Harvard</option>
                <option value="Oxford" <?=isset($_POST['style'])&&$_POST['style']=='Oxford'?'selected':'';?>>Oxford</option>
                <option value="Vancouver" <?=isset($_POST['style'])&&$_POST['style']=='Vancouver'?'selected':'';?>>Vancouver</option>
                <option value="CBE" <?=isset($_POST['style'])&&$_POST['style']=='CBE'?'selected':'';?>>CBE</option>
                <option value="Other" <?=isset($_POST['style'])&&$_POST['style']=='Other'?'selected':'';?>>Other</option>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['sources'])):?>
        <div class="form-group">
            <label class="control-label col-3" for="sources">Number of sources:</label>
            <div class="col-7">
            <input type="number" name="sources" id="sources" class="form-control" min="1" required value="<?=isset($_POST['sources'])?esc_html($_POST['sources']):'1';?>"  />
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['slides'])):?>
        <div class="form-group">
            <div class="control-label col-3"><strong>No. of Slides</strong></div>
            <div class="col-7">
            <select name="slides" class="form-control">
            	<? for($i=0; $i<101; $i++){?>
                <option value="<?=$i;?>" <?=isset($_POST['slides'])&&$_POST['slides']==$i?'selected':'';?>><?=$i;?></option>
                <? }?>
            </select>
          </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['t10w'])):?>
        <div class="form-group">
            <label class="control-label col-3">Written by Top 10 Writers</label>
            <div class="col-7">
            <input type="checkbox" name="t10w" id="t10w" value="<?=$t10w_cost;?>" <?=isset($_POST['t10w'])?'checked':'';?> /> 
            <label for="t10w"><span id="top10cost">USD <?=$t10w_cost;?></span> / page</label>
          </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['vipsupport'])):?>
        <div class="form-group">
            <label class="control-label col-3">VIP support:</label>
            <div class="col-7">
            <input type="checkbox" name="vipsupport" value="<?=$vip_cost;?>" id="vipsupport" <?=isset($_POST['vipsupport'])?'checked':'';?> /> 
            <label for="vipsupport"><span id="vipcost">USD <?=$vip_cost;?></span></label>
          </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['english'])):?>
        <div class="form-group">
            <label class="control-label col-3">English</label>
            <div class="col-7">
            <select name="english" class="form-control" id="english" required>
            	<option value="English UK" <?=isset($_POST['english'])&&$_POST['english']=='English UK'?'selected':'';?>>English UK</option>
                <option value="English US" <?=isset($_POST['english'])&&$_POST['english']=='English US'?'selected':'';?>>English US</option>
            </select>
          </div>
        </div>
       <? endif;?>
        
  		<div class="form-group">
            <label class="control-label col-3" for="desciption">Order description:<br /><span style="font-size:10px">(Type your instructions here)</span></label>
            <div class="col-7">
            <textarea name="desciption" id="desciption" rows="3" cols="50" required class="form-control"><?=isset($_POST['desciption'])?esc_textarea($_POST['desciption']):'';?></textarea>
            </div>
        </div>
        
        <? $curre=isset($_POST['currency']) ? esc_html($_POST['currency']) : 'USD';?>
        <div class="form-group">
            <div class="control-label col-3"><strong>Currencies</strong></div>
            <div class="col-7">
            	<div class="btn-group" data-toggle="buttons">
                	<button type="button" class="btn btn-sm btn-default cur-radio <?=empty($_POST)||$curre=='USD'?'active':'';?>">USD</button>
                    <? if($currency) foreach($currency as $key=>$curr): if($key=='task') continue;?>
                    <button type="button" id="cur-<?=$key;?>" class="btn btn-sm btn-default cur-radio <?=$curre==$key?'active':'';?>"><?=$key;?></button>
                    <? endforeach;?>
                </div>
            </div>
       </div>
       
       <? $ttl=isset($_POST['total']) ? esc_html($_POST['total']) : 0;
	   		if(!isset($fields['total'])):
	   ?>
      	<div class="form-group">
        	<label class="control-label col-3" for="minamount" style="font-weight:bold; font-size:18px">Am willing to pay:</label>
            <div class="col-7">
            	<div class="input-group">
                    <span class="input-group-addon mincurrency"><?=$curre;?></span>
                    <input type="number" name="minamount" id="minamount" class="form-control" min="<?=$fields['minamount'];?>" value="<?=$ttl?$ttl:$fields['minamount'];?>" step="any" />
            	</div>
            </div>
        </div>
        <? endif;?>
        
        <div class="form-group">
        	<label class="control-label col-3" for="total" style="font-weight:bold; font-size:18px">Fee:</label>
            <div class="col-7">
            	<strong style="font-size:16px; background:#999; padding:10px;">
                <input type="text" name="currency" id="currency" readonly value="USD" style="width:50px; background:none; border:none;" />
                <input type="text" name="total" id="total" readonly value="<?=$ttl;?>" style="font-size:16px; border:none; width:100px; display:inline-block; background:none"  /></strong>
            </div>
      </div>
        
        <div class="form-group">
        	<div class="control-label col-3">&nbsp;</div>
        	<h4 class="col-7">If you have additional files, you will upload them when managing the order.</h4>
        </div>
        
        <? if(isset($fields['couponcode'])):?>
        <div class="form-group">
        	<label class="control-label col-3" for="couponcode"><strong style="font-size:18px">Get Discount</strong></label>
            <div class="col-7">
            	<? global $wpdb; $coupon = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."coupons WHERE status LIKE 'ACTIVE'" );?>
                <?=strlen($coupon->name)?'<h4 style="margin:0;">'.($coupon->discount*100).'% '.$coupon->name.'</h4>':'';?>
				<?=strlen($coupon->instructions)?'<div>'.$coupon->instructions.'</div>':'';?>
                <?=strlen($coupon->code)?'Coupon Code: <strong style="font-size:18px; color:#F90">'.$coupon->code.'</strong>':'';?>
                <input type="text" name="couponcode" id="couponcode" class="form-control" placeholder="Type the discount code here" value="<?=isset($_POST['coupon'])?esc_html($_POST['coupon']):'';?>" style=""  />
            </div>
        </div>
        <? endif;?>
        
        <? if(!is_user_logged_in()):?>
        
      <h3>Sign Up Details</h3>
        
        <div class="form-group">
            <label class="control-label col-3" for="full_name">Full Name:</label>
            <div class="col-7">
            <input type="text" name="full_name" id="full_name" class="form-control" value="<?=isset($_POST['full_name'])?esc_html($_POST['full_name']):'';?>" required  />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-3" for="email">Email:</label>
            <div class="col-7">
            <input type="email" name="email" id="email" class="form-control" value="<?=isset($_POST['email'])?esc_html($_POST['email']):'';?>" required  />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-3" for="username">Username:</label>
            <div class="col-7">
            <input type="text" name="username" id="username" class="form-control" value="<?=isset($_POST['username'])?esc_html($_POST['username']):'';?>" required  />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-3" for="password">Password:</label>
            <div class="col-7">
            <input type="password" name="password" id="password" class="form-control" value=""  required pattern="().{4,}" onchange="form.repassword.pattern = this.value;" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-3" for="repassword">Re-Type Password:</label>
            <div class="col-7">
            <input type="password" name="repassword" id="repassword" class="form-control" value="" required pattern="().{4,}"  />
            </div>
        </div>
        
        <? if(isset($fields['country'])):?>
        <div class="form-group">
            <label class="control-label col-3" for="country">Country:</label>
            <div class="col-7">
            <select name="country" id="country" class="form-control" required>
            	<option value="">Select</option>
                <? foreach($this->countries as $c):?>
                <option value="<?=$c->id;?>" <?=isset($_POST['country'])&&$_POST['country']==$c->id?'selected':'';?> currency="<?=$c->currency_iso3;?>"><?=$c->nicename;?></option>
                <? endforeach;?>
            </select>
            </div>
        </div>
        <? endif;?>
        
        <? if(isset($fields['phone'])):?>
        <div class="form-group">
            <label class="control-label col-3" for="phone">Contact Phone #1:</label>
            <div class="col-7">
            <input type="text" name="phone" id="phone" class="form-control" value="<?=isset($_POST['phone'])?esc_html($_POST['phone']):'';?>" required  />
            </div>
        </div>
        <? endif;?>
        
        <? endif;?>
        
        <div class="form-group">
        	<input type="hidden" name="task" value="order.save" /> 
            <label class="control-label col-3">&nbsp;</label>
            <div class="col-7">
            <input type="submit" name="sbtn" class="btn btn-primary" value="Proceed to Checkout"  />
            </div>
        </div>
        
    </form>
    
</div>
<script>
	(function($){
		$(window).load(function(){
			var order = new window.order(config={wordsPerPage:<?=$wordsperpage;?>, top10cost:$('#t10w')[0].checked?<?=$t10w_cost;?>:0, 
				vipcost:$('#vipsupport')[0].checked?<?=$vip_cost;?>:0}),
				pages=1, spacing=1, level=1, urgency=1, totalPer=1, essayType=$('#doctype').length ? parseInt($('#doctype').find('option:selected').val()) : 1, 
				currency = <?=json_encode($currency);?>, ex_rate = 1, minamount=parseFloat($('#minamount').val()) || 0;
			
			$('#top10cost').html('USD '+<?=$t10w_cost;?>).prev().val(<?=$t10w_cost;?>);
			$('#vipcost').html('USD '+<?=$vip_cost;?>).prev().val(<?=$vip_cost;?>);
			
			$('#minamount').change(function(){
				minamount = parseFloat($(this).val()) / ex_rate ;
				var isVIPChecked = $('#vipsupport').length && $('#vipsupport')[0].checked;
				var ist10supportChecked = $('#t10w').length && $('#t10w')[0].checked;
				$('#total').val( ((minamount + (isVIPChecked ? config.vipcost : 1) + (ist10supportChecked ? config.top10cost : 1) ) * ex_rate).toFixed(2) );
			}).trigger('change');
			
			<? if(isset($fields['total'])):?>
			$('#doctype').change(function(){
				essayType=parseInt($(this).find('option:selected').attr('amnt'));
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
			});
			
			$('#service').change(function(){
				if($(this).val() == 'Revision / Editing') totalPer = <?=get_option('_revedit_percentage', 0.3);?>;
				else totalPer = 1;
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
			});
			
			$('#spacing').change(function(){
				spacing=$(this)[0].checked?2:1;
				$('#words').val(order.wordsPerPage*pages*spacing);
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
			});
			
			$('#aclevel').change(function(){
				level=parseInt($(this).find('option:selected').attr('cost'));
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
			});
			
			$('#urgency').change(function(){
				urgency=parseInt($(this).find('option:selected').attr('cost'));
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
			});
			<? endif;?>
			
			$('#pages').change(function(){
				pages=parseInt($(this).val());
				$('#words').val(order.wordsPerPage*pages*spacing);
				<? if(isset($fields['total'])):?>
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
				<? else:?>
				$('#minamount').trigger('change');
				<? endif;?>
			});
			
			$('#t10w').change(function(){
				order.top10cost = $(this)[0].checked ? parseFloat($(this).val()) : 0;
				console.log(order.top10cost);
				<? if(isset($fields['total'])):?>
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
				<? else:?>
				$('#minamount').trigger('change');
				<? endif;?>
			});
			
			$('#vipsupport').change(function(){
				order.vipcost = (vc=$(this)[0]).checked ? parseFloat($(this).val()) : 0;
				<? if(isset($fields['total'])):?>
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
				<? else:?>
				$('#minamount').trigger('change');
				<? endif;?>
			});
			
			$('.cur-radio').click(function(){
				$(this).addClass('active').siblings().removeClass('active');
				ex_rate = currency[$(this).html()] ? currency[$(this).html()].exchange_rate : 1;
				
				$('#currency').val($(this).html());
				$('#top10cost').html( $(this).html() + ' ' +((<?=$t10w_cost;?> * ex_rate).toFixed(2)) );
				$('#vipcost').html( $(this).html() + ' ' +((<?=$vip_cost;?> * ex_rate).toFixed(2)) );
				(minAmountField=$('.mincurrency').html( $(this).html() ).next()).val( (minamount * ex_rate).toFixed(2) );
				
				<? if(isset($fields['total'])):?>
				$('#total').val( parseFloat((order.total(pages, spacing, level, urgency, essayType)*totalPer)*ex_rate).toFixed(2) );
				<? else:?>
				$('#minamount').trigger('change');
				<? endif;?>
			});
			
		});
		
		$(document).ready(function(){
			
			<? if(isset($_POST['calc-currency'])):?>
				$('#doctype').val(<?=$_POST['calc-doctype'];?>).trigger('change');
				$('#aclevel').val(<?=$_POST['calc-aclevel'];?>).trigger('change');
				$('#pages').val(<?=$_POST['calc-pages'];?>).trigger('change');
				$('#urgency').val('<?=$_POST['calc-urgency'];?>').trigger('change');
				$('#doctype').val(<?=$_POST['calc-doctype'];?>).trigger('change');
				$('#cur-<?=$_POST['calc-currency'];?>').trigger('click').addClass('active');
			<? endif;?>
		});
	})(jQuery);
</script>