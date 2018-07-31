<?php
	include("includes/dbconnector.php");
	
?>


    <select name="bank" id="bank" class="select" tabindex="1" required />
	<option value="" selected="selected"> --Select Bank--</option>
    <?php   
		 
       $sqlquly = "select * from bank_accounts"; 
			$getStd1 = mysql_query($sqlquly);
			  while ($rowstudenc= mysql_fetch_array($getStd1 )) {
				?>
    <option value="<?php echo str_replace(" ","_",$rowstudenc['account_number'])?>"><?php echo str_replace("_"," ",$rowstudenc['bank_name'])?></option>
    <?php 
	} 
	?>
    </select>
  

