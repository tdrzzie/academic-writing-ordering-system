<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );?>
<h3>Generate Coupon <a href="#" onclick="($=jQuery)('#name').val(''); $('#desc').val(''); $('#code').val('<?=strtoupper(substr(md5(rand(0,199999)), 0, 8));?>'); $('#discount').val('1'); $('#minamount').val('0.00'); $('#state').val('ACTIVATE');" class="btn btn-default btn-xs" data-toggle="modal" data-target="#couponModal">Generate</a></h3>

<table width="70%" class="table table-hover table-striped">

<thead>

    <tr>

        <td>Coupon Code</td>

        <td>Discount</td>

        <td>Minimum Amount</td>

        <td colspan="2">Status</td>

    </tr>

</thead>

<tbody>

    <? foreach($this->coupons as $coupon):?>

    <tr>

        <td><?=$coupon->code;?></td>

        <td><?=$coupon->discount*100;?>%</td>

        <td><?=number_format($coupon->min_amount, 2);?></td>

        <td><?=$coupon->status;?></td>

        <td>
        	<div class="btn-group">
        	<a href="#" onclick="($=jQuery)('#name').val('<?=$coupon->name;?>'); $('#desc').val('<?=$coupon->instructions;?>'); $('#code').val('<?=$coupon->code;?>'); $('#discount').val('<?=$coupon->discount*100;?>'); $('#minamount').val('<?=number_format($coupon->min_amount,2);?>'); $('#state').val('<?=$coupon->status;?>');" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#couponModal"><span class="glyphicon glyphicon-pencil"></span></a>
            <a href="" class="btn btn-default btn-xs" onclick="return rm(jQuery(this).parent().parent().parent(), 'coupons', <?=$coupon->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
           </div>
        </td>

    </tr>

    <? endforeach;?>

</tbody>

</table>



<div class="modal fade" id="couponModal" tabindex="-1" role="dialog" aria-labelledby="couponModalLabel">

    <div class="modal-dialog" role="form">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="couponModalLabel">Coupons</h4>

      </div>

      <div class="modal-body" style="padding:10px;">

    

    <form action="" method="post" class="form">

        <input type="hidden" name="id" id="couponid" value="0" />

        <div class="form-group">

            <label class="control-label" for="name">Name</label>

            <input type="text" name="name" id="name" value="" class="form-control"  />

        </div>

        

        <div class="form-group">

            <label class="control-label" for="desc">Description</label>

            <input type="text" name="desc" id="desc" value="" class="form-control"  />

        </div>

        

        <div class="form-group">

            <label class="control-label" for="code">Code</label>

            <div class="input-group">

            <input type="text" name="code" id="code" value="" class="form-control" required  />

            <div class="input-group-btn">

                <button type="button" class="btn btn-primary" onclick="jQuery('#code').val(Math.random().toString(36).substr(2,10).toUpperCase());">Random Generate</button>

            </div>

            </div>

        </div>

        

        <div class="form-group">

            <label class="control-label" for="discount">Discrount</label>

            <div class="input-group">

            <input type="number" name="discount" id="discount" min="0" step="any" value="" class="form-control" required />

            <span class="input-group-addon">%</span>

            </div>

        </div>

        

        <div class="form-group">

            <label class="control-label" for="minamount">Minimal Amount</label>

            <input type="number" name="minamount" id="minamount" min="0" step="any" value="" class="form-control" />

        </div>

        

        <div class="form-group">

            <label class="control-label" for="state">Status</label>

            <select name="state" id="state" class="form-control">

                <option value="ACTIVE">ACTIVATED</option>

                <option value="DISABLED">DISABLED</option>

            </select>

        </div>

        

        <div class="form-group" align="right">

            <input type="hidden" name="task" value="admin.save_coupon" />

            <input type="submit" value="SAVE" class="btn btn-primary" />

        </div>

    </form>

    </div>

    </div>

    </div>

</div>