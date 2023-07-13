<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	global $wpdb;

?>

<div class="BEx">
    <div class="page-heading">
    	<h3>Configurations</h3>
    </div>
    
    <div>

    	<nav>

        	<ul class="nav nav-tabs">

            	<li role="presentation" class="active"><a class="tab" href="#apiconfigs">API Configurations</a></li>

                <li role="presentation"><a class="tab" href="#smtpconfigs">SMTP Configurations</a></li>

                <li role="presentation"><a class="tab" href="#fields">Application Form Fields</a></li>
                
                <li role="presentation"><a class="tab" href="#currency">Currency</a></li>

                <li role="presentation"><a class="tab" href="#pricing">Pricing</a></li>

                <li role="presentation"><a class="tab" href="#coupon">Coupon</a></li>

                <li role="presentation"><a class="tab" href="#revedi">Revision / Editing</a></li>

            </ul>

        </nav>

    </div>

    

    <div class="nav-panes" style="padding:20px;">

    	<?=$this->showMessages()?>   

        <div class="tab-pane" id="apiconfigs">
        	<? include plugin_dir_path(__file__).'/apiconfig.php';?>
        </div>
        
        <div class="tab-pane" id="smtpconfigs">
        	<? include plugin_dir_path(__file__).'/smtpconfigs.php';?>
        </div>
        
		<div class="tab-pane" id="currency">
         	<? include plugin_dir_path(__file__).'/currency_ex.php';?>
        </div>
        
        <div class="tab-pane" id="fields">
         	<? include plugin_dir_path(__file__).'/fields.php';?>
        </div>
        
        <div class="tab-pane" id="pricing">
			<? include plugin_dir_path(__file__).'/pricing.php';?>
        </div>
        
        <div class="tab-pane" id="coupon">
        	<? include plugin_dir_path(__file__).'/coupon.php';?>
        </div>

        <div class="tab-pane" id="revedi">
        	<? include plugin_dir_path(__file__).'/revenue.php';?>
        </div>

    </div>

    

</div>

<script>

	

	(function($){

		$(document).ready(function(){

			$('.tab-pane').hide();

			$($('li.active a').attr('href')).show();

			

			$('.tab').click(function(e){

				$('.tab-pane').hide();

				$('.nav-tabs li').removeClass('active');

				$($(this).attr('href')).show();

				$(this).parent().addClass('active');

			});

			var hash = (locationHash=window.location.hash).length?locationHash:'#apiconfigs';

			$('[href="'+hash+'"]').trigger('click');

		});

	})(jQuery);

</script>