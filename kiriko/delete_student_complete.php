<?php

// This is a sample code in case you wish to check the username from a mysql db table
include("includes/dbconnector.php");
 include 'includes/functions.php';
  require_once('auth.php');
  
if($_GET['id']){
$id=$_GET['id'];

  	$update="delete from studentdetails where admno='$id'";
 	mysql_query($update);
	$res=mysql_query("DELETE FROM transfers WHERE admno=$id");
 
 if(!$res){

}else{
echo "<script language=javascript>alert('Student Have Been Deleted Completely') </script>";
		 echo "<script language=javascript>window.location='student_transfers.php' </script>";
	}
	
$func = new Functions();
	$activity = "deleted ".$id ."to completely";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

}

?>