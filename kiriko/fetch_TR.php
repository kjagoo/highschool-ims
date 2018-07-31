<?php
include("includes/dbconnector.php"); 
$q = str_replace("_"," ",$_GET['q']);
$re=1280;
	if($q=="New"){
	$result = mysql_query("select * from tbl_hr_reliefs where type='New'");
	}else{
	$result = mysql_query("select * from tbl_hr_reliefs where type='Old'");
	}
	while($row = mysql_fetch_array($result)){
		$re=$row['amount'];
	}
?>
	<input type="number" name="incometaxpersonalrelief" class="demoInputBox"  required   value='<?php echo $re?>' style="font-size:14px; font-weight:bold;" />	
	


