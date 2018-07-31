<?php
/* 
 DELETE.PHP
*/
 // connect to the database
 require_once('auth.php');
include('includes/dbconnector.php');
 include 'includes/functions.php';
 
 if ($_GET['id']){
 
 $id = $_GET['id'];
 $form= $_GET['form'];
 
  $update="update studentdetails set form='$form' where admno='$id'";
 	mysql_query($update);
	
	$updatept="update tbleperformancetrack set s_status='0' where admno='$id'";
 mysql_query($updatept);
 
 
 	mysql_query("DELETE FROM transfers WHERE admno=$id");

	$func = new Functions();
	$activity = "Restored ".$id." From Deletion";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

 

 
 

 }

 
?>