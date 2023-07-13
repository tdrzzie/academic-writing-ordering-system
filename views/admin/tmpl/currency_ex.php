<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );?>

<p>Enable and configure the currencies that you would like to use</p>

<form action="" method="post" class="form form-inline">
	
    <div class="row">
    
        <div class="col-lg-3 col-md-3">
			<?
            	//$curren
				$c=0;
				foreach($this->currencies as $curr):
				 $c++;
			?>
            
            <div class="">
        
               <div class="input-group">
                    
                    <span class="input-group-addon">
                        <input type="checkbox" class="usecurrency" <?=isset($this->_currency[$curr]['exchange_rate'])?'checked':'';?> />
                    </span>
                    
                     <input type="number" <?=!isset($this->_currency[$curr]['exchange_rate'])?'disabled':'';?> name="<?=$curr;?>[exchange_rate]" class="form-control" min="0.01" step=any 
                    	 value="<?=isset($this->_currency[$curr]['exchange_rate'])?$this->_currency[$curr]['exchange_rate']:'1.00';?>" 
                         placeholder="0.00 Rate" required title="Exchange Rate" />
        
                    <span class="input-group-addon"><?=$curr;?> = 1 USD</span>
        
               </div>
        
            </div>
        
            <br />
         <? if(!($c % floor(count((array)$this->currencies)/4))):?></div><div class="col-lg-3 col-md-3"><? endif;?>
            <? endforeach;?>
        </div>
    </div>
    
    <script>
		(function($){
			$(document).ready(function(){
				$('.usecurrency').change(function(){
					$(this).parent().next()[0].disabled = !this.checked;
				});
			});
		})(jQuery);
	</script>
    

    <div class="form-group">

        <input type="hidden" name="task" value="admin.set_currency" />

        <input type="submit" value="SET" class="btn btn-success" />

    </div>

</form>