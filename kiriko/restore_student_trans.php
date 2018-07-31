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
 
 
 	$res=mysql_query("DELETE FROM transfers WHERE admno=$id");
if(!$res){

}else{
echo "<script language=javascript>alert('Student Have Been Restored') </script>";
		 echo "<script language=javascript>window.location='student_transfers.php' </script>";
	}	 
		 
	$func = new Functions();
	$activity = "Restored ".$id." From Deletion";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

 

 
 

 }

 
?>