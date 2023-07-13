<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

	$this->orders = $this->get('Orders');

	$doctypes=(array)$this->doctypes;

	$aclevels=(array)$this->aclevels;

	$subjects=(array)$this->subjects;

?>



<div class="BEx Orders">

	

    <div class="page-heading">

    	<h3>Orders</h3>

    </div>

    <?=$this->showMessages()?>

    <div>

    	

        <table class="table table-hover">

        	

            <thead>

                <tr>

                    <td>Order No</td>

                    <td>Title</td>

                    <td>Subject Area</td>

                    <td>Academic Level</td>

                    <td>Deadline</td>

                    <td>Pages</td>

                    <td>Cost(USD)</td>

                </tr>

           </thead>

           

           <tbody>

           		<? if(!empty($this->orders)):

					foreach($this->orders as $order):

				?>

                <tr>

                    <td><a href="<?=get_site_url();?>/order?view=order&ordid=<?=$order->id;?>">#<?=str_pad($order->order_id, 5, '0', STR_PAD_LEFT);?></a></td>

                	<td><?=$order->topic;?></td>

                    <td><?=$subjects[$order->subject]->subject;?></td>

                    <td><?=$aclevels[$order->level]->level;?></td>

                    <td><?=date('j M, Y H:i:s', strtotime($order->deadline));?></td>

                    <td><?=$order->pages;?></td>

                    <td><?=$order->amount;?></td>

                </tr>

                <? endforeach; else:?>

                <tr>

                	<td colspan="7">No Orders</td>

                </tr>

                <? endif;?>

           </tbody>

            

        </table>

        

    </div>

    

</div>