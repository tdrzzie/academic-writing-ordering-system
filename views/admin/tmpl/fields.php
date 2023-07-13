<? defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
	$fields = json_decode(get_option("_fields", '[]'), true);
?>

<div>
	<div class="page-header">
    	<h3>Order Application Fields Settings</h3>
        <p>Some of the order fields are optional and you can choose which fields the customer can enter while making an order</p>
    </div>
    
    <div>
    	<form action="" method="post">
    	<table class="table table-striped table-hover" width="50%">
        	<thead>
            	<th width="40%">Field</th>
                <th width="50%">Enable / Disable</th>
            </thead>
            
            <tbody>
            	<!--<tr>
                	<td><label style="display:inline-block; width:100%;" for="ordtopic">Title</label></td>
                    <td><input type="checkbox" name="ordtopic" id="ordtopic" value="1" <?=isset($fields['ordtopic'])||isset($_POST['ordtopic'])||empty($fields)?'checked':'';?> /></td>
                </tr>-->
                
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="total">Allow customer to enter their price</label></td>
                    <td bgcolor="#FF0000">
                    	
                    	<div style="display:inline-block; vertical-align:middle">
                    	<input type="checkbox" name="total" id="total" value="1" <?=isset($fields['total'])||isset($_POST['total'])?'checked':'';?> onchange="($=jQuery)(this)[0].checked?$('#minamountholder').hide().find('#minamount')[0].disabled=true:$('#minamountholder').css({display:'inline-block'}).find('#minamount')[0].disabled=false;" />
                        </div>
                        
                        <div id="minamountholder" style="margin-left:20px; display:none; vertical-align:middle; width:50px">
                            <div  class="input-group">
                            <input type="number" name="minamount" id="minamount" value="<?=isset($fields['minamount'])?$fields['minamount']:10;?>" min="10" style="width:50px; text-align:center" disabled="disabled" /><span class="input-group-addon">USD Minimum</span>
                            </div>
                        </div>
                        
                        <script>
							($=jQuery)('#total')[0].checked ? 
							$('#minamountholder').hide().find('#minamount')[0].disabled=true : 
							$('#minamountholder').css({display:'inline-block'}).find('#minamount')[0].disabled=false;
                        </script>
                    </td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="service">Type of service</label></td>
                    <td><input type="checkbox" name="service" id="service" value="1" <?=isset($fields['service'])||isset($_POST['service'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="doctype">Type of Document</label></td>
                    <td><input type="checkbox" name="doctype" id="doctype" value="1" <?=isset($fields['doctype'])||isset($_POST['doctype'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="aclevel">Academic Level</label></td>
                    <td><input type="checkbox" name="aclevel" id="aclevel" value="1" <?=isset($fields['aclevel'])||isset($_POST['aclevel'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="ordsubj">Subject or Discipline</label></td>
                    <td><input type="checkbox" name="ordsubj" id="ordsubj" value="1" <?=isset($fields['ordsubj'])||isset($_POST['ordsubj'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="pages">No. of pages</label></td>
                    <td><input type="checkbox" name="pages" id="pages" value="1" <?=isset($fields['pages'])||isset($_POST['pages'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="spacing">Spacing</label></td>
                    <td><input type="checkbox" name="spacing" id="spacing" value="1" <?=isset($fields['spacing'])||isset($_POST['spacing'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <!--<tr>
                	<td><label style="display:inline-block; width:100%;" for="words">No. of words</label></td>
                    <td><input type="checkbox" name="words" id="words" value="1" <?=isset($fields['words'])||isset($_POST['words'])||empty($fields)?'checked':'';?> /></td>
                </tr>-->
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="urgency">Deadline</label></td>
                    <td><input type="checkbox" name="urgency" id="urgency" value="1" <?=isset($fields['urgency'])||isset($_POST['urgency'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="style">Paper format</label></td>
                    <td><input type="checkbox" name="style" id="style" value="1" <?=isset($fields['style'])||isset($_POST['style'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="sources">Number of sources</label></td>
                    <td><input type="checkbox" name="sources" id="sources" value="1" <?=isset($fields['sources'])||isset($_POST['sources'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="slides">No. of Slides</label></td>
                    <td><input type="checkbox" name="slides" id="slides" value="1" <?=isset($fields['slides'])||isset($_POST['slides'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
               <!-- <tr>
                	<td><label style="display:inline-block; width:100%;" for="currencies">Currencies</label></td>
                    <td><input type="checkbox" name="currencies" id="currencies" value="1" <?=isset($fields['currencies'])||isset($_POST['currencies'])||empty($fields)?'checked':'';?> /></td>
                </tr>-->
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="t10w">Written by Top 10 Writers</label></td>
                    <td><input type="checkbox" name="t10w" id="t10w" value="1" <?=isset($fields['t10w'])||isset($_POST['t10w'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="vipsupport">VIP support</label></td>
                    <td><input type="checkbox" name="vipsupport" id="vipsupport" value="1" <?=isset($fields['vipsupport'])||isset($_POST['vipsupport'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="english">English</label></td>
                    <td><input type="checkbox" name="english" id="english" value="1" <?=isset($fields['english'])||isset($_POST['english'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <!--<tr>
                	<td><label style="display:inline-block; width:100%;" for="desciption">Order description</label></td>
                    <td><input type="checkbox" name="desciption" id="desciption" value="1" <?=isset($fields['desciption'])||isset($_POST['desciption'])||empty($fields)?'checked':'';?> /></td>
                </tr>-->
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="couponcode">Get Discount</label></td>
                    <td><input type="checkbox" name="couponcode" id="couponcode" value="1" <?=isset($fields['couponcode'])||isset($_POST['couponcode'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="country">Country</label></td>
                    <td><input type="checkbox" name="country" id="country" value="1" <?=isset($fields['country'])||isset($_POST['country'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td><label style="display:inline-block; width:100%;" for="phone">Contact Phone #1</label></td>
                    <td><input type="checkbox" name="phone" id="phone" value="1" <?=isset($fields['phone'])||isset($_POST['phone'])||empty($fields)?'checked':'';?> /></td>
                </tr>
                
                <tr>
                	<td>&nbsp;</td>
                    <td>
                    	<input type="hidden" name="task" value="admin.save_fields" />
                        <input type="submit" class="btn btn-primary" value="Save Changes" />
                    </td>
                </tr>
                
            </tbody>
        </table>
        </form>
    </div>
</div>

