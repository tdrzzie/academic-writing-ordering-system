<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );?>
<div class="col-5">

    <h3>Urgency <a href="" class="btn btn-default btn-xs" onclick="($=jQuery)('#time').val('1'); $('#notationtxt').html(''); $('#urgamount').val('0.00'); $('#urgid').val('0'); $('#notation').val('');" data-toggle="modal" data-target="#urgencyModal">Add</a></h3>

    <table width="70%" class="table table-hover table-striped">

        <thead>

            <tr>

                <td>Time</td>

                <td colspan="2">Amount</td>

            </tr>

        </thead>

        <tbody>

            <? foreach($this->urgency as $urgency):?>

            <tr>

                <td><?=$urgency->time.' '.$urgency->marker;?></td>

                <td><?=number_format($urgency->amount, 2);?></td>

                <td>
                	<div class="btn-group">
                	<a href="" class="btn btn-warning btn-xs" onclick="($=jQuery)('#time').val('<?=$urgency->time;?>'); $('a[ntxt=\'<?=$urgency->marker;?>\']').trigger('click'); $('#urgamount').val('<?=number_format($urgency->amount, 2);?>'); $('#urgid').val('<?=$urgency->id;?>');" data-toggle="modal" data-target="#urgencyModal"><span class="glyphicon glyphicon-pencil"></a>
                    <a href="" class="btn btn-default btn-xs" onclick="return rm(jQuery(this).parent().parent().parent(), 'urgency', <?=$urgency->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
                    </span>
               </td>

            </tr>

            <? endforeach;?>

        </tbody>

    </table>

    <div class="modal fade" id="urgencyModal" tabindex="-1" role="dialog" aria-labelledby="urgencyModalLabel">

        <div class="modal-dialog" role="form">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="modal-title" id="urgencyModalLabel">Urgency</h4>

          </div>

          <div class="modal-body" style="padding:10px;">

        <form action="" method="post" class="form">

            <input type="hidden" name="id" id="urgid" value="0" />

            <div class="form-group">

                <label class="control-label" for="time">Duration</label>

                <div class="input-group">

                <input type="number" name="time" id="time" value="1" class="form-control" required  />

                <div class="input-group-btn">

                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <span id="notationtxt">Notation</span> <span class="caret"></span></button>

                    <ul class="dropdown-menu dropdown-menu-right">

                      <li><a ntxt="hours" href="#" onclick="jQuery('#notationtxt').html('Hours'); jQuery('#notation').val('hours'); return false;">Hours</a></li>

                      <li><a ntxt="days" href="#" onclick="jQuery('#notationtxt').html('Days'); jQuery('#notation').val('days'); return false;">Days</a></li>

                    </ul>

                </div>

                </div>

                <input type="hidden" name="notation" id="notation" value="" required  />

            </div>

            <div class="form-group">

                <label class="control-label" for="amount">Amount</label>

                <div class="input-group">

                    <span class="input-group-addon">USD</span>

                    <input type="number" name="amount" id="urgamount" min="0" value="" step="any" class="form-control" required  />

                </div>

            </div>

            <div class="form-group" align="right">

                <input type="hidden" name="task" value="admin.save_urgency" />

                <input type="submit" value="SAVE" class="btn btn-primary" />

            </div>

        </form>

        </div>

        </div>

        </div>

    </div>

</div>



<div class="col-5">

    <h3>Academic Levels <a href="#" onclick="($=jQuery)('#level').val(''); $('#levelAmount').val('0.00'); $('#levelid').val('0');" class="btn btn-default btn-xs" data-toggle="modal" data-target="#levelModal">Add</a></h3>

    <table width="70%" class="table table-hover table-striped">

        <thead>

            <tr>

                <td>Level</td>

                <td colspan="2">Amount</td>

            </tr>

        </thead>

        <tbody>

            <? foreach($this->aclevels as $level):?>

            <tr>

                <td><?=$level->level;?></td>

                <td><?=number_format($level->amount, 2);?></td>

                <td>
                	<div class="btn-group">
                    <a href="#" onclick="($=jQuery)('#level').val('<?=$level->level;?>'); $('#levelAmount').val('<?=number_format($level->amount, 2);?>'); $('#levelid').val('<?=$level->id;?>');" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#levelModal"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="" class="btn btn-default btn-xs" onclick="return rm(jQuery(this).parent().parent().parent(), 'aclevels', <?=$level->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
                    </div>
                </td>

            </tr>

            <? endforeach;?>

        </tbody>

    </table>

    <div class="modal fade" id="levelModal" tabindex="-1" role="dialog" aria-labelledby="levelModalLabel">

        <div class="modal-dialog" role="form">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="modal-title" id="levelModalLabel">Levels</h4>

          </div>

          <div class="modal-body" style="padding:10px;">

        

        <form action="" method="post" class="form">

            <input type="hidden" name="id" id="levelid" value="0" />

            <div class="form-group">

                <label class="control-label" for="level">Level</label>

                <input type="text" name="level" id="level" value="" class="form-control" required  />

            </div>

            <div class="form-group">

                <label class="control-label" for="amount">Amount</label>

                <input type="number" name="amount" id="levelAmount" min="0" step="any" value="" class="form-control" required />

            </div>

            <div class="form-group" align="right">

                <input type="hidden" name="task" value="admin.save_level" />

                <input type="submit" value="SAVE" class="btn btn-primary" />

            </div>

        </form>

        </div>

        </div>

        </div>

    </div>

</div>



<div class="col-5">

    <h3>Document Types <a href="#" onclick="($=jQuery)('#type').val(''); $('#typeAmount').val('0.00'); $('#typeid').val('0');" class="btn btn-default btn-xs" data-toggle="modal" data-target="#doctypeModel">Add</a></h3>

    <table width="70%" class="table">

        <thead>

            <tr>

                <td width="70%">Type</td>

                <td colspan="2">Amount</td>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td colspan="2">

                    <div style="max-height:300px; overflow:hidden; overflow-y:auto;">

                    <table width="70%" class="table table-hover table-striped">

                    <? foreach($this->doctypes as $doctype):?>

                    <tr>

                        <td width="70%"><?=$doctype->type;?></td>

                        <td><?=number_format($doctype->amount, 2);?></td>

                        <td>
                        	<div class="btn-group">
                        	<a href="#" onclick="($=jQuery)('#type').val('<?=$doctype->type;?>'); $('#typeAmount').val('<?=$doctype->amount;?>'); $('#typeid').val('<?=$doctype->id;?>');" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#doctypeModel"><span class="glyphicon glyphicon-pencil"></span></a>
                            <a href="" class="btn btn-default btn-xs" onclick="return rm(jQuery(this).parent().parent().parent(), 'doctypes', <?=$doctype->id;?>)"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                       </td>

                    </tr>

                    <? endforeach;?>

                    </table>

                    </div>

                </td>

            </tr>

        </tbody>

    </table>

    <div class="modal fade" id="doctypeModel" tabindex="-1" role="dialog" aria-labelledby="doctypeModelLabel">

        <div class="modal-dialog" role="form">

        <div class="modal-content">

          <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h4 class="modal-title" id="doctypeModelLabel">Document Type</h4>

          </div>

          <div class="modal-body" style="padding:10px;">

        

        <form action="" method="post" class="form">

            <input type="hidden" name="id" id="typeid" value="0" />

            <div class="form-group">

                <label class="control-label" for="type">Type</label>

                <input type="text" name="type" id="type" value="" class="form-control" required  />

            </div>

            <div class="form-group">

                <label class="control-label" for="typeAmount">Amount</label>

                <input type="number" name="amount" id="typeAmount" min="0" step="any" value="" class="form-control" required />

            </div>

            <div class="form-group" align="right">

                <input type="hidden" name="task" value="admin.save_doctype" />

                <input type="submit" value="SAVE" class="btn btn-primary" />

            </div>

        </form>

        </div>

        </div>

        </div>

    </div>

</div>



<div class="col-5">

    <div style="padding:10px">

    <h3>Other Order Settings</h3>

    <form action="" method="post" class="form-horizontal">

        <div class="form-group">

            <label class="control-label col-sm-5 " for="t10w_cost">Written by Top 10 Writers Cost</label>

            <div class="col-sm-7">

            <div class="input-group">

                <span class="input-group-addon">USD</span>

                <input type="number" name="t10w_cost" id="t10w_cost" min="1" step="any" value="<?=get_option('_t10w_cost', 2.95);?>" class="form-control" required />

                <span class="input-group-addon"> / Page</span>

            </div>

            </div>

        </div>

        

        <div class="form-group">

            <label class="control-label col-sm-5 " for="vip_cost">VIP Support Cost</label>

            <div class="col-sm-7">

            <div class="input-group">

                <span class="input-group-addon">USD</span>

                <input type="number" name="vip_cost" id="vip_cost" min="1" step="any" value="<?=get_option('_vip_cost', 9.95);?>" class="form-control" required />

                

            </div>

            </div>

        </div>

        

        <div class="form-group">

            <label class="control-label col-sm-5 " for="wordsperpage">Words Per Page</label>

            <div class="col-sm-7">

            <div class="input-group">

                <input type="number" name="wordsperpage" id="wordsperpage" min="1" step="any" value="<?=get_option('_wordsperpage', 275);?>" class="form-control" required />

                <span class="input-group-addon">Words</span>

            </div>

            </div>

        </div>

        

        <div class="form-group">

            <input type="hidden" name="task" value="admin.save_order_settings" />

            <input type="submit" value="Save Options" class="btn btn-success" />

        </div>

    </form>

    </div>

</div>
<script>
	function rm(trg, r, r_id){
		if(confirm('Are you sure you want to delete this item?')){
			($=jQuery)(trg).remove();
			$.post('<?=admin_url();?>', {resource:r, resource_id:r_id, task:'admin.rm'}, function(res){
				console.log(res);
			}).error(function(e){ console.log(e.statusText); });
		}
		return false;
	}
</script>