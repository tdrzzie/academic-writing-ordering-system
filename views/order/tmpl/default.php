<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	$doctypes=(array)$this->doctypes;

	$aclevels=(array)$this->get('AcademicLevels');

	$subjects=(array)$this->get('Subjects');
	
	$fields = json_decode(get_option("_fields", '[]'), true);

?>



<div class="BEx">

	

    <? if(!empty($this->item)):

		$_SESSION['recheck']=0;

	?>

    <div class="page-heading">

    	<div style="float:right">

        	Status: <span id="orderstatus" style="display:inline-block; padding:2px 10px; background:#DDF4FF"><?=ucwords(strtolower($this->item->status));?></span>

        	<span id="setstatus" style="cursor:pointer" onclick="jQuery(this).next().slideToggle();" class="btn btn-default">Set</span>

            <ul class="statusSetter nav nav-stacked" style="position:absolute; display:none; width:180px; background:#FFF; border:1px #CCC solid; margin-top:-1px;">

            	<? if(ucwords(strtolower($this->item->status)) != 'Revision'):?><li><a href="" status="Revision">Revision</a></li><? endif;?>

                <? if(ucwords(strtolower($this->item->status)) != 'Complete'):?><li><a href="" status="Complete">Complete</a></li><? endif;?>

            </ul>

        </div>

    	<h3>Order <?=$this->item->order_id;?></h3>

    </div>

    

    <?=$this->showMessages()?>

    

    <? if($this->item->payment_status == 'NOT PAID'):?>

    <div style="background:#FFDDAE; padding:3px 20px 20px 20px; margin-bottom:20px;">

        <h3>Order Payment</h3>

        <p>You have not paid for this order. Please click on the checkout button below to pay</p>

        <? include plugin_dir_path(__file__).'/default_pay.php';?>

    </div>

    <? endif;?>

    

    <div>

    	<nav>

        	<ul class="nav nav-tabs">

            	<li role="presentation" class="active"><a class="tab" href="#orderdetails">Order Details</a></li>

                <li role="presentation"><a class="tab" href="#orderfiles">Files</a></li>

                <li role="presentation"><a class="tab" href="#messages">Messages(<span id="messagecount">0</span>)</a></li>

            </ul>

        </nav>

    </div>

    

    <div class="nav-panes">

    	

        <div class="tab-pane" id="orderdetails">

        	

             <form action="" method="post" enctype="multipart/form-data">

             <input type="hidden" name="orderid" id="orderid" value="<?=esc_html($this->item->id);?>" />

             

             
			<? if(isset($fields['service'])):?>
             <div>

            	<div class="col-4">

                	Type of service:

                </div>

                <div class="col-5"><?=esc_html($this->item->service_type);?></div>

            </div>
			<? endif;?>
            
			<? if(isset($fields['urgency'])):?>
            <div>

            	<div class="col-4">

                	Deadline:

                </div>

                <div class="col-5">

                	<?=esc_html($this->item->deadline);?>

                </div>

            </div>
			<? endif;?>
            
			<? if(isset($fields['aclevel'])):?>
            <div>

            	<div class="col-4">

                	Academic Level:

                </div>

                <div class="col-5">

                	<?=esc_html($aclevels[$this->item->level]->level);?>

                </div>

            </div>
			<? endif;?>
            
			<? if(isset($fields['ordsubj'])):?>
            <div>

            	<div class="col-4">

                	Subject / Discipline:

                </div>

                <div class="col-5">

                	<?=$subjects[(int)$this->item->subject]->subject;?>

                </div>

            </div>
			<? endif;?>
            
            <div>

            	<div class="col-4">

                	Title:

                </div>

                <div class="col-5"><?=esc_html($this->item->topic);?></div>

            </div>
            
			<? if(isset($fields['sources'])):?>
            <div>

            	<div class="col-4">

                	Number of Sources:

                </div>

                <div class="col-5">

                	<?=esc_html($this->item->sources);?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['style'])):?>
            <div>

            	<div class="col-4">

                	Paper format:

                </div>

                <div class="col-5">

                	<?=esc_html($this->item->style);?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['pages'])):?>
            <div>

            	<div class="col-4">

                	Pages:

                </div>

                <div class="col-5">

                	<?=(int)$this->item->pages;?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['spacing'])):?>
            <div>

            	<div class="col-4">

                	Spacing:

                </div>

                <div class="col-5">

                	<?=(int)$this->item->spacing==1?'Double Space':'Single Space';?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['pages'])):?>
            <div>

            	<div class="col-4">

                	No of Words:

                </div>

                <div class="col-5">

                	<?=number_format((int)$this->item->wordcount);?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['slides'])):?>
            <div>

            	<div class="col-4">

                	No of Slides:

                </div>

                <div class="col-5">

                	<?=ucwords((int)$this->item->slides);?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['t10w'])):?>
            <div>

            	<div class="col-4">

                	Top 10 Writers:

                </div>

                <div class="col-5">

                	<?=number_format((float)$this->item->toptenwriters,2);?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['vipsupport'])):?>
            <div>

            	<div class="col-4">

                	VIP support:

                </div>

                <div class="col-5">

                	<?=number_format((float)$this->item->vipsupport,2);?>

                </div>

            </div>
            <? endif;?>
            
			<? if(isset($fields['english'])):?>
            <div>

            	<div class="col-4">

                	English:

                </div>

                <div class="col-5">

                	<?=esc_html($this->item->language);?>

                </div>

            </div>
            <? endif;?>
            
            <div>

            	<div class="col-4">

                	Fee:

                </div>

                <div class="col-5">

                	<? $color = $this->item->payment_status=='NOT PAID' ? 'red' : ($this->item->payment_status == 'PENDING PAYMENT' ? 'orange' : 'green');?>

                	<?=$this->item->currency.' '.number_format($this->item->amount, 2).' <span style="color:'.$color.'">'.esc_html($this->item->payment_status).'</span>';?>

                </div>

            </div>

            

            <div>

            	<div class="col-4">

                	Paper Details:

                </div>

                <div class="col-5">

                	<?=nl2br(esc_html($this->item->requirements));?>

                </div>

            </div>

            

            <input type="hidden" name="task" id="task" value="" />

            </form>

            

        </div>

        

       <!-- Files Tab-->

        

        <div class="tab-pane" id="orderfiles">

        	

             <div align="left">                

             	<form action="<?=$this->item->upload_url;?>" method="post" enctype="multipart/form-data" id="uploadFrm">

                <input type="hidden" name="orderid" id="orderid" value="<?=$this->item->id;?>" />

                <input type="hidden" name="token" value="<?=$this->item->uptoken;?>" />

             	<input type="file" name="orderFiles[]" id="filefield" required multiple style="display:inline-block" />
				
                <input type="hidden" name="task" value="api.upload_files" />
                
             	<input type="submit" value="Upload Files" />
               <!-- <button id="uploadFilesBtn" class="btn btn-primary" style="display:inline-block"><span class="glyphicon glyphicon-upload"></span> <span>Upload Files</span></button>-->

                </form>

             </div>

             

            <? if(strlen($this->item->files)):?>

            <ul>

			<?	foreach(json_decode($this->item->files) as $file):?>

            <li>

            	<a href="<?=site_url('order?view=order&ordid='.$this->item->id.'&task=order.download&f='.$file->newname);?>"><?=$file->name;?></a>

                <?=isset($file->uploader)?'Uploaded at '.date('d/m/Y h:ma', strtotime($file->date)):'';?>

            </li>

            <? endforeach;?>

			</ul>

            <? else:?>

            <h3 align="center">No Files Uploaded</h3>

			<? endif;?>

           

        </div>

        

        <!-- Messages Tab-->

        

        <div class="tab-pane" id="messages">

        	

           <? include plugin_dir_path(__file__).'/default_messages.php';?>

            

        </div>

        

    </div>

    <? else:

		if(!isset($_SESSION['recheck'])) $_SESSION['recheck']=0;

		if($_SESSION['recheck'] <= 3):

		$_SESSION['recheck']+=1;

	?>

    	<h3 align="center"><i style="font-size:12px">We are having difficulties pulling this error due to slow communication.</i><br/>Wait while we pull this order...</h3>

        <script>window.location.reload();</script>

    <? else:?>

    <h3 align="center">Order not found</h3>

    <?  endif; endif;?>

    

</div>



<script>

	(function($){

		var order = new window.order({url:'<?=get_site_url();?>'});

		$(document).ready(function(){

			var top=$(window).scrollTop();

			$(window).scroll(function(){ top=$(window).scrollTop(); });

			$('.tab-pane').hide();

			$($('li.active a').attr('href')).show();

			

			$('.tab').click(function(e){

				

				$('.tab-pane').hide();

				$('.nav-tabs li').removeClass('active');

				$($(this).attr('href')).show();

				$(this).parent().addClass('active');

			});

			var hash = (locationHash=window.location.hash).length?locationHash:'#orderdetails';

			$('[href="'+hash+'"]').trigger('click');

			

			$('.statusSetter li a').click(function(e){

				e.preventDefault();

				$(this).parent().parent().slideUp();

				$('#orderstatus').html('Setting...');

				order.setStatus((status=$(this).attr('status')), $('#orderid').val(), function(){

					window.location.reload();

				});

			});


			<? if(isset($_SESSION['js_send_emails_data']) && $_SESSION['js_send_emails_data']):?>

			var data = <?=$_SESSION['js_send_emails_data'];?>;

			console.log(data);

			data.task='order.email_notify';

			data.step=1;

			$.post('http://'+window.location.host, data, function(res){

				console.log('step one done');

				data.step=2;

				$.post('http://'+window.location.host, data, function(resp){

					console.log('step two done');

				}).error(function(e){ console.log(e.statusText); });

			}).error(function(e){ console.log(e.statusText); });

			<? $_SESSION['js_send_emails_data']=null; endif;?>

		});

	})(jQuery);

</script>