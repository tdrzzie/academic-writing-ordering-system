<?	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );?>
<form action="" method="post">

    <div class="form-group">

        <h3>SMTP Configurations</h3>

        <p>Configure SMTP settings for sending emails to clients</p>

    </div> 

    

    <div class="form-group">

        <label class="control-label" for="smtphost">SMTP Host</label>

        <input type="text" name="smtphost" id="smtphost" class="form-control" value="<?=isset($this->smtpconfigs['smtphost'])?$this->smtpconfigs['smtphost']:'';?>" />

    </div>

    

    <div class="form-group">

        <label class="control-label" for="smtpfromname">From Name</label>

        <input type="text" name="smtpfromname" id="smtpfromname" class="form-control" value="<?=isset($this->smtpconfigs['smtpfromname'])?$this->smtpconfigs['smtpfromname']:'';?>" />

    </div>

    

    <div class="form-group">

        <label class="control-label" for="smtpfromemail">From Email</label>

        <input type="text" name="smtpfromemail" id="smtpfromemail" class="form-control" value="<?=isset($this->smtpconfigs['smtpfromemail'])?$this->smtpconfigs['smtpfromemail']:'';?>" />

    </div>

    

    <div class="form-group">

        <label class="control-label" for="smtpusername">Username</label>

        <input type="text" name="smtpusername" id="smtpusername" class="form-control" value="<?=isset($this->smtpconfigs['smtpusername'])?$this->smtpconfigs['smtpusername']:'';?>" />

    </div>

    

    <div class="form-group">

        <label class="control-label" for="smtppwd">SMTP Password</label>

        <input type="password" name="smtppwd" id="smtppwd" class="form-control" value="<?=isset($this->smtpconfigs['smtppwd'])?$this->smtpconfigs['smtppwd']:'';?>" />

    </div>

    

    <div class="form-group">

        <input type="hidden" name="task" value="admin.save_smtp" />

        <input type="submit" value="SAVE" class="btn btn-primary" />

    </div>

</form>