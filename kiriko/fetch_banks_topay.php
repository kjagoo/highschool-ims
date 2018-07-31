<?php
	include("includes/dbconnector.php");
	$selected = $_GET['q'];
if($selected=='Cheque' ||$selected=='EFT' || $selected=="Mobile_Money_Mpesa" || $selected=="Cash" || $selected=="Direct Deposit"  ){	
?>

    <select name="bank" id="bank" class="select" tabindex="1" required />
    
    <?php
    if($selected=="Mobile_Money_Mpesa"){
	$sqlquly = "select * from bank_accounts where bank_name like'%paybill%'";
    }else{
       $sqlquly = "select * from bank_accounts"; 
    }
	$getStd1 = mysql_query($sqlquly);
	while ($rowstudenc= mysql_fetch_array($getStd1 )) {
	?>
    <option value="<?php echo str_replace(" ","_",$rowstudenc['account_number'])?>"><?php echo str_replace("_"," ",$rowstudenc['bank_name'])?></option>
    <?php 
	} 
	?>
    </select>
  
<?php
}else{
    
  
?>
    <div class="form-group" style="display:none">
         <label class="control-label col-lg-3">Bank Account:</label>
         <div class="col-sm-8">
            <input type="hidden" name="bank" id="bank" class="select" tabindex="1" value="-"  />
        </div>
    </div>

<?php
    
    
    
    
}
?>