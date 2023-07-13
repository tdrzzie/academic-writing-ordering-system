<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );?>
<form action="" method="post" class="form form-inline">

    <div class="form-group">

        <label class="control-label" for="state">Revision / Editing Fee</label>

        <div class="input-group">

            <input type="number" name="_revedit_percentage" class="form-control" value="<?=(isset($this->_revedit_percentage)?$this->_revedit_percentage:0.3)*100;?>" />

            <span class="input-group-addon">% of total</span>

        </div>

    </div>

    

    <div class="form-group">

        <input type="hidden"t name="task" value="admin.save_revedit" />

        <input type="submit" value="SAVE" class="btn btn-primary" />

    </div>

</form>