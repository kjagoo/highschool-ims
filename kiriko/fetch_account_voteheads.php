<?php
	include("includes/dbconnector.php");
	$selected = $_GET['q'];
	if($selected=='Parents'){
		$table='finance_voteheads';
	}elseif($selected=='Operations'){
		$table='finance_operationalvoteheads';
	}elseif($selected=='Tution'){
		$table='finance_tuitionvoteheads';
	}else{
		$table='finance_voteheads';
	}
$curryear=date("Y");	
?>


    <select name="t_type" id="t_type" class="select" tabindex="1" required />
	<option value="" selected="selected"> --Select Debited Votehead--</option>
    <?php   
		 
       $sqlquly = "select * from $table where fiscal_year='$curryear'"; 
			$getStd1 = mysql_query($sqlquly);
			  while ($rowstudenc= mysql_fetch_array($getStd1 )) {
				?>
    <option value="<?php echo str_replace(" ","_",$rowstudenc['votehead'])?>"><?php echo str_replace("_"," ",$rowstudenc['votehead'])?></option>
    <?php 
	} 
	?>
    </select>
  

