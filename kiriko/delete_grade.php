<?php
require_once('auth.php');
// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
 include 'includes/functions.php';
  
if (isset($_POST['oldsubject'])) {  // Check if selections were made

$oldsubject = $_POST['oldsubject'];  // Retrieve POST data
$oldminv = $_POST['oldminv']; 
$oldmaxv = $_POST['oldmaxv']; 
$oldgrade = $_POST['oldgrade']; 
$oldform = $_POST['oldform']; 

 $sql = "delete from tblgrades where subject='$oldsubject' and minv='$oldminv' and maxv='$oldmaxv' and grade='$oldgrade' and form='$oldform'";
$result= mysql_query( $sql);

 if(!$result){
		die('Invalid query: ' . mysql_error());
		}else{
		echo "<script language=javascript>alert('Grade Has Been Deleted');</script>";
		
		$func = new Functions();
	$activity = "Deleted Grade ".$oldgrade. " $oldform with minv $oldminv and maxv $oldmaxv fro class $oldform";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);
		?>
		<script language=javascript>window.location='grades_view.php'</script>
		<?php
		}
		


}

?>