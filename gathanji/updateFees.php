<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Update Fees";
$func->addAuditTrail($activity,$username);
	if(isset($_POST['amount']) ){
	require_once("includes/dbconnector.php");
	
	
	$votehead=$_POST['vote'];
	$amount=$_POST['amount'];
	$yr=$_POST['year'];
	$trm=$_POST['term'];
	$frm=$_POST['form'];
	
	
	$qury="update finance_fees set amount='$amount' where votehead='$votehead' and fiscal_yr='$yr' and term='$trm' and form='$frm'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Updated Votehead Amount ".$votehead;
	$func->addAuditTrail($activity,$username);
	
	 ?>
	
	<script language=javascript>alert('Fees Votehead Update Successfull') </script>
	
	<script language=javascript>window.location='finance_view_fees.php?year=<?php echo $yr?>&form=<?php echo $frm?>&term=<?php echo $trm?>'; </script>
	
	<?php
	}
	}
	
?>  