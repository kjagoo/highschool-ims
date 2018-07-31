<?php
 require_once('auth.php'); 
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
require_once("includes/dbconnector.php");
$func = new Functions();


	if(isset($_POST['comment']) && isset($_POST['userid'])){
	
	$admno=$_POST['userid'];
	$datebooked=date("Y-m-d H:m:s");
	$comments=$_POST['comment'];
	
	
	
	$qury="insert into tbldispline (admno,comments,comment_by,date_added) values ('$admno','$comments','$username','$datebooked')";
	$resultq = mysql_query($qury);
		if(!$resultq){
		die('Invalid query: ' . mysql_error());
		}else{
	$activity = "Added a Discipline record to ".$admno;
	$func->addAuditTrail($activity,$username);
	echo "<script language=javascript>alert('Record added successfully') </script>";
		 echo "<script language=javascript>window.location='displine.php' </script>";
	}
	
}
	?>
   