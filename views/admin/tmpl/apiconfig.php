<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );?>
<form action="<?=admin_url('?page=orderconfigs');?>" method="post">

    <div class="form-group">
    
        <label class="control-label" for="apikey">API Key</label>
    
        <input type="text" name="api_key" id="apikey" class="form-control" required placeholder="Type the API Key here" value="<?=isset($this->apiConfigs['api_key'])?$this->apiConfigs['api_key']:'';?>" />
    
    </div>
    
    
    
    <div class="form-group">
    
        <label class="control-label" for="apisecret">API Secret</label>
    
        <input type="text" name="api_secret" id="apisecret" class="form-control" required placeholder="Type the API Secret here" value="<?=isset($this->apiConfigs['api_secret'])?$this->apiConfigs['api_secret']:'';?>" />
    
    </div>
    
    
    
    <div class="form-group">
    
        <label class="control-label" for="apihost">API Host</label>
    
        <p>Enter your writers website url here</p>
        
        <input type="text" name="apihost" id="apihost" class="form-control" required value="<?=isset($this->apiConfigs['apihost'])?$this->apiConfigs['apihost']:'http://opskill.com';?>" />
    
    </div> 
    
   <?php /*?> <h3>PayPal Payment Parameters</h3>
    
    <div class="form-group">
    	<label class="control-label" for="paypalemail">Paypal Email</label>
        <i>Enter the email address that will be receiving payments from PayPal</i>    
        <input type="email" name="paypalemail" id="paypalemail" readonly class="form-control" required value="<?=isset($this->apiConfigs['paypalemail'])?$this->apiConfigs['paypalemail']:'';?>"  />
   	</div>
    
     <div class="form-group">
     	<label class="control-label" for="paypalidt">Paypal Identity Token</label>
        <input type="text" name="paypalidt" id="paypalidt" readonly class="form-control" required value="<?=isset($this->apiConfigs['paypalidt'])?$this->apiConfigs['paypalidt']:'';?>"  />
         <p>Aquire this from paypal by upgrading your paypal account to a business account and setup website preferences</p>
        <p>On paypal website preferences, enable "Auto Return" and copy this url as the return url <strong><?=get_site_url();?>/aworder/order?task=order.PDTResponse</strong>,
        	then enable "Payment Data Transfer" and save. Once you save, you will get the identity token just below "Payment Data Transfer", copy it and paste it below.
        </p>
    
    </div> <?php */?>
    
    
    
    <div class="form-group">
    
        <input type="hidden" name="task" value="admin.save_api_configs" />
    
        <input type="submit" value="SAVE" class="btn btn-primary" /> | 
    
        <a href="<?=isset($this->apiConfigs['apihost'])?$this->apiConfigs['apihost']:'http://opskill.com';?>?option=com_writers&view=api">Get API Key and Secret Here</a>
    
    </div>
    
</form>